<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class MaterialCreditorsController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Material Creditors');
        $this->seo()->setDescription("");
        SEOMeta::setKeywords([]);
        $this->seo()->opengraph()->setTitle('Material Creditors');
        $this->seo()->opengraph()->setDescription("");
        $this->seo()->twitter()->setTitle('Material Creditors');
        $this->seo()->twitter()->setDescription("");

        return view('material-creditors.show');
    }
}
