<?php

namespace App\Http\Controllers\Admin;

use App\Brochure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrochureController extends Controller
{
    public function index()
    {
        $brochure = Brochure::first();
        return view('admin.brochure-page.index', ['brochure' => $brochure]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'nullable',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $brochure = Brochure::firstOrNew();
        $brochure->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $brochure->seo_title = $validated['seo_title'];
        $brochure->seo_description = $validated['seo_description'];
        $brochure->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $brochure->banner_image = $path;
        }

        $res = $brochure->save();
        if ($res) {
            activity('admin')->performedOn($brochure)->causedBy($user)->withProperties(['data' => $request])->log('Updated Brochure Page.');
            return redirect()->back()->with('success', 'Successfully updated Brochure page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Brochure page. Please try again.');
        }
    }
}
