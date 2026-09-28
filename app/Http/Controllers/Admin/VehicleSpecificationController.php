<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\Specification;
use App\VehicleSpecification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleSpecificationController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $vspecifications = $vehicle->specifications()->get();
        $specifications = Specification::where('status', 1)->orderBy('name')->get();
        return view('admin.vehicles.specifications.index', ['vehicle' => $vehicle, 'specifications' => $specifications, 'vspecifications' => $vspecifications]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'details' => 'required|array|min:1',

        ]);
        foreach ($validated['details'] as $key => $value) {
            $specification = VehicleSpecification::getBySpecification($vehicle->id, $key);
            $specification->vehicle_id = $vehicle->id;
            $specification->specification_id = $key;
            $specification->value = $value;
            $specification->save();
            activity('admin')->performedOn($specification)->causedBy($user)->withProperties(['data' => $request])->log('Added Specification to Vehicle #' . $vehicle->name . '.');
        }
        return redirect()->back()->with('success', 'Successfully added specification to vehicle.');
    }
}
