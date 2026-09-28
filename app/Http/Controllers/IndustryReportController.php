<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class IndustryReportController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Industry Report');
        $this->seo()->setDescription("");
        SEOMeta::setKeywords([]);
        $this->seo()->opengraph()->setTitle('Industry Report');
        $this->seo()->opengraph()->setDescription("");
        $this->seo()->twitter()->setTitle('Industry Report');
        $this->seo()->twitter()->setDescription("");

        return view('industry-report.show');
    }
}
