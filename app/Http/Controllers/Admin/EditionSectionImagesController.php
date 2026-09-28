<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\VehicleEdition;
use App\VehicleEditionSection;
use App\EditionSectionImages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;


class EditionSectionImagesController extends Controller
{
    public function index($edition_id,$section_id)
    {
        $EditionSection = VehicleEditionSection::where('id',$section_id)->first();
        $VehicleEdition = VehicleEdition::where('id',$EditionSection->edition_id)->first();
        $vehicle = Vehicle::where('id',$EditionSection->vehicle_id)->first();
        $images = EditionSectionImages::where('section_id',$section_id)->paginate(10);
        return view('admin.vehicles.editions.sections.images.index', ['VehicleEdition' => $VehicleEdition ,'EditionSection' => $EditionSection, 'vehicle' => $vehicle, 'images' => $images]);
    }

    public function store(Request $request,$section_id)
    {
        $EditionSection = VehicleEditionSection::where('id',$section_id)->first();
        $VehicleEdition = VehicleEdition::where('id',$EditionSection->edition_id)->first();
        $vehicle = Vehicle::where('id',$EditionSection->vehicle_id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'order' => 'required',

        ]);
        $images = new EditionSectionImages;
        $images->vehicle_id = $vehicle->id;
        $images->section_id = $EditionSection->id;
        $images->edition_id = $VehicleEdition->id;
        $images->title = $validated['title'];
        $images->description = $validated['description'];
        $images->order = $validated['order'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/vehicle/edition/images',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $images->image = $path;
        }
        $res = $images->save();
        if ($res) {
            activity('admin')->performedOn($images)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to Section #' . $EditionSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully added image to edition section.');
        } else {
            return redirect()->back()->with('error', 'Failed to add image to edition section. Please try again.');
        }
    }

    public function edit($section_id,$id)
    {
        $EditionSection = VehicleEditionSection::where('id',$section_id)->first();
        $VehicleEdition = VehicleEdition::where('id',$EditionSection->edition_id)->first();
        $vehicle = Vehicle::where('id',$EditionSection->vehicle_id)->first();
        $image = EditionSectionImages::where('id',$id)->first();
        return view('admin.vehicles.editions.sections.images.edit', ['VehicleEdition' => $VehicleEdition ,'EditionSection' => $EditionSection, 'vehicle' => $vehicle, 'image' => $image]);
    }

    public function update(Request $request,$section_id,$id)
    {
        $EditionSection = VehicleEditionSection::where('id',$section_id)->first();
        $VehicleEdition = VehicleEdition::where('id',$EditionSection->edition_id)->first();
        $vehicle = Vehicle::where('id',$EditionSection->vehicle_id)->first();
        $images = EditionSectionImages::where('id',$id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'order' => 'required',

        ]);
        $images->vehicle_id = $vehicle->id;
        $images->section_id = $EditionSection->id;
        $images->edition_id = $VehicleEdition->id;
        $images->title = $validated['title'];
        $images->description = $validated['description'];
        $images->order = $validated['order'];
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($images->image);
            $path = $request->file('image')->storeAs(
                'upload/vehicle/edition/images',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $images->image = $path;
        }
        $res = $images->save();
        if ($res) {
            activity('admin')->performedOn($images)->causedBy($user)->withProperties(['data' => $request])->log('Updated Image in edition Section #' . $EditionSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully updated image in detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to update image in detail section. Please try again.');
        }
    }

    public function destroy(Request $request,$section_id,$id)
    {
        $user = auth()->guard('admin')->user();
        $images = EditionSectionImages::where('id',$id)->first();
        $res = $images->delete();
        if ($res) {
            Storage::disk('public')->delete($images->image);
            activity('admin')->performedOn($images)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Image in Section #' . $vehicleSection->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted image in detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete image in detail section. Please try again.');
        }
    }
}
