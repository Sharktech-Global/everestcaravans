<?php

namespace App\Http\Controllers\Admin;

use App\Transmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransmissionController extends Controller
{
    public function index()
    {
        return view('admin.transmissions.index', ['transmissions' => Transmission::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:transmissions,name',
            'status' => 'required'
        ]);
        $transmission = new Transmission;
        $transmission->name = $validated['name'];
        $transmission->status = $validated['status'];
        $res = $transmission->save();
        if ($res) {
            activity('admin')->performedOn($transmission)->causedBy($user)->withProperties(['data' => $request])->log('Created New Transmission Type.');
            return redirect()->back()->with('success', 'Successfully created new transmission type.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new transmission type. Please try again.');
        }
    }

    public function show(Transmission $transmission)
    {
        return redirect()->route('admin.transmissions.edit', $transmission->id);
    }

    public function edit(Transmission $transmission)
    {
        return view('admin.transmissions.edit', ['transmission' => $transmission]);
    }

    public function update(Request $request, Transmission $transmission)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:transmissions,name,' . $transmission->id,
            'status' => 'required'
        ]);
        $transmission->name = $validated['name'];
        $transmission->status = $validated['status'];
        $res = $transmission->save();
        if ($res) {
            activity('admin')->performedOn($transmission)->causedBy($user)->withProperties(['data' => $request])->log('Updated Transmission Type #' . $transmission->name . '.');
            return redirect()->back()->with('success', 'Successfully updated transmission type.');
        } else {
            return redirect()->back()->with('error', 'Failed to update transmission type. Please try again.');
        }
    }
    public function destroy(Transmission $transmission, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $transmission->delete();
        if ($res) {
            activity('admin')->performedOn($transmission)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Transmission Type #' . $transmission->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the transmission type.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the transmission type. Please try again.');
        }
    }
}
