<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Location;
use Illuminate\Http\Request;
use App\InsuranceFeaturePage;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use App\BookServiceOnline;
use App\State;
use App\Country;
use App\InsureMyCarPage;
use App\InsurancePage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Area;

class InsuranceController extends Controller
{
    use SEOToolsTrait;
    public function show()
    {
        $page = InsureMyCarPage::first();
        $refer = request()->headers->get('referer');


        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);

        $vehicles = Vehicle::where('status', 1)->orderBy('name')->get();
        $locations = Location::where('status', 1)->orderBy('name')->get();
        $states = State::where('status', 1)->get();
        $countries = Country::get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        $areas_sales = Area::where('status', 1)->orderBy('name')->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        return view('insure-my-car.show', [
            'areas_sales' => $areas_sales,
            'vehicles' => $vehicles, 'locations' => $locations,
            'page' => $page, 'states' => $states, 'countries' => $countries, 'areas' => $areas, 'refer' => $refer
        ]);
    }

    public function features()
    {
        $page = InsurancePage::where('slug', 'insurance-features')->first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        return view('insurance-features', ['page' => $page]);
    }

    public function marutiInsurance()
    {
        $page = InsurancePage::where('slug', 'why-buy-maruti-insurance')->first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        return view('insurance-features', ['page' => $page]);
    }
    public function advantagepopular()
    {
        $page = InsurancePage::where('slug', 'advantages-of-popular')->first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        return view('insurance-features', ['page' => $page]);
    }

    public function addons()
    {
        $page = InsurancePage::where('slug', 'add-ons')->first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        return view('insurance-features', ['page' => $page]);
    }
    public function vas()
    {
        $page = InsurancePage::where('slug', 'vas')->first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        return view('insurance-features', ['page' => $page]);
    }
    public function faqs()
    {
        $page = InsurancePage::where('slug', 'faqs')->first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        return view('insurance-features', ['page' => $page]);
    }
}
