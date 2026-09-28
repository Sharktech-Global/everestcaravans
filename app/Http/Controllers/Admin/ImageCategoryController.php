<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ImageCategory;
use Illuminate\Http\Request;

class ImageCategoryController extends Controller
{
    public function index()
    {

        return view('admin.image-category.index', ['category' => ImageCategory::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        // $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);
        $category = new ImageCategory();
        $category->title = $validated['title'];
        $category->status = $validated['status'];
        $res = $category->save();
        if ($res) {
            // activity('admin')->performedOn($category)->causedBy($user)->withProperties(['data' => $request])->log('Created New Fuel.');
            return redirect()->back()->with('success', 'Successfully created new category.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new category. Please try again.');
        }
    }
    public function edit($id)
    {
        $category = ImageCategory::where('id', $id)->first();
        // $services = Service::where('status', 1)->get();
        return view('admin.image-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ImageCategory::where('id', $id)->first();
        // $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);
        $category->title = $validated['title'];
        $category->status = $validated['status'];
        $res = $category->save();
        if ($res) {
            // activity('admin')->performedOn($Service)->causedBy($user)->withProperties(['data' => $request])->log('Updated Service #' . $Service->name . '.');
            return redirect()->back()->with('success', 'Successfully updated the servie details.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the servie details. Please try again.');
        }
    }
    public function destroy($id)
    {
        // $this->authorize('delete', $menu);
        $res = ImageCategory::where('id', $id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
   
}
