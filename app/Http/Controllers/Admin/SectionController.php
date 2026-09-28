<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Section;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::where('status',1)->paginate(10);
        return view('admin.sections.index', ['sections' => $sections]);
    }

    public function create()
    {
        return view('admin.sections.create');
    }
    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required|unique:sections,title',
            'sub_title' => 'nullable',
            'description' => 'nullable',
            'sub_content' => 'nullable',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'order_number' => 'required|unique:sections,order',
            'link' => 'nullable',
            'status' => 'required',

        ]);
        $section = new Section;
        $section->title = $validated['title'];
        $section->sub_title = $validated['sub_title'];
        $section->sub_content = $validated['sub_content'];
        $section->slug = SlugService::createSlug(Section::class, 'slug', $section->title, ['unique' => false]);
        $section->description = $validated['description'];
        $section->order = $validated['order_number'];
        $section->status = $validated['status'];
        $section->link = $validated['link'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/section/image',
                $section->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $section->image = $path;
        }
        if ($request->hasFile('thumb')) {
            $path = $request->file('thumb')->storeAs(
                'upload/section/thumb',
                $section->slug . '_' . $request->thumb->getClientOriginalName(),
                'public'
            );
            $section->thumbnail = $path;
        }
        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->storeAs(
                'upload/section/background_image',
                $section->slug . '_' . $request->background_image->getClientOriginalName(),
                'public'
            );
            $section->background = $path;
        }
        $res = $section->save();
        if ($res) {
            activity('admin')->performedOn($section)->causedBy($user)->withProperties(['data' => $request])->log('Created New Section.');
            return redirect()->back()->with('success', 'Successfully created new section.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new section. Please try again.');
        }
    }
    public function edit(Section $section)
    {
        $section = Section::where('id',$section->id)->first();
        return view('admin.sections.edit', ['section' => $section]);
    }

    // update code for section
    public function update(Request $request, Section $section)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required|unique:sections,title,' . $section->id,
            'sub_title' => 'nullable',
            'description' => 'nullable',
            'sub_content' => 'nullable',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'order_number' => 'required|unique:sections,order,' . $section->id,
            'link' => 'nullable',
            'status' => 'required',

        ]);
        $section->title = $validated['title'];
        $section->sub_title = $validated['sub_title'];
        $section->sub_content = $validated['sub_content'];
        $section->slug = SlugService::createSlug(Section::class, 'slug', $section->title, ['unique' => false]);
        $section->description = $validated['description'];
        $section->order = $validated['order_number'];
        $section->status = $validated['status'];
        $section->link = $validated['link'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/section/image',
                $section->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $section->image = $path;
        }
        if ($request->hasFile('thumb')) {
            $path = $request->file('thumb')->storeAs(
                'upload/section/thumb',
                $section->slug . '_' . $request->thumb->getClientOriginalName(),
                'public'
            );
            $section->thumbnail = $path;
        }
        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->storeAs(
                'upload/section/background_image',
                $section->slug . '_' . $request->background_image->getClientOriginalName(),
                'public'
            );
            $section->background = $path;
        }
        $res = $section->save();
        if ($res) {
            activity('admin')->performedOn($section)->causedBy($user)->withProperties(['data' => $request])->log('Created New Section.');
            return redirect()->back()->with('success', 'Successfully updated new section.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the section. Please try again.');
        }
    }
    public function destroy(Request $request, Section $section)
    {
        $user = auth()->guard('admin')->user();
        $res = $section->delete();
        if ($res) {
            Storage::disk('public')->delete($section->image);
            Storage::disk('public')->delete($section->thumb);
            Storage::disk('public')->delete($section->background_image);
            activity('admin')->performedOn($section)->causedBy($user)->withProperties(['data' => $request])->log('Deleted section #' . $section->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the section.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the section. Please try again.');
        }
    }

}
