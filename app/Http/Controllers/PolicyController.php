<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class PolicyController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Policies');
        $this->seo()->setDescription("");
        SEOMeta::setKeywords([]);
        $this->seo()->opengraph()->setTitle('Policies');
        $this->seo()->opengraph()->setDescription("");
        $this->seo()->twitter()->setTitle('Policies');
        $this->seo()->twitter()->setDescription("");

        return view('policies.show');
    }
}
