<?php

namespace App\Http\Controllers\Admin;

use App\Fuel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        
        return view('admin.fuels.index', ['fuels' => Fuel::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:fuels,name',
            'status' => 'required'
        ]);
        $fuel = new Fuel;
        $fuel->name = $validated['name'];
        $fuel->status = $validated['status'];
        $res = $fuel->save();
        if ($res) {
            activity('admin')->performedOn($fuel)->causedBy($user)->withProperties(['data' => $request])->log('Created New Fuel.');
            return redirect()->back()->with('success', 'Successfully created new fuel.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new fuel. Please try again.');
        }
    }

    public function show(Fuel $fuel)
    {
        return redirect()->route('admin.fuels.edit', $fuel->id);
    }

    public function edit(Fuel $fuel)
    {
        return view('admin.fuels.edit', ['fuel' => $fuel]);
    }

    public function update(Request $request, Fuel $fuel)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:fuels,name,' . $fuel->id,
            'status' => 'required'
        ]);
        $fuel->name = $validated['name'];
        $fuel->status = $validated['status'];
        $res = $fuel->save();
        if ($res) {
            activity('admin')->performedOn($fuel)->causedBy($user)->withProperties(['data' => $request])->log('Updated Fuel #' . $fuel->name . '.');
            return redirect()->back()->with('success', 'Successfully updated fuel.');
        } else {
            return redirect()->back()->with('error', 'Failed to update fuel. Please try again.');
        }
    }
    public function destroy(Fuel $fuel, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $fuel->delete();
        if ($res) {
            activity('admin')->performedOn($fuel)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Fuel #' . $fuel->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the fuel.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the fuel. Please try again.');
        }
    }
}
