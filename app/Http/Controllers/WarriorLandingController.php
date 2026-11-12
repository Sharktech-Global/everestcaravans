<?php

namespace App\Http\Controllers;

use App\Notifications\WarriorEnquiryNotification;
use App\WarriorEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WarriorLandingController extends Controller
{
    public function show()
    {
        return view('landing.warrior');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',

            // Australian numbers, written any of the usual ways:
            // 0412 345 678, (03) 9357 9440, +61 412 345 678
            'phone' => ['required', 'string', 'max:30', 'regex:/^(\+?61[\s-]?|0)[2-57-8]([\s-]?\d){8}$/'],

            'postcode' => ['required', 'regex:/^[0-9]{4}$/'],

            'preferred_model'    => ['required', Rule::in(['19.5', '21.5', 'both'])],
            'purchase_timeframe' => ['required', Rule::in([
                'Within 3 months', '3 to 6 months', '6 to 12 months', 'Just researching',
            ])],
            'enquiry_type' => ['required', Rule::in([
                'Pricing', 'Specifications', 'Factory inspection',
            ])],

            'g-recaptcha-response' => 'required|captcha',
        ], [
            'phone.regex'    => 'Please enter a valid Australian phone number.',
            'postcode.regex' => 'Please enter a 4-digit Australian postcode.',
        ]);

        if ($validator->fails()) {
            // Send them back to the form itself, not the top of a long page
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('enquire');
        }

        $data = $validator->validated();

        $enquiry = WarriorEnquiry::create([
            'name'               => $data['name'],
            'email'              => $data['email'],
            'phone'              => $data['phone'],
            'postcode'           => $data['postcode'],
            'preferred_model'    => $data['preferred_model'],
            'purchase_timeframe' => $data['purchase_timeframe'],
            'enquiry_type'       => $data['enquiry_type'],
            'source_url'         => $request->fullUrl(),
        ]);

        Log::info('Warrior landing enquiry saved', [
            'warrior_enquiry_id' => $enquiry->id,
        ]);

        $details = $enquiry->toArray();
        $details['preferred_model'] = $enquiry->modelLabel();

        try {
            Notification::route('mail', config('mail.everest_contact_to'))
                ->notify(new WarriorEnquiryNotification($details));

        } catch (\Throwable $e) {
            // A failed email must not lose the lead — it is already saved
            Log::error('Warrior landing notification failed', [
                'warrior_enquiry_id' => $enquiry->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('warrior-landing.show')
            ->with('warrior_success', true)
            ->withFragment('enquire');
    }
}
