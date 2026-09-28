<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\MainNetwork;
use App\Http\Controllers\Controller;

class NetworkAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = MainNetwork::get();
        return view('admin.network_page.main.index', compact('datas'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $result = new MainNetwork();
        $result->title = $validated['name'];
        $res = $result->save();
        if ($res) {
            return redirect()->back()->with('success', 'Main Network Added successfully');
        } else {
            return redirect()->back()->with('error', 'Your details creation was not successful. Please try again.');
        }
    }
    public function edit($id)
    {
        $data = MainNetwork::findOrFail($id);
        return view('admin.network_page.main.edit', ['data' => $data]);
    }
    public function update(Request $request, $id)
    {

        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $result = MainNetwork::findOrFail($id);
        $result->title = $validated['name'];
        $res = $result->save();
        if ($res) {
            activity('admin')->performedOn($result)->causedBy($user)->withProperties(['data' => $request])->log('Updated Main Network #' . $result->title . '.');
            return redirect()->back()->with('success', 'Successfully updated Main Network.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Main Network. Please try again.');
        }
    }
    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $result = MainNetwork::findOrFail($id);
        $res = $result->delete();
        if ($res) {
            activity('admin')->performedOn($result)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Main Network #' . $result->title . '.');
            return redirect()->back()->with('success', 'Successfully deleted the Main Network.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the Main Network. Please try again.');
        }
    }
}
