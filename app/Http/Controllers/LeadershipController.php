<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Helpers\SendEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class LeadershipController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Leadership Team - Abreco AUTOCARS PVT LTD Maruti Suzuki Dealers');
        $this->seo()->setDescription("Abreco AUTOCARS team is composed of members who are passionate, work towards interchangeable achievements, and share common attainments.");
        SEOMeta::setKeywords(["Abreco AUTOCARS team is composed of members who are passionate, work towards interchangeable achievements, and share common attainments."]);
        $this->seo()->opengraph()->setTitle('Leadership Team - Abreco AUTOCARS PVT LTD Maruti Suzuki Dealers');
        $this->seo()->opengraph()->setDescription("Abreco AUTOCARS team is composed of members who are passionate, work towards interchangeable achievements, and share common attainments.");
        $this->seo()->twitter()->setTitle('Leadership Team - Abreco AUTOCARS PVT LTD Maruti Suzuki Dealers');
        $this->seo()->twitter()->setDescription("");

        return view('leadership.show');
    }
}
