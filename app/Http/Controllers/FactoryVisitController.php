<?php

namespace App\Http\Controllers;

use App\FactoryVisit;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\VehicleType;
use App\Notifications\FactoryVisitNotification;
use App\Notifications\FactoryVisitConfirmation;
use Illuminate\Support\Facades\Notification;

class FactoryVisitController extends Controller
{
    public function show()
    {
        $caravanTypes = VehicleType::where('status', 1)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('factory-visit', compact('caravanTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',

            'visit_date' => 'required|date|after_or_equal:today',
            'visit_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^\d{2}:\d{2}$/', $value)) {
                        return;
                    }

                    [$hour, $minute] = array_map('intval', explode(':', $value));

                    if (
                        $value < '09:00' ||
                        $value > '14:00' ||
                        !in_array($minute, [0, 15, 30, 45], true)
                    ) {
                        $fail('Please select a valid factory visit time.');
                    }
                },
            ],
            'suburb' => 'required|string|max:255',
            'state' => 'required|in:ACT,NSW,NT,QLD,SA,TAS,VIC,WA',
            'postcode' => 'required|digits:4',

            'vehicle_name' => 'required|string|max:255',
            'additional_requirements' => 'nullable|string|max:5000',

            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('factory-visit-form');
        }

        $data = $validator->validated();

        $visit = FactoryVisit::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'visit_date' => $data['visit_date'],
            'visit_time' => $data['visit_time'],
            'suburb' => $data['suburb'],
            'state' => $data['state'],
            'postcode' => $data['postcode'],
            'vehicle_name' => $data['vehicle_name'],
            'additional_requirements' => $data['additional_requirements'] ?? null,
        ]);

        
        Log::info('Factory visit enquiry saved', [
            'factory_visit_id' => $visit->id,
        ]);

        $details = $visit->toArray();

        $details['visit_date'] = $visit->visit_date->format('d-m-Y');
        $details['visit_time'] = date('g:i A', strtotime($visit->visit_time));

        try {
            // Administrator notification
            Notification::route(
                'mail',
                config('mail.everest_contact_to')
            )->notify(new FactoryVisitNotification($details));

            // Customer acknowledgement
            Notification::route(
                'mail',
                $visit->email
            )->notify(new FactoryVisitConfirmation($details));

        } catch (\Throwable $e) {

            Log::error('Factory visit notification failed', [
                'factory_visit_id' => $visit->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect('/thank-you');

    }
}
