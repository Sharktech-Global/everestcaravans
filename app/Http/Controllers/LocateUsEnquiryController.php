<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LocateUsEnquiry;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Area;
use App\Helpers\SendEmail;

class LocateUsEnquiryController extends Controller
{
    public function store(Request $request)
    {

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $validated = $request->validate([
            'service' => 'required|string',
            'name' => 'required|min:3|string|max:255',
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'location' => 'required'
        ]);
        $area = Area::find($request->location);
        $enquiry = new LocateUsEnquiry;
        $enquiry->service = $validated['service'];
        $enquiry->name = $validated['name'];
        $enquiry->form_name = 'Locate Us';
        $enquiry->page_name = $actual_link;
        $enquiry->phone = $validated['phone'];
        $enquiry->location_id = $area->location_id;
        $res = $enquiry->save();
        if ($res) {
            SendEmail::quick('Locate Us from ' . $enquiry->name, $enquiry, $enquiry->location_id);
            //return Redirect::to(URL::previous() . "#locate-us")->with('success_message', 'Your enquiry was successful. We will get back to you soon');
            return redirect()->route('network.show')->with('success_message', 'Your enquiry was successful. We will get back to you soon')->with('locationtab', $enquiry->service);
        } else {
            return redirect()->back()->with('error_message', 'Your enquiry was not successful. Please try again.');
        }
    }
}
