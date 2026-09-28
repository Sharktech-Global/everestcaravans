<?php

namespace App\Http\Controllers;

use App\CngModelPage;
use App\Vehicle;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class CngModelsController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = CngModelPage::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);

        $vehicles = Vehicle::whereStatus(1)->whereHas('vehicle_type', function ($q) {
            $q->where('has_sales_page', 1)->where('sales_page', 'cng-models');
        })->get();
        return view('cng-models', ['page' => $page, 'vehicles' => $vehicles]);
    }
}
