<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class GoogleReviewsController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Google Reviews | Everest Caravans');
        $this->seo()->setDescription('Explore our Google Reviews.');

        SEOMeta::setKeywords([
            'Everest Caravans',
            'caravans',
            'Google Reviews'
        ]);

        $testimonials = \App\Testimonial::latest()->get();
        return view('google-reviews', compact('testimonials'));
    }
}