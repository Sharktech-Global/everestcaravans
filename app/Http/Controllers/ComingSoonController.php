<?php

namespace App\Http\Controllers;

use App\Privacy;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Area;
use App\Location;
use App\VehicleType;

class ComingSoonController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Coming Soon');
        $this->seo()->setDescription('Coming Soon');
        SEOMeta::setKeywords(['Coming Soon']);
        $this->seo()->opengraph()->setTitle('Coming Soon');
        $this->seo()->opengraph()->setDescription('Coming Soon');
        $this->seo()->twitter()->setTitle('Coming Soon');
        $this->seo()->twitter()->setDescription('Coming Soon');

        $areas = Area::where('status',1)->get();
        $vehicle_type = VehicleType::whereStatus(1)->with('vehicles')->get();
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();

        return view('coming-soon',['areas' => $areas,'areas_sales' => $areas_sales, 'vehicle_type' => $vehicle_type, 'locations' => $locations]);
    }
}
