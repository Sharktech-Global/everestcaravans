<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VehicleType;
use App\VehicleApplication;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VehicleApplicationController extends Controller
{
    public function index()
    {
        $types = VehicleType::whereStatus(1)->orderBy('name')->get();
        $applications = VehicleApplication::with('vehicle_type')->orderBy("order_by")->paginate(10);
        return view('admin.vehicle-application.index', ['applications' => $applications,'types' => $types]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:vehicle_applications,name',
            'status' => 'required',
            'vehicle_type_id' => 'required',
            'order' => 'required|min:1',
        ]);
        $type = new VehicleApplication();
        $type->name = $validated['name'];
        $type->slug = Str::slug($type->name, '-');
        $type->vehicle_type_id = $validated['vehicle_type_id'];
        $type->status = $validated['status'];
        $type->order_by = $validated['order'];
        $res = $type->save();
        if ($res) {
            activity('admin')->performedOn($type)->causedBy($user)->withProperties(['data' => $request])->log('Created New Vehicle Type.');
            return redirect()->back()->with('success', 'Successfully created new vehicle application.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new vehicle application. Please try again.');
        }
    }

   
    public function edit(VehicleApplication $VehicleApplication)
    {
        $datas = VehicleType::whereStatus(1)->orderBy('name')->get();
        return view('admin.vehicle-application.edit', ['type' => $VehicleApplication,'datas' => $datas]);
    }

    public function update(Request $request, VehicleApplication $VehicleApplication)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:vehicle_applications,name,' . $VehicleApplication->id,
            'status' => 'required',
            'vehicle_type_id' => 'required',
            'order' => 'required|min:1',
        ]);
        $VehicleApplication->name = $validated['name'];
        $VehicleApplication->slug = Str::slug($VehicleApplication->name, '-');
        $VehicleApplication->vehicle_type_id = $validated['vehicle_type_id'];
        $VehicleApplication->status = $validated['status'];
        $VehicleApplication->order_by = $validated['order'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($VehicleApplication->image);
            $path = $request->file('image')->storeAs(
                'upload/blogs/image',
                $VehicleApplication->title . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $VehicleApplication->image = $path;
        }
        $res = $VehicleApplication->save();
        if ($res) {
            activity('admin')->performedOn($VehicleApplication)->causedBy($user)->withProperties(['data' => $request])->log('Updated Vehicle Application #' . $VehicleApplication->name . '.');
            return redirect()->back()->with('success', 'Successfully updated vehicle application.');
        } else {
            return redirect()->back()->with('error', 'Failed to update vehicle application. Please try again.');
        }
    }
    public function destroy(VehicleApplication $VehicleApplication, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $VehicleApplication->delete();
        if ($res) {
            activity('admin')->performedOn($VehicleApplication)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Vehicle Application #' . $VehicleApplication->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the vehicle type.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the vehicle type. Please try again.');
        }
    }

}
