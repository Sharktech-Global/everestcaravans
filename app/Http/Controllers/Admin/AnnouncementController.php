<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('admin.announcements.index', ['announcements' => Announcement::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'description' => 'required',
            'link' => 'nullable|url',
            'status' => 'required'
        ]);
        $announcement = new Announcement;
        $announcement->description = $validated['description'];
        $announcement->link = $validated['link'];
        $announcement->status = $validated['status'];
        $res = $announcement->save();
        if ($res) {
            activity('admin')->performedOn($announcement)->causedBy($user)->withProperties(['data' => $request])->log('Added New Announcement.');
            return redirect()->back()->with('success', 'Successfully created new announcement.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new announcement. Please try again.');
        }
    }

    public function show(Announcement $announcement)
    {
        return redirect()->route('admin.announcements.edit', $announcement->id);
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', ['announcement' => $announcement]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'description' => 'required',
            'link' => 'nullable|url',
            'status' => 'required'
        ]);
        $announcement->description = $validated['description'];
        $announcement->link = $validated['link'];
        $announcement->status = $validated['status'];
        $res = $announcement->save();
        if ($res) {
            activity('admin')->performedOn($announcement)->causedBy($user)->withProperties(['data' => $request])->log('Updated Announcement #' . $announcement->description . '.');
            return redirect()->back()->with('success', 'Successfully updated announcement.');
        } else {
            return redirect()->back()->with('error', 'Failed to update announcement. Please try again.');
        }
    }
    public function destroy(Announcement $announcement, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $announcement->delete();
        if ($res) {
            activity('admin')->performedOn($announcement)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Announcement #' . $announcement->description . '.');
            return redirect()->back()->with('success', 'Successfully deleted the announcement.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the announcement. Please try again.');
        }
    }
}
