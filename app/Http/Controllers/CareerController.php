<?php

namespace App\Http\Controllers;

use App\Career;
use App\Country;
use App\CareerEnquiry;
use App\Seo;
use App\CareerPage;
use App\PageContactUs;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Helpers\SendEmail;


class CareerController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = Seo::where('route_name','careers')->first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);

        $careers = Career::where('status', 1)->orderBy('title')->get();
        $countries = Country::orderBy('name')->get();
        return view('career', ['careers' => $careers, 'countries' => $countries]);
    }

    // public function store(Request $request)
    // {
    //     $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    //     $validated = $request->validate([
    //         'career' => 'required|string|max:255',
    //         'name' => 'required|min:3|string|max:255',
    //         'email' => 'required|string|email|max:255',
    //         'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
    //         'educational_qualification' => 'required',
    //         'cv' => 'required|mimes:pdf|max:10000',
    //         'g-recaptcha-response' => 'required|captcha'
    //     ]);
    //     $enquiry = new CareerEnquiry;
    //     $enquiry->career_id = $validated['career'];
    //     $enquiry->name = $validated['name'];
    //     $enquiry->email = $validated['email'];
    //     $enquiry->phone = $validated['phone'];
    //     $enquiry->form_name = 'Career';
    //     $enquiry->page_name = $actual_link;
    //     $enquiry->educational_qualification = $validated['educational_qualification'];
    //     if ($request->hasFile('cv')) {
    //         $path = $request->file('cv')->storeAs(
    //             'upload/career/cv',
    //             urlencode(time()) . '_' . $request->cv->getClientOriginalName(),
    //             'public'
    //         );
    //         $enquiry->cv = $path;
    //     }
    //     $res = $enquiry->save();
    //     $career = Career::find($enquiry->career_id);
    //     if ($res) {
    //         $data['Job'] = $enquiry->career->title;
    //         $data['Name'] = $enquiry->name;
    //         $data['Email'] = $enquiry->email;
    //         $data['Phone'] = $enquiry->phone;
    //         $data['Qualification'] = $enquiry->educational_qualification;
    //         $data['to_emails'] = $career->email;
    //         $data['cv'] = $enquiry->cv;
    //         SendEmail::career('Career Enquiry from ' . $enquiry->name, $data);
    //         return redirect('thank-you')->with('status','1')->with('success', 'Your enquiry was successful.  We will get back to you soon.');
    //     } else {
    //         return Redirect::to(URL::previous() . "#career_mainform")->with('error', 'Your enquiry was not successful. Please try again.');
    //     }
    // }
    // public function change(Request $request){
    //     $careers = Career::where('status', 1)->orderBy('title')->get();
    //     $career=Career::where('id',$request->id)->first();
    //     return response()->json(['careers'=> $careers]);
    // }
}
