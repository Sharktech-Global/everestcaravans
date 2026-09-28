<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Seo;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    use SEOToolsTrait;

    public function show()
    {

        $seo = Seo::where('route_name','blog')->first();
        $blogs=Blog::where('status',1)->get();
        $this->seo()->setTitle(@$seo->seo_title);
        $this->seo()->setDescription(@$seo->seo_description);
        SEOMeta::setKeywords([@$seo->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$seo->seo->title);
        $this->seo()->opengraph()->setDescription(@$seo->seo_description);
        $this->seo()->twitter()->setTitle(@$seo->seo->title);
        $this->seo()->twitter()->setDescription(@$seo->seo_description);
        return view('blog.show', ['blogs' => $blogs]);
    }
    public function view($id)
    {

        $blog=Blog::where('slug',$id)->first();
        $blogs=Blog::where('slug','!=',$id)->where('status',1)->get();
        $this->seo()->setTitle(@$blog->seo_title);
        $this->seo()->setDescription(@$blog->seo_description);
        SEOMeta::setKeywords([@$blog->seo_keywords]);
        $this->seo()->opengraph()->setTitle(@$blog->seo->title);
        $this->seo()->opengraph()->setDescription(@$blog->seo_description);
        $this->seo()->twitter()->setTitle(@$blog->seo->title);
        $this->seo()->twitter()->setDescription(@$blog->seo_description);
       
        return view('blog.view', ['blog' => $blog,'blogs' => $blogs]);
    }
}
