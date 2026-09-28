<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\NewsAndEvents;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsAndEventsController extends Controller
{
    public function index()
    {
        $page = NewsAndEvents::first();
        return view('admin.news-events.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();  
        $validated = $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'nullable',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',


        ]);
        $page = NewsAndEvents::firstOrNew();
        $page->title = $validated['title'];
        $page->sub_title = $validated['sub_title'];
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->seo_title = $validated['seo_title'];
        $page->seo_description = $validated['seo_description'];
        $page->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }
       
        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated About Page.');
            return redirect()->back()->with('success', 'Successfully Updated News & Events.');
        } else {
            return redirect()->back()->with('error', 'Failed to update News & Events. Please try again.');
        }
    }
}
