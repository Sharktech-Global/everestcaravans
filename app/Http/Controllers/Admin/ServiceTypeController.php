<?php

namespace App\Http\Controllers\Admin;

use App\ServiceType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index()
    {
        return view('admin.service_types.index', ['service_types' => ServiceType::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:service_types,name',
            'status' => 'required'
        ]);
        $type = new ServiceType;
        $type->name = $validated['name'];
        $type->status = $validated['status'];
        $res = $type->save();
        if ($res) {
            activity('admin')->performedOn($type)->causedBy($user)->withProperties(['data' => $request])->log('Created New Service Type.');
            return redirect()->back()->with('success', 'Successfully created new service type.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new service type. Please try again.');
        }
    }

    public function show(ServiceType $serviceType)
    {
        return redirect()->route('admin.service_types.edit', $serviceType->id);
    }

    public function edit(ServiceType $serviceType)
    {
        return view('admin.service_types.edit', ['serviceType' => $serviceType]);
    }

    public function update(Request $request, ServiceType $serviceType)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:service_types,name,' . $serviceType->id,
            'status' => 'required'
        ]);
        $serviceType->name = $validated['name'];
        $serviceType->status = $validated['status'];
        $res = $serviceType->save();
        if ($res) {
            activity('admin')->performedOn($serviceType)->causedBy($user)->withProperties(['data' => $request])->log('Updated Service Type #' . $serviceType->name . '.');
            return redirect()->back()->with('success', 'Successfully updated service type.');
        } else {
            return redirect()->back()->with('error', 'Failed to update service type. Please try again.');
        }
    }
    public function destroy(ServiceType $serviceType, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $serviceType->delete();
        if ($res) {
            activity('admin')->performedOn($serviceType)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Service Type #' . $serviceType->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the service type.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the service type. Please try again.');
        }
    }
}
