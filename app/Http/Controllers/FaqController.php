<?php

namespace App\Http\Controllers;

use App\Faq;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use SEOToolsTrait;
    public function show()
    {
        $page = Faq::where('status',1)->orderBy('id', 'desc')->get();
        $seo = Seo::where('route_name','faqs')->first();

        $this->seo()->setTitle(@$seo->seo_title);
        $this->seo()->setDescription(@$seo->seo_description);
        SEOMeta::setKeywords([@$seo->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$seo->seo->title);
        $this->seo()->opengraph()->setDescription(@$seo->seo_description);
        $this->seo()->twitter()->setTitle(@$seo->seo->title);
        $this->seo()->twitter()->setDescription(@$seo->seo_description);
        //  dd($page);
        return view('faq', ['page' => $page]);
    }
}
