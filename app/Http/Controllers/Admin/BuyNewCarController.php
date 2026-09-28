<?php

namespace App\Http\Controllers\Admin;

use App\BuyNewCar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyNewCarController extends Controller
{
    public function index()
    {
        $page = BuyNewCar::first();
        return view('admin.buy-new-car.index', ['page' => $page]);
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
        $page = BuyNewCar::firstOrCreate();
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
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated Buy New Car Page.');
            return redirect()->back()->with('success', 'Successfully updated Buy New Car page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Buy New Car page. Please try again.');
        }
    }
}
