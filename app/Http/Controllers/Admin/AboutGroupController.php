<?php

namespace App\Http\Controllers\Admin;

use App\AboutGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutGroupController extends Controller
{
    public function index()
    {
        $page = AboutGroup::first();
        return view('admin.about-page.group.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();  
        $validated = $request->validate([

            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'required',
            'title' =>'nullable',
            'sub_title' =>'nullable',
            'link' =>'nullable',
            'sub_content' => 'nullable',
            'location_title' => 'nullable',
            'location_content' => 'nullable',
            'content_image_one' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content_image_two' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content_image_three' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            // 'seo_title' => 'nullable',
            // 'seo_description' => 'nullable',
            // 'seo_keywords' => 'nullable',


        ]);
        $page = AboutGroup::firstOrNew();
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->title = $validated['title'];
        $page->sub_title = $validated['sub_title'];

        $page->link = $validated['link'];
        $page->location_content = $validated['location_content'];
        $page->location_title = $validated['location_title'];
        $page->sub_content = $validated['sub_content'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }
        if ($request->hasFile('mobile_banner')) {
            $path = $request->file('mobile_banner')->storeAs(
                'upload/site',
                time() . '_' . $request->mobile_banner->getClientOriginalName(),
                'public'
            );
            $page->mobile_banner = $path;
        }
        if ($request->hasFile('content_image_one')) {
            $path = $request->file('content_image_one')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_one->getClientOriginalName(),
                'public'
            );
            $page->content_image_one = $path;
        }
        if ($request->hasFile('content_image_two')) {
            $path = $request->file('content_image_two')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_two->getClientOriginalName(),
                'public'
            );
            $page->content_image_two = $path;
        }
        if ($request->hasFile('content_image_three')) {
            $path = $request->file('content_image_three')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_three->getClientOriginalName(),
                'public'
            );
            $page->content_image_three = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated About Page.');
            return redirect()->back()->with('success', 'Successfully updated About page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update About page. Please try again.');
        }
    }
}
