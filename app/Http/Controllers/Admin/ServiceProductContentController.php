<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceProductContent;
use Illuminate\Http\Request;

class ServiceProductContentController extends Controller
{
    public function index()
    {
        $service_product = ServiceProductContent::first();
        return view('admin.service-product-content.index', compact('service_product'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);

        $service_product = ServiceProductContent::firstOrNew();
        $service_product->content = $validated['content'];
        ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $service_product->seo_title = $validated['seo_title'];
        $service_product->seo_description = $validated['seo_description'];
        $service_product->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/location-content/image',
                $service_product->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $service_product->image = $path;
        }

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $service_product->banner_image = $path;
        }

        $res = $service_product->save();
        if ($res) {
            activity('admin')->performedOn($service_product)->causedBy($user)->withProperties(['data' => $request])->log('Created New Service Product content.');
            return redirect()->back()->with('success', 'Successfully created new Service Product content.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new Service Product content. Please try again.');
        }
    }
}
