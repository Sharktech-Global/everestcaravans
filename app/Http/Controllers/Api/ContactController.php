<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\SendEmail;
use App\Location;
use App\Mail\ContactMail;
use App\QuickEnquiry;
use App\PageContactUs;
use App\Contact;
use App\Dealership;
use App\EOutlet;
use Illuminate\Support\Facades\Validator;
use App\Vehicle;
use App\Area;
use App\Admin;
use App\VehicleType;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;

    use SEOToolsTrait;

   
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'message' => 'nullable',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);
       
        $enquiry = new Contact;
        $enquiry->name = $request->name;
        $enquiry->email =$request->email;
        $enquiry->phone =$request->phone;
        if($request->message){
            $enquiry->message = $request->message;
        }
        $res = $enquiry->save();
        if ($res) {
            $data['Name'] = $enquiry->name;
            $data['Email'] = $enquiry->email;
            $data['Phone'] = $enquiry->phone;
            $data['Message'] = $enquiry->message;
            $admin = Admin::first();
            Mail::to($admin->email)->send(new ContactMail($admin, $data));
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        } else {
            return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $data], $this->failedStatus);
        }
    }
    
}
