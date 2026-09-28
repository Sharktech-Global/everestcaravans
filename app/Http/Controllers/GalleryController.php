<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Gallery;
use App\Seo;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    use SEOToolsTrait;
    public function index()
    {
        // $this->authorize('create', Admin::class); 
        $galleries = Gallery::get();
        $seo = Seo::where('route_name','gallery')->first();

        $this->seo()->setTitle(@$seo->seo_title);
        $this->seo()->setDescription(@$seo->seo_description);
        SEOMeta::setKeywords([@$seo->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$seo->seo->title);
        $this->seo()->opengraph()->setDescription(@$seo->seo_description);
        $this->seo()->twitter()->setTitle(@$seo->seo->title);
        $this->seo()->twitter()->setDescription(@$seo->seo_description);
        return view('gallery', compact('galleries'));
    }
}
