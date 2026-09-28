<?php

namespace App\Http\Controllers\Admin;

use App\LocationType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationTypeController extends Controller
{
    public function index()
    {
        return view('admin.location_types.index', ['location_types' => LocationType::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:location_types,name',
            'status' => 'required'
        ]);
        $type = new LocationType;
        $type->name = $validated['name'];
        $type->status = $validated['status'];
        $res = $type->save();
        if ($res) {
            activity('admin')->performedOn($type)->causedBy($user)->withProperties(['data' => $request])->log('Created New Location Type.');
            return redirect()->back()->with('success', 'Successfully created new location type.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new location type. Please try again.');
        }
    }

    public function show(LocationType $locationType)
    {
        return redirect()->route('admin.location_types.edit', $locationType->id);
    }

    public function edit(LocationType $locationType)
    {
        return view('admin.location_types.edit', ['locationType' => $locationType]);
    }

    public function update(Request $request, LocationType $locationType)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:location_types,name,' . $locationType->id,
            'status' => 'required'
        ]);
        $locationType->name = $validated['name'];
        $locationType->status = $validated['status'];
        $res = $locationType->save();
        if ($res) {
            activity('admin')->performedOn($locationType)->causedBy($user)->withProperties(['data' => $request])->log('Updated Location Type #' . $locationType->name . '.');
            return redirect()->back()->with('success', 'Successfully updated location type.');
        } else {
            return redirect()->back()->with('error', 'Failed to update location type. Please try again.');
        }
    }
    public function destroy(LocationType $locationType, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $locationType->delete();
        if ($res) {
            activity('admin')->performedOn($locationType)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Location Type #' . $locationType->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the location type.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the location type. Please try again.');
        }
    }
}
