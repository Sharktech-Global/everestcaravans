<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Location_Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationContentController extends Controller
{
    public function index()
    {
        $location_content = Location_Content::first();
        return view('admin.location-content.create', compact('location_content'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $location_content = Location_Content::firstOrNew();
        $location_content->content = $validated['content'];
        ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/location-content/image',
                $location_content->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $location_content->image = $path;
        }

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $location_content->banner_image = $path;
        }

        $res = $location_content->save();
        if ($res) {
            activity('admin')->performedOn($location_content)->causedBy($user)->withProperties(['data' => $request])->log('Created New location content.');
            return redirect()->back()->with('success', 'Successfully created new location content.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new location content. Please try again.');
        }
    }
}
