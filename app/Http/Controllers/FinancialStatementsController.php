<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class FinancialStatementsController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Financial statements of the company');
        $this->seo()->setDescription("");
        SEOMeta::setKeywords([]);
        $this->seo()->opengraph()->setTitle('Financial statements of the company');
        $this->seo()->opengraph()->setDescription("");
        $this->seo()->twitter()->setTitle('Financial statements of the company');
        $this->seo()->twitter()->setDescription("");

        return view('financial-statements.show');
    }

    public function materialSubsidiary()
    {
        $this->seo()->setTitle('Material Subsidiary');
        $this->seo()->setDescription("");
        SEOMeta::setKeywords([]);
        $this->seo()->opengraph()->setTitle('Material Subsidiary');
        $this->seo()->opengraph()->setDescription("");
        $this->seo()->twitter()->setTitle('Material Subsidiary');
        $this->seo()->twitter()->setDescription("");

        return view('financial-statements.material-subsidiary');
    }
}
