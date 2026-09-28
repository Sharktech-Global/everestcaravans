<?php

namespace App\Http\Controllers;

use App\Brochure;
use App\Vehicle;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class BrochureController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $brochure = Brochure::first();

        $this->seo()->setTitle(@$brochure->seo_title);
        $this->seo()->setDescription(@$brochure->seo_description);
        SEOMeta::setKeywords([@$brochure->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$brochure->seo_title);
        $this->seo()->opengraph()->setDescription(@$brochure->seo_description);
        $this->seo()->twitter()->setTitle(@$brochure->seo_title);
        $this->seo()->twitter()->setDescription(@$brochure->seo_description);

        $vehicles = Vehicle::where('status', 1)->whereNotNull('brochure')->get();
        return view('brochures.show', ['vehicles' => $vehicles, 'brochure' => $brochure]);
    }
}
