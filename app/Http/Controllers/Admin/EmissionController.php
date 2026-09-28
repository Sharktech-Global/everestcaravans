<?php

namespace App\Http\Controllers\Admin;

use App\Emission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmissionController extends Controller
{
    public function index()
    {
        return view('admin.emissions.index', ['emissions' => Emission::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:emissions,name',
            'status' => 'required'
        ]);
        $emmision = new Emission;
        $emmision->name = $validated['name'];
        $emmision->status = $validated['status'];
        $res = $emmision->save();
        if ($res) {
            activity('admin')->performedOn($emmision)->causedBy($user)->withProperties(['data' => $request])->log('Created New Emmision.');
            return redirect()->back()->with('success', 'Successfully created new emmision.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new emmision. Please try again.');
        }
    }

    public function show(Emission $emission)
    {
        return redirect()->route('admin.emissions.edit', $emission->id);
    }

    public function edit(Emission $emission)
    {
        return view('admin.emissions.edit', ['emission' => $emission]);
    }

    public function update(Request $request, Emission $emission)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:emissions,name,' . $emission->id,
            'status' => 'required'
        ]);
        $emission->name = $validated['name'];
        $emission->status = $validated['status'];
        $res = $emission->save();
        if ($res) {
            activity('admin')->performedOn($emission)->causedBy($user)->withProperties(['data' => $request])->log('Updated Emission #' . $emission->name . '.');
            return redirect()->back()->with('success', 'Successfully updated emission.');
        } else {
            return redirect()->back()->with('error', 'Failed to update emission. Please try again.');
        }
    }
    public function destroy(Emission $emission, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $emission->delete();
        if ($res) {
            activity('admin')->performedOn($emission)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Emission #' . $emission->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the emission.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the emission. Please try again.');
        }
    }
}
