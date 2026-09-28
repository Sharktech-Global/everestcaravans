<?php

namespace App\Http\Controllers;

use App\Booking;
use App\FederalPayment;
use App\Helpers\SendEmail;
use App\Services\Fedpay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FederalPaymentController extends Controller
{
    public function payment(Request $request)
    {
        if ($request->session()->has('booking-data')) {
            $session = $request->session()->get('booking-data');
            $booking = Booking::find($session->id);
            $actionurl = config('federal.url');
            $user_code = config('federal.user_code');
            $pass_code = config('federal.pass_code');
            $hash_code = config('federal.hash_code');
            $charge_code = config('federal.charge_code');
            $order_amount = sprintf("%.2f", $booking->vehicle->booking_amount);
            $erp_code = $booking->location->erp_code;
            $fedpay = new Fedpay(array(
                'user_code' => $user_code,
                'pass_code' => $pass_code,
                'hash_key' => $hash_code,
                'tran_id'  => $booking->booking_id,
                'amount' => $order_amount,
                'charge_code' => $charge_code,
            ));
            $data['action'] = $actionurl;
            $data['user_code'] = $fedpay['user_code'];
            $data['pass_code'] = $fedpay['pass_code'];
            $data['hash_value'] = $fedpay['hash_value'];
            $data['tran_id'] = $fedpay['tran_id'];
            $data['amount'] = $fedpay['amount'];
            $data['charge_code'] = $fedpay['charge_code'];
            $data['erp_code'] = $erp_code;
            $data['returnUrl'] = route('federal.status');
            $request->session()->put('popular_tran_id', $fedpay['tran_id']);
            return view('payment.federal', compact('data'));
        } else {
            return redirect()->route('booking.index');
        }
    }

    public function status(Request $request)
    {
        if ($request->session()->has('booking-data')) {
            $session = $request->session()->get('booking-data');
            $booking = Booking::find($session->id);
            $post = $request->post();
            if (isset($post['Tran_status']) && strtoupper($post['Tran_status']) == 'S') {
                $tran_id = $request->session()->get('popular_tran_id');
                if ($post['tran_id'] == $tran_id) {
                    $payment = new FederalPayment();
                    $payment->payable_id = $booking->id;
                    $payment->txnid = $tran_id;
                    $payment->firstname = $booking->first_name;
                    $payment->lastname = $booking->last_name;
                    $payment->email = $booking->email;
                    $payment->phone = $booking->phone;
                    $payment->amount = $post['amount'] / 100;
                    $payment->data = json_encode($post);
                    $payment->status = 1;
                    $res = $payment->save();
                    if ($res) {
                        SendEmail::booking($booking);
                        return redirect()->route('checkout.success', $booking->vehicle->slug)->with('booking-success', 'Booking Successful');
                    } else {
                        notify()->error("Failed to capture payment", 'Payment Failed');
                        return redirect()->route('checkout', $booking->vehicle->slug);
                    }
                } else {
                    notify()->error("Invalid or Forged Transaction", 'Payment Failed');
                    return redirect()->route('checkout', $booking->vehicle->slug);
                }
            } else {
                notify()->error("Federal Bank Response - Failed Transaction", 'Payment Failed');
                return redirect()->route('checkout', $booking->vehicle->slug);
            }
        } else {
            return redirect()->route('booking.index');
        }
    }
}
