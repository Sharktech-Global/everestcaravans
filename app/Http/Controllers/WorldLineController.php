<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Vehicle;
use App\Payment;
use Helper;
use App\Notifications\PaymentNotification;
use App\Notifications\PaymentThankyouNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;

class WorldLineController extends Controller
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
            $amount = $booking->vehicle->booking_amount * 100;
            $id = $session->id;
            $route = route('worldline.payment.response', $id);
            $response = processFederalPayment($id, $amount, $route);
            // $str = '';
            // $length = 25;
            // $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            // $count = strlen($charset);
            // while ($length--) {
            //     $str .= $charset[mt_rand(0, $count - 1)];
            // }

            // $obj = new AWLMEAPI;
            // $reqMsgDTO = new ReqMsgDTO();
            // $reqMsgDTO->setOrderId($str);
            // $reqMsgDTO->setMid(config('federal.merchant_id'));
            // $reqMsgDTO->setTrnAmt((int) $amount);
            // $reqMsgDTO->setTrnCurrency("INR");
            // $reqMsgDTO->setMeTransReqType("S");
            // $reqMsgDTO->setEnckey(config('federal.encryption_key'));
            // $reqMsgDTO->setResponseUrl($route);
            // $reqMsgDTO->setTrnRemarks("VSSKerala registration payment");
            // $reqMsgDTO->setAddField1($id);
            // $reqMsgDTO->setAddField2("");
            // $reqMsgDTO->setAddField3("");
            // $reqMsgDTO->setAddField4("");
            // $reqMsgDTO->setAddField5("");
            // $reqMsgDTO->setAddField6("");
            // $reqMsgDTO->setAddField7("");
            // $reqMsgDTO->setAddField8("");
            // $reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
            // if (config('federal.live_active')) {
            //     $action_url = config('federal.action_urls.live');
            // } else {
            //     $action_url = config('federal.action_urls.test');
            // }
            $action_url = $response['action_url'];
            $reqMsgDTO = $response['reqMsgDTO'];
            
            $merchantRequest = "";
            if ($reqMsgDTO->getStatusDesc() == "Success") {
                // $request->session()->put('admin_uuid', $admin_uuid);
                $merchantRequest = $reqMsgDTO->getReqMsg();
            }
            // Return response on payment page
            $attributes = [
                'amount' => $booking->vehicle->booking_amount * 100,
                'currency' => 'INR',
                'name' => config('app.name'),
                'description' => 'Payment for ' . $booking->vehicle->name,
                'productinfo' => "Booking - {$booking->vehicle->name}",
                'firstname' => $booking->first_name,
                'email' => $booking->email,
                'phone' => $booking->phone,
            ];
            // Creating order
            return view('payment.payment_page', ['booking' => $booking, 'attributes' => $attributes, 'reqMsgDTO' => $reqMsgDTO, 'merchantRequest' => $merchantRequest, 'action_url' => $action_url]);
        }
        // dd($response['action_url']);


        else {
            return redirect()->back();
        }
    }

    function generateTrnReqMsg($reqMsgDTO)
    { //echo $reqMsgDTO; die;


        if ($reqMsgDTO->getAddField10() == "") {
            $reqMsgDTO->setAddField10("NA");
        }

        if ($reqMsgDTO->getAddField9() == "") {
            $reqMsgDTO->setAddField9("NA");
        }

        try {

            if (
                $reqMsgDTO->getMid() == ""
                || $reqMsgDTO->getOrderId() == ""
                || $reqMsgDTO->getTrnAmt() == ""
                || $reqMsgDTO->getMeTransReqType() == ""
                || $reqMsgDTO->getEnckey() == ""
                || $reqMsgDTO->getResponseUrl() == ""
                || $reqMsgDTO->getTrnCurrency() == ""
            ) {
                $reqMsgDTO->setStatusDesc("Mandatory fields are missing");
                return $reqMsgDTO;
            }
            if (!(($reqMsgDTO->getMeTransReqType() == "R") || ($reqMsgDTO->getMeTransReqType() == "P") || ($reqMsgDTO->getMeTransReqType() == "S"))) {
                $reqMsgDTO->setStatusDesc("Mandatory fields are missing");
                return $reqMsgDTO;
            }
            if (($reqMsgDTO->getMeTransReqType() == "R")
                && ($reqMsgDTO->getRecurrPeriod() == ""
                    || $reqMsgDTO->getRecurrDay() == ""
                    || $reqMsgDTO->getNoOfRecurring() == "")
            ) {

                $reqMsgDTO->setStatusDesc("Mandatory fields are missing for recurring payment");
                return $reqMsgDTO;
            }



            $merchantReqStr = $reqMsgDTO->getMid()     . "|" . $reqMsgDTO->getOrderId()   . "|" . $reqMsgDTO->getTrnAmt()
                . "|" . $reqMsgDTO->getTrnCurrency()     . "|" . $reqMsgDTO->getTrnRemarks()  . "|" . $reqMsgDTO->getMeTransReqType()
                . "|" . $reqMsgDTO->getRecurrPeriod()    . "|" . $reqMsgDTO->getRecurrDay()   . "|" . $reqMsgDTO->getNoOfRecurring()
                . "|" . $reqMsgDTO->getResponseUrl()     . "|" . $reqMsgDTO->getAddField1()   . "|" . $reqMsgDTO->getAddField2()
                . "|" . $reqMsgDTO->getAddField3()       . "|" . $reqMsgDTO->getAddField4()   . "|" . $reqMsgDTO->getAddField5()
                . "|" . $reqMsgDTO->getAddField6()       . "|" . $reqMsgDTO->getAddField7()   . "|" . $reqMsgDTO->getAddField8()
                . "|" . $reqMsgDTO->getAddField9()       . "|" . $reqMsgDTO->getAddField10();

            $vTransactSecurity = new VTransactSecurity();
            $enc_data = $vTransactSecurity->encryptValue($merchantReqStr, $reqMsgDTO->getEnckey());

            $reqMsgDTO->setReqMsg($enc_data);
            $reqMsgDTO->setStatusDesc("Success");
        } catch (Exception $ex) {
            $reqMsgDTO->setStatusDesc("Error Occured during Creating request message");
            throw new Exception($ex->getMessage());
        }
        return $reqMsgDTO;
    }
    public function response(Request $request, $uuid)
    {
        $response = requestFederalPayment($request->post('merchantResponse'));
        $session = $request->session()->get('booking-data');
        if(!$response->getTrnAmt()){
            return redirect()->route('worldline.payment.index')->with('error', 'Something wrong. Please try again.');
        }
        if (isset($session)) {
            $amount =  ($response->getTrnAmt()) / 100;
            $booking = Booking::with('vehicle','location')->find($session->id);
            $vehicle= Vehicle::where('id',$booking->vehicle_id)->first();
            $phone=  $booking->phone;
            $email=  $booking->email;
            $name=$booking->first_name;
            if($response->getStatusCode() == "S") {
                $payment = new Payment();
                $payment->account = "Federal Bank";
                $payment->payable_id =  $booking->id;
                $payment->payable_type = "App\Admin";
                $payment->txnid = $response->getOrderId();
                $payment->mihpayid = $response->getPgMeTrnRefNo();
                $payment->firstname = $name;
                $payment->email = $email;
                $payment->phone =  $phone;
                $payment->amount =  $amount;
                $payment->discount = "0";
                $payment->net_amount_debit = $amount;
                $payment->data = $response->getAddField10();
                $payment->status = "Completed";
                $payment->unmappedstatus = "captured";
                $payment->mode = $response->getAddField9();
                $payment->save();
            $booking->status = "success" ;
            $booking->save();
            $request->session()->forget('booking-data');

            $details['name'] = @$name;
            $details['email'] = @$email;
            $details['number'] = @$phone;
            $details['amount'] = @$amount;
            $details['vehicle'] = @$booking->vehicle->name;
            $details['booking_id'] = @$booking->booking_id;
            $details['txnid'] = @$payment->txnid;
            $details['location'] = @$booking->location->name;
            $details['date'] = @$booking->created_at;
            // Notification::route('mail', 'info@everestcaravans.com.au')->notify(new ContactNotification($details));
            Notification::route('mail', 'divin.netventure@gmail.com')->notify(new PaymentNotification($details));
            Notification::route('mail', $email)->notify(new PaymentThankyouNotification($details));
            return redirect()->route('worldline.payment.success')->with('booking-success', 'Booking Successful');

            } elseif ($response->getStatusCode() == "F") {
                $booking->status = "failure" ;
                $booking->save();
                return redirect()->route('booking.show', @$vehicle->slug)->with('error', 'Something wrong. Please try again.');
                // ->route('admin.renewals.renew')->with('error', 'Something wrong. Please try again.');

            }
        }
        else{
            return redirect()->route('booking.index')->with('error', 'Something wrong. Please try again.');
        }
        
    }
    public function success(Request $request)
    {
        $request->session()->forget(['booking-data', 'vehicle-data', 'location']);
        return view('payment_success');
    }
}
