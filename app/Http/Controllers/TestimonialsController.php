<?php

namespace App\Http\Controllers;

use App\TestimonialPage;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Testimonial;

class TestimonialsController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $page = TestimonialPage::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        $testimonials = Testimonial::simplePaginate(5);

        return view('testimonials', ['page' => $page, 'testimonials' => $testimonials]);
    }
}
