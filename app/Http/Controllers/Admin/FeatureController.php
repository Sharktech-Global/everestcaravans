<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        return view('admin.features.index', ['features' => Feature::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:features,name',
            'status' => 'required'
        ]);
        $feature = new Feature;
        $feature->name = $validated['name'];
        $feature->status = $validated['status'];
        $res = $feature->save();
        if ($res) {
            activity('admin')->performedOn($feature)->causedBy($user)->withProperties(['data' => $request])->log('Created New Feature.');
            return redirect()->back()->with('success', 'Successfully created new feature.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new feature. Please try again.');
        }
    }

    public function show(Feature $feature)
    {
        return redirect()->route('admin.features.edit', $feature->id);
    }

    public function edit(Feature $feature)
    {
        return view('admin.features.edit', ['feature' => $feature]);
    }

    public function update(Request $request, Feature $feature)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:features,name,' . $feature->id,
            'status' => 'required'
        ]);
        $feature->name = $validated['name'];
        $feature->status = $validated['status'];
        $res = $feature->save();
        if ($res) {
            activity('admin')->performedOn($feature)->causedBy($user)->withProperties(['data' => $request])->log('Updated Feature #' . $feature->name . '.');
            return redirect()->back()->with('success', 'Successfully updated feature.');
        } else {
            return redirect()->back()->with('error', 'Failed to update feature. Please try again.');
        }
    }
    public function destroy(Feature $feature, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $feature->delete();
        if ($res) {
            activity('admin')->performedOn($feature)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Feature #' . $feature->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the feature.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the feature. Please try again.');
        }
    }
}
