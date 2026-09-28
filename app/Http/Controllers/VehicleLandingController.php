<?php

namespace App\Http\Controllers;

use App\CategoryType;
use App\Location;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Area;

class VehicleLandingController extends Controller
{
    public function show($slug)
    {
        $vehicle = Vehicle::has('vehicle_type')->with(['sections', 'colors', 'sections.images', 'features', 'specifications', 'seo', 'vehicle_type'])->where('slug', $slug)->where('status', 1)->where('has_landing', 1)->firstorFail();
        if ($vehicle->vehicle_type->has_sales_page) {
            return redirect(url($vehicle->vehicle_type->sales_page));
        }
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $vehicle_details = $vehicle->categories()->get();
        $category_types = CategoryType::with('categories')->where('status', 1)->get();
        $areas = Area::where('status',1)->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        return view('vehicles.landing.show', ['areas_sales' => $areas_sales,'vehicle' => $vehicle, 'locations' => $locations, 'vehicle_details' => $vehicle_details, 'category_types' => $category_types,'areas' => $areas]);
    }
}
