<?php

namespace App\Http\Controllers;

use App\AboutPage;
use App\AboutLeader;
use App\AboutGroup;
use App\AboutMotor;
use App\AboutLocation;
use App\Blog;
use App\Seo;
use App\CounterList;
use App\Faq;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {
        $pages = AboutPage::get();
        $leaders = AboutLeader::where('name','!=','Mohammed Shaji')->where('status',1)->orderBy('order','ASC')->get();
        $ceo = AboutLeader::where('name','=','Mohammed Shaji')->where('status',1)->first();
        $group = AboutGroup::first();
        $motors = AboutMotor::first();
        $counters = CounterList::get();
        $blogs = Blog::where('status',1)->get();
        $locations= AboutLocation::where('status',1)->get();
        $faqs = Faq::where('status', 1)->get();
        // dd($counters);
        $page= Seo::where('route_name','about-us')->first();
        // $this->seo()->setTitle(@$page->seo_title);
        // $this->seo()->setDescription(@$page->seo_description);
        // SEOMeta::setKeywords([@$page->seo_keywords]);
        // $this->seo()->opengraph()->setTitle(@$page->seo_title);
        // $this->seo()->opengraph()->setDescription(@$page->seo_description);
        // $this->seo()->twitter()->setTitle(@$page->seo_title);
        // $this->seo()->twitter()->setDescription(@$page->seo_description);
        // dd($groups);
        return view('about',['motors' => $motors,'pages' => $pages,'leaders' => $leaders,'group' => $group,'counters' => $counters,'ceo' => $ceo,'blogs' => $blogs,'locations' => $locations,'faqs' => $faqs]);
    }

    public function founder()
    {

        $this->seo()->setTitle("About Founder");
        $this->seo()->setDescription("");
        SEOMeta::setKeywords(['About Founder']);
        $this->seo()->opengraph()->setTitle("About Founder");
        $this->seo()->opengraph()->setDescription("");
        $this->seo()->twitter()->setTitle("About Founder");
        $this->seo()->twitter()->setDescription("");

        return view('founder');
    }
    public function show_popular()
    {
        $page = AboutPage::first();

        $this->seo()->setTitle('Everest Caravans');
        $this->seo()->setDescription('Everest Caravans');
        SEOMeta::setKeywords(['Everest Caravans']);
        $this->seo()->opengraph()->setTitle('Everest Caravans');
        $this->seo()->opengraph()->setDescription('Everest Caravans');
        $this->seo()->twitter()->setTitle('Everest Caravans');
        $this->seo()->twitter()->setDescription('Everest Caravans');

        return view('life_at_popular',['page' => $page]);
    }
}
