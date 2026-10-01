<?php

namespace App\Http\Controllers;

use App\AddPage;
use App\Vehicle;
use App\HomeEnquiry;
use App\TalkToCEO;
use App\Announcement;
use App\GeneralSetting;
use App\HomeSlider;
use App\Blog;
use App\AboutGroup;
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
use App\VehicleApplication;
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
use App\ServiceProduct;
use App\VehicleType;
use App\SubscriptionEnquiry;
use App\CounterList;
use App\Finance;
use App\ImageCategory;
use App\Service;
use App\Gallery;
use App\Seo;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    use SEOToolsTrait;

    public function index()
    {
        $home_settings = Seo::where('route_name','home')->first();

        $this->seo()->setTitle(@$home_settings->seo_title);
        $this->seo()->setDescription(@$home_settings->seo_description);
        SEOMeta::setKeywords([@$home_settings->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$home_settings->seo_title);
        $this->seo()->opengraph()->setDescription(@$home_settings->seo_description);
        $this->seo()->twitter()->setTitle(@$home_settings->seo_title);
        $this->seo()->twitter()->setDescription(@$home_settings->seo_description);

        $sliders = HomeSlider::select('id','sub_title', 'title', 'vehicle_id', 'description', 'image', 'booking', 'status')->where('status', 1)->get();
        // $vehicle_slider =VehicleSlider::select('id','type','order_id','name','slug','logo','description','image','vehicle_id','booking','status')->whereStatus(1)->get();
        $vehicles = Vehicle::select('id', 'name', 'slug', 'vehicle_type_id', 'application_id','title','image','is_booking','booking_amount')
                                                ->with(['vehicle_type' => function ($query) {
                                                    $query->select('name','slug','image','order','status')->where('status', 1);
                                                }])
                                                ->where('status', 1)->orderBy('order','ASC')->get();
        $testimonials = Testimonial::latest()->take(5)->get();
        $blogs = Blog::where('status',1)->latest()->take(4)->get();    
        $group = AboutGroup::first();
        $about_section = Section::where('order',1)->first();
        $counters = CounterList::get();
        $services = Service::where('status',1)->orderBy('order','ASC')->get();
        $products = ServiceProduct::where('status',1)->get();
        $galleries = Gallery::take(8)->get();
        $blogs = Blog::where('status',1)->get();
        return view('home',compact('galleries','blogs','products','services','counters','home_settings','sliders','vehicles','testimonials','blogs','group','about_section'));
    }

  

    public function vehicle_search(Request $request)
    {
        if ($request) {
            if ($request->type) {
                $vehicle_application_name="";
                $vehicle_type_name="";
                $vehicle_type = $request->type;
                $vehicle_list = Vehicle::where('vehicle_type_id', $vehicle_type)->orderBy('order','ASC')->where('status',1);
                $Vtype=VehicleType::where('id',$vehicle_type)->first();
                $this->seo()->setTitle(@$Vtype->seo_title);
                $this->seo()->setDescription(@$Vtype->seo_description);
                SEOMeta::setKeywords([@$Vtype->seo_keywords]);
                $this->seo()->opengraph()->setTitle(@$Vtype->seo_title);
                $this->seo()->opengraph()->setDescription(@$Vtype->seo_description);
                $this->seo()->twitter()->setTitle(@$Vtype->seo_title);
                $this->seo()->twitter()->setDescription(@$Vtype->seo_description);     
                $application_list=VehicleApplication::where('vehicle_type_id',$vehicle_type)->where('status', 1)->whereIn('id', function($query) {
                                $query->select('application_id')
                                    ->from('vehicles');
                            })->get();
                if ($request->vehicleApplications !== NULL) {
                    // dd($request->vehicleApplications);
                    $vehicle_application = $request->vehicleApplications;
                    $vehicle_list = $vehicle_list->where('application_id', $vehicle_application);
                    $vehicle_application_name=VehicleApplication::select('name','id')->where('id',$vehicle_application)->first();
                   
                }
                $vehicle_list = $vehicle_list->get();
                return view('vehicles.index', compact('vehicle_list','Vtype','vehicle_application_name','application_list'));
            }
        }
    }

    public function vehicle_type($type = null)
    {
        $Vtype =  VehicleType::whereStatus(1)->where('slug',$type)->first();
        $vehicle_application_name="";
        $application_list = collect();
        $vehicle_list = Vehicle::orderBy('order','ASC')->where('status',1);
        if ($type && $Vtype) {
            $vehicle_type = $type;
            $vehicle_list = $vehicle_list->where('vehicle_type_id', $Vtype->id);
            $application_list=VehicleApplication::where('vehicle_type_id',$Vtype->id)->where('status', 1)->whereIn('id', function($query) {
                $query->select('application_id')
                    ->from('vehicles');
            })->get(); 
            $this->seo()->setTitle(@$Vtype->seo_title);
            $this->seo()->setDescription(@$Vtype->seo_description);
            SEOMeta::setKeywords([@$Vtype->seo_keywords]);
            $this->seo()->opengraph()->setTitle(@$Vtype->seo_title);
            $this->seo()->opengraph()->setDescription(@$Vtype->seo_description);
            $this->seo()->twitter()->setTitle(@$Vtype->seo_title);
            $this->seo()->twitter()->setDescription(@$Vtype->seo_description);            
        }
        $vehicle_list = $vehicle_list->get();
        return view('vehicles.index', compact('vehicle_list','Vtype','vehicle_application_name','application_list'));
    }

    public function createslugfromvalue(Request $request)
    {
        $customValue = $request->input('customValue');
        $Vtype =  VehicleType::whereStatus(1)->where('slug',$customValue)->first();
        if($Vtype){
            $newUrl = route('vehicle_type', $Vtype->slug);        
            return $newUrl;
        }
       
    }
    public function thankyou(Request $request)
    {
        $status = $request->session()->get('status');
        // if ($status == "1") {
            return view('thankyou');
        // } else {
        //     return abort(404);
        // }
    }

    public function finance()
    {

        // $finances = Finance::with('category')->get();
        $image = ImageCategory::with('finance')->get();
        $locations=Location::where('status',1)->get();
        // dd($image);
        $service = Service::where('slug','financial-services')->first();
        $this->seo()->setTitle(@$service->seo_title);
        $this->seo()->setDescription(@$service->seo_description);
        SEOMeta::setKeywords([@$service->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$service->seo_title);
        $this->seo()->opengraph()->setDescription(@$service->seo_description);
        $this->seo()->twitter()->setTitle(@$service->seo_title);
        $this->seo()->twitter()->setDescription(@$service->seo_description);
        return view('finance',compact('image','locations','service'));
       
    }
}
