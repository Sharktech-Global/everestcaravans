<?php

namespace App\Http\Controllers;

use App\BuyUsedCarPage;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use Validator;
use App\Setting;
use App\Location;
use App\UsedcarEnquiry;
use App\Helpers\SendOTP;

class UsedCarController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = BuyUsedCarPage::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);

        $locations = Location::where('status', 1)->orderBy('name')->get();
        return view('used-car.show', ['locations' => $locations, 'page' => $page]);
    }
    public function sent_otp_usedcar(Request $request)
    {
        if ($request->ajax()) {
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $validated = Validator::make($request->all(), [
                'model' => 'required',
                'year' => 'required',
                'name' => 'required|string',
                'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
                'location' => 'required',
                'g-recaptcha-response' => 'required|captcha'
            ]);
            if ($validated->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validated->errors()->all()
                ]);
            }
            $enquiry = new UsedcarEnquiry;
            $enquiry->name = $request->name;
            $enquiry->phone = $request->phone;
            $enquiry->model = $request->model;
            $enquiry->form_name = 'Used Car';
            $enquiry->page_name = $actual_link;
            $enquiry->year = $request->year;
            $enquiry->location_id = $request->location;
            $enquiry->status = 0;
            $res = $enquiry->save();
            if ($res) {
                $otp = Setting::getOtp(6);
                //code for sending otp
                return SendOTP::send('usedcar',$enquiry,$enquiry->phone,$otp);
            }
        }
    }
}
