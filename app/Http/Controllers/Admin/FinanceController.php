<?php

namespace App\Http\Controllers\Admin;

use App\Finance;
use App\Http\Controllers\Controller;
use App\ImageCategory;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class FinanceController extends Controller
{

    public function index(Request $request)
    {
        // $search = ($request->search) ? $request->search : null; 
        $pages = Finance::latest("updated_at")->paginate(10);
        return view('admin.finance.index', compact('pages'));
    }
    public function create()
    {
        // $services = Service::where('status', 1)->get();
        $category = ImageCategory::where('status', 1)->get();
        // dd($category);
        return view('admin.finance.create', compact('category'));
    }

    public function store(Request $request)
    {
        // $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'nullable',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'status' => 'required',
        ]);
        $Service = new Finance();
        $Service->title = $validated['title'];
        // $Service->slug = SlugService::createSlug(Service::class, 'slug', $Service->title, ['unique' => false]);
        $Service->category = $validated['category'];
        $Service->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/finance/image',
                $Service->title . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $Service->image = $path;
        }
        $res = $Service->save();
        if ($res) {
            // activity('admin')->performedOn($Service)->causedBy($user)->withProperties(['data' => $request])->log('Created New Page.');
            return redirect()->back()->with('success', 'Successfully created new page.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new page. Please try again.');
        }
    }
    public function edit($id)
    {
        $Service = Finance::where('id', $id)->first();
        $category = ImageCategory::where('status', 1)->get();
        // dd($Service);
        // $services = Service::where('status', 1)->get();
        return view('admin.finance.edit', compact('Service', 'category'));
    }

    public function update(Request $request, $id)
    {
        $Service = Finance::where('id', $id)->first();
        // $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'nullable',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'banner_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'status' => 'required',
        ]);
        $Service->title = $validated['title'];
        // $Service->slug = SlugService::createSlug(Service::class, 'slug', $Service->title, ['unique' => false]);
        $Service->category = $validated['category'];
        $Service->status = $validated['status'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/finance/image',
                $Service->title . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $Service->image = $path;
        }
        $res = $Service->save();
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
        $res = Finance::where('id', $id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}
