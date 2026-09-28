<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\VehicleSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleSectionController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $sections = $vehicle->sections()->orderBy('order')->paginate(10);
        return view('admin.vehicles.sections.index', ['vehicle' => $vehicle, 'sections' => $sections]);
    }

    public function create(Vehicle $vehicle)
    {
        return view('admin.vehicles.sections.create', ['vehicle' => $vehicle]);
    }
    public function store(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'order' => 'required|unique:vehicle_sections,order,NULL,id,vehicle_id,' . $vehicle->id,
            'has_tab' => 'required',
            'background' => 'required',

        ]);
        $detail = new VehicleSection;
        $detail->vehicle_id = $vehicle->id;
        $detail->title = $validated['title'];
        $detail->description = $validated['description'];
        $detail->order = $validated['order'];
        $detail->has_tab = $validated['has_tab'];
        $detail->background = $validated['background'];
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Section to Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully created detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to create detail section. Please try again.');
        }
    }

    public function edit(Vehicle $vehicle, VehicleSection $vehicleSection)
    {
        return view('admin.vehicles.sections.edit', ['vehicle' => $vehicle, 'vehicleSection' => $vehicleSection]);
    }

    public function update(Request $request, Vehicle $vehicle, VehicleSection $vehicleSection)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'order' => 'required|unique:vehicle_sections,order,' . $vehicleSection->id . ',id,vehicle_id,' . $vehicle->id,
            'has_tab' => 'required',
            'background' => 'required',
        ]);
        $vehicleSection->vehicle_id = $vehicle->id;
        $vehicleSection->title = $validated['title'];
        $vehicleSection->description = $validated['description'];
        $vehicleSection->order = $validated['order'];
        $vehicleSection->has_tab = $validated['has_tab'];
        $vehicleSection->background = $validated['background'];
        $res = $vehicleSection->save();
        if ($res) {
            activity('admin')->performedOn($vehicleSection)->causedBy($user)->withProperties(['data' => $request])->log('Edited Detail Section ' . $vehicleSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully edited detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit detail section. Please try again.');
        }
    }

    public function destroy(Request $request, Vehicle $vehicle, VehicleSection $vehicleSection)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicleSection->delete();
        if ($res) {
            activity('admin')->performedOn($vehicleSection)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Detail Section ' . $vehicleSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete detail section. Please try again.');
        }
    }
}
