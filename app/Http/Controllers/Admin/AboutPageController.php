<?php

namespace App\Http\Controllers\Admin;

use App\AboutPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $pages = AboutPage::paginate(10);
        return view('admin.about-page.index', ['pages' => $pages]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();  
        $validated = $request->validate([

            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'required',
            'title' => 'nullable',
            // 'link' => 'nullable',
            'sub_title' => 'nullable',
            'content_image_one' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content_image_two' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content_image_three' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            // 'seo_title' => 'nullable',
            // 'seo_description' => 'nullable',
            // 'seo_keywords' => 'nullable',


        ]);
        $page = new AboutPage();
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->title = $validated['title'];

        $page->sub_title = $validated['sub_title'];
        // $page->link = $validated['link'];
        // $page->seo_title = $validated['seo_title'];
        // $page->seo_description = $validated['seo_description'];
        // $page->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }
        if ($request->hasFile('content_image_one')) {
            $path = $request->file('content_image_one')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_one->getClientOriginalName(),
                'public'
            );
            $page->content_image_one = $path;
        }
        if ($request->hasFile('content_image_two')) {
            $path = $request->file('content_image_two')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_two->getClientOriginalName(),
                'public'
            );
            $page->content_image_two = $path;
        }
        if ($request->hasFile('content_image_three')) {
            $path = $request->file('content_image_three')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_three->getClientOriginalName(),
                'public'
            );
            $page->content_image_three = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated About Page.');
            return redirect()->back()->with('success', 'Successfully Created About page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update About page. Please try again.');
        }
    }
    public function edit(Request $request,$id)
    {
        $page = AboutPage::where('id',$id)->first();
        return view('admin.about-page.edit', ['page' => $page]);
    }

    public function update(Request $request,$id)
    {
        $user = auth()->guard('admin')->user();  
        $page = AboutPage::where('id',$id)->first();
        $validated = $request->validate([

            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'required',
            'title' => 'nullable',
            // 'link' => 'nullable',
            'sub_title' => 'nullable',
            'content_image_one' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content_image_two' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content_image_three' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            // 'seo_title' => 'nullable',
            // 'seo_description' => 'nullable',
            // 'seo_keywords' => 'nullable',


        ]);
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->title = $validated['title'];

        $page->sub_title = $validated['sub_title'];
        // $page->link = $validated['link'];
        // $page->seo_title = $validated['seo_title'];
        // $page->seo_description = $validated['seo_description'];
        // $page->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }
        if ($request->hasFile('content_image_one')) {
            $path = $request->file('content_image_one')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_one->getClientOriginalName(),
                'public'
            );
            $page->content_image_one = $path;
        }
        if ($request->hasFile('content_image_two')) {
            $path = $request->file('content_image_two')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_two->getClientOriginalName(),
                'public'
            );
            $page->content_image_two = $path;
        }
        if ($request->hasFile('content_image_three')) {
            $path = $request->file('content_image_three')->storeAs(
                'upload/site',
                time() . '_' . $request->content_image_three->getClientOriginalName(),
                'public'
            );
            $page->content_image_three = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated About Page.');
            return redirect()->back()->with('success', 'Successfully updated About page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update About page. Please try again.');
        }
    }
    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $page = AboutPage::where('id',$id)->first();
        $res = $page->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the page.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the page. Please try again.');
        }
    }
}
