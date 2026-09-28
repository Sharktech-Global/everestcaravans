<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\VehicleEdition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class VehicleEditionController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $editions = $vehicle->editions()->orderBy('order')->paginate(10);
        return view('admin.vehicles.editions.index', ['vehicle' => $vehicle,'editions' => $editions]);
    }
    public function create(Vehicle $vehicle)
    {
        return view('admin.vehicles.editions.create', ['vehicle' => $vehicle]);
    }
    public function store(Request $request,Vehicle $vehicle)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required|unique:vehicle_editions,title',
            'description' => 'nullable',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'brochure' => 'nullable|mimetypes:application/pdf|max:50000',
            'is_booking' => 'required',
            'order_number' => 'required',
            'status' => 'required',
            'booking_amount' => 'required|integer:min:1',

        ]);
        $edition = new VehicleEdition;
        $edition->vehicle_id = $vehicle->id;
        $edition->title = $validated['title'];
        $edition->slug = SlugService::createSlug(VehicleEdition::class, 'slug', $edition->title, ['unique' => false]);
        $edition->description = $validated['description'];
        $edition->is_booking = $validated['is_booking'];
        $edition->status = $validated['status'];
        $edition->order = $validated['order_number'];
        $edition->booking_amount = $validated['booking_amount'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/vehicle/edition/image',
                $edition->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $edition->image = $path;
        }
        if ($request->hasFile('thumb')) {
            $path = $request->file('thumb')->storeAs(
                'upload/vehicle/edition/thumb',
                $edition->slug . '_' . $request->thumb->getClientOriginalName(),
                'public'
            );
            $vehicle->thumb = $path;
        }
        if ($request->hasFile('brochure')) {
            $path = $request->file('brochure')->storeAs(
                'upload/vehicle/edition/brochure',
                $edition->slug . '_' . $request->brochure->getClientOriginalName(),
                'public'
            );
            $edition->brochure = $path;
        }
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/edition/banner_image',
                $vehicle->slug . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $edition->banner_image = $path;
        }
        $res = $edition->save();
        if ($res) {
            activity('admin')->performedOn($edition)->causedBy($user)->withProperties(['data' => $request])->log('Created New edition.');
            return redirect()->back()->with('success', 'Successfully created new edition.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new edition. Please try again.');
        }
    }
    
    public function edit(Vehicle $vehicle,$id)
    {
        $edition = VehicleEdition::where('id',$id)->first();
        return view('admin.vehicles.editions.edit', ['vehicle' => $vehicle, 'edition' => $edition]);
    }


    public function update(Request $request, Vehicle $vehicle,$id)
    {
        $edition = VehicleEdition::where('id',$id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required|unique:vehicle_editions,title,'.$edition->id,
            'description' => 'nullable',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'brochure' => 'nullable|mimetypes:application/pdf|max:50000',
            'is_booking' => 'required',
            'status' => 'required',
            'order_number' => 'required',
            'booking_amount' => 'required|integer:min:1',

        ]);
        $edition->vehicle_id = $vehicle->id;
        $edition->title = $validated['title'];
        $edition->slug = SlugService::createSlug(VehicleEdition::class, 'slug', $edition->title, ['unique' => false]);
        $edition->description = $validated['description'];
        $edition->is_booking = $validated['is_booking'];
        $edition->status = $validated['status'];
        $edition->order = $validated['order_number'];
        $edition->booking_amount = $validated['booking_amount'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/vehicle/edition/image',
                $edition->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $edition->image = $path;
        }
        if ($request->hasFile('thumb')) {
            $path = $request->file('thumb')->storeAs(
                'upload/vehicle/edition/thumb',
                $edition->slug . '_' . $request->thumb->getClientOriginalName(),
                'public'
            );
            $vehicle->thumb = $path;
        }
        if ($request->hasFile('brochure')) {
            $path = $request->file('brochure')->storeAs(
                'upload/vehicle/edition/brochure',
                $edition->slug . '_' . $request->brochure->getClientOriginalName(),
                'public'
            );
            $edition->brochure = $path;
        }
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/edition/banner_image',
                $vehicle->slug . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $edition->banner_image = $path;
        }
        $res = $edition->save();
        if ($res) {
            activity('admin')->performedOn($edition)->causedBy($user)->withProperties(['data' => $request])->log('Created New edition.');
            return redirect()->back()->with('success', 'Successfully updated edition.');
        } else {
            return redirect()->back()->with('error', 'Failed to update edition. Please try again.');
        }
    }
    public function destroy(Request $request, Vehicle $vehicle, $id)
    {
        $user = auth()->guard('admin')->user();
        $edition = VehicleEdition::where('id',$id)->first();;
        $res = $edition->delete();
        if ($res) {
            activity('admin')->performedOn($edition)->causedBy($user)->withProperties(['data' => $request])->log('Deleted edition ' . $edition->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted edition.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete edition. Please try again.');
        }
    }
    

}
