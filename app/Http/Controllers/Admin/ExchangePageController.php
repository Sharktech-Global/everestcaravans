<?php

namespace App\Http\Controllers\Admin;

use App\ExchangePage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExchangePageController extends Controller
{
    public function index()
    {
        $page = ExchangePage::first();
        return view('admin.exchange-page.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_banner' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $page = ExchangePage::firstOrCreate();
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

        if ($request->hasFile('mobile_banner')) {
            $path = $request->file('mobile_banner')->storeAs(
                'upload/slider/mobile_banner',
                time() . '_' . $request->mobile_banner->getClientOriginalName(),
                'public'
            );
            $page->mobile_banner = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated Exchange Page.');
            return redirect()->back()->with('success', 'Successfully updated exchange page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update exchange page. Please try again.');
        }
    }
}
