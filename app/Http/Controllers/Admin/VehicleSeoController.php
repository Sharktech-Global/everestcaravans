<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\VehicleSeo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleSeoController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $seo = $vehicle->seo;
        return view('admin.vehicles.seo.index', ['vehicle' => $vehicle, 'seo' => $seo]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',

        ]);
        $seo = VehicleSeo::getByVehicle($vehicle->id);
        $seo->vehicle_id = $vehicle->id;
        $seo->title = $validated['title'];
        $seo->description = $validated['description'];
        $seo->keywords = $validated['keywords'];
        $res = $seo->save();
        if ($res) {
            activity('admin')->performedOn($seo)->causedBy($user)->withProperties(['data' => $request])->log('Updated SEO for Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully updated seo for vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to update seo for vehicle. Please try again.');
        }
    }
}
