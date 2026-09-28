<?php

namespace App\Http\Controllers;

use App\Booking;
use App\CodPayment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\SendEmail;

class CodController extends Controller
{
    public function payment(Request $request)
    {
        if ($request->session()->has('booking-data')) {
            $session = $request->session()->get('booking-data');
            $booking = Booking::find($session->id);
            $cod = new CodPayment;
            $cod->booking_id = $booking->id;
            $cod->txnid = strtoupper(Str::random(15));
            $cod->amount = $booking->vehicle->booking_amount;
            $cod->status = 1;
            $cod->save();
            // SendEmail::booking($booking);
            return redirect()->route('checkout.success', $booking->vehicle->slug)->with('booking-success', 'Booking Successful');
        } else {
            return redirect()->route('home');
        }
    }
}
