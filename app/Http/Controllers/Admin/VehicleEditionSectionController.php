<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use App\VehicleEdition;
use App\VehicleEditionSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class VehicleEditionSectionController extends Controller
{
    public function index(Vehicle $vehicle, $id)
    {
        $VehicleEdition = VehicleEdition::where('id',$id)->first();
        $sections = VehicleEditionSection::where('edition_id',$id)->paginate(10);
        return view('admin.vehicles.editions.sections.index', ['vehicle' => $vehicle,'VehicleEdition' => $VehicleEdition,'sections' => $sections]);
    }
    public function create($id)
    {
        $VehicleEdition = VehicleEdition::where('id',$id)->first();
        $vehicle = Vehicle::where('id',$VehicleEdition->vehicle_id)->first();
        return view('admin.vehicles.editions.sections.create', ['VehicleEdition' => $VehicleEdition,'vehicle' => $vehicle]);
    }
    public function store(Request $request, $id)
    {
        $VehicleEdition = VehicleEdition::where('id',$id)->first();
        $vehicle = Vehicle::where('id',$VehicleEdition->vehicle_id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'order' => 'required',
            'has_tab' => 'required',
            'background' => 'required',

        ]);
        $detail = new VehicleEditionSection;
        $detail->vehicle_id = $vehicle->id;
        $detail->edition_id = $VehicleEdition->id;
        $detail->title = $validated['title'];
        $detail->description = $validated['description'];
        $detail->order = $validated['order'];
        $detail->has_tab = $validated['has_tab'];
        $detail->background = $validated['background'];
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Section to Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully created detail section.');
        } else {
            return redirect()->back()->with('error', 'Failed to create detail section. Please try again.');
        }
    }

    public function edit(Request $request,$edition_id,$id)
    {
        $VehicleEdition = VehicleEdition::where('id',$edition_id)->first();
        $vehicle = Vehicle::where('id',$VehicleEdition->vehicle_id)->first();
        $section = VehicleEditionSection::where('id',$id)->first();
        return view('admin.vehicles.editions.sections.edit', ['section' => $section,'vehicle' => $vehicle, 'VehicleEdition' => $VehicleEdition]);
    }

    public function update(Request $request,$edition_id,$Section_id)
    {
        $user = auth()->guard('admin')->user();
        $VehicleEdition = VehicleEdition::where('id',$edition_id)->first();
        $vehicle = Vehicle::where('id',$VehicleEdition->vehicle_id)->first();
        $section = VehicleEditionSection::where('id',$Section_id)->first();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'order' => 'required',
            'has_tab' => 'required',
            'background' => 'required',
        ]);
        $section->vehicle_id = $vehicle->id;
        $section->edition_id = $VehicleEdition->id;
        $section->title = $validated['title'];
        $section->description = $validated['description'];
        $section->order = $validated['order'];
        $section->has_tab = $validated['has_tab'];
        $section->background = $validated['background'];
        $res = $section->save();
        if ($res) {
            activity('admin')->performedOn($section)->causedBy($user)->withProperties(['data' => $request])->log('Edited  Edition Section ' . $section->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully edited vehicle edition section.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit vehicle edition section. Please try again.');
        }
    }

    public function destroy(Request $request,$edition_id,$Section_id)
    {
        $VehicleEdition = VehicleEdition::where('id',$edition_id)->first();
        $vehicle = Vehicle::where('id',$VehicleEdition->vehicle_id)->first();
        $section = VehicleEditionSection::where('id',$Section_id)->first();
        $user = auth()->guard('admin')->user();
        $res = $section->delete();
        if ($res) {
            activity('admin')->performedOn($section)->causedBy($user)->withProperties(['data' => $request])->log('Deleted  Edition Section ' . $section->title . ' of Vehicle #' . $vehicle->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted Vehicle Edition Section.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete Vehicle Edition Section. Please try again.');
        }
    }
}
