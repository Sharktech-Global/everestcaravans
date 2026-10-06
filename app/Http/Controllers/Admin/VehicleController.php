<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\Http\Controllers\Controller;
use App\VehicleType;
use App\VehicleApplication;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index(Request $request)
    {

        $search = ($request->search) ? $request->search : null;
        $vehicles = Vehicle::search($search)->with('vehicle_type')->orderBy("name")->paginate(50);
        return view('admin.vehicles.index', ['search' => $search, 'vehicles' => $vehicles]);
    }

    public function create()
    {
        $types = VehicleType::whereStatus(1)->orderBy('name')->get();
        return view('admin.vehicles.create', compact('types'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'vehicle_type' => 'required',
            'application' => 'required',
            'name' => 'required|unique:vehicles,name',
            'title' => 'nullable',
            'tagline' => 'nullable',
            'thumb' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'online_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'brochure' => 'nullable',
            'is_booking' => 'required',
            'status' => 'required',
            'order' => 'required|unique:vehicles,order',
            'booking_amount' => 'required|integer:min:1',

        ]);
        $vehicle = new Vehicle;
        $vehicle->vehicle_type_id = $validated['vehicle_type'];
        $vehicle->name = $validated['name'];
        $vehicle->application_id = $validated['application'];
        $vehicle->slug = SlugService::createSlug(Vehicle::class, 'slug', $vehicle->name, ['unique' => false]);
        $vehicle->title = $validated['title'];
        $vehicle->tagline = $validated['tagline']; 
        $vehicle->is_booking = $validated['is_booking'];
        $vehicle->status = $validated['status'];
        $vehicle->order = $validated['order'];
        $vehicle->booking_amount = $validated['booking_amount'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/vehicle/image',
                $vehicle->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $vehicle->image = $path;
        }
        if ($request->hasFile('mobile_banner')) {
            $path = $request->file('mobile_banner')->storeAs(
                'upload/vehicle/mobile_banner',
                $vehicle->slug . '_' . $request->mobile_banner->getClientOriginalName(),
                'public'
            );
            $vehicle->mobile_banner = $path;
        }
        if ($request->hasFile('thumb')) {
            $path = $request->file('thumb')->storeAs(
                'upload/vehicle/thumb',
                $vehicle->slug . '_' . $request->thumb->getClientOriginalName(),
                'public'
            );
            $vehicle->thumb = $path;
        }
        if ($request->brochure) {
            $vehicle->brochure = $request->brochure;
        }
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/vehicle/banner_image',
                $vehicle->slug . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $vehicle->banner_image = $path;
        }
        if ($request->hasFile('online_image')) {
            $path = $request->file('online_image')->storeAs(
                'upload/vehicle/online_image',
                $vehicle->slug . '_' . $request->online_image->getClientOriginalName(),
                'public'
            );
            $vehicle->online_image = $path;
        }
        $res = $vehicle->save();
        if ($res) {
            activity('admin')->performedOn($vehicle)->causedBy($user)->withProperties(['data' => $request])->log('Created New Vehicle.');
            return redirect()->back()->with('success', 'Successfully created new vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new vehicle. Please try again.');
        }
    }

    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicles.show', ['vehicle' => $vehicle]);
    }

    public function edit(Vehicle $vehicle)
    {
        $types = VehicleType::whereStatus(1)->orderBy('name')->get();
        $applications = VehicleApplication::where('vehicle_type_id',$vehicle->vehicle_type_id)->whereStatus(1)->orderBy('name')->get();
        return view('admin.vehicles.edit', ['vehicle' => $vehicle, 'types' => $types,'applications' => $applications]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        if ($request->ajax()) {
            $has_landing = ($request->status) ? $request->status : "0";
            //return response()->json($has_landing);
            $vehicle->has_landing = $has_landing;
            $res = $vehicle->save();
            if ($res) {
                $message = ($vehicle->has_landing) ? "Landing page is active" : "Landing page is inactive";
                activity('admin')->performedOn($vehicle)->causedBy($user)->withProperties(['data' => $request])->log('Updated "Has Landing Status" of Vehicle #' . $vehicle->name . '.');
                return response()->json(['status' => true, 'message' => $message]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to change landing page status"]);
            }
        }
        $validated = $request->validate([
            'vehicle_type' => 'required',
            'name' => 'required|unique:vehicles,name,' . $vehicle->id,
            'title' => 'nullable',
            'application' => 'required',
            'tagline' => 'nullable',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'mobile_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',

            'online_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'brochure' => 'nullable',
            'is_booking' => 'required',
            'status' => 'required',
            'order' => 'required|unique:vehicles,order,' . $vehicle->id,
            'booking_amount' => 'required|integer:min:1',

        ]);
        $vehicle->vehicle_type_id = $validated['vehicle_type'];
        $vehicle->name = $validated['name'];
        $vehicle->slug = SlugService::createSlug(Vehicle::class, 'slug', $vehicle->name, ['unique' => false]);
        $vehicle->title = $validated['title'];
        $vehicle->application_id = $validated['application'];
        $vehicle->tagline = $validated['tagline'];
        $vehicle->is_booking = $validated['is_booking'];
        $vehicle->status = $validated['status'];
        $vehicle->order = $validated['order'];
        $vehicle->booking_amount = $validated['booking_amount'];
        if ($request->hasFile('image')) {

            if (!empty($vehicle->image)) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $path = $request->file('image')->storeAs(
                'upload/vehicle/image',
                $vehicle->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $vehicle->image = $path;
        }
        if ($request->hasFile('thumb')) {

            if (!empty($vehicle->thumb)) {
                Storage::disk('public')->delete($vehicle->thumb);
            }
            $path = $request->file('thumb')->storeAs(
                'upload/vehicle/thumb',
                $vehicle->slug . '_' . $request->thumb->getClientOriginalName(),
                'public'
            );
            $vehicle->thumb = $path;
        }
        if ($request->hasFile('online_image')) {
            $path = $request->file('online_image')->storeAs(
                'upload/vehicle/online_image',
                $vehicle->slug . '_' . $request->online_image->getClientOriginalName(),
                'public'
            );
            $vehicle->online_image = $path;
        }
        if ($request->hasFile('mobile_banner')) {
            $path = $request->file('mobile_banner')->storeAs(
                'upload/vehicle/mobile_banner',
                $vehicle->slug . '_' . $request->mobile_banner->getClientOriginalName(),
                'public'
            );
            $vehicle->mobile_banner = $path;
        }
        if ($request->brochure) {
            $vehicle->brochure = $request->brochure;
        }
        if ($request->hasFile('banner_image')) {

            if (!empty($vehicle->banner_image)) {
                Storage::disk('public')->delete($vehicle->banner_image);
            }
            $path = $request->file('banner_image')->storeAs(
                'upload/vehicle/banner_image',
                $vehicle->slug . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $vehicle->banner_image = $path;
        }
        $res = $vehicle->save();
        if ($res) {
            activity('admin')->performedOn($vehicle)->causedBy($user)->withProperties(['data' => $request])->log('Updated Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully updated the vehicle details.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the vehicle details. Please try again.');
        }
    }

    public function destroy(Request $request, Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $res = $vehicle->delete();
        if ($res) {
            foreach ([
                $vehicle->logo,
                $vehicle->image,
                $vehicle->thumb,
                $vehicle->brochure,
                $vehicle->banner_image,
                $vehicle->mobile_banner,
                $vehicle->online_image,
            ] as $file) {
                if (!empty($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
            activity('admin')->performedOn($vehicle)->causedBy($user)->withProperties(['data' => $request])->log('Deleted vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the vehicle.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the vehicle. Please try again.');
        }
    }

    
    public function fetch_vehicle(Request $request){
        $data  = VehicleApplication::where('vehicle_type_id',$request->type_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
