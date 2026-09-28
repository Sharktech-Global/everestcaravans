<?php

namespace App\Http\Controllers\Admin;

use App\Fuel;
use App\Vehicle;
use App\Transmission;
use App\VehicleVarient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleVarientController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $varients = $vehicle->varients()->paginate(10);
        $fuels = Fuel::where('status', 1)->orderBy('name')->get();
        $transmissions = Transmission::where('status', 1)->orderBy('name')->get();
        return view('admin.vehicles.varients.index', ['vehicle' => $vehicle, 'varients' => $varients, 'fuels' => $fuels, 'transmissions' => $transmissions]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            "fuel"  => "required|string",
            "transmission"  => "required|string",
            'status' => 'required',

        ]);
        $varient = new VehicleVarient;
        $varient->vehicle_id = $vehicle->id;
        $varient->name = $validated['name'];
        $varient->fuel_id = $validated['fuel'];
        $varient->transmission_id = $validated['transmission'];
        $varient->status = $validated['status'];
        $res = $varient->save();
        if ($res) {
            activity('admin')->performedOn($varient)->causedBy($user)->withProperties(['data' => $request])->log('Added Variant to #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully added variant to vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to add variant to vehicle. Please try again.');
        }
    }

    public function edit(Vehicle $vehicle, VehicleVarient $vehicleVarient)
    {
        $fuels = Fuel::where('status', 1)->orderBy('name')->get();
        $transmissions = Transmission::where('status', 1)->orderBy('name')->get();
        return view('admin.vehicles.varients.edit', ['vehicle' => $vehicle, 'vehicleVarient' => $vehicleVarient, 'fuels' => $fuels, 'transmissions' => $transmissions]);
    }

    public function update(Request $request, Vehicle $vehicle, VehicleVarient $vehicleVarient)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            "fuel"  => "required|string",
            "transmission"  => "required|string",
            'status' => 'required',

        ]);
        $vehicleVarient->vehicle_id = $vehicle->id;
        $vehicleVarient->name = $validated['name'];
        $vehicleVarient->fuel_id = $validated['fuel'];
        $vehicleVarient->transmission_id = $validated['transmission'];
        $vehicleVarient->status = $validated['status'];
        $res = $vehicleVarient->save();
        if ($res) {
            activity('admin')->performedOn($vehicleVarient)->causedBy($user)->withProperties(['data' => $request])->log('Edited Varient #' . $vehicleVarient->name . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully edited variant of vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit variant of vehicle. Please try again.');
        }
    }

    public function destroy(Request $request, Vehicle $vehicle, VehicleVarient $vehicleVarient)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicleVarient->delete();
        if ($res) {
            activity('admin')->performedOn($vehicleVarient)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Varient #' . $vehicleVarient->name . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted variant of vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete variant of vehicle. Please try again.');
        }
    }
}
