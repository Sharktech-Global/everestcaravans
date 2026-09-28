<?php

namespace App\Http\Controllers;

use App\TalkToCEO;
use App\AboutPage;
use App\Location;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use App\Helpers\SendOTP;
use App\Setting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class TalkToCEOController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = AboutPage::first();

        $this->seo()->setTitle('Talk To CEO');
        $this->seo()->setDescription('Talk To CEO');
        SEOMeta::setKeywords(['Talk To CEO']);
        $this->seo()->opengraph()->setTitle('Talk To CEO');
        $this->seo()->opengraph()->setDescription('Talk To CEO');
        $this->seo()->twitter()->setTitle('Talk To CEO');
        $this->seo()->twitter()->setDescription('Talk To CEO');
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $refer = request()->headers->get('referer');        
        return view('talktoCEO',['page' => $page,'locations' => $locations,'refer' => $refer]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'location' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $result = new TalkToCEO;
        $result->name = $validated['name'];
        $result->email = $validated['email'];
        $result->phone = $validated['phone'];
        $result->subject = $validated['subject'];
        $result->location_id = $validated['location'];
        $result->message = $validated['message'];
        $res = $result->save();
        if ($res) {
            $talkToCEO = TalkToCEO::find($result->id);
            $talkToCEO->status = 1;
            $res = $talkToCEO->save();
            SendEmail::talk('Request to contact CEO from ' . $talkToCEO->name, $talkToCEO, $talkToCEO->location_id);
            // $otp = Setting::getOtp(6);
            // return SendOTP::send('talktoceo', $result, $result->phone, $otp);
            return Redirect::to(URL::previous() . "/#service_mainform")->with('success', 'Your enquiry was successful.  We will get back to you soon.');
        }
        else{
            return redirect()->back()->with('success', 'Your enquiry was not successful.  Please try again.');
        }
    }
}
