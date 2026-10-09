<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Blog;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs=Blog::paginate(10);
        return view('admin.blogs.index', ['blogs' => $blogs]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required|unique:blogs',
            'date' => 'nullable',
            'details' => 'nullable',
            'images' => 'nullable',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'

        ]);
       
        $detail = new Blog();
        $detail->title = $validated['title'];
        $detail->slug = SlugService::createSlug(Blog::class, 'slug', $validated['title'], ['unique' => true]);
        $detail->date_display = $validated['date'];
        $detail->details = $validated['details'];
        $detail->status = $validated['status'];
        $detail->seo_title = $validated['seo_title'];
        $detail->seo_description = $validated['seo_description'];
        $detail->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('feature_image')) {

            if (!empty($detail->feature_image)) {
                Storage::disk('public')->delete($detail->feature_image);
            }

            $path = $request->file('feature_image')->storeAs(
                'upload/blogs/feature_image',
                $request->file('feature_image')->getClientOriginalName(),
                'public'
            );

            $detail->feature_image = $path;
        }
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to vehicle feature #' . $detail->title . '.');
            return redirect()->back()->with('success', 'Successfully added blog.');
        } else {
            return redirect()->back()->with('error', 'Failed to add blog. Please try again.');
        }
    }
     
    public function edit(Request $request,$id)
    {
        $blog = Blog::where('id',$id)->first();
        return view('admin.blogs.edit', ['blog' => $blog]);
    }

    public function update(Request $request,$id)
    {
        $detail = Blog::where('id',$id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required|unique:blogs,title,' . $detail->id,
            'date' => 'nullable',
            'details' => 'nullable',
            'images' => 'nullable',
            'status' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'

        ]);
        $detail->title = $validated['title'];
        $detail->slug = SlugService::createSlug(Blog::class, 'slug', $detail->title, ['unique' => false]);
        $detail->date_display = $validated['date'];
        $detail->status = $validated['status'];
        $detail->details = $validated['details'];
        $detail->seo_title = $validated['seo_title'];
        $detail->seo_description = $validated['seo_description'];
        $detail->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('feature_image')) {
            Storage::disk('public')->delete($detail->feature_image);
            $path = $request->file('feature_image')->storeAs(
                'upload/blogs/feature_image',
                $request->feature_image->getClientOriginalName(),
                'public'
            );
            $detail->feature_image = $path;
        }
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to vehicle feature #' . $detail->title . '.');
            return redirect()->back()->with('success', 'Successfully Updated blog.');
        } else {
            return redirect()->back()->with('error', 'Failed to update blog. Please try again.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $blog = Blog::where('id',$id)->first();
        $res = $blog->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the blog.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the blog. Please try again.');
        }
    }
    
}
