<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class TranscriptController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $this->seo()->setTitle('Transcript of the 01st Extra-Ordinary General Meeting of the Company for the financial year 2021-22');
        $this->seo()->setDescription('');
        SEOMeta::setKeywords([]);
        $this->seo()->opengraph()->setTitle('Transcript of the 01st Extra-Ordinary General Meeting of the Company for the financial year 2021-22');
        $this->seo()->opengraph()->setDescription('');
        $this->seo()->twitter()->setTitle('Transcript of the 01st Extra-Ordinary General Meeting of the Company for the financial year 2021-22');
        $this->seo()->twitter()->setDescription('');

        return view('transcript.show');
    }
}
