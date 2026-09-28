<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Career;
use App\CareerAbrecco;
use App\CareerPage;
use App\Seo;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Notifications\CareerAsNotification;
use App\Notifications\CareerNotification;
use App\Notifications\ContactusNotification;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CareersController extends Controller
{
    use SEOToolsTrait;
    public function show()
    {
        $page = CareerPage::first();
        $seo = Seo::where('route_name','careers')->first();

        $this->seo()->setTitle(@$seo->seo_title);
        $this->seo()->setDescription(@$seo->seo_description);
        SEOMeta::setKeywords([@$seo->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$seo->seo->title);
        $this->seo()->opengraph()->setDescription(@$seo->seo_description);
        $this->seo()->twitter()->setTitle(@$seo->seo->title);
        $this->seo()->twitter()->setDescription(@$seo->seo_description);

        $vehicles = Vehicle::where('status', 1)->get();
        $careers = Career::where('status', 1)->get();
        // dd($careers);
        return view('career', compact('vehicles', 'careers', 'page'));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|min:3|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'nullable|numeric',
            'vehicle_name' => 'nullable',
            'career_type' => 'nullable',
            'query_type' => 'nullable',
            'message' => 'nullable',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'g-recaptcha-response' => 'required|captcha'
        ], [
            'cv.max' => 'The cv may not be greater than 2 mb.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('my-form-request-id');
        }

        $enquiry = new CareerAbrecco();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->vehicle_name = $request->vehicle_name;
        $enquiry->career_type = $request->career_type;
        $enquiry->query_type = $request->query_type;
        $enquiry->message = $request->message;
      
        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->storeAs('media/career/file', $request->file('cv')->getClientOriginalName(), 'public');
            $enquiry->cv = $path;
        
            
        }
        // dd($request);my-form-request-id
        $res = $enquiry->save();

        if ($res) {
            $admin = Admin::where('email','vimal@abrecomotors.com')->first();
            $careersname=Career::where('id',$request->career_type)->first();
            $details['position']=$careersname->title;
            $details['cv']=$enquiry->cv;
            $details['message']=$request->message;
            $details['name'] = $request->name;
            $details['email'] = $request->email;
            $details['phone'] = $request->phone;
            $details['vehicle_name'] = $request->vehicle_name;
            $details['query_type'] = $request->query_type;
            $details['admin_name'] = $admin->name;
            Notification::send($admin, new CareerNotification($details));
            Notification::route('mail', $details['email'])->notify(new CareerAsNotification($details));
            // return redirect()->back()->with('success', 'Submitted Sucessfully');
            return redirect('thank-you');
        } else {
            return redirect()->back()->with('error', 'Failed to contact us. Please try again.');
        }
    }
}
