<?php

namespace App\Http\Controllers;

use App\DealershipPage;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Dealership;
use App\Vehicle;
use App\Location;
use App\LocationType;
use App\Area;
use App\Helpers\SendEmail;
use Validator;
use App\VehicleEnquiry;
use App\Setting;
use App\Helpers\SendOTP;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


use App\Brand;
use App\Network;
use App\NetworkBranch;
use App\MainNetwork;
class DealershipController extends Controller
{
    use SEOToolsTrait;

    public function all_locations()
    {

        // $locations = Location::where('status',1)->get();
        // if($locations->count() > 0){
        //     return view('dealership.all_locations1',['locations' => $locations]);
        // } else {
        //     return abort(404);
        // }
        $LocationTypes=LocationType::with('type')->orderBy('created_at')->get();
        if(isset($request->locationtab)){
            $locationtab = $request->locationtab;
        }else{
            $locationtab = NULL; 
        }
        $this->seo()->setTitle("Find Us - Abreco AUTOCARS PVT LTD Maruti Suzuki Car Dealers");
        $this->seo()->setDescription("Find the nearest Abreco AUTOCAR dealership near you without any hassle. Buy new Maruti Suzuki Car from your nearest Abreco AUTOCAR showroom today.");
        SEOMeta::setKeywords(["Find Us - Abreco AUTOCARS PVT LTD Maruti Suzuki Car Dealers"]);
        $this->seo()->opengraph()->setTitle("Find Us - Abreco AUTOCARS PVT LTD Maruti Suzuki Car Dealers");
        $this->seo()->opengraph()->setDescription("Find the nearest Abreco AUTOCAR dealership near you without any hassle. Buy new Maruti Suzuki Car from your nearest Abreco AUTOCAR showroom today.");
        $this->seo()->twitter()->setTitle("Find Us - Abreco AUTOCARS PVT LTD Maruti Suzuki Car Dealers");
        $this->seo()->twitter()->setDescription("Find the nearest Abreco AUTOCAR dealership near you without any hassle. Buy new Maruti Suzuki Car from your nearest Abreco AUTOCAR showroom today.");

        return view('dealership.all_locations', ['LocationTypes' => $LocationTypes]);

    }
    public function show($id)
    {
        $this->seo()->setTitle("Dealerships - Abreco AUTOCARS PVT LTD");
        $this->seo()->setDescription("Abreco AUTOCARS are looking for new entrepreneurs who are willing to join the expansion od Abreco AUTOCARS PVT LTD");
        SEOMeta::setKeywords(["Dealerships - Abreco AUTOCARS PVT LTD"]);
        $this->seo()->opengraph()->setTitle("Dealerships - Abreco AUTOCARS PVT LTD");
        $this->seo()->opengraph()->setDescription("Abreco AUTOCARS are looking for new entrepreneurs who are willing to join the expansion od Abreco AUTOCARS PVT LTD");
        $this->seo()->twitter()->setTitle("Dealerships - Abreco AUTOCARS PVT LTD");
        $this->seo()->twitter()->setDescription("Abreco AUTOCARS are looking for new entrepreneurs who are willing to join the expansion od Abreco AUTOCARS PVT LTD");

        $vehicles = Vehicle::whereStatus(1)->with('vehicle_type')->get();
        $location = Location::where('slug',$id)->where('status',1)->first();
        $area = Area::where('name',$location->name)->first();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        if($location){
            return view('dealership.show',['areas_sales'=>$areas_sales,'vehicles' => $vehicles,'location' => $location,'area'=> $area]);
        } else {
            return abort(404);
        }

    }
    public function sent_otp_getintouch_location(Request $request)
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
                return response()->json([
                    'status' => false,
                    'message' => $validated->errors()->all()
                ]);
            }
            
            $area = Area::find($request->location);
            $enquiry = new VehicleEnquiry;
            $enquiry->name = $request->name;
            $enquiry->phone = $request->phone;
            $enquiry->vehicle_id = $request->model;
            $enquiry->form_name = 'Dealership Enquiry';
            if($request->formPageName){
                $formPageName = env('APP_URL').$request->formPageName;
            }
            else{
                $formPageName = "Dealership";
            }
            $enquiry->page_name = ( $formPageName) ? $formPageName : "Dealership";
            $enquiry->location_id = $area->location_id;
            $enquiry->status = 1;
            $res = $enquiry->save();
            if ($res) {
                SendEmail::buynewcar('Buy New Car Enquiry from ' . $enquiry->name, $enquiry, $enquiry->location_id);
                return redirect('thank-you')->with('status','1')->with('success', 'Your enquiry was successful.  We will get back to you soon.');
            }
            else{
                return redirect()->back()->with('success', 'Your enquiry was not successful.  Please try again.');
            }
            // }
        // }
    }
}
