<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Location;
use App\TestDriveEnquiry;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use App\TestDrive;
use App\State;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Area;


class TestDriveController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = TestDrive::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);

        $vehicles = Vehicle::where('status', 1)->orderBy('name')->get();
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $states = State::where('status', 1)->get();
        $areas = Area::where('status',1)->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        return view('test-drive.show', ['areas_sales' => $areas_sales,'vehicles' => $vehicles, 'locations' => $locations, 'page' => $page,'states'=>$states,'areas'=>$areas]);
    }

    public function store(Request $request)
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $validated = $request->validate([
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'model' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'time_of_contact' => 'required|string|max:255',
            'address' => 'nullable',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $enquiry = new TestDriveEnquiry;
        $enquiry->name = $validated['name'];
        $enquiry->email = $validated['email'];
        $enquiry->phone = $validated['phone'];
        $enquiry->form_name = 'Subscription';
        $enquiry->page_name = $actual_link;
        $enquiry->vehicle_id = $validated['model'];
        $enquiry->location_id = $validated['location'];
        $enquiry->time_of_contact = $validated['time_of_contact'];
        $enquiry->address = $validated['address'];
        $res = $enquiry->save();
        if ($res) {
            $data['Name'] = $enquiry->name;
            $data['Email'] = $enquiry->email;
            $data['Phone'] = $enquiry->phone;
            $data['Model'] = $enquiry->vehicle->name;
            $data['Location'] = $enquiry->location->name;
            $data['Time of Contact'] = $enquiry->time_of_contact;
            $data['Address'] = $enquiry->address;
            SendEmail::send('Test Drive Enquiry from ' . $enquiry->name, $data, $enquiry->location_id);
            // return redirect()->back()->with('success', 'Your enquiry was successfull. We will get back to you soon');
            return Redirect::to(URL::previous() . "#contact")->with('success', 'Your enquiry was successful. We will get back to you soon');
        } else {
            return redirect()->back()->with('error', 'Your enquiry was not successful. Please try again.');
        }
    }

    public function test(){
        return view('emails.email_test');
    }
}
