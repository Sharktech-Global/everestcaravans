<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Vehicle;
use App\VehicleAllFeature;
use App\VehicleAllFeatureImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleFeatureController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $vehicle=Vehicle::where('id',$vehicle->id)->first();
        $features = VehicleAllFeature::where('vehicle_id',$vehicle->id)->orderBy('title')->paginate(10);
        return view('admin.vehicles.features.index', ['vehicle' => $vehicle, 'features' => $features]);
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'subtitle' => 'nullable',
            'details' => 'nullable',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'

        ]);
        $detail = new VehicleAllFeature();
        $detail->vehicle_id = $vehicle->id;
        $detail->title = $validated['title'];
        $detail->subtitle = $validated['subtitle'];
        $detail->details = $validated['details'];
        $res = $detail->save();
        if ($res) {
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $image)
                {
                    $image_data = new VehicleAllFeatureImage();
                    $path = $image->storeAs(
                        'upload/vehicle/image/feature',
                        time() . '_' . $image->getClientOriginalName(),
                        'public'
                    );
                    $image_data->vehicle_id = $vehicle->id;
                    $image_data->vehicle_feature_id = $detail->id;
                    $image_data->image = $path;
                    $image_data->save();
                }
            }
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to vehicle feature #' . $detail->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully added image to detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to add image to detail section. Please try again.');
        }
    }
    
    public function edit(Vehicle $vehicle,$id)
    {
        $vehicleFeature = VehicleAllFeature::with('image_files')->where('id',$id)->first();
        return view('admin.vehicles.features.edit', ['vehicle' => $vehicle, 'vehicleFeature' => $vehicleFeature]);
    }


    public function update(Request $request, Vehicle $vehicle,$id)
    {
        $detail = VehicleAllFeature::where('id',$id)->firstOrFail();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'subtitle' => 'nullable',
            'details' => 'nullable',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'

        ]);
        $detail->vehicle_id = $vehicle->id;
        $detail->title = $validated['title'];
        $detail->subtitle = $validated['subtitle'];
        $detail->details = $validated['details'];
        $res = $detail->save();
        if ($res) {
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $image)
                {
                    $image_data = new VehicleAllFeatureImage();
                    $path = $image->storeAs(
                        'upload/vehicle/image/feature',
                        time() . '_' . $image->getClientOriginalName(),
                        'public'
                    );
                    $image_data->vehicle_id = $vehicle->id;
                    $image_data->vehicle_feature_id = $detail->id;
                    $image_data->image = $path;
                    $image_data->save();
                }
            }
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to vehicle feature #' . $detail->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully added image to detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to add image to detail section. Please try again.');
        }
    }

    public function destroy_image(Request $request,$id)
    {
        $user = auth()->guard('admin')->user();
        $vehicleFeature = VehicleAllFeatureImage::where('id',$id)->first();
        $res = $vehicleFeature->delete();
        return response()->json(['status' => "success"]);
    }

    public function destroy(Vehicle $vehicle, $id)
    {
        $user = auth()->guard('admin')->user();
        $VehicleAllFeature = VehicleAllFeature::with('image_files')->where('id',$id)->first();
        $vehicleFeatureImage = VehicleAllFeatureImage::where('vehicle_feature_id',$VehicleAllFeature->id)->delete();
        $res = $VehicleAllFeature->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the vehicle feature.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the vehicle feature. Please try again.');
        }
    }
    
}
