<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\Location;
use App\LocationType;
use Storage;

class DealershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $dealerships = Area::with(['location'])->search($search)->latest("updated_at")->get();
        return view('admin.dealership.index', ['search' => $search, 'dealerships' => $dealerships]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->type;
            $type =  LocationType::where('id',$type)->first();
            // dd($type);
            $data = [];
            if ( $type->name) {

                $data =Location::where('status', 1)->whereHas('type', function ($q) use ($type) {
                    $q->where('name', $type->name );
                })->get();
            }
            return response()->json(['data' => $data]);
        }
        $type = LocationType::where('status',1)->get();
        $locations = Location::where('status', 1)->whereHas('type', function ($q) {
            $q->where('name',  'Sales');
        })->get();
        return view('admin.dealership.create', ['locations' => $locations,'type' => $type]);
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
            'location' => 'required',
            'name' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);
        $location_name = Location::find($validated['location']);
        $dealership = new Area;
        $dealership->location_id = $validated['location'];
        $dealership->name = $validated['name'];
        $dealership->location_type_id = $validated['type'];
        $dealership->status = $validated['status'];
        $res = $dealership->save();
        if ($res) {
            activity('admin')->performedOn($dealership)->causedBy($user)->withProperties(['data' => $request])->log('Added New area.');
            return redirect()->back()->with('success', 'Successfully added new area.');
        } else {
            return redirect()->back()->with('error', 'Failed to add new area. Please try again.');
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
    public function edit(Request $request,$id)
    {
        $type = LocationType::where('status',1)->get();
        if ($request->ajax()) {
            $type = $request->type;
            $type =  LocationType::where('id',$type)->first();
            // dd($type);
            $data = [];
            if ( $type->name) {

                $data =Location::where('status', 1)->whereHas('type', function ($q) use ($type) {
                    $q->where('name', $type->name );
                })->get();
            }
            return response()->json(['data' => $data]);
        }
        $locations = Location::where('status', 1)->get();
        $dealership = Area::with(['location'])->find($id);
        return view('admin.dealership.edit', ['locations' => $locations,'type' =>$type, 'dealership' => $dealership]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'location' => 'required',
            'name' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);
        $location_name = Location::find($validated['location']);
        $dealership = Area::find($id);
        $dealership->location_id = $validated['location'];
        $dealership->location_type_id = $validated['type'];
        $dealership->name = $validated['name'];
        $dealership->status = $validated['status'];
        $res = $dealership->save();
        if ($res) {
            activity('admin')->performedOn($dealership)->causedBy($user)->withProperties(['data' => $request])->log('Updated dealership.');
            return redirect()->back()->with('success', 'Successfully updated dealership.');
        } else {
            return redirect()->back()->with('error', 'Failed to update dealership. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $user = auth()->guard('admin')->user();
        $dealership = Area::find($id);
        $res = $dealership->delete();
        if ($res) {
            Storage::disk('public')->delete($dealership->banner_image);
            activity('admin')->performedOn($dealership)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Dealership #' . $dealership->location->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the area.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the area. Please try again.');
        }
    }
}
