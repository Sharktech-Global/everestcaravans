<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class FinancePartnerController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Finance Partners | Everest Caravans');
        $this->seo()->setDescription('Explore our finance partner options.');

        SEOMeta::setKeywords([
            'Everest Caravans',
            'caravans',
            'finance partners'
        ]);

        return view('finance-partner');
    }
}