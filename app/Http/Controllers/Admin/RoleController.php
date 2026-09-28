<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // abort_unless(\Gate::allows('roles.index'), 403);
        return view('admin.roles.index', ['roles' => Role::where('name', '!=', 'super admin')->latest("updated_at")->paginate(10)]);
    }

    public function create()
    {
        // abort_unless(\Gate::allows('roles.create'), 403);
        return view('admin.roles.create', ['permissions' => Permission::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        // abort_unless(\Gate::allows('roles.store'), 403);
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
            'rolecategory'=>'required',
            'permissions.*' => 'required'
        ]);
        if($validated['rolecategory'] == 'admin') {
            $permissions = Permission::find($validated['permissions']);
            $role = new Role;
            $role->uuid = (string) Str::uuid();
            $role->name = $validated['name'];
            $res = $role->save();
            if ($res) {
                $role->syncPermissions($permissions);
                activity('admin')->performedOn($role)->causedBy($user)->withProperties(['data' => $request])->log('Added New Role.');
                return redirect()->back()->with('success', 'Successfully created new role.');
            } else {
                return redirect()->back()->with('error', 'Failed to create role. Please try again.');
            }
        } else {
            $role = new Role;
            $role->uuid = (string) Str::uuid();
            $role->name = $validated['name'];
            $role->guard_name = 'web';
            $res = $role->save();
            if ($res) {
                activity('admin')->performedOn($role)->causedBy($user)->withProperties(['data' => $request])->log('Added New Role.');
                return redirect()->back()->with('success', 'Successfully created new role.');
            } else {
                return redirect()->back()->with('error', 'Failed to create role. Please try again.');
            }
        }
        
    }

    public function show($id)
    {
        // abort_unless(\Gate::allows('roles.show'), 403);
        $role = Role::where('uuid', $id)->firstorFail();
        return redirect()->route('admin.roles.edit', $role->uuid);
    }

    public function edit($id)
    {
        // abort_unless(\Gate::allows('roles.edit'), 403);
        $role = Role::where('uuid', $id)->firstorFail();
        return view('admin.roles.edit', ['role' => $role, 'permissions' => Permission::orderBy('name')->get()]);
    }

    public function update(Request $request, $id)
    {
        // abort_unless(\Gate::allows('roles.update'), 403);
        $user = auth()->guard('admin')->user();
        $role = Role::where('uuid', $id)->firstorFail();
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'rolecategory' => 'required',
            'permissions.*' => 'required'
        ]);
        if($validated['rolecategory'] == 'admin') {
            $permissions = Permission::find($validated['permissions']);
            $role->name = $validated['name'];
            $role->guard_name = 'admin';
            $res = $role->save();
            if ($res) {
                $role->syncPermissions($permissions);
                activity('admin')->performedOn($role)->causedBy($user)->withProperties(['data' => $request])->log('Updated Role #' . $role->name . '.');
                return redirect()->back()->with('success', 'Successfully updated role.');
            } else {
                return redirect()->back()->with('error', 'Failed to update role. Please try again.');
            }
        } else {
            $role->name = $validated['name'];
            $role->guard_name = 'web';
            $res = $role->save();
            if ($res) {
                activity('admin')->performedOn($role)->causedBy($user)->withProperties(['data' => $request])->log('Updated Role #' . $role->name . '.');
                return redirect()->back()->with('success', 'Successfully updated role.');
            } else {
                return redirect()->back()->with('error', 'Failed to update role. Please try again.');
            }
        }
        
    }

    public function destroy($id, Request $request)
    {
        abort_unless(\Gate::allows('roles.destroy'), 403);
        $user = auth()->guard('admin')->user();
        $role = Role::where('uuid', $id)->firstorFail();
        if($role->guard_name == 'web') {
            $users = User::role($role->name)->delete();
        } else {
            $users = Admin::role($role->name)->delete();
        }
        $res = $role->delete();
        if ($res) {
            activity('admin')->performedOn($role)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Role #' . $role->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the role.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the role. Please try again.');
        }
    }
}
