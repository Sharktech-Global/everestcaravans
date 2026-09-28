<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vehicle;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\VehicleSlider;

class VehicleSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliders = VehicleSlider::with('vehicle')->latest("updated_at")->paginate(10);
        return view('admin.vehicle-slider.index', ['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::whereStatus(1)->get();
        return view('admin.vehicle-slider.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'type' => 'required',
            'name' => 'required',
            'description' => 'required',
            'booking' => 'required_if:type,nexa',
            'explore' => 'required_if:type,nexa',
            'vehicle' => 'required_if:type,arena',
            'logo' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'thumb1' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'thumb2' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'order' => 'required|min:1',
            'status' => 'required'
        ]);
        $slider = new VehicleSlider();
        $slider->type = $validated['type'];
        $slider->name = $validated['name'];
        $slider->slug = SlugService::createSlug(VehicleSlider::class, 'slug', $slider->name, ['unique' => false]);
        $slider->description = $validated['description'];
        $slider->booking = (isset($validated['booking'])) ? $validated['booking'] : null;
        $slider->explore = (isset($validated['explore'])) ? $validated['explore'] : null;
        $slider->vehicle_id = (isset($validated['vehicle'])) ? $validated['vehicle'] : null;
        $slider->order_id = $validated['order'];
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->storeAs(
                'upload/slider/vehicle/logo',
                time() . '_' . $request->logo->getClientOriginalName(),
                'public'
            );
            $slider->logo = $path;
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/slider/vehicle/image',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $slider->image = $path;
        }
        if ($request->hasFile('thumb1')) {
            $path = $request->file('thumb1')->storeAs(
                'upload/slider/vehicle/thumb1',
                time() . '_' . $request->thumb1->getClientOriginalName(),
                'public'
            );
            $slider->thumb1 = $path;
        }
        if ($request->hasFile('thumb2')) {
            $path = $request->file('thumb2')->storeAs(
                'upload/slider/vehicle/thumb2',
                time() . '_' . $request->thumb2->getClientOriginalName(),
                'public'
            );
            $slider->thumb2 = $path;
        }
        $slider->status = $validated['status'];
        $res = $slider->save();
        if ($res) {
            activity('admin')->performedOn($slider)->causedBy($user)->withProperties(['data' => $request])->log('Added New Vehicle Slider.');
            return redirect()->back()->with('success', 'Successfully created new vehicle slider.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new vehicle slider. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleSlider $vehicleSlider)
    {
        $vehicles = Vehicle::whereStatus(1)->get();
        return view('admin.vehicle-slider.edit', ['slider' => $vehicleSlider, 'vehicles' => $vehicles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleSlider $vehicleSlider)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'type' => 'required',
            'name' => 'required',
            'description' => 'required',
            'booking' => 'required_if:type,nexa',
            'explore' => 'required_if:type,nexa',
            'vehicle' => 'required_if:type,arena',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp',
            'thumb1' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp',
            'thumb2' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp',
            'order' => 'required|min:1',
            'status' => 'required'
        ]);
        $vehicleSlider->type = $validated['type'];
        $vehicleSlider->name = $validated['name'];
        $vehicleSlider->slug = SlugService::createSlug(VehicleSlider::class, 'slug', $vehicleSlider->name, ['unique' => false]);
        $vehicleSlider->description = $validated['description'];
        $vehicleSlider->booking = (isset($validated['booking'])) ? $validated['booking'] : null;
        $vehicleSlider->explore = (isset($validated['explore'])) ? $validated['explore'] : null;
        $vehicleSlider->vehicle_id = (isset($validated['vehicle'])) ? $validated['vehicle'] : null;
        $vehicleSlider->order_id = $validated['order'];
        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($vehicleSlider->logo);
            $path = $request->file('logo')->storeAs(
                'upload/slider/vehicle/logo',
                time() . '_' . $request->logo->getClientOriginalName(),
                'public'
            );
            $vehicleSlider->logo = $path;
        }
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($vehicleSlider->image);
            $path = $request->file('image')->storeAs(
                'upload/slider/vehicle/image',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $vehicleSlider->image = $path;
        }
        if ($request->hasFile('thumb1')) {
            Storage::disk('public')->delete($vehicleSlider->thumb1);
            $path = $request->file('thumb1')->storeAs(
                'upload/slider/vehicle/thumb1',
                time() . '_' . $request->thumb1->getClientOriginalName(),
                'public'
            );
            $vehicleSlider->thumb1 = $path;
        }
        if ($request->hasFile('thumb2')) {
            Storage::disk('public')->delete($vehicleSlider->thumb2);
            $path = $request->file('thumb2')->storeAs(
                'upload/slider/vehicle/thumb2',
                time() . '_' . $request->thumb2->getClientOriginalName(),
                'public'
            );
            $vehicleSlider->thumb2 = $path;
        }
        $vehicleSlider->status = $validated['status'];
        $res = $vehicleSlider->save();
        if ($res) {
            activity('admin')->performedOn($vehicleSlider)->causedBy($user)->withProperties(['data' => $request])->log('Updated Vehicle Slider #' . $vehicleSlider->name);
            return redirect()->back()->with('success', 'Successfully updated vehicle slider.');
        } else {
            return redirect()->back()->with('error', 'Failed to update vehicle slider. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VehicleSlider $vehicleSlider)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicleSlider->delete();
        if ($res) {
            Storage::disk('public')->delete($vehicleSlider->image);
            Storage::disk('public')->delete($vehicleSlider->logo);
            Storage::disk('public')->delete($vehicleSlider->thumb1);
            Storage::disk('public')->delete($vehicleSlider->thumb2);
            activity('admin')->performedOn($vehicleSlider)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Vehicle Slider #' . $vehicleSlider->name);
            return redirect()->back()->with('success', 'Successfully deleted the vehicle slider.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the vehicle slider. Please try again.');
        }
    }
}
