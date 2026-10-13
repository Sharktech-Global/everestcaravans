<?php

namespace App\Http\Controllers;

use App\BookingEnquiry;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Notifications\BookingEnquiryNotification;
use App\Notifications\BookingEnquiryConfirmation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class BookingEnquiryController extends Controller
{
    public function store(Request $request, string $slug)
    {
        // Find the vehicle using its slug
        $vehicle = \App\Vehicle::where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'suburb' => 'required|string|max:255',
            'state' => [
                'required',
                \Illuminate\Validation\Rule::in([
                    'NSW', 'VIC', 'QLD', 'WA',
                    'SA', 'TAS', 'ACT', 'NT'
                ]),
            ],
            'postcode' => ['required', 'regex:/^[0-9]{4}$/'],
            'additional_details' => 'nullable|string|max:5000',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->to(url()->previous() . '#booking')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        unset($validated['g-recaptcha-response']);

        // Save enquiry to database
        $booking = \App\BookingEnquiry::create([
            ...$validated,
            'vehicle_id' => $vehicle->id,
            'vehicle_name' => $vehicle->name,
        ]);

        Log::info('Vehicle booking enquiry saved', [
            'booking_enquiry_id' => $booking->id,
        ]);

        $details = $booking->toArray();

        // Send admin and customer emails independently
        try {
            Notification::route(
                'mail',
                config('mail.everest_contact_to')
            )->notify(new BookingEnquiryNotification($details));

        } catch (\Throwable $e) {
            Log::error('Booking enquiry admin notification failed', [
                'booking_enquiry_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
        }

        try {
            Notification::route(
                'mail',
                $booking->email
            )->notify(new BookingEnquiryConfirmation($details));

        } catch (\Throwable $e) {
            Log::error('Booking enquiry customer confirmation failed', [
                'booking_enquiry_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect('/thank-you');
    }
}