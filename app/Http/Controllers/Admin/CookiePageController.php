<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Cookie;
use Illuminate\Http\Request;

class CookiePageController extends Controller
{
    public function index()
    {
        $page = Cookie::first();
        return view('admin.cookie.index', ['page' => $page]);
    }
    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'content' => 'required',
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $page = Cookie::firstOrCreate(); 
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->seo_title = $validated['seo_title'];
        $page->seo_description = $validated['seo_description'];
        $page->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/slider/banner_image',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated Terms and services Page.');
            return redirect()->back()->with('success', 'Successfully updated Terms and services page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Terms and services page. Please try again.');
        }
    }
}
