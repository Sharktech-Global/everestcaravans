<?php

namespace App\Http\Controllers;

use App\Location;
use App\ServiceProduct;
use App\ServiceProductEnquiry;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use App\ServiceProductContent;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ServiceProductEnquiryController extends Controller
{
    use SEOToolsTrait;

    public function show(Request $request)
    {
        $service_content = ServiceProductContent::first();

        $this->seo()->setTitle(@$service_content->seo_title);
        $this->seo()->setDescription(@$service_content->seo_description);
        SEOMeta::setKeywords([@$service_content->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$service_content->seo_title);
        $this->seo()->opengraph()->setDescription(@$service_content->seo_description);
        $this->seo()->twitter()->setTitle(@$service_content->seo_title);
        $this->seo()->twitter()->setDescription(@$service_content->seo_description);

        $products = ServiceProduct::where('status', 1)->orderBy('name')->get();
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $req = ServiceProduct::where('status', 1)->where('slug', $request->product)->first();
        $service_content = ServiceProductContent::first();
        return view('service-products-enquiry.show', ['products' => $products, 'locations' => $locations, 'req' => $req, 'service_content' => $service_content]);
    }

    public function store(Request $request)
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $validated = $request->validate([
            'service_product' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'location' => 'required|string|max:255',
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $enquiry = new ServiceProductEnquiry;
        $enquiry->service_product_id = $validated['service_product'];
        $enquiry->details = $validated['details'];
        $enquiry->name = $validated['name'];
        $enquiry->form_name = 'Service Product';
        $enquiry->page_name = $actual_link;
        $enquiry->email = $validated['email'];
        $enquiry->phone = $validated['phone'];
        $enquiry->location_id = $validated['location'];
        $res = $enquiry->save();
        if ($res) {
            $data['Service Product'] = $enquiry->service_product->name;
            $data['Details'] = $enquiry->details;
            $data['Name'] = $enquiry->name;
            $data['Email'] = $enquiry->email;
            $data['Phone'] = $enquiry->phone;
            $data['Location'] = $enquiry->location->name;
            SendEmail::send('Service Product Enquiry from ' . $enquiry->name, $data, $enquiry->location_id);
            // return redirect()->back()->with('success', 'Your enquiry was successfull. We will get back to you soon');
            return Redirect::to(URL::previous() . "#contact")->with('success', 'Your enquiry was successful. We will get back to you soon');

        } else {
            return redirect()->back()->with('error', 'Your enquiry was not successful. Please try again.');
        }
    }
}
