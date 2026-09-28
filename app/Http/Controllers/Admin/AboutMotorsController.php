<?php

namespace App\Http\Controllers\Admin;

use App\AboutMotor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutMotorsController extends Controller
{
    public function index()
    {
        $page = AboutMotor::first();
        return view('admin.about-page.motors.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();  
        $validated = $request->validate([

            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'required',
            'title' =>'required',
            'sub_title' =>'nullable',
            'link' =>'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            // 'seo_title' => 'nullable',
            // 'seo_description' => 'nullable',
            // 'seo_keywords' => 'nullable',


        ]);
        $page = AboutMotor::firstOrNew();
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->title = $validated['title'];
        $page->sub_title = $validated['sub_title'];
        $page->link = $validated['link'];
      
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/site',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $page->image = $path;
        }
       
        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated About Motors.');
            return redirect()->back()->with('success', 'Successfully updated About motors.');
        } else {
            return redirect()->back()->with('error', 'Failed to update About motors. Please try again.');
        }
    }
}
