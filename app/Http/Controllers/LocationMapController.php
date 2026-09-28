<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\LocationMapPage;

class LocationMapController extends Controller
{
    use SEOToolsTrait;
    public function show()
    {
        $offer = LocationMapPage::first();
        $this->seo()->setTitle(@$offer->seo_title);
        $this->seo()->setDescription(@$offer->seo_description);
        SEOMeta::setKeywords([@$offer->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$offer->seo_title);
        $this->seo()->opengraph()->setDescription(@$offer->seo_description);
        $this->seo()->twitter()->setTitle(@$offer->seo_title);
        $this->seo()->twitter()->setDescription(@$offer->seo_description);
        return view('location-map.show');
    }
}
