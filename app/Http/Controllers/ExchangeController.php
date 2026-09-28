<?php

namespace App\Http\Controllers;

use App\Condition;
use App\Emission;
use App\Location;
use App\Exchange;
use App\ExchangePage;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use Validator;
use App\Setting;
use App\Privacy;
use App\Helpers\SendOTP;
use App\Area;

class ExchangeController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = ExchangePage::first();
        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);

       
        return view('exchange.show', [ 'page' => $page]);
    }

    public function sent_otp_exchange(Request $request)
    {
        if ($request->ajax()) {
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
            $area = Area::find($request->location);
            $enquiry = new Exchange;
            $enquiry->name = $request->name;
            $enquiry->phone = $request->phone;
            $enquiry->model = $request->model;
            $enquiry->year = $request->year;
            $enquiry->location_id = $area->location_id;
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
