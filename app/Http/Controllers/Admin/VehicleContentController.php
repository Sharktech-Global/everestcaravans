<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Vehicle;
use App\VehicleContent;
use Illuminate\Http\Request;

class VehicleContentController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $contents = $vehicle->contents()->orderBy('order')->paginate(10);
        return view('admin.vehicles.content.index', ['vehicle' => $vehicle,'contents' => $contents]);
    }

    public function create(Vehicle $vehicle)
    {
        return view('admin.vehicles.content.create', ['vehicle' => $vehicle]);
    }

    public function store(Request $request,Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'order' => 'required|unique:vehicle_contents,order,NULL,id,vehicle_id,' . $vehicle->id,
            'background' => 'required',

        ]);
        $detail = new VehicleContent();
        $detail->vehicle_id = $vehicle->id;
        $detail->title = $validated['title'];
        $detail->description = $validated['description'];
        $detail->order = $validated['order'];
        $detail->background = $validated['background'];
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Content to Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully created contnet section.');
        } else {
            return redirect()->back()->with('error', 'Failed to create contnet section. Please try again.');
        }
    }

    public function edit(Vehicle $vehicle, VehicleContent $vehicleContent)
    {
        return view('admin.vehicles.content.edit', ['vehicle' => $vehicle, 'vehicleContent' => $vehicleContent]);
    }

    public function update(Request $request, Vehicle $vehicle, VehicleContent $vehicleContent)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'order' => 'required|unique:vehicle_contents,order,' . $vehicleContent->id . ',id,vehicle_id,' . $vehicle->id,
            'background' => 'required',
        ]);
        $vehicleContent->vehicle_id = $vehicle->id;
        $vehicleContent->title = $validated['title'];
        $vehicleContent->description = $validated['description'];
        $vehicleContent->order = $validated['order'];
        $vehicleContent->background = $validated['background'];
        $res = $vehicleContent->save();
        if ($res) {
            activity('admin')->performedOn($vehicleContent)->causedBy($user)->withProperties(['data' => $request])->log('Edited Content Section ' . $vehicleContent->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully edited Content section.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit Content section. Please try again.');
        }
    }

    public function destroy(Request $request, Vehicle $vehicle, VehicleContent $vehicleContent)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicleContent->delete();
        if ($res) {
            activity('admin')->performedOn($vehicleContent)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Content Section ' . $vehicleContent->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted Content section.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Content section. Please try again.');
        }
    }

}
