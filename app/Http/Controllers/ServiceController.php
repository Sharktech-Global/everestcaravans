<?php

namespace App\Http\Controllers;

use App\BookServiceOnline;
use App\Vehicle;
use App\Location;
use App\ServiceType;
use App\ServiceEnquiry;
use App\Setting;
use App\Seo;
use App\State;
use Illuminate\Support\Facades\Validator;
use App\Service;
use App\AddPage;
use App\Admin;
use App\Area;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use App\Notifications\ServiceNotification;
use App\Notifications\ServiceUserNotification;
use App\Notifications\ServiceLocationNotification;
use App\ServiceContent;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ServiceController extends Controller
{
    use SEOToolsTrait;


    public function index(){
        $services = Service::where('status',1)->orderBy('order','ASC')->get();
        $settings = Setting::first();
        $seo = Seo::where('route_name','services')->first();

        $this->seo()->setTitle(@$seo->seo_title);
        $this->seo()->setDescription(@$seo->seo_description);
        SEOMeta::setKeywords([@$seo->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$seo->seo->title);
        $this->seo()->opengraph()->setDescription(@$seo->seo_description);
        $this->seo()->twitter()->setTitle(@$seo->seo->title);
        $this->seo()->twitter()->setDescription(@$seo->seo_description);
        return view('services.index',compact('services','settings'));
    }
    public function show($slug)
    {
        // dd($content);
        $service = Service::where('slug',$slug)->first();
        $content= ServiceContent::where('service_id',$service->id)->where('status',1)->get();
        $locations=Location::where('status',1)->orderBy('order','ASC')->get();
        $this->seo()->setTitle(@$service->seo_title);
        $this->seo()->setDescription(@$service->seo_description);
        SEOMeta::setKeywords([@$service->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$service->seo_title);
        $this->seo()->opengraph()->setDescription(@$service->seo_description);
        $this->seo()->twitter()->setTitle(@$service->seo_title);
        $this->seo()->twitter()->setDescription(@$service->seo_description);

        return view('services.show',compact('service','content','locations'));
    }

    public function store(Request $request)
    {
        
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|min:10',
            'model' => 'required|string|max:255',
            'location_id' => 'required',
            'message' => 'nullable',
            'date' => 'nullable|date|after_or_equal:' . date('d-m-Y'),
            'service_name' => 'required|string|max:255',
            'g-recaptcha-response' => 'required|captcha'
        ]);  
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('all_service_form');
            }
        $enquiry = new ServiceEnquiry;
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        if($request->message){
            $enquiry->message =$request->message;
        }
        if($request->date){
            $enquiry->date = date("Y-m-d", strtotime($request->date));
        }
        $enquiry->form_name = 'Service';
        $enquiry->location_id = $request->location_id;
        $enquiry->page_name = $actual_link;
        if($request->service_name){
            $enquiry->service_name = $request->service_name;
        }
        $enquiry->model = $request->model;
      
        $res = $enquiry->save();
    
        if ($res) {
            $admin = Admin::first();
            $serve=$enquiry->service_name;
            $location=$enquiry->location_id;
            $locationemail=Location::where('id',$location)->first();
            // $servicesname=Service::where('id',$serve)->first();
            $details['date'] = "";
            $details['message']=$request->message;
            $details['location']= $locationemail->email;
            $details['locationname']=$locationemail->name;
            $details['servename']=$request->service_name;
            $details['model']=$request->model;
            $details['name'] = $request->name;
            $details['email'] = $request->email;
            if($request->date){
                $details['date'] = $request->date;
            }
            $details['phone'] = $request->phone;
            $details['form_name'] = 'Service';
            $details['page_name'] =$request->actual_link;
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new ServiceNotification($details));
            Notification::route('mail',$details['location'])->notify(new ServiceLocationNotification($details));
            Notification::route('mail', $details['email'])->notify(new ServiceUserNotification($details));
            // return redirect()->back()->with('success', 'Your enquiry was successfull. We will get back to you soon');
            return redirect()->route('thank-you');
           // return Redirect::to(URL::previous() . "#service-booking")->with('success', 'Your enquiry was successful. We will get back to you soon');
           

        } else {
            return Redirect::to(URL::previous() . "#all_service_form")->with('error', 'Your enquiry was not successful. Please try again.');
        }
    }
}
