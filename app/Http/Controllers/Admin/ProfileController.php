<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SterilizeRequest;
use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->guard('admin')->user();
        $activities = Activity::causedBy($user)->latest()->paginate(6)->onEachSide(1);
        return view('admin.profile.show', compact(['activities', 'user']));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|min:8|confirmed',
        ]);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $res = $user->save();
        if ($res) {
            activity('admin')->performedOn($user)->causedBy($user)->withProperties(['data' => SterilizeRequest::sterilize($request)])->log('Updated Profile.');
            return redirect()->back()->with('success', 'Successfully updated your profile.');
        } else {
            return redirect()->back()->with('error', 'Failed to update your profile. Please try again.');
        }
    }
}
