<?php

namespace App\Http\Controllers\Admin;

use App\Counter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index()
    {
        $page = Counter::first();
        return view('admin.counter.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();  
        $validated = $request->validate([

            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'required',
            'title' => 'nullable',
            'link' => 'nullable',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            // 'seo_description' => 'nullable',
            // 'seo_keywords' => 'nullable',


        ]);
        $page = Counter::firstOrNew();
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->title = $validated['title'];
        $page->link = $validated['link'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/site',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated Counter Page.');
            return redirect()->back()->with('success', 'Successfully updated Counter page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Counter page. Please try again.');
        }
    }
}
