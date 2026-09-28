<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Vehicle;
use App\VehicleGallery;
use Storage;
use Illuminate\Http\Request;

class VehicleGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vehicle $vehicle)
    {
        $images = VehicleGallery::where('vehicle_id',$vehicle->id)->get();
        return view('admin.vehicles.gallery.index', ['vehicle' => $vehicle,'images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $vehicle = Vehicle::where('id',$id)->first();
        $image =$request->file('file');
        $imageUpload = new VehicleGallery();
        if($image){
            $avatarName =  $vehicle->slug . '_' .$image->getClientOriginalName();
            $image->move(public_path('upload/vehicle/gallery'),$avatarName);
            
            
            // $vehicle->image = $avatarName;
            $imageUpload->title = $vehicle->name;
            $imageUpload->image = $avatarName;
            $imageUpload->vehicle_id = $vehicle->id;
            $imageUpload->save();
            // return response()->json(['success'=>$avatarName]);
            return redirect()->back()->with('success', 'Successfully added images to gallery.');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_name(Request $request,$id)
    {
        $vehicle = Vehicle::where('id',$id)->first();
        $image = VehicleGallery::where('id',$request->id)->where('vehicle_id',$id)->first();
        $image->title = $request->data;
        $res = $image->update();
        // dd($vehicle);
        if($res){
            $data['message'] = 'Title updated Successfully';
            $data['status'] = '1';
            return response()->json($data);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Vehicle $vehicle, $id)
    {
        $user = auth()->guard('admin')->user();
        $image = VehicleGallery::where('id',$id)->first();
        $res = $image->delete();
        if ($res) {
            Storage::disk('public')->delete($image->image);
            activity('admin')->performedOn($image)->causedBy($user)->withProperties(['data' => $request])->log('Deleted image #' . $image->name . ' of Vehicle #' . $vehicle->name . ' from gallery.');
            return redirect()->back()->with('success', 'Successfully deleted image of vehicle from gallery.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete image of vehicle. Please try again.');
        }
    }
}
