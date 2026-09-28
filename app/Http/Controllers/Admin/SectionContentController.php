<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use App\SectionContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SectionContentController extends Controller
{

    public function index( $id)
    {
        $sections= Section::where('id',$id)->first();
        // dd($sections);
        $contents = SectionContent::where('section_id',$sections->id)->get();

// dd( $sections );

        return view('admin.sections.content.index',compact('sections','contents'));
    }
    public function create($id)
    {
        $section= Section::where('id',$id)->first();
        return view('admin.sections.content.create',compact('section'));
    }
    public function store(Request $request, $id)
    {
        // return 1;
        // dd($request);
        $section= Section::where('id',$id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            'icon_content' => 'nullable',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
            'status' => 'required',
        ]); 

        $content = new SectionContent();
        $content->id = (string) Str::uuid();
        $content->section_id = $section->id;
        $content->title =  $validated['title'];
        $content->icon_content =  $validated['icon_content'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->button_link =  $validated['button_link'];
        $section->status = $validated['status'];

        if ($request->hasFile('icon')) {
            $path =  $request->file('icon')->storeAs('media/image',  $validated['icon']->getClientOriginalName(), 'public');
            $content->icon = $path;
        }
        $res = $content->save();
        //  dd($res);
        if ($res) {
            // activity('admin')->performedOn($section)->causedBy($user)->withProperties(['data' => $request])->log('Created New Section.');
            return redirect()->back()->with('success', 'Successfully created new section.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new section. Please try again.');
        }


    }
    public function edit($id,$uuid)
    {
        $section= Section::where('id',$id)->first();
        $content = SectionContent::where('id',$uuid)->first();
        // dd($content);
        return view('admin.sections.content.edit',compact('section','content'));
    }


    public function update(Request $request, $id,$uuid)
    {
        $section= Section::where('id',$id)->first();
        $content = SectionContent::where('id',$uuid)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2000',
            'order' => 'required|numeric',
            'icon_content' => 'nullable',
            'button_title' => 'nullable',
            'button_link' => 'nullable',
            'status' => 'required',
        ]); 

        // $content = new ServiceContent(); 
        // $content->service_id = $services->uuid;
        $content->section_id = $section->id;
        $content->title =  $validated['title'];
        $content->icon_content =  $validated['icon_content'];
        $content->order =  $validated['order'];
        $content->button_title =  $validated['button_title'];
        $content->button_link =  $validated['button_link'];
        $section->status = $validated['status'];

        if ($request->hasFile('icon')) {
            $path =  $request->file('icon')->storeAs('media/image',  $validated['icon']->getClientOriginalName(), 'public');
            $content->icon = $path;
        }
        $res = $content->save();

       
        if ($res) {
            // activity('admin')->performedOn($section)->causedBy($user)->withProperties(['data' => $request])->log('Created New Section.');
            return redirect()->back()->with('success', 'Updated created new section.');
        } else {
            return redirect()->back()->with('error', 'Failed to Updated new section. Please try again.');
        }
    }

    public function destroy($id,$uuid)
    {
        // $this->authorize('delete', $menu);
        // $res = Service::where('uuid',$id);
        $res = SectionContent::where('id',$uuid)->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


}