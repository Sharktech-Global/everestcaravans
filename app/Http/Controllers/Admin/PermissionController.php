<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        // abort_unless(\Gate::allows('permissions.index'), 403);
        return view('admin.permissions.index', ['permissions' => Permission::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        // abort_unless(\Gate::allows('permissions.store'), 403);
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        $permission = Permission::create(['name' => $validated['name']]);
        if ($permission) {
            activity('admin')->performedOn($permission)->causedBy($user)->withProperties(['data' => $request])->log('Created New Permission.');
            return redirect()->back()->with('success', 'Successfully created new permission.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new permission. Please try again.');
        }
    }

    public function destroy($id, Request $request)
    {
        // abort_unless(\Gate::allows('permissions.destroy'), 403);
        $user = auth()->guard('admin')->user();
        $permission = Permission::findorFail($id);
        $res = $permission->delete();
        if ($res) {
            activity('admin')->performedOn($permission)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Permission #' . $permission->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the permission.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the permission. Please try again.');
        }
    }
}
