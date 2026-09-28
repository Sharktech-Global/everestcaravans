<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Career;
use App\Country;
use App\CareerEnquiry;
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
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['careers'] = Career::where('status', 1)->orderBy('title')->get();
        // return $data['careers'];

        if ($data['careers']->isNotEmpty()) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
        // return response()->json(['status'=>'ok'],$this->successStatus);
    }

    public function store(Request $request)
    {
        // $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $validated = $request->validate([
            'career_id' => 'required|string|max:255',
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'educational_qualification' => 'required',
            'cv' => 'required|mimes:pdf|max:10000',
            'form_name' =>'nullable',
            'page_name' =>'nullable',
            'refer' =>'nullable',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);
        $enquiry = new CareerEnquiry;
        $enquiry->career_id = $validated['career_id'];
        $enquiry->name = $validated['name'];
        $enquiry->email = $validated['email'];
        $enquiry->phone = $validated['phone'];
        $enquiry->form_name = $validated['form_name'];
        $enquiry->page_name = $validated['page_name'];
        $enquiry->refer = $validated['refer'];
        $enquiry->educational_qualification = $validated['educational_qualification'];
        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->storeAs(
                'upload/career/cv',
                urlencode(time()) . '_' . $request->cv->getClientOriginalName(),
                'public'
            );
            $enquiry->cv = $path;
        }
        $res = $enquiry->save();
        // $career = Career::find($enquiry->career_id);
        // if ($res) {
        //     $data['Job'] = $enquiry->career->title;
        //     $data['Name'] = $enquiry->name;
        //     $data['Email'] = $enquiry->email;
        //     $data['Phone'] = $enquiry->phone;
        //     $data['Qualification'] = $enquiry->educational_qualification;
        //     $data['to_emails'] = $career->email;
        //     $data['cv'] = $enquiry->cv;
        //     SendEmail::career('Career Enquiry from ' . $enquiry->name, $data);
        //     return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        // } else {
        //     return response()->json(['code' => 404, 'message' => 'Failed to submit data', 'data' => $data], $this->failedStatus);
        // }
    }
}
