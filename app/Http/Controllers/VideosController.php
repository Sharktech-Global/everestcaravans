<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class VideosController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        // $this->seo()->setTitle('Videos | Everest Caravans');
        // $this->seo()->setDescription('Walkthroughs, build stories and road tests from the Everest Caravans yard.');

        // SEOMeta::setKeywords([
        //     'Everest Caravans',
        //     'caravans',
        //     'caravan videos',
        //     'van walkthrough'
        // ]);

        return view('videos');
    }
}
