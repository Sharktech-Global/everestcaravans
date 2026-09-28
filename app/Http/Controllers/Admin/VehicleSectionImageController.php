<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Vehicle;
use App\VehicleSection;
use App\VehicleSectionImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleSectionImageController extends Controller
{
    public function index(Vehicle $vehicle, VehicleSection $vehicleSection)
    {
        $images = $vehicleSection->images()->orderBy('order')->paginate(10);
        return view('admin.vehicles.sections.images.index', ['vehicleSection' => $vehicleSection, 'vehicle' => $vehicle, 'images' => $images]);
    }

    public function store(Request $request, Vehicle $vehicle, VehicleSection $vehicleSection)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'order' => 'required|unique:vehicle_section_images,order,NULL,id,vehicle_section_id,' . $vehicleSection->id,

        ]);
        $detail = new VehicleSectionImage;
        $detail->vehicle_id = $vehicle->id;
        $detail->vehicle_section_id = $vehicleSection->id;
        $detail->title = $validated['title'];
        $detail->description = $validated['description'];
        $detail->order = $validated['order'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/vehicle/image/slider',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $detail->image = $path;
        }
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to Section #' . $vehicleSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully added image to detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to add image to detail section. Please try again.');
        }
    }

    public function edit(Vehicle $vehicle, VehicleSection $vehicleSection, VehicleSectionImage $vehicleSectionImage)
    {
        return view('admin.vehicles.sections.images.edit', ['vehicle' => $vehicle, 'vehicleSection' => $vehicleSection, 'vehicleSectionImage' => $vehicleSectionImage]);
    }

    public function update(Request $request, Vehicle $vehicle, VehicleSection $vehicleSection, VehicleSectionImage $vehicleSectionImage)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'order' => 'required|unique:vehicle_section_images,order,' . $vehicleSectionImage->id . ',id,vehicle_section_id,' . $vehicleSection->id,

        ]);
        $vehicleSectionImage->vehicle_id = $vehicle->id;
        $vehicleSectionImage->vehicle_section_id = $vehicleSection->id;
        $vehicleSectionImage->title = $validated['title'];
        $vehicleSectionImage->description = $validated['description'];
        $vehicleSectionImage->order = $validated['order'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($vehicleSectionImage->image);
            $path = $request->file('image')->storeAs(
                'upload/vehicle/image/slider',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $vehicleSectionImage->image = $path;
        }
        $res = $vehicleSectionImage->save();
        if ($res) {
            activity('admin')->performedOn($vehicleSectionImage)->causedBy($user)->withProperties(['data' => $request])->log('Updated Image in Section #' . $vehicleSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully updated image in detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to update image in detail section. Please try again.');
        }
    }

    public function destroy(Request $request, Vehicle $vehicle, VehicleSection $vehicleSection, VehicleSectionImage $vehicleSectionImage)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicleSectionImage->delete();
        if ($res) {
            Storage::disk('public')->delete($vehicleSectionImage->image);
            activity('admin')->performedOn($vehicleSectionImage)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Image in Section #' . $vehicleSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted image in detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete image in detail section. Please try again.');
        }
    }
}
