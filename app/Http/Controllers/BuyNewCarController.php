<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Location;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\BuyNewCar;
use App\State;
use App\Area;
use App\VehicleType;

class BuyNewCarController extends Controller
{
    use SEOToolsTrait;
    public function show(Request $request)
    {
        $page = BuyNewCar::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);

        $vehicle_type = VehicleType::whereStatus(1)->with('vehicles')->get();
        $vehicles = Vehicle::where('status', 1)->orderBy('name')->get();
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $states = State::where('status', 1)->get();
        $areas = Area::where('status',1)->orderBy('name','asc')->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        $search = $request->vehicle;
        return view('buy-new-car.show', ['vehicles' => $vehicles,'vehicle_type' => $vehicle_type, 'locations' => $locations, 'page' => $page, 'states' => $states, 'search' => $search,'areas' => $areas,'areas_sales' => $areas_sales]);
    }
}
