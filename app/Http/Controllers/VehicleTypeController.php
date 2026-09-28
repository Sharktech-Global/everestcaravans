<?php

namespace App\Http\Controllers;

use App\CategoryType;
use App\Vehicle;
use App\VehicleType;
use App\Location;
use App\VehicleEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use Validator;
use App\Setting;
use App\Helpers\SendOTP;
use App\Area;
use App\VehicleGallery;


class VehicleTypeController extends Controller
{
    use SEOToolsTrait;
    public function show($slug)
    {
        $refer = request()->headers->get('referer'); 
        $VehicleType= VehicleType::where('slug',$slug)->first(); 
        $vehicles = Vehicle::has('vehicle_type')->with(['sections','contents', 'colors', 'sections.images', 'features', 'specifications', 'seo', 'vehicle_type'])
                    ->where('vehicle_type_id',$VehicleType->id)
                     ->where('status', 1)->orderBy('order','ASC')->get();
        
        $this->seo()->setTitle(@$VehicleType->seo_title);
        $this->seo()->setDescription(@$VehicleType->seo_description);
        SEOMeta::setKeywords([@$VehicleType->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$VehicleType->seo_title);
        $this->seo()->opengraph()->setDescription(@$VehicleType->seo_description);
        $this->seo()->twitter()->setTitle(@$VehicleType->seo_title);
        $this->seo()->twitter()->setDescription(@$VehicleType->seo_description);  

        $locations = Location::where('status', 1)->orderBy('name')->get();
        $areas = Area::where('status',1)->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        return view('vehicles.types.show',  ['refer' => $refer,'areas_sales' => $areas_sales,'vehicles' => $vehicles, 'locations' => $locations,'VehicleType' => $VehicleType]);
    }
}
