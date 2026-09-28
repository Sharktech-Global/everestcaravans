<?php

namespace App\Http\Controllers;

use App\CategoryType;
use App\Vehicle;
use App\Location;
use App\VehicleEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use Illuminate\Support\Facades\Validator;
use App\Setting;
use App\Helpers\SendOTP;
use App\Area;
use App\VehicleAllFeature;
use App\VehicleSeo;
use App\VehicleApplication;
use App\VehicleGallery;
use App\VehicleSection;

class VehicleController extends Controller
{
    use SEOToolsTrait;

    public function getapplication($type){
        $vehicleApplications = VehicleApplication::where('vehicle_type_id', $type)->where('status', 1)->whereIn('id', function($query) {
            $query->select('application_id')
                ->from('vehicles');
        })->get();


        return response()->json($vehicleApplications);
    }

    public function show($slug)
    {
        $refer = request()->headers->get('referer');    
        $vehicle = Vehicle::has('vehicle_type')->with(['categories', 'colors',  'allfeatures', 'specifications', 'seo', 'vehicle_type'])->where('slug', $slug)->where('status', 1)->firstorFail();
        // dd($vehicle->allfeatures);
        $sections = VehicleSection::where('vehicle_id',$vehicle->id)->where('order',1)->select('title','description')->first();
        $features = VehicleAllFeature::where('vehicle_id',$vehicle->id)->with('image_files')->get();
        $seo = VehicleSeo::where('vehicle_id',$vehicle->id)->first();
        $this->seo()->setTitle(@$seo->title);
        $this->seo()->setDescription(($seo) ? @$seo->description : '');
        SEOMeta::setKeywords(($seo) ? [@$seo->keywords] : ['']);
        $this->seo()->opengraph()->setTitle(@$seo->title);
        $this->seo()->opengraph()->setDescription(($seo) ? @$seo->description : '');
        $this->seo()->twitter()->setTitle(@$seo->title);
        $this->seo()->twitter()->setDescription(($seo) ? @$seo->description : '');
        $locations = Location::where('status', 1)->select('id','name')->orderBy('order')->get();
        $vehicle_details = $vehicle->categories()->get();
        $category_types_specs = CategoryType::with('categories')->where('name',"specifications")->where('status', 1)->get();
        // $category_types_features = CategoryType::with('categories')->where('name',"features")->where('status', 1)->get();
        $areas = Area::where('status',1)->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        $galleries = VehicleGallery::where('vehicle_id',$vehicle->id)->get();
        $vehicles_list= Vehicle::where('status',1)->orderBy('order','ASC')->get();
        //  dd($vehicle);
        // $vehicles = ($gallery->currentPage() * $gallery->perPage()) - $gallery->perPage();
        return view('vehicles.show', ['features' => $features,'sections' => $sections,'galleries' => $galleries,'refer' => $refer,'areas_sales' => $areas_sales,'vehicle' => $vehicle, 'locations' => $locations, 'vehicle_details' => $vehicle_details, 'category_types_specs' => $category_types_specs,'areas' => $areas,'vehicles_list'=>$vehicles_list]);
    }
    public function booking(Request $request, $slug)
    {
        // dd(1);
        //  dd($slug);
        // return $slug;
        // dd($request->hasFile('proof'));
        $vehicle = Vehicle::where('slug', $slug)->where('status', 1)->firstorFail();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string|max:255',
            'pan' => ['required', 'regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/'],
            'location' => 'required',
            'email' => 'required|email',
        ]);
        // dd(1);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
       
       
        // $area = Area::find($request->location);
        $lName = Location::where('id', $request->input('location'))->first();
        
        $request->session()->put('location', $lName->id);
        $validated['location'] = $lName->name;
        $validated['name'] = $request->input('name');
        $validated['email'] = $request->input('email');
        // unset($validated['g-recaptcha-response']);
        // dd( $validated);
        $request->session()->put('vehicle-data', $validated);
        // return redirect()->route('checkout', $vehicle->slug);
        return response()->json(['redirect_url' => route('checkout', $vehicle->slug)]);
    }
}
