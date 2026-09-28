<?php

namespace App\Http\Controllers\Admin;

use App\CareerPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerPageController extends Controller
{
    public function index()
    {
        $page = CareerPage::first();
        return view('admin.career-page.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'nullable',
            'sub_title' => 'nullable',
            'title2' =>'nullable',
            'content' => 'required',
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $page = CareerPage::firstOrCreate();
        $page->title = $validated['title'];
        $page->sub_title = $validated['sub_title'];
        $page->title2 = $validated['title2'];
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
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated Career Page.');
            return redirect()->back()->with('success', 'Successfully updated Career page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Career page. Please try again.');
        }
    }
}
