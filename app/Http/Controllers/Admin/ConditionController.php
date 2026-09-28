<?php

namespace App\Http\Controllers\Admin;

use App\Condition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function index()
    {
        return view('admin.conditions.index', ['conditions' => Condition::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:conditions,name',
            'status' => 'required'
        ]);
        $condition = new Condition;
        $condition->name = $validated['name'];
        $condition->status = $validated['status'];
        $res = $condition->save();
        if ($res) {
            activity('admin')->performedOn($condition)->causedBy($user)->withProperties(['data' => $request])->log('Created New Condition.');
            return redirect()->back()->with('success', 'Successfully created new condition.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new condition. Please try again.');
        }
    }

    public function show(Condition $condition)
    {
        return redirect()->route('admin.conditions.edit', $condition->id);
    }

    public function edit(Condition $condition)
    {
        return view('admin.conditions.edit', ['condition' => $condition]);
    }

    public function update(Request $request, Condition $condition)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:conditions,name,' . $condition->id,
            'status' => 'required'
        ]);
        $condition->name = $validated['name'];
        $condition->status = $validated['status'];
        $res = $condition->save();
        if ($res) {
            activity('admin')->performedOn($condition)->causedBy($user)->withProperties(['data' => $request])->log('Updated Condition #' . $condition->name . '.');
            return redirect()->back()->with('success', 'Successfully updated condition.');
        } else {
            return redirect()->back()->with('error', 'Failed to update condition. Please try again.');
        }
    }
    public function destroy(Condition $condition, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $condition->delete();
        if ($res) {
            activity('admin')->performedOn($condition)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Condition #' . $condition->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the condition.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the condition. Please try again.');
        }
    }
}
