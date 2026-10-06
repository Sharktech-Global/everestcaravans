<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class OurRangeController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Our Range | Everest Caravans');
        $this->seo()->setDescription('Explore the Everest Caravans range.');

        SEOMeta::setKeywords([
            'Everest Caravans',
            'caravans',
            'our range'
        ]);

        return view('our-range');
    }
}