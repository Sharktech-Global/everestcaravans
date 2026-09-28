<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\MainNetwork;
use App\SubNetwork;
use App\Http\Controllers\Controller;

class SubNetworkAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = SubNetwork::with('main')->paginate(10);
        $networks = MainNetwork::get();
        $brands = Brand::get();

        return view('admin.network_page.sub.index', compact('datas', 'networks','brands'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_network' => 'required',
            'name' => 'required',
            'brand' => 'nullable'
        ]);
        $result = new SubNetwork();
        $result->main_id = $validated['main_network'];
        $result->sub_title = $validated['name'];
        $result->brand_id = $validated['brand'];
        $res = $result->save();
        if ($res) {
            return redirect()->back()->with('success', 'Sub Network Added successfully');
        } else {
            return redirect()->back()->with('error', 'Your details creation was not successful. Please try again.');
        }
    }
    public function edit($id)
    {
        $networks = MainNetwork::get();
        $data = SubNetwork::with('main','brand')->findOrFail($id);
        $brands = Brand::get();
        return view('admin.network_page.sub.edit', ['data' => $data, 'networks' => $networks,'brands' => $brands]);
    }
    public function update(Request $request, $id)
    {

        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'main_network' => 'required',
            'name' => 'required',
            'brand' => 'nullable'
        ]);
        $result = SubNetwork::findOrFail($id);
        $result->main_id = $validated['main_network'];
        $result->brand_id = $validated['brand'];
        $result->sub_title = $validated['name'];
        $res = $result->save();
        if ($res) {
            activity('admin')->performedOn($result)->causedBy($user)->withProperties(['data' => $request])->log('Updated Sub Network #' . $result->title . '.');
            return redirect()->back()->with('success', 'Successfully updated Sub Network.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Sub Network. Please try again.');
        }
    }
    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $result = SubNetwork::findOrFail($id);
        $res = $result->delete();
        if ($res) {
            activity('admin')->performedOn($result)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Sub Network #' . $result->title . '.');
            return redirect()->back()->with('success', 'Successfully deleted the Sub Network.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the Sub Network. Please try again.');
        }
    }
}
