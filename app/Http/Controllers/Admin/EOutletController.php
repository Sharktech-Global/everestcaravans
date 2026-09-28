<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EOutlet;
use App\Dealership;

class EOutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($dealership_id)
    {
        $dealership = Dealership::find($dealership_id);
        $e_outlets = EOutlet::where('dealership_id',$dealership_id)->paginate(10);
        return view('admin.dealership.e_outlets.index', ['dealership' => $dealership, 'e_outlets' => $e_outlets]);
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
    public function store(Request $request, $dealership_id)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'spc_name' => 'required',
            "spc_head"  => "required|string",
            "spc_phone"  => "required|string",
            "spc_email"  => "required|email",
            "spc_address"  => "required|string",
            "status"  => "required",

        ]);
        $e_outlet = new EOutlet;
        $e_outlet->dealership_id = $dealership_id;
        $e_outlet->spc_name = $validated['spc_name'];
        $e_outlet->spc_head = $validated['spc_head'];
        $e_outlet->spc_head_phone = $validated['spc_phone'];
        $e_outlet->spc_head_email = $validated['spc_email'];
        $e_outlet->address = $validated['spc_address'];
        $e_outlet->status = $validated['status'];
        $res = $e_outlet->save();
        if ($res) {
            activity('admin')->performedOn($e_outlet)->causedBy($user)->withProperties(['data' => $request])->log('Added E-Outlet to #' . $e_outlet->name . '.');
            return redirect()->back()->with('success', 'Successfully added e-outlet.');
        } else {
            return redirect()->back()->with('error', 'Failed to add e-outlet. Please try again.');
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
    public function edit($dealership_id, $e_outlet_id)
    {
        $dealership = Dealership::find($dealership_id);
        $e_outlet = EOutlet::where('dealership_id',$dealership_id)->where('status',1)->first();
        return view('admin.dealership.e_outlets.edit', ['dealership' => $dealership, 'e_outlet' => $e_outlet]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dealership_id, $e_outlet_id)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'spc_name' => 'required',
            "spc_head"  => "required|string",
            "spc_phone"  => "required|string",
            "spc_email"  => "required|email",
            "spc_address"  => "required|string",
            "status"  => "required",

        ]);
        $e_outlet = EOutlet::find($e_outlet_id);
        $e_outlet->spc_name = $validated['spc_name'];
        $e_outlet->spc_head = $validated['spc_head'];
        $e_outlet->spc_head_phone = $validated['spc_phone'];
        $e_outlet->spc_head_email = $validated['spc_email'];
        $e_outlet->address = $validated['spc_address'];
        $e_outlet->status = $validated['status'];
        $res = $e_outlet->save();
        if ($res) {
            activity('admin')->performedOn($e_outlet)->causedBy($user)->withProperties(['data' => $request])->log('Updated E-Outlet to #' . $e_outlet->name . '.');
            return redirect()->back()->with('success', 'Successfully updated e-outlet.');
        } else {
            return redirect()->back()->with('error', 'Failed to update e-outlet. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$dealership_id, $e_outlet_id)
    {
        $user = auth()->guard('admin')->user();
        $e_outlet = EOutlet::find($e_outlet_id);
        $res = $e_outlet->delete();
        if ($res) {
            activity('admin')->performedOn($e_outlet)->causedBy($user)->withProperties(['data' => $request])->log('Deleted E-Outlet #' . $e_outlet->name);
            return redirect()->back()->with('success', 'Successfully deleted E-Outlet.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete E-Outlet. Please try again.');
        }
    }
}
