<?php

namespace App\Http\Controllers;

use App\Helpers\SendEmail;
use App\Location;
use App\Mail\ContactMail;
use App\QuickEnquiry;
use App\PageContactUs;
use App\Contact;
use App\Dealership;
use App\EOutlet;
use Illuminate\Support\Facades\Validator;
use App\Vehicle;
use App\Area;
use App\Admin;
use App\ContactUs;
use App\Notifications\ContactNotification;
use App\Notifications\ContactusNotification;
use App\Setting;
use App\Seo;
use App\VehicleType;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $caravanTypes = VehicleType::where('status', 1)
    ->orderBy('name')
    ->get(['id', 'name']);
        $settings = Setting::get();
        $page= Seo::where('route_name','contact')->first();
        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo_title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo_title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        // dd($vehicles);
        return view('contact', compact('caravanTypes', 'page'));
    }

    
public function store(Request $request)
{
    // Step 1: Validate Everest Caravans form fields
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:30',
        'suburb' => 'nullable|string|max:255',
        'state' => 'nullable|in:ACT,NSW,NT,QLD,SA,TAS,VIC,WA',
        'vehicle_name' => 'nullable|string|max:255',
        'message' => 'nullable|string',
        'g-recaptcha-response' => 'required|captcha',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->withFragment('fotcont');
    }

    $validated = $validator->validated();

    // Step 2: Save enquiry to database
    $enquiry = new ContactUs();

    $enquiry->name = $validated['name'];
    $enquiry->email = $validated['email'];
    $enquiry->phone = $validated['phone'];
    $enquiry->suburb = $validated['suburb'] ?? null;
    $enquiry->state = $validated['state'] ?? null;
    $enquiry->vehicle_name = $validated['vehicle_name'] ?? null;
    $enquiry->query_type = null;
    $enquiry->message = $validated['message'] ?? null;

    $enquiry->save();

    // Step 3: Prepare notification details
    $details = [
        'name' => $enquiry->name,
        'email' => $enquiry->email,
        'phone' => $enquiry->phone,
        'suburb' => $enquiry->suburb,
        'state' => $enquiry->state,
        'vehicle_name' => $enquiry->vehicle_name,
        'query_type' => null,
        'message' => $enquiry->message,
        'admin_name' => 'Everest Caravans Team',
    ];

    // Step 4: Send email to Everest Caravans admin
    $adminEmail = config('mail.everest_contact_to');

    try {
        if (!empty($adminEmail)) {
            Notification::route('mail', $adminEmail)
                ->notify(new ContactNotification($details));
        }

        // Step 5: Send acknowledgement to customer
        Notification::route('mail', $enquiry->email)
            ->notify(new ContactusNotification($details));

    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error(
            'Everest contact notification failed',
            [
                'enquiry_id' => $enquiry->id,
                'error' => $e->getMessage(),
            ]
        );
    }

    // Step 6: Redirect to thank-you page
    return redirect('thank-you');
}

}
