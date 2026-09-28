<?php

namespace App\Http\Controllers\Admin;


use Storage;
use App\AboutLocation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutLocationController extends Controller
{
    public function index()
    {
        return view('admin.about-page.location.index', ['location_types' => AboutLocation::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:about_locations,name',
            'icon' => 'nullable',
            'icon.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required'
        ]);
        $type = new AboutLocation;
        $type->name = $validated['name'];
        $type->status = $validated['status'];
        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($detail->icon);
            $path = $request->file('icon')->storeAs(
                'upload/blogs/icon',
                $request->icon->getClientOriginalName(),
                'public'
            );
            $AboutLocation->icon = $path;
        }
        $res = $type->save();
        if ($res) {
            activity('admin')->performedOn($type)->causedBy($user)->withProperties(['data' => $request])->log('Created New About location.');
            return redirect()->back()->with('success', 'Successfully created new About location.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new About location. Please try again.');
        }
    }

    public function show(AboutLocation $AboutLocation)
    {
        $locationType =  AboutLocation::where('id',$id)->first();
        return redirect()->route('admin.about-page.location.edit', compact('locationType'));
    }

    public function edit(AboutLocation $AboutLocation,$id)
    {
        $locationType =  AboutLocation::where('id',$id)->first();
        return view('admin.about-page.location.edit',compact('locationType'));
    }

    public function update(Request $request, $id)
    {
        $AboutLocation =  AboutLocation::where('id',$id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:about_locations,name,' . $AboutLocation->id,
            'icon' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required'
        ]);
        $AboutLocation->name = $validated['name'];
        $AboutLocation->status = $validated['status'];
        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($AboutLocation->icon);
            $path = $request->file('icon')->storeAs(
                'upload/blogs/icon',
                $request->icon->getClientOriginalName(),
                'public'
            );
            $AboutLocation->icon = $path;
        }
        $res = $AboutLocation->save();
        if ($res) {
            activity('admin')->performedOn($AboutLocation)->causedBy($user)->withProperties(['data' => $request])->log('Updated About location #' . $AboutLocation->name . '.');
            return redirect()->back()->with('success', 'Successfully updated About location.');
        } else {
            return redirect()->back()->with('error', 'Failed to update About location. Please try again.');
        }
    }
    public function destroy(AboutLocation $AboutLocation, Request $request)
    {
        $requestedId= $request->id;
        $aboutlocation = AboutLocation::find($requestedId);
        $user = auth()->guard('admin')->user();
        $res =  $aboutlocation->delete();
        if ($res) {
            activity('admin')->performedOn($aboutlocation)->causedBy($user)->withProperties(['data' => $request])->log('Deleted About location #' . $request->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the About location.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the About location. Please try again.');
        }
    }
}
