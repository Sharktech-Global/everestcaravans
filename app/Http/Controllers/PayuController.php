<?php

namespace App\Http\Controllers;

use App\Booking;
use Tzsk\Payu\Facade\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\SendEmail;

class PayuController extends Controller
{
    public function payment(Request $request)
    {
        if ($request->session()->has('booking-data')) {
            $session = $request->session()->get('booking-data');
            $booking = Booking::find($session->id);
            $attributes = [
                'txnid' => strtoupper(Str::random(15)),
                'amount' => $booking->vehicle->booking_amount,
                'productinfo' => "Booking - {$booking->vehicle->name}",
                'firstname' => $booking->first_name,
                'email' => $booking->email,
                'phone' => $booking->phone,
            ];
            return Payment::with($booking)->make($attributes, function ($then) {
                $then->redirectRoute('payu.status');
            });
        } else {
            return redirect()->route('booking.index');
        }
    }
    public function status(Request $request)
    {
        if ($request->session()->has('booking-data')) {
            $payment = Payment::capture();
            $payment->fill([
                'payable_id' => $payment->payable_id,
                'payable_type' => 'App\Booking',
            ])->save();
            $booking = Booking::with('vehicle')->find($payment->payable_id);
            if ($payment->isCaptured()) {
                SendEmail::booking($booking);
                return redirect()->route('checkout.success', $booking->vehicle->slug)->with('booking-success', 'Booking Successful');
            } else {
                return redirect()->route('checkout', $booking->vehicle->slug);
            }
        } else {
            return redirect()->route('booking.index');
        }
    }
}
