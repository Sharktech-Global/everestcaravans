<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\HomeSlider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = HomeSlider::latest("updated_at")->paginate(10);
        return view('admin.home-slider.index', ['sliders' => $sliders]);
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 1)->orderBy('name')->get();
        return view('admin.home-slider.create', ['vehicles' => $vehicles]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'type' => 'required',
            'description' => 'required',
            'booking' => 'required_if:type,nexa',
            'explore' => 'required_if:type,nexa',
            'vehicle' => 'required',
            'title' => 'required',
            'sub_title' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'status' => 'required'

        ]);
        $slider = new HomeSlider;
        $slider->type = $validated['type'];
        $slider->description = $validated['description'];
        $slider->booking = (isset($validated['booking'])) ? $validated['booking'] : null;
        $slider->explore = (isset($validated['explore'])) ? $validated['explore'] : null;
        $slider->vehicle_id = (isset($validated['vehicle'])) ? $validated['vehicle'] : null;
        $slider->status = $validated['status'];
        $slider->title = $validated['title'];
        $slider->sub_title = $validated['sub_title'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/slider/image',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $slider->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            $path = $request->file('mobile_image')->storeAs(
                'upload/slider/mobile_image',
                time() . '_' . $request->mobile_image->getClientOriginalName(),
                'public'
            );
            $slider->mobile_image = $path;
        }
        // if ($request->hasFile('title')) {
        //     $path = $request->file('title')->storeAs(
        //         'upload/slider/title',
        //         time() . '_' . $request->title->getClientOriginalName(),
        //         'public'
        //     );
        //     $slider->title = $path;
        // }
        $res = $slider->save();
        if ($res) {
            activity('admin')->performedOn($slider)->causedBy($user)->withProperties(['data' => $request])->log('Added New Slider to Home Page.');
            return redirect()->back()->with('success', 'Successfully created new slider.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new slider. Please try again.');
        }
    }

    public function show(HomeSlider $homeSlider)
    {
        return redirect()->route('admin.home-slider.edit', $homeSlider->id);
    }

    public function edit(HomeSlider $homeSlider)
    {
        $vehicles = Vehicle::where('status', 1)->orderBy('name')->get();
        return view('admin.home-slider.edit', ['homeSlider' => $homeSlider, 'vehicles' => $vehicles]);
    }

    public function update(Request $request, HomeSlider $homeSlider)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'type' => 'required',
            'description' => 'required',
            'booking' => 'required_if:type,nexa',
            'explore' => 'required_if:type,nexa',
            'vehicle' => 'required',
            'title' => 'required',
            'sub_title' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',

            'status' => 'required',


        ]);
        $homeSlider->type = $validated['type'];
        $homeSlider->description = $validated['description'];
        $homeSlider->booking = (isset($validated['booking'])) ? $validated['booking'] : null;
        $homeSlider->explore = (isset($validated['explore'])) ? $validated['explore'] : null;
        $homeSlider->vehicle_id = (isset($validated['vehicle'])) ? $validated['vehicle'] : null;
        $homeSlider->status = $validated['status'];
        $homeSlider->title = $validated['title'];
        $homeSlider->sub_title = $validated['sub_title'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($homeSlider->image);
            $path = $request->file('image')->storeAs(
                'upload/slider/image',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $homeSlider->image = $path;
        }
        if ($request->hasFile('mobile_image')) {
            Storage::disk('public')->delete($homeSlider->mobile_image);
            $path = $request->file('mobile_image')->storeAs(
                'upload/slider/mobile_image',
                time() . '_' . $request->mobile_image->getClientOriginalName(),
                'public'
            );
            $homeSlider->mobile_image = $path;
        }
       
        $res = $homeSlider->save();
        if ($res) {
            activity('admin')->performedOn($homeSlider)->causedBy($user)->withProperties(['data' => $request])->log('Updated Slider in Home Page.');
            return redirect()->back()->with('success', 'Successfully updated the slider.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the slider. Please try again.');
        }
    }

    public function destroy(HomeSlider $homeSlider, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $homeSlider->delete();
        if ($res) {
            Storage::disk('public')->delete($homeSlider->image);
            Storage::disk('public')->delete($homeSlider->title);
            activity('admin')->performedOn($homeSlider)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Slider in Home Page.');
            return redirect()->back()->with('success', 'Successfully deleted the slider.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the slider. Please try again.');
        }
    }
}
