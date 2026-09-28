<?php

namespace App\Http\Controllers\Admin;

use App\CngModelPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CngModelPageController extends Controller
{
    public function index()
    {
        $page = CngModelPage::first();
        return view('admin.cng-model.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $page = CngModelPage::firstOrCreate();
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
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated CNG Model Page.');
            return redirect()->back()->with('success', 'Successfully updated CNG Model page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update CNG Model page. Please try again.');
        }
    }
}
