<?php

namespace App\Http\Controllers;

use App\TestDriveEnquiry;
use App\Vehicle;
use App\VehicleType;
use App\Fuel;
use App\Admin;
use App\Location;
use App\Notifications\BookingTestAdminNotification;
use App\Notifications\BookingTestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Area;

class BookingTestController extends Controller
{
    use SEOToolsTrait;

    public function index()
    {
        $page = TestDriveEnquiry::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo_title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo_title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        $locations=Location::where('status',1)->orderBy('order','ASC')->get();
        return view('booking_test',compact('locations'));
    }

   

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'vehicle_id' => 'required',
            'location_id' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $enquiry = new TestDriveEnquiry();
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
            $admin = Admin::where('email','info@everestcaravans.com.au')->first();
            // $admin = Admin::first();
            $details['name'] = $request->name;
            $details['email'] = $request->email;
            $details['phone'] = $request->phone;
            $details['message'] =$request->message;
            $details['vehicle_name'] = $vehicle->name;
            $details['location_name'] = $location->name;
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new BookingTestAdminNotification($details));
            Notification::route('mail', $details['email'])->notify(new BookingTestNotification($details));
            return redirect('thank-you');
            // return redirect()->back()->with('success', 'Submitted Sucessfully');
        } else {
            return redirect()->back()->with('error', 'Failed to contact us. Please try again.');
        }
        return redirect()->route('checkout', $vehicle->slug);
    }

    
}
