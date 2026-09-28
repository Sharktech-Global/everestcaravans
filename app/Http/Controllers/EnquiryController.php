<?php

namespace App\Http\Controllers;

use App\VehicleEnquiry;
use App\Helpers\SendEmail;
use App\Location;
use App\Vehicle;
use App\Notifications\EnquiryAdminNotification;
use App\Notifications\EnquiryNotification;
use Illuminate\Support\Facades\Notification;
use App\QuickEnquiry;
use App\PageContactUs;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Admin;
use Illuminate\Support\Facades\Validator;

use App\VehicleType;

class EnquiryController extends Controller
{
    use SEOToolsTrait;

    public function show($slug)
    {
        $page = VehicleEnquiry::first();
        $vehicle = Vehicle::where('slug', $slug)->first();
        $vehicles_list = Vehicle::where('status', 1)->get();
        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo_title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo_title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        $locations = Location::where('status', 1)->get();

        return view('vehicle_enquiry', compact('vehicle', 'locations', 'vehicles_list'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'vehicle_id' => 'required',
            'location_id' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            if ($request->popup == 1) {
                $specificFunctionError = true;
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()->with('specificFunctionError', @$specificFunctionError);
            } else {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->withFragment('enquiryFont');
            }
        }


        $enquiry = new VehicleEnquiry();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->vehicle_id = $request->vehicle_id;
        $enquiry->location_id = $request->location_id;
        $enquiry->message = $request->message;
        $res = $enquiry->save();
        $vehicle = Vehicle::where('id', $request->vehicle_id)->firstorFail();
        $location = Location::where('id', $request->location_id)->firstorFail();

        if ($res) {
            $admin = Admin::where('email','agm.cvpass@abrecomotors.com')->first();
            // $admin = Admin::first();
            $details['vehicle'] = $vehicle->name;
            $details['name'] = $request->name;
            $details['email'] = $request->email;
            $details['phone'] = $request->phone;
            $details['vehicle_name'] = $vehicle->name;
            $details['location_name'] = $location->name;
            $details['message'] = $request->message;
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new EnquiryAdminNotification($details));
            Notification::route('mail', $details['email'])->notify(new EnquiryNotification($details));
            return redirect('thank-you');
            // return redirect()->back()->with('success', 'Submitted Sucessfully');
        } else {
            return redirect()->back()->with('error', 'Failed to contact us. Please try again.');
        }
        return redirect()->route('checkout', $vehicle->slug);
    }
}
