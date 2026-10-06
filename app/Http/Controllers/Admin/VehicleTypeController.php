<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VehicleType;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        return view('admin.vehicle-types.index', ['types' => VehicleType::orderBy("order")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:vehicle_types,name',
            'status' => 'required',
            'has_sales_page' => 'required',
            'sales_page' => 'required_if:has_sales_page,1',
            'order' => 'required|min:1',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $type = new VehicleType();
        $type->name = $validated['name'];
        $type->slug = Str::slug($type->name, '-');
        $type->has_sales_page = $validated['has_sales_page'];
        $type->sales_page = $validated['sales_page'];
        $type->status = $validated['status'];
        $type->order = $validated['order'];
        $type->seo_title = $validated['seo_title'];
        $type->seo_description = $validated['seo_description'];
        $type->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/blogs/image',
                $type->name . '_' . $request->image->getClientOriginalName(),
                'public'
            );

            $type->image = $path;
        }
        $res = $type->save();
        if ($res) {
            activity('admin')->performedOn($type)->causedBy($user)->withProperties(['data' => $request])->log('Created New Vehicle Type.');
            return redirect()->back()->with('success', 'Successfully created new vehicle type.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new vehicle type. Please try again.');
        }
    }

    public function show(VehicleType $vehicleType)
    {
        return redirect()->route('admin.vehicle-types.edit', $vehicleType->id);
    }

    public function edit(VehicleType $vehicleType)
    {
        return view('admin.vehicle-types.edit', ['type' => $vehicleType]);
    }

    public function update(Request $request, VehicleType $vehicleType)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:vehicle_types,name,' . $vehicleType->id,
            'status' => 'required',
            'has_sales_page' => 'required',
            'sales_page' => 'required_if:has_sales_page,1',
            'order' => 'required|min:1',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $vehicleType->name = $validated['name'];
        $vehicleType->slug = Str::slug($vehicleType->name, '-');
        $vehicleType->has_sales_page = $validated['has_sales_page'];
        $vehicleType->sales_page = $validated['sales_page'];
        $vehicleType->status = $validated['status'];
        $vehicleType->order = $validated['order'];
        $vehicleType->seo_title = $validated['seo_title'];
        $vehicleType->seo_description = $validated['seo_description'];
        $vehicleType->seo_keywords = $validated['seo_keywords'];
        if ($request->hasFile('image')) {

            if (!empty($vehicleType->image)) {
                Storage::disk('public')->delete($vehicleType->image);
            }

            $path = $request->file('image')->storeAs(
                'upload/blogs/image',
                $vehicleType->name . '_' . $request->image->getClientOriginalName(),
                'public'
            );

            $vehicleType->image = $path;
        }
        $res = $vehicleType->save();
        if ($res) {
            activity('admin')->performedOn($vehicleType)->causedBy($user)->withProperties(['data' => $request])->log('Updated Vehicle Type #' . $vehicleType->name . '.');
            return redirect()->back()->with('success', 'Successfully updated vehicle type.');
        } else {
            return redirect()->back()->with('error', 'Failed to update vehicle type. Please try again.');
        }
    }
    public function destroy(VehicleType $vehicleType, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicleType->delete();
        if ($res) {
            activity('admin')->performedOn($vehicleType)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Vehicle Type #' . $vehicleType->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the vehicle type.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the vehicle type. Please try again.');
        }
    }
}
