<?php

namespace App\Http\Controllers\Admin;

use App\Specification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    public function index()
    {
        return view('admin.specifications.index', ['specifications' => Specification::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:specifications,name',
            'status' => 'required'
        ]);
        $specification = new Specification;
        $specification->name = $validated['name'];
        $specification->status = $validated['status'];
        $res = $specification->save();
        if ($res) {
            activity('admin')->performedOn($specification)->causedBy($user)->withProperties(['data' => $request])->log('Created New Specification.');
            return redirect()->back()->with('success', 'Successfully created new specification.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new specification. Please try again.');
        }
    }

    public function show(Specification $specification)
    {
        return redirect()->route('admin.specifications.edit', $specification->id);
    }

    public function edit(Specification $specification)
    {
        return view('admin.specifications.edit', ['specification' => $specification]);
    }

    public function update(Request $request, Specification $specification)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:specifications,name,' . $specification->id,
            'status' => 'required'
        ]);
        $specification->name = $validated['name'];
        $specification->status = $validated['status'];
        $res = $specification->save();
        if ($res) {
            activity('admin')->performedOn($specification)->causedBy($user)->withProperties(['data' => $request])->log('Updated Specification #' . $specification->name . '.');
            return redirect()->back()->with('success', 'Successfully updated specification.');
        } else {
            return redirect()->back()->with('error', 'Failed to update specification. Please try again.');
        }
    }
    public function destroy(Specification $specification, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $specification->delete();
        if ($res) {
            activity('admin')->performedOn($specification)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Specification #' . $specification->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the specification.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the specification. Please try again.');
        }
    }
}
