<?php

namespace App\Http\Controllers\Api;

use App\AddPage;
use App\Vehicle;
use App\HomeEnquiry;
use App\TalkToCEO;
use App\Announcement;
use App\GeneralSetting;
use App\HomeSlider;
use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use App\Location;
use App\Location_Content;
use App\Pages;
use App\HomeSettings;
use App\Marketing;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Validator;
use App\AboutPage;
use App\Testimonial;
use App\State;
use App\TestDriveEnquiry;
use App\VehicleEnquiry;
use App\InsuranceEnquiry;
use App\Country;
use App\ServiceType;
use App\ServiceEnquiry;
use App\QuickEnquiry;
use App\OfferEnquiry;
use App\NexaCar;
use App\Setting;
use App\Section;
use App\Mail\EnquiryTestDriveMail;
use App\VehicleSlider;
use App\Exchange;
use App\UsedcarEnquiry;
use App\Helpers\SendOTP;
use App\Area;
use App\Faq;
use App\VehicleType;
use App\SubscriptionEnquiry;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    use SEOToolsTrait;
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['settings'] = GeneralSetting::select('mobile','whatsapp','logo','favicon','instagram','youtube','facebook','map')->first();
        $data['sliders'] = HomeSlider::select('id','title','type','vehicle_id','description','image','booking','status')->where('status', 1)->get();
        $data['vehicle_slider'] =VehicleSlider::select('id','type','order_id','name','slug','logo','description','image','vehicle_id','booking','status')->whereStatus(1)->get();
        // $vehicles_filtered = Vehicle::whereStatus(1)->whereHas('vehicle_type', function ($q) {
        //     $q->where('has_sales_page', 0);
        // })->get();
        $data['vehicle_types'] = VehicleType::select('name','slug','image','order','status')
                                            ->with(['vehicles' => function ($query) {
                                                    $query->select('id', 'name', 'slug', 'vehicle_type_id', 'application_id','title','image','is_booking','booking_amount')->where('status', 1);
                                                }])
                                                ->where('status', 1)
                                                ->orderBy('order')
                                                ->get();
        $data['vehicles'] = Vehicle::select('id', 'name', 'slug', 'vehicle_type_id', 'application_id','title','image','is_booking','booking_amount')
                                                ->with(['vehicle_type' => function ($query) {
                                                    $query->select('name','slug','image','order','status')->where('status', 1);
                                                }])
                                                ->where('status', 1)->get();
        // $states = State::where('status', 1)->get();
        // $locations = Location::where('status', 1)->orderBy('name','asc')->get();
        // $countries = Country::get();
        $data['testimonials'] = Testimonial::select()->whereNull('url')->get();
        $data['$blogs'] = Blog::where('status',1)->latest()->take(4)->get();    

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   
    }

    public function general()
    {

        $data['general'] = GeneralSetting::select('mobile','whatsapp','logo','logo_secondary','favicon','facebook','instagram','youtube','map','popup','website_color','logo_third','logo_fourth')->first();
       
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }   


    public function section() 
    {
       // section 1
       $data['section_1'] = Section::with(['contents' => function ($query) {
                                $query->select('id', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('id', 'title','slug', 'description', 'image', 'background', 'thumbnail','link','order')
                            ->where('status', 1)
                            ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

    public function faq()
    {
        $data['faq'] = Faq::where('status',1)->get();
        // dd($data['faq']);

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }

}
