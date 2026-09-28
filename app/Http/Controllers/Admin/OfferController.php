<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offer = Offer::first();
        return view('admin.offer-page.index', ['offer' => $offer]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'nullable',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $offer = Offer::firstOrNew();
        $offer->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $offer->seo_title = $validated['seo_title'];
        $offer->seo_description = $validated['seo_description'];
        $offer->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $offer->banner_image = $path;
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/site',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $offer->image = $path;
        }

        $res = $offer->save();
        if ($res) {
            activity('admin')->performedOn($offer)->causedBy($user)->withProperties(['data' => $request])->log('Updated Offer Page.');
            return redirect()->back()->with('success', 'Successfully updated Offer page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Offer page. Please try again.');
        }
    }
}
