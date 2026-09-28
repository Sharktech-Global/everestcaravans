<?php

namespace App\Http\Controllers;

use App\BookOnline;
use App\Vehicle;
use App\VehicleType;
use App\Fuel;
use App\Location;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Area;

class BookingController extends Controller
{
    use SEOToolsTrait;

    // public function index()
    // {
    //     $page = BookOnline::first();

    //     $this->seo()->setTitle(@$page->seo_title);
    //     $this->seo()->setDescription(@$page->seo_description);
    //     SEOMeta::setKeywords([@$page->seo_keywords]);
    //     $this->seo()->opengraph()->setTitle(@$page->seo_title);
    //     $this->seo()->opengraph()->setDescription(@$page->seo_description);
    //     $this->seo()->twitter()->setTitle(@$page->seo_title);
    //     $this->seo()->twitter()->setDescription(@$page->seo_description);

    //     $arena_vehicles = Vehicle::where('status', 1)->where('is_booking', 1)->whereHas('vehicle_type', function ($q) {
    //         $q->where('has_sales_page', 0)->where('slug','!=','nexa');
    //     })->get();
    //     $nexa_vehicles = Vehicle::where('status', 1)->where('is_booking', 1)->whereHas('vehicle_type', function ($q) {
    //         $q->where('has_sales_page', 0)->where('slug','=','nexa');
    //     })->get();
    //     return view('booking.index', ['arena_vehicles' => $arena_vehicles,'nexa_vehicles' => $nexa_vehicles, 'page' => $page]);
    // }

    // public function show(Request $request, $slug)
    // {
    //     $vehicle = Vehicle::has('vehicle_type')->with('colors','varients')->where('slug', $slug)->where('status', 1)->where('is_booking', 1)->whereHas('vehicle_type', function ($q) {
    //         $q->where('has_sales_page', 0);
    //     })->firstorFail();
    //     if ($vehicle->vehicle_type->has_sales_page) {
    //         return redirect(url($vehicle->vehicle_type->sales_page));
    //     }
    //     if ($request->ajax()) {
    //         $name = $request->post('color');
    //         $color = $vehicle->colors()->where('name', $name)->first();
    //         if ($color) {
    //             return response()->json(['status' => true, 'color' => $color]);
    //         } else {
    //             return response()->json(['status' => false]);
    //         }
    //     }
    //     $this->seo()->setTitle(($vehicle->seo) ? $vehicle->seo->title : ' Car' . ' Booking');
    //     $this->seo()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
    //     SEOMeta::setKeywords(($vehicle->seo) ? [$vehicle->seo->keywords] : ['']);
    //     $this->seo()->opengraph()->setTitle(($vehicle->seo) ? $vehicle->seo->title : ' Car' . ' Booking');
    //     $this->seo()->opengraph()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
    //     $this->seo()->twitter()->setTitle(($vehicle->seo) ? $vehicle->seo->title : ' Car' . ' Booking');
    //     $this->seo()->twitter()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
    //     $fuels = Fuel::where('status', 1)->orderBy('name')->get();
    //     $locations = Location::where('status', 1)->orderBy('name')->get();
    //     $areas = Area::where('status',1)->get();
    //     $varients = [];
    //     foreach ($fuels as $fuel) {
    //         $varients[$fuel->name] = $vehicle->varients()->where('fuel_id', $fuel->id)->get();
    //     }
    //     return view('booking.show', ['vehicle' => $vehicle, 'fuels' => $fuels, 'varients' => $varients, 'locations' => $locations,'areas' => $areas]);
    // }

    public function store(Request $request, $slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->where('status', 1)->where('is_booking', 1)->firstorFail();
        $validated = $request->validate([
            // 'fuel' => 'required',
            // 'varient' => 'required',
            // 'color' => 'required',
            'name' => 'required|min:3|string|max:255',
            'pan' => ['required', 'regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/'],
            'location' => 'required',
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            // 'g-recaptcha-response' => 'required|captcha'
        ],
        [
            'proof.max'  => 'The proof may not be greater than 2 MB.',
        ]);
        // if ($validated->fails()) {
        //     return Redirect::to(URL::previous() . "#online-booking")->withErrors($validated);
        // } 
        if ($request->hasFile('proof')) {
            $path = $request->file('proof')->storeAs(
                'upload/vehicle/proof',
                $request->proof->getClientOriginalName(),
                'public'
            );
            $validated['proof'] = $path;
        }
        $area = Area::find($request->location);
        $lName = Location::find($area->location_id);
        $request->session()->put('location', $lName->id);
        $validated['location'] = $lName->name;
        // unset($validated['g-recaptcha-response']);
        $request->session()->put('vehicle-data', $validated);
        return redirect()->route('checkout', $vehicle->slug);
    }

    public function send_enquiry($id)
    {
        $vehicle_type = VehicleType::where('id',$id)->first();
        $vehicle_types = VehicleType::whereStatus(1)->with('vehicles')->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();

        return view('enquiry_send', ['areas_sales' => $areas_sales,'vehicle_types' => $vehicle_types,'vehicle_type' => $vehicle_type]);
    }

}
