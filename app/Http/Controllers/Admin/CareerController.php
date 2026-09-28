<?php

namespace App\Http\Controllers\Admin;

use App\Career;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $careers = Career::search($search)->latest("updated_at")->paginate(10);
        return view('admin.careers.index', ['search' => $search, 'careers' => $careers]);
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'location' => 'nullable',
            'qualification' => 'nullable',
            'experience' => 'nullable',
            'email' => 'required',
            'contact_numbers' => 'nullable',
            'description' => 'nullable',
            'status' => 'required'
        ]);
        $career = new Career;
        $career->title = $validated['title'];
        $career->location = $validated['location'];
        $career->qualification = $validated['qualification'];
        $career->experience = $validated['experience'];
        $career->email = $validated['email'];
        $career->contact_numbers = $validated['contact_numbers'];
        $career->description = $validated['description'];
        $career->status = $validated['status'];
        $res = $career->save();
        if ($res) {
            activity('admin')->performedOn($career)->causedBy($user)->withProperties(['data' => $request])->log('Added New Job to Careers.');
            return redirect()->back()->with('success', 'Successfully added new job to careers.');
        } else {
            return redirect()->back()->with('error', 'Failed to add new job to careers. Please try again.');
        }
    }

    public function show(Career $career)
    {
        return redirect()->route('admin.careers.edit', $career->id);
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', ['career' => $career]);
    }

    public function update(Request $request, Career $career)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'location' => 'nullable',
            'qualification' => 'nullable',
            'experience' => 'nullable',
            'email' => 'required',
            'contact_numbers' => 'nullable',
            'description' => 'nullable',
            'status' => 'required'

        ]);
        $career->title = $validated['title'];
        $career->location = $validated['location'];
        $career->qualification = $validated['qualification'];
        $career->experience = $validated['experience'];
        $career->email = $validated['email'];
        $career->contact_numbers = $validated['contact_numbers'];
        $career->description = $validated['description'];
        $career->status = $validated['status'];
        $res = $career->save();
        if ($res) {
            activity('admin')->performedOn($career)->causedBy($user)->withProperties(['data' => $request])->log('Updated Job #' . $career->title . '.');
            return redirect()->back()->with('success', 'Successfully updated the job details.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the job details. Please try again.');
        }
    }

    public function destroy(Career $career, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $career->delete();
        if ($res) {
            activity('admin')->performedOn($career)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Job #' . $career->title . '.');
            return redirect()->back()->with('success', 'Successfully deleted the job.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the job. Please try again.');
        }
    }
}
