<?php

namespace App\Http\Controllers;

use App\ExitPopupEnquiry;
use App\Helpers\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class ExitPopupController extends Controller
{
    public function store(Request $request)
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $validated = $request->validate([
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'location' => 'required|min:3|string|max:255',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $enquiry = new ExitPopupEnquiry;
        $enquiry->name = $validated['name'];
        $enquiry->email = $validated['email'];
        $enquiry->phone = $validated['phone'];
        $enquiry->form_name = 'Exit Pop Up';
        $enquiry->page_name = $actual_link;
        $enquiry->location = $validated['location'];
        $res = $enquiry->save();
        if ($res) {
            $data['Name'] = $enquiry->name;
            $data['Email'] = $enquiry->email;
            $data['Phone'] = $enquiry->phone;
            $data['Location'] = $enquiry->location;
            SendEmail::send('Exit Popup Enquiry from ' . $enquiry->name, $data);
            return Redirect::to(URL::previous() . "#redirect")->with('success', 'Your enquiry was successful. We will get back to you soon');
        } else {
            return Redirect::to(URL::previous() . "#redirect")->with('error', 'Your enquiry was not successful. Please try again.');
        }
    }
}
