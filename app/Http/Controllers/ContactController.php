<?php

namespace App\Http\Controllers;

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
use App\ContactUs;
use App\Notifications\ContactNotification;
use App\Notifications\ContactusNotification;
use App\Setting;
use App\Seo;
use App\VehicleType;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $vehicles = Vehicle::where('status', 1)->get();
        $settings = Setting::get();
        $page= Seo::where('route_name','contact')->first();
        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo_title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo_title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        // dd($vehicles);
        return view('contact', compact('vehicles','page'));
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'vehicle_name' => 'required',
            'query_type' =>'nullable',
            'message' => 'nullable',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->withFragment('fotcont');
        }
        $enquiry = new ContactUs();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->vehicle_name = $request->vehicle_name;
        $enquiry->query_type = $request->query_type;
        $enquiry->message = $request->message;
        $res = $enquiry->save();

        if ($res) {
            $admin = Admin::where('email','agm.cvpass@abrecomotors.com')->first();
            // $admin = Admin::first();
            $details['name'] = $request->name;
            $details['email'] = $request->email;
            $details['phone'] = $request->phone;
            $details['vehicle_name'] = $request->vehicle_name;
            $details['query_type'] =$request->query_type;
            $details['message']=$request->message;
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new ContactNotification($details));
            Notification::route('mail', $details['email'])->notify(new ContactusNotification($details));
            // return redirect()->back()->with('success', 'Submitted Sucessfully');
            return redirect('thank-you');
        } else {
            return redirect()->back()->with('error', 'Failed to contact us. Please try again.');
        }
    }
}
