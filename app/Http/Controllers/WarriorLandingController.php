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

    /**
     * The confirmation page.
     *
     * The live enquiry form on /warrior is a GoHighLevel embed, so set this
     * URL as the form's "On submit -> Redirect to URL" in GoHighLevel and
     * visitors land here. The native Laravel form in store() redirects here
     * too, so both paths end on the same page.
     */
    public function thankYou()
    {
        return view('landing.warrior-thank-you', [
            // The shared landing layout points its header and footer calls to
            // action at #enquire, which does not exist on this page. Send them
            // back to the form instead.
            'lpCtaHref' => route('warrior-landing.show') . '#enquire',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'preferred_model' => [
                'required',
                Rule::in([
                    '19.5',
                    '21.5',
                    'custom',
                    'compare_both',
                ]),
            ],

            'next_action' => [
                'required',
                Rule::in([
                    'Request pricing and specifications',
                    'Arrange a factory inspection',
                    'Speak with the sales team',
                ]),
            ],

            'purchase_timeframe' => [
                'required',
                Rule::in([
                    'As soon as possible',
                    'Within 3 months',
                    'Within 3–6 months',
                    '6+ months / still researching',
                ]),
            ],

            'location' => [
                'required',
                Rule::in([
                    'Victoria',
                    'NSW / ACT',
                    'Other Australian state or territory',
                ]),
            ],

            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',

            'postcode' => [
                'required',
                'regex:/^[0-9]{4}$/',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
                function ($attribute, $value, $fail) {
                    $number = preg_replace('/[\s()-]/', '', $value);

                    if (!preg_match('/^(?:\+61|61|0)[2-478]\d{8}$/', $number)) {
                        $fail('Please enter a valid Australian phone number.');
                    }
                },
            ],

            'whatsapp_number' => [
                'nullable',
                'string',
                'max:30',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        return;
                    }

                    $number = preg_replace('/[\s()-]/', '', $value);

                    if (!preg_match('/^(?:\+61|61|0)[2-478]\d{8}$/', $number)) {
                        $fail('Please enter a valid Australian WhatsApp number.');
                    }
                },
            ],

            'g-recaptcha-response' => 'required|captcha',
        ], [
            'preferred_model.required' => 'Please select a caravan.',
            'next_action.required' => 'Please select what you would like to do next.',
            'purchase_timeframe.required' => 'Please select your purchasing timeframe.',
            'location.required' => 'Please select where you are based.',
            'postcode.regex' => 'Please enter a valid 4-digit Australian postcode.',
            'phone.regex' => 'Please enter a valid Australian phone number.',
            'whatsapp_number.regex' => 'Please enter a valid Australian WhatsApp number.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('enquire');
        }

        $data = $validator->validated();

        $enquiry = WarriorEnquiry::create([
            'preferred_model' => $data['preferred_model'],
            'next_action' => $data['next_action'],
            'purchase_timeframe' => $data['purchase_timeframe'],
            'location' => $data['location'],
            'name' => $data['name'],
            'email' => $data['email'],
            'postcode' => $data['postcode'],
            'phone' => $data['phone'],
            'whatsapp_number' => $data['whatsapp_number'] ?? null,

            // Retain the existing column for compatibility.
            'enquiry_type' => $data['next_action'],

            'source_url' => $request->fullUrl(),
        ]);

        Log::info('Warrior enquiry saved', [
            'warrior_enquiry_id' => $enquiry->id,
        ]);

        $details = $enquiry->toArray();
        $details['preferred_model'] = $enquiry->modelLabel();

        try {
            $adminEmail = config('mail.everest_contact_to');

            if (!empty($adminEmail)) {
                Notification::route('mail', $adminEmail)
                    ->notify(new WarriorEnquiryNotification($details));
            }
        } catch (\Throwable $e) {
            Log::error('Warrior enquiry email failed', [
                'warrior_enquiry_id' => $enquiry->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('warrior-landing.thank-you')
            ->with('warrior_success', true);
    }
}