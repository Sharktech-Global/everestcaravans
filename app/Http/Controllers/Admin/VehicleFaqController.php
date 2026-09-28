<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Vehicle;
use App\VehicleFaq;
use Illuminate\Http\Request;

class VehicleFaqController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $faqs = $vehicle->faqs()->orderBy('order')->paginate(10);
        return view('admin.vehicles.faq.index', ['vehicle' => $vehicle,'faqs' => $faqs]);
    }

    public function create(Vehicle $vehicle)
    {
        return view('admin.vehicles.faq.create', ['vehicle' => $vehicle]);
    }

    public function store(Request $request,Vehicle $vehicle)
    {
        
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'order' => 'required|unique:vehicle_faqs,order,NULL,id,vehicle_id,' . $vehicle->id,
        ]);
        $detail = new VehicleFaq();
        $detail->vehicle_id = $vehicle->id;
        $detail->title = $validated['title'];
        $detail->description = $validated['description'];
        $detail->order = $validated['order'];
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Faq to Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully created contnet section.');
        } else {
            return redirect()->back()->with('error', 'Failed to create contnet section. Please try again.');
        }
    }

    public function edit(Vehicle $vehicle,$id)
    {
        $vehicleFaq = VehicleFaq::where('id',$id)->first();
        return view('admin.vehicles.faq.edit', ['vehicle' => $vehicle, 'vehicleFaq' => $vehicleFaq]);
    }

    public function update(Request $request, Vehicle $vehicle,$id)
    {
        $vehicleFaq = VehicleFaq::where('id',$id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'order' => 'required|unique:vehicle_faqs,order,' . $vehicleFaq->id . ',id,vehicle_id,' . $vehicle->id,
        ]);
        $vehicleFaq->vehicle_id = $vehicle->id;
        $vehicleFaq->title = $validated['title'];
        $vehicleFaq->description = $validated['description'];
        $vehicleFaq->order = $validated['order'];
        $res = $vehicleFaq->save();
        if ($res) {
            activity('admin')->performedOn($vehicleFaq)->causedBy($user)->withProperties(['data' => $request])->log('Edited Faq Section ' . $vehicleFaq->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully edited Faq section.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit Faq section. Please try again.');
        }
    }

    public function destroy(Request $request, Vehicle $vehicle, $id)
    {
        $user = auth()->guard('admin')->user();
        $vehicleFaq = VehicleFaq::where('id',$id)->first();;
        $res = $vehicleFaq->delete();
        if ($res) {
            activity('admin')->performedOn($vehicleFaq)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Faq Section ' . $vehicleFaq->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted Faq section.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Faq section. Please try again.');
        }
    }
}
