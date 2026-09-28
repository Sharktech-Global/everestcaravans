<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Network;
use App\NetworkBranch;
use App\MainNetwork;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class NetworkController extends Controller
{
    use SEOToolsTrait;

    public function show(Request $request)
    {
        
        if(isset($request->locationtab)){
            $locationtab = $request->locationtab;
        }else{
            $locationtab = NULL; 
        }
        $page = Network::first();

        $this->seo()->setTitle(@$page->seo_title);
        $this->seo()->setDescription(@$page->seo_description);
        SEOMeta::setKeywords([@$page->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$page->seo->title);
        $this->seo()->opengraph()->setDescription(@$page->seo_description);
        $this->seo()->twitter()->setTitle(@$page->seo->title);
        $this->seo()->twitter()->setDescription(@$page->seo_description);
        $main_networks = MainNetwork::get();
        $network_branches = MainNetwork::with('sub')->get();
        $brands = Brand::with('network')->get();
        return view('network', ['page' => $page,'locationtab' => $locationtab, 'network_branches' => $network_branches,'main_networks' => $main_networks,'brands' => $brands]);
    }
}
