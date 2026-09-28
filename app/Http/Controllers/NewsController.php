<?php

namespace App\Http\Controllers;

use App\NewsEventsList;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {

        // $this->seo()->setTitle('Blog - Abreco AUTOCARS PVT LTD');
        // $this->seo()->setDescription("Let's hear what our technicians have to advice you, Latest news regarding Maruti Suzuki Automobiles and many more.");
        // SEOMeta::setKeywords(["Blog - Abreco AUTOCARS PVT LTD"]);
        // $this->seo()->opengraph()->setTitle('Blog - Abreco AUTOCARS PVT LTD');
        // $this->seo()->opengraph()->setDescription("Let's hear what our technicians have to advice you, Latest news regarding Maruti Suzuki Automobiles and many more.");
        // $this->seo()->twitter()->setTitle('Blog - Abreco AUTOCARS PVT LTD');
        // $this->seo()->twitter()->setDescription("Let's hear what our technicians have to advice you, Latest news regarding Maruti Suzuki Automobiles and many more.");
        // $blogs = Blog::where('status', 1)->get();
        $news = NewsEventsList::where('status',1)->get();
        // dd($news);
        return view('news-event.index',compact('news'));
    }
    public function inner(Request $request, $slug)
    {
        $news = NewsEventsList::where('slug', $slug)->first();
        // $seo = Seo::where('route_name', 'blogs/' . $blog->slug)->first();

      
        $relatedPosts = NewsEventsList::where('slug', '<>', $slug)->get();
        // dd($relatedPosts);
        return view('news-event.show',compact('news', 'relatedPosts'));
    }
}
