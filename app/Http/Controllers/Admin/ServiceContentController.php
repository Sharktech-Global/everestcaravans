<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceContent;
use Illuminate\Http\Request;

class ServiceContentController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $pages = ServiceContent::search($search)->latest("updated_at")->with('services')->paginate(10);
        $services=Service::where('status',1)->get();
        return view('admin.service-content.index', compact('pages','services'));
    }
    public function create()
    {
        $services=Service::where('status',1)->get();
        return view('admin.service-content.create',compact('services'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            'service_id' => 'required',
            'content' => 'nullable',
            'status' => 'required',
          
        ]);
        $Service = new ServiceContent();
        $Service->name = $validated['name'];
        $Service->service_id = $validated['service_id'];
        $Service->content = $validated['content'];
        $Service->status = $validated['status'];
     
       
        $res = $Service->save();
        if ($res) {
            activity('admin')->performedOn($Service)->causedBy($user)->withProperties(['data' => $request])->log('Created New Page.');
            return redirect()->back()->with('success', 'Successfully created new page.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new page. Please try again.');
        }
    }
    // public function show()
    // {
    //     $Service = ServiceContent::firstOrFail();
    //     return view('admin.service-content.show', compact('Service'));
    // }
    public function edit($id)
    {
        $Service= ServiceContent::where('id',$id)->first();
        $services=Service::where('status',1)->get();
        return view('admin.service-content.edit', ['Service' => $Service,'services' => $services]);
    }

    public function update(Request $request,$id)
    {
        $Service= ServiceContent::where('id',$id)->first();
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            'service_id' => 'required',
            'content' => 'nullable',
            'status' => 'required',
        ]);
        $Service->name = $validated['name'];
        $Service->content = $validated['content'];
        $Service->service_id = $validated['service_id'];
        $Service->status = $validated['status'];
        $res = $Service->save();
        if ($res) {
            activity('admin')->performedOn($Service)->causedBy($user)->withProperties(['data' => $request])->log('Updated Service #' . $Service->name . '.');
            return redirect()->back()->with('success', 'Successfully updated the servie details.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the servie details. Please try again.');
        }
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = ServiceContent::where('id',$id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
