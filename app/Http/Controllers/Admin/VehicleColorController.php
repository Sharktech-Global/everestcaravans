<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Vehicle;
use App\VehicleColor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleColorController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $colors = $vehicle->colors()->orderBy('order')->paginate(10);
        return view('admin.vehicles.colors.index', ['vehicle' => $vehicle, 'colors' => $colors]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            "color"    => "required|array|min:1",
            'color.1' => 'required',
            'color.1' => 'nullable',
            'order' => 'required|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',

        ]);
        $validated['color'] = array_filter($validated['color'], function ($v) {
            return !is_null($v) && $v !== '';
        });
        $color = new VehicleColor;
        $color->vehicle_id = $vehicle->id;
        $color->name = $validated['name'];
        $color->color = $validated['color'];
        $color->order = $validated['order'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/vehicle/colors',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $color->image = $path;
        }
        $res = $color->save();
        if ($res) {
            activity('admin')->performedOn($color)->causedBy($user)->withProperties(['data' => $request])->log('Added Color to Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully added color to vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to add color to vehicle. Please try again.');
        }
    }

    public function edit(Vehicle $vehicle, VehicleColor $vehicleColor)
    {
        return view('admin.vehicles.colors.edit', ['vehicle' => $vehicle, 'vehicleColor' => $vehicleColor]);
    }

    public function update(Request $request, Vehicle $vehicle, VehicleColor $vehicleColor)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            "color"    => "required|array|min:1",
            'color.1' => 'required',
            'color.1' => 'nullable',
            'order' => 'required|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',

        ]);
        $validated['color'] = array_filter($validated['color'], function ($v) {
            return !is_null($v) && $v !== '';
        });
        $vehicleColor->vehicle_id = $vehicle->id;
        $vehicleColor->name = $validated['name'];
        $vehicleColor->order = $validated['order'];
        $vehicleColor->color = $validated['color'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($vehicleColor->image);
            $path = $request->file('image')->storeAs(
                'upload/vehicle/colors',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $vehicleColor->image = $path;
        }
        $res = $vehicleColor->save();
        if ($res) {
            activity('admin')->performedOn($vehicleColor)->causedBy($user)->withProperties(['data' => $request])->log('Edited Color #' . $vehicleColor->name . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully edited color of vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit color of vehicle. Please try again.');
        }
    }

    public function destroy(Request $request, Vehicle $vehicle, VehicleColor $vehicleColor)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicleColor->delete();
        if ($res) {
            Storage::disk('public')->delete($vehicleColor->image);
            activity('admin')->performedOn($vehicleColor)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Color #' . $vehicleColor->name . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted color of vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete color of vehicle. Please try again.');
        }
    }
}
