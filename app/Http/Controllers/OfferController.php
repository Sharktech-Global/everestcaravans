<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Location;
use App\LocationType;
use App\OfferEnquiry;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use App\Offer;
use App\OfferDetail;
use App\State;
use App\Setting;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Helpers\SendOTP;
use App\Area;

class OfferController extends Controller
{
    use SEOToolsTrait;

    public function show($slug)
    {
        $refer = request()->headers->get('referer');
        $offer = Offer::first();
        $this->seo()->setTitle(@$offer->seo_title);
        $this->seo()->setDescription(@$offer->seo_description);
        SEOMeta::setKeywords([@$offer->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$offer->seo_title);
        $this->seo()->opengraph()->setDescription(@$offer->seo_description);
        $this->seo()->twitter()->setTitle(@$offer->seo_title);
        $this->seo()->twitter()->setDescription(@$offer->seo_description);

        $vehicles = Vehicle::where('status', 1)->orderBy('name')->get();
        $locations = Location::where('status', 1)->orderBy('name')->get();
        if($slug == 'kerala-offers') {
            $offerdetails = OfferDetail::where('slug',$slug)->where('status', 1)->get();
        }
        if($slug == 'chennai-offers') {
            $offerdetails = OfferDetail::where('slug',$slug)->where('status', 1)->get();
        }
        $location_type = LocationType::where('name','Offer')->first();
        $areas = Area::where('status',1)->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        //$locations = Location::where('location_type_id',$location_type->id)->get();
        return view('offers.show', ['areas_sales' => $areas_sales, 'vehicles' => $vehicles, 'locations' => $locations,
        'offer' => $offer,'offerdetails' => $offerdetails,'locations' => $locations,'areas' => $areas,'refer' => $refer]);
    }

    public function sent_otp_offer(Request $request)
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $validated = Validator::make($request->all(), [
            'model' => 'required',
            'name' => 'required|string',
            'mobile' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'location' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validated->errors()->all()
            ]);
        }
        $area = Area::find($request->location);
        $enquiry = new OfferEnquiry;
        $enquiry->model = json_encode($request->model);
        $enquiry->name = $request->name;
        $enquiry->form_name = 'Offer';
        $enquiry->page_name = $actual_link;
        $enquiry->phone = $request->mobile;
        $enquiry->location_id = $area->location_id;
        $enquiry->status = 0;
        if($request->refer !== ''){
            $refer = $request->refer;
        }
        if($refer){
            $enquiry->refer = $refer;
        }
        $res = $enquiry->save();
        if ($res) {
            $enquiry = OfferEnquiry::find($enquiry->id);
            $enquiry->status = 1;
            $res = $enquiry->save();
            SendEmail::offer('Offer Enquiry from ' . $enquiry->name, $enquiry, $enquiry->location_id);
            return Redirect::to(URL::previous())->with('success', 'Your enquiry was successful. We will get back to you soon');
            // $otp = Setting::getOtp(6);
            // return SendOTP::send('usedcar',$enquiry,$enquiry->phone,$otp);
        }
        else{
            return redirect()->back()->with('success', 'Your enquiry was not successful.  Please try again.');
        }
    }
}
