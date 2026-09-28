<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Location;
use App\Helpers\SendOTP;
use App\SubscriptionEnquiry;
use Validator;
use App\Setting;
use App\Helpers\SendEmail;
use App\SubscribePage;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class SubscribeController extends Controller
{
    use SEOToolsTrait;
    public function show()
    {
        $page = SubscribePage::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        $areas = Area::where('status',1)->get();
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();

        return view('subscribe',['areas_sales' => $areas_sales, 'areas' => $areas, 'locations' => $locations,'page' => $page]);
    }
    public function sent_otp_subscribe(Request $request)
    {
        // if ($request->ajax()) {
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $validated = Validator::make($request->all(), [
                'model' => 'required',
                'name' => 'required|string',
                'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
                'location' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);
            if ($validated->fails()) {
                return redirect()->back()->withErrors($validated)->withInput();
            }
            $area = Area::find($request->location);
            $enquiry = new SubscriptionEnquiry;
            $enquiry->name = $request->name;
            $enquiry->phone = $request->phone;
            $enquiry->form_name = 'Subscription';
            $enquiry->page_name = $actual_link;
            $enquiry->vehicle_id = $request->model;
            $enquiry->location_id = $area->location_id;
            $enquiry->status = 0;
            $res = $enquiry->save();
            if ($res) {
                $enquiry = SubscriptionEnquiry::find($enquiry->id);
                $enquiry->status = 1;
                $res = $enquiry->save();
                SendEmail::subscribe('Subscription Enquiry from ' . $enquiry->name, $enquiry, $enquiry->location_id);
                return Redirect::to(URL::previous() . "/#subscribe_mainform")->with('success', 'Your subscription was successful. We will get back to you soon');
                // $otp = Setting::getOtp(6);
                // return SendOTP::send('subscribe', $enquiry, $enquiry->phone, $otp);
            }
            else{
                return redirect()->back()->with('success', 'Your enquiry was not successful.  Please try again.');
            }
        // }
    }
}
