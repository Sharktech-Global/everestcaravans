<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Booking;
use Session;
use Exception;

class RazorpayPaymentController extends Controller
{
  /**
     * Write code on Method
     *
     * @return response()
     */
     public function index(Request $request)
    {       
        if ($request->session()->has('booking-data')) {
            $session = $request->session()->get('booking-data');
            $booking = Booking::find($session->id);
            // Create an object of razorpay
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            // In razorpay you have to convert rupees into paise we multiply by 100
            // Currency will be INR
            // Creating order
            $order = $api->order->create(array(
                'receipt' => $session->id,
                'amount' => $booking->vehicle->booking_amount * 100,
                'currency' => 'INR'
                )
            );
            // Return response on payment page
            $attributes = [
                'orderId' => $order['id'],
                'amount' => $booking->vehicle->booking_amount * 100,
                'currency' => 'INR',
                'name' => config('app.name'),
                'description' => 'Payment for '.$booking->vehicle->name,
                'productinfo' => "Booking - {$booking->vehicle->name}",
                'firstname' => $booking->first_name,
                'email' => $booking->email,
                'phone' => $booking->phone,
            ];
            // Let's checkout payment page is it working
            // dd($booking);
            return view('razorpayView',compact('attributes','booking'));
        } else {
            return redirect()->back();
        } 
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
  
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        
        if($response->status == "captured"){
            $session = $request->session()->get('booking-data');
            $booking = Booking::find($session->id);
            $booking->status = "success" ;
            $booking->save();
        }
        else{
            $session = $request->session()->get('booking-data');
            $booking = Booking::find($session->id);
            $booking->status = "failure" ;
            $booking->save();
        }
        // Session::put('success', 'Payment successful');
        return redirect()->route('razorpay.payment.success')->with('booking-success', 'Booking Successful');
    }
    public function success(Request $request)
    {
        $request->session()->forget(['booking-data', 'vehicle-data', 'location']);
        return view('payment_success');
    }
}
