<?php

namespace App\Http\Controllers\Admin;

use App\PageContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index()
    {
        $page = PageContactUs::first();
        return view('admin.contact-page.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'branch_helpline' => 'nullable',
            'contact_person' => 'nullable',
            'map_url' => 'required',
            'contact_info' => 'required',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $page = PageContactUs::firstOrNew();
        $page->branch_helpline = ($validated['branch_helpline'] != '<p><br></p>') ? $validated['branch_helpline'] : null;
        $page->contact_person = ($validated['contact_person'] != '<p><br></p>') ? $validated['contact_person'] : null;
        $page->contact_info = $validated['contact_info'];
        $page->map_url = $validated['map_url'];
        $page->seo_title = $validated['seo_title'];
        $page->seo_description = $validated['seo_description'];
        $page->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/slider/image',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $page->image = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated Contact Page.');
            return redirect()->back()->with('success', 'Successfully updated contact page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update contact page. Please try again.');
        }
    }
}
