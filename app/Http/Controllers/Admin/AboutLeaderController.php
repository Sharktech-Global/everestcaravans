<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\AboutLeader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutLeaderController extends Controller
{
    public function index(Request $request)
    {
        $leaders=AboutLeader::orderBy('order','ASC')->paginate(10);
        return view('admin.about-page.leaders.index', ['leaders' => $leaders]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:about_leaders',
            'email' => 'nullable',
            'mobile' => 'nullable',
            'order' => 'required|unique:about_leaders,order',
            'position' => 'nullable',
            // 'dob' => 'nullable',
            'details' => 'nullable',
            'images' => 'nullable',
            'status' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'

        ]);
        $detail = new AboutLeader();
        $detail->name = $validated['name'];
        // $detail->dob = $validated['dob'];
        $detail->email = $validated['email'];
        $detail->mobile = $validated['mobile'];
        $detail->position = $validated['position'];
        $detail->details = $validated['details'];
        $detail->status = $validated['status'];
        $detail->order = $validated['order'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($detail->image);
            $path = $request->file('image')->storeAs(
                'upload/blogs/image',
                 $request->image->getClientOriginalName(),
                'public'
            );
            $detail->image = $path;
        }
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to leader #' . $detail->name . '.');
            return redirect()->back()->with('success', 'Successfully added leader.');
        } else {
            return redirect()->back()->with('error', 'Failed to add leader. Please try again.');
        }
    }
     
    public function edit(Request $request,$id)
    {
        $leader = AboutLeader::where('id',$id)->first();
        return view('admin.about-page.leaders.edit', ['leader' => $leader]);
    }

    public function update(Request $request,$id)
    {
        $detail = AboutLeader::where('id',$id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:about_leaders,name,' . $detail->id,
            'email' => 'nullable',
            'mobile' => 'nullable',
            'position' => 'nullable',
            'order' => 'required|unique:about_leaders,order,'.$detail->id,
            // 'dob' => 'nullable',
            'details' => 'nullable',
            'images' => 'nullable',
            'status' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'

        ]);
        $detail->name = $validated['name'];
        // $detail->dob = $validated['dob'];
        $detail->email = $validated['email'];
        $detail->mobile = $validated['mobile'];
        $detail->position = $validated['position'];
        $detail->status = $validated['status'];
        $detail->details = $validated['details'];
        $detail->order = $validated['order'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($detail->image);
            $path = $request->file('image')->storeAs(
                'upload/blogs/image',
                $request->image->getClientOriginalName(),
                'public'
            );
            $detail->image = $path;
        }
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to leader #' . $detail->name . '.');
            return redirect()->back()->with('success', 'Successfully Updated leader.');
        } else {
            return redirect()->back()->with('error', 'Failed to update leader. Please try again.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $leader = AboutLeader::where('id',$id)->first();
        $res = $leader->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the leader.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the leader. Please try again.');
        }
    }
}
