<?php

namespace App\Http\Controllers;

use App\Terms;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class TermsController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = Terms::first();
        // dd($page);

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);



        return view('terms', ['page' => $page]);
    }
}
