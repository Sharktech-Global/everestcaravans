<?php

namespace App\Http\Controllers\Admin;


use App\Service;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $pages = Service::search($search)->latest("updated_at")->paginate(10);
        return view('admin.services.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'sub_title' => 'nullable',
            'content' => 'nullable',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'status' => 'required',
            'order' => 'required|unique:services,order',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $Service = new Service;
        $Service->title = $validated['title'];
        $Service->sub_title = $validated['sub_title'];
        $Service->slug = SlugService::createSlug(Service::class, 'slug', $Service->title, ['unique' => false]);
        $Service->content = $validated['content'];
        $Service->status = $validated['status'];
        $Service->order = $validated['order'];
        $Service->seo_title = $validated['seo_title'];
        $Service->seo_description = $validated['seo_description'];
        $Service->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/Service/image',
                $Service->title . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $Service->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path = $request->file('mobile_image')->storeAs(
                'upload/Service/mobile_image',
                $Service->title . '_' . $request->mobile_image->getClientOriginalName(),
                'public'
            );
            $Service->mobile_image = $path;
        }
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/Service/banner_image',
                $request->banner_image->getClientOriginalName(),
                'public'
            );
            $Service->banner_image = $path;
        }
        $res = $Service->save();
        if ($res) {
            activity('admin')->performedOn($Service)->causedBy($user)->withProperties(['data' => $request])->log('Created New Page.');
            return redirect()->back()->with('success', 'Successfully created new page.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new page. Please try again.');
        }
    }

    public function show($slug)
    {
        $Service = Service::where('slug', $slug)->firstOrFail();
        return view('admin.services.show', compact('Service'));
    }

    public function edit(Service $Service)
    {
      
        return view('admin.services.edit', ['Service' => $Service]);
    }

    public function update(Request $request, Service $Service)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'sub_title' => 'nullable',
            'content' => 'nullable',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'status' => 'required',
            'order' => 'required|unique:services,order,' . $Service->id,
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',

        ]);
        $Service->title = $validated['title'];
        $Service->sub_title = $validated['sub_title'];
        $Service->slug = SlugService::createSlug(Service::class, 'slug', $Service->title, ['unique' => false]);
        $Service->content = $validated['content'];
        $Service->status = $validated['status'];
        $Service->order = $validated['order'];
        $Service->seo_title = $validated['seo_title'];
        $Service->seo_description = $validated['seo_description'];
        $Service->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($Service->image);
            $path = $request->file('image')->storeAs(
                'upload/Service/image',
                $Service->title . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $Service->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            Storage::disk('public')->delete($Service->mobile_image);
            $path = $request->file('mobile_image')->storeAs(
                'upload/Service/mobile_image',
                $Service->title . '_' . $request->mobile_image->getClientOriginalName(),
                'public'
            );
            $Service->mobile_image = $path;
        }
        if ($request->hasFile('banner_image')) {
            Storage::disk('public')->delete($Service->banner_image);
            $path = $request->file('banner_image')->storeAs(
                'upload/Service/banner_image',
                $request->banner_image->getClientOriginalName(),
                'public'
            );
            $Service->banner_image = $path;
        }
        $res = $Service->save();
        if ($res) {
            activity('admin')->performedOn($Service)->causedBy($user)->withProperties(['data' => $request])->log('Updated Service #' . $Service->name . '.');
            return redirect()->back()->with('success', 'Successfully updated the servie details.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the servie details. Please try again.');
        }
    }

    public function destroy(Request $request, Service $Service)
    {
        $user = auth()->guard('admin')->user();
        $res = $Service->delete();
        if ($res) {
            Storage::disk('public')->delete($Service->image);
            Storage::disk('public')->delete($Service->banner_image);
            activity('admin')->performedOn($Service)->causedBy($user)->withProperties(['data' => $request])->log('Deleted servie #' . $Service->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the servie.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the servie. Please try again.');
        }
    }
}
