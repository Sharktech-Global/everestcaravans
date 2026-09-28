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
use Validator;
use App\Setting;
use App\Helpers\SendOTP;
use App\Area;
use App\VehicleGallery;

class NexaPageController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $refer = request()->headers->get('referer');    
        $vehicles = Vehicle::has('vehicle_type')->with(['sections','contents', 'colors', 'sections.images', 'features', 'specifications', 'seo', 'vehicle_type'])
                    ->whereHas('vehicle_type', function ($query)
                     {
                          $query->where('name', 'nexa');
                     })
                     ->where('status', 1)->get();
        $this->seo()->setTitle("Maruti Suzuki Nexa Cars  -  Abreco AUTOCARS PVT LTD");
        $this->seo()->setDescription("Your one-stop shop for premium and luxury Maruti Suzuki sedans and hatchbacks in India is NEXA. Learn more about NEXA car prices, models, and dealers.");
        SEOMeta::setKeywords(["Maruti Suzuki Nexa Cars  -  Abreco AUTOCARS PVT LTD"]);
        $this->seo()->opengraph()->setTitle("Maruti Suzuki Nexa Cars  -  Abreco AUTOCARS PVT LTD");
        $this->seo()->opengraph()->setDescription("Your one-stop shop for premium and luxury Maruti Suzuki sedans and hatchbacks in India is NEXA. Learn more about NEXA car prices, models, and dealers.");
        $this->seo()->twitter()->setTitle("Maruti Suzuki Nexa Cars  -  Abreco AUTOCARS PVT LTD");
        $this->seo()->twitter()->setDescription("Your one-stop shop for premium and luxury Maruti Suzuki sedans and hatchbacks in India is NEXA. Learn more about NEXA car prices, models, and dealers.");

        $locations = Location::where('status', 1)->orderBy('name')->get();
        $areas = Area::where('status',1)->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        return view('vehicles.nexa.show',  ['refer' => $refer,'areas_sales' => $areas_sales,'vehicles' => $vehicles, 'locations' => $locations,]);
    }
    public function nexa_show($slug)
    {
        $refer = request()->headers->get('referer');    
        $vehicle = Vehicle::has('vehicle_type')->with(['allfeatures','sections', 'colors', 'sections.images', 'features', 'specifications', 'seo', 'vehicle_type'])->where('slug', $slug)->where('status', 1)->firstorFail();
        // if(isset($vehicle->vehicle_type)) {
        //     if ($vehicle->vehicle_type->has_sales_page) {
        //         return redirect(url($vehicle->vehicle_type->sales_page));
        //     }
        // }

        $this->seo()->setTitle(($vehicle->seo) ? $vehicle->seo->title : ' Car');
        $this->seo()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
        SEOMeta::setKeywords(($vehicle->seo) ? [$vehicle->seo->keywords] : ['']);
        $this->seo()->opengraph()->setTitle(($vehicle->seo) ? $vehicle->seo->title : ' Car');
        $this->seo()->opengraph()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
        $this->seo()->twitter()->setTitle(($vehicle->seo) ? $vehicle->seo->title : ' Car');
        $this->seo()->twitter()->setDescription(($vehicle->seo) ? $vehicle->seo->description : '');
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $vehicle_details = $vehicle->categories()->get();
        $category_types_specs = CategoryType::with('categories')->where('name',"technical")->where('status', 1)->get();
        $category_types_features = CategoryType::with('categories')->where('name',"features")->where('status', 1)->get();
        $areas = Area::where('status',1)->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        $gallery = VehicleGallery::where('vehicle_id',$vehicle->id)->paginate(12);
        return view('vehicles.nexa.view', ['gallery' => $gallery,'refer' => $refer,'areas_sales' => $areas_sales,'vehicle' => $vehicle, 'locations' => $locations, 'vehicle_details' => $vehicle_details,'category_types_features' => $category_types_features, 'category_types_specs' => $category_types_specs,'areas' => $areas]);
    }
}
