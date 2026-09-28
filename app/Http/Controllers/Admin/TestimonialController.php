<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial.index', ['testimonials' => $testimonials]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'title' => 'nullable',
            'designation' => 'nullable',
            'content' => 'nullable',
            'message' => 'required_without:url',
            'url' => 'nullable|url|required_without:message',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'rating' => 'nullable|numeric',
        ]);
        $testimonial = new Testimonial();
        $testimonial->name = $validated['name'];
        $testimonial->title = $validated['title'];
        $testimonial->designation = $validated['designation'];
        $testimonial->message = $validated['message'];
        $testimonial->content = $validated['content'];
        $testimonial->rating = $validated['rating'];
        $testimonial->url = $validated['url'];
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->storeAs(
                'upload/testimonial/photo',
                $testimonial->name . '_' . $request->photo->getClientOriginalName(),
                'public'
            );
            $testimonial->photo = $path;
        }
        $res = $testimonial->save();
        if ($res) {
            return redirect()->back()->with('success', 'Testimonial added successfully');
        } else {
            return redirect()->back()->with('error', ' Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return redirect()->route('admin.testimonials.edit', $testimonial->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', ['testimonial' => $testimonial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            'title' => 'nullable',
            'designation' => 'nullable',
            'message' => 'required_without:url',
            'content' => 'nullable',
            'url' => 'nullable|url|required_without:message',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'rating' => 'nullable|numeric',
        ]);
        $testimonial->name = $validated['name'];
        $testimonial->designation = $validated['designation'];
        $testimonial->title = $validated['title'];
        $testimonial->message = $validated['message'];
        $testimonial->content = $validated['content'];
        $testimonial->rating = $validated['rating'];
        $testimonial->url = $validated['url'];
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->storeAs(
                'upload/testimonial/photo',
                $testimonial->name . '_' . $request->photo->getClientOriginalName(),
                'public'
            );
            Storage::disk('public')->delete($testimonial->photo);
            $testimonial->photo = $path;
        }
        $res = $testimonial->save();
        if ($res) {
            activity('admin')->performedOn($testimonial)->causedBy($user)->withProperties(['data' => $request])->log('Updated Testimonial.');
            return redirect()->back()->with('success', 'Successfully updated testimonial.');
        } else {
            return redirect()->back()->with('error', 'Failed to update. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $user = auth()->guard('admin')->user();
        $res = $testimonial->delete();
        if ($res) {
            Storage::disk('public')->delete($testimonial->photo);
            activity('admin')->performedOn($testimonial)->causedBy($user)->log('Deleted Testimonial.');
            return redirect()->back()->with('success', 'Successfully deleted testimonial.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete testimonial. Please try again.');
        }
    }
}
