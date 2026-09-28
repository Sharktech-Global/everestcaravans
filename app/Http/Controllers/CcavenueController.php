<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Vehicle;
use App\Payment;
use Helper;
use App\ccavenue\cavRequestHandler;
use App\Notifications\PaymentNotification;
use App\Notifications\PaymentThankyouNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Http;

class CcavenueController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        return view('ccavenue.ccavRequestHandler');
    }
    function initiatePaymentRequest($requestData) {
        // Access request data as needed
        $postData = $requestData->all();
       
        // Your payment request logic here
        // You can use $postData to access form fields sent via POST
       }
    public function response(Request $request)
    {
      
        $slug = $request->session()->get('slug-data');
        // dd($slug);
        //  return view('ccavenue.ccavResponseHandler',compact('slug'));
        // dd($slug);
        error_reporting(0);
        
        // $workingKey='4591A342C9B00199D927970038116060';		//Working Key should be provided here.
        $workingKey='06C5566552E469E01561F97954CBB8F9';		//Working Key should be provided here.
        $encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
        $rcvdString=dpgdecrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
        $order_status="";
        $decryptValues=explode('&', $rcvdString);
        $dataSize=sizeof($decryptValues);
        $order_details=[];
        for($i = 0; $i < $dataSize; $i++) 
        {
            $information=explode('=',$decryptValues[$i]);
            if($i==3)	$order_status=$information[1];
            $order_details[$i][$information[0]]=$information[1];

        }
        $booking_data=$request->session()->get('booking-data');
        if($booking_data){
            // dd($order_details);
            $booking = Booking::with('vehicle','location')->find($booking_data->id);
            // dd($booking_data);
            $tracking_id=Payment::where('txnid',$order_details[1]['tracking_id'])->first();
            if($tracking_id){
                return redirect()->route('checkout.failure', $slug);
            }
            $payment = new Payment();
            $payment->account = "CC Avenue";
            $payment->payable_id =  @$order_details[0]['order_id'];
            $payment->payable_type = "App\Admin";
            if(@$order_details[1]['tracking_id']){
            $payment->txnid = @$order_details[1]['tracking_id'];
            }else{ 
            $payment->txnid ='NIL' ;
            }
            $payment->mihpayid =$booking_data->id;
            $payment->firstname = $booking_data->first_name;
            $payment->email = $booking_data->email;
            $payment->phone =  $booking_data->phone;
            $payment->amount =  @$booking->amount;
            $payment->discount = "0";
            $payment->net_amount_debit = @$booking_data->amount;
            $payment->data = "status code = ".@$order_details[7]['status_code']." status_message = ".@$order_details[8]['status_message'];
            $payment->unmappedstatus = "captured";
            $payment->mode = @$order_details[5]['payment_mode'];
            
        
            if(@$order_details[10]['amount'] != $booking_data->amount){
                $payment->status = "Failure";
                $payment->save();
                $booking->status = "failure";
                $booking->save();
                return redirect()->route('checkout.failure', $slug);
            }
            if($order_status ==="Success")
            {
                $payment->status = $order_status;
                $payment->save();
                $booking->status = $order_status ;
                $booking->save();
                // $request->session()->forget('booking-data');
                return redirect()->route('checkout.success', $payment->id);
                
            }
            else
            {
                $payment->status = "Failure";
                $payment->save();
                $booking->status = "failure";
                $booking->save();
                return redirect()->route('checkout.failure', $slug);
            
            }
        }
        else
        {
            return redirect()->route('checkout.failure', $slug);
        
        }

        // return view('ccavenue.ccavResponseHandler',compact('slug'));
    }


   
    public function success(Request $request)
    {
        
        $request->session()->forget(['booking-data', 'vehicle-data', 'location']);
        return view('payment_success');
    }
}
