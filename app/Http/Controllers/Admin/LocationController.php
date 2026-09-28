<?php

namespace App\Http\Controllers\Admin;

use App\Location;
use App\LocationType;
use App\State;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $locations = location::with(['type'])->search($search)->orderBy('order','ASC')->latest("updated_at")->get();
        return view('admin.locations.index', ['search' => $search, 'locations' => $locations]);
    }

    public function create()
    {
        $location_types = LocationType::where('status', 1)->orderBy('name')->get();
        $states = State::where('status', 1)->orderBy('name')->get();
        return view('admin.locations.create', ['location_types' => $location_types, 'states' => $states]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'state' => 'required',
            'name' => 'required',
            'location_type' => 'required',
            'email' => 'nullable|email',
            'showroom' => 'nullable',
            'content' => 'nullable',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'icon2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'address' => 'nullable',
            'map' => 'nullable',
            'email_ccs' => 'nullable',
            'order' => 'required|unique:locations,order',
            'email_bccs' => 'nullable',
            'phone_numbers' => 'nullable',
            'erp_code' => 'nullable',
            'status' => 'required'
        ]);
        $location = new Location;
        $location->state_id = $validated['state'];
        $location->name = $validated['name'];
        $location->location_type_id = $validated['location_type'];
        $location->email = $validated['email'];
        $location->showroom = $validated['showroom'];
        $location->content = $validated['content'];
        $location->address = $validated['address'];
        $location->map = $validated['map'];
        $location->email_ccs = $validated['email_ccs'];
        $location->email_bccs = $validated['email_bccs'];
        $location->phone_numbers = $validated['phone_numbers'];
        $location->erp_code = ($validated['erp_code']) ? $validated['erp_code'] : '';
        $location->status = $validated['status'];
        $location->order = $validated['order'];
        $location->slug = str_slug($validated['showroom'] . " " . $validated['name'], "-");
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/location/banner_image',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $location->banner_image = $path;
        }
        if ($request->hasFile('icon2')) {
            $path = $request->file('icon2')->storeAs(
                'upload/location/icon2',
                time() . '_' . $request->icon2->getClientOriginalName(),
                'public'
            );
            $location->icon2 = $path;
        }
        $res = $location->save();
        if ($res) {
            activity('admin')->performedOn($location)->causedBy($user)->withProperties(['data' => $request])->log('Added New location.');
            return redirect()->back()->with('success', 'Successfully added new location.');
        } else {
            return redirect()->back()->with('error', 'Failed to add new location. Please try again.');
        }
    }

    public function show(Location $location)
    {
        return redirect()->route('admin.locations.edit', $location->id);
    }

    public function edit(Location $location)
    {
        $location_types = LocationType::where('status', 1)->orderBy('name')->get();
        $states = State::where('status', 1)->orderBy('name')->get();
        return view('admin.locations.edit', ['location' => $location, 'location_types' => $location_types, 'states' => $states]);
    }

    public function update(Request $request, Location $location)
    {
        // dd($request);
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'state' => 'required',
            'name' => 'required',
            'location_type' => 'required',
            'email' => 'nullable|email',
            'showroom' => 'nullable',
            'content' => 'nullable',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'icon2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'address' => 'nullable',
            'map' => 'nullable',
            'order' => 'required|unique:locations,order,'.$location->id,
            'email_ccs' => 'nullable',
            'email_bccs' => 'nullable',
            'phone_numbers' => 'nullable',
            'erp_code' => 'nullable',
            'status' => 'required'

        ]);
        $location->state_id = $validated['state'];
        $location->name = $validated['name'];
        $location->location_type_id = $validated['location_type'];
        $location->email = $validated['email'];
        $location->showroom = $validated['showroom'];
        $location->content = $validated['content'];
        $location->address = $validated['address'];
        $location->map = $validated['map'];
        $location->email_ccs = $validated['email_ccs'];
        $location->email_bccs = $validated['email_bccs'];
        $location->phone_numbers = $validated['phone_numbers'];
        $location->erp_code = ($validated['erp_code']) ? $validated['erp_code'] : '';
        $location->status = $validated['status'];
        $location->order = $validated['order'];
        $location->slug = str_slug($validated['showroom'] . " " . $validated['name'], "-");
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/location/banner_image',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $location->banner_image = $path;
        }
        if ($request->hasFile('icon2')) {
            $path = $request->file('icon2')->storeAs(
                'upload/location/icon2',
                time() . '_' . $request->icon2->getClientOriginalName(),
                'public'
            );
            $location->icon2 = $path;
        }
        $res = $location->save();
        if ($res) {
            activity('admin')->performedOn($location)->causedBy($user)->withProperties(['data' => $request])->log('Updated Location #' . $location->name . '.');
            return redirect()->back()->with('success', 'Successfully updated the location details.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the location details. Please try again.');
        }
    }

    public function destroy(Location $location, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $location->delete();
        if ($res) {
            activity('admin')->performedOn($location)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Location #' . $location->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the location.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the location. Please try again.');
        }
    }
}
