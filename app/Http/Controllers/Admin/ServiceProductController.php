<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceProduct;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceProductController extends Controller
{
    public function index()
    {
        return view('admin.service_products.index', ['service_products' => ServiceProduct::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:service_products,name',
            'description' => 'nullable',
            'button_link' => 'nullable',
            'status' => 'required',
            'image'=> 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image_secondary' =>'nullable',
            'image_secondary.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image_third' =>'nullable',
            'image_third.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $product = new ServiceProduct;
        $product->name = $validated['name'];
        $product->slug = SlugService::createSlug(ServiceProduct::class, 'slug', $product->name, ['unique' => false]);
        $product->description = $validated['description'];
        $product->status = $validated['status'];
        $product->button_link = $validated['button_link'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/section/image',
                $request->image->getClientOriginalName(),
                'public'
            );
            $product->image = $path;
        }
        if ($request->hasFile('image_secondary')) {
            $path1 = $request->file('image_secondary')->storeAs(
                'upload/section/image',
                $request->image_secondary->getClientOriginalName(),
                'public'
            );
            $product->image_secondary = $path1;
        } 
         if ($request->hasFile('image_third')) {
            $path1 = $request->file('image_third')->storeAs(
                'upload/section/image',
                $request->image_third->getClientOriginalName(),
                'public'
            );
            $product->image_third = $path1;
        }
        $res = $product->save();
        if ($res) {
            activity('admin')->performedOn($product)->causedBy($user)->withProperties(['data' => $request])->log('Created New Service Product.');
            return redirect()->back()->with('success', 'Successfully created new service product.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new service product. Please try again.');
        }
    }

    public function show(ServiceProduct $serviceProduct)
    {
        return redirect()->route('admin.service_products.edit', $serviceProduct->id);
    }

    public function edit(ServiceProduct $serviceProduct)
    {
        return view('admin.service_products.edit', ['serviceProduct' => $serviceProduct]);
    }

    public function update(Request $request, ServiceProduct $serviceProduct)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:service_products,name,' . $serviceProduct->id,
            'description' => 'nullable',
            'status' => 'required',
            'image'=> 'nullable',
            'button_link' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image_secondary' =>'nullable',
            'image_secondary.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'image_third' =>'nullable',
            'image_third.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $serviceProduct->name = $validated['name'];
        $serviceProduct->slug = SlugService::createSlug(ServiceProduct::class, 'slug', $serviceProduct->name, ['unique' => false]);
        $serviceProduct->description = $validated['description'];
        $serviceProduct->status = $validated['status'];
        $serviceProduct->button_link = $validated['button_link'];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/section/image',
                $serviceProduct->slug . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $serviceProduct->image = $path;
        }
        if ($request->hasFile('image_secondary')) {
            $path1 = $request->file('image_secondary')->storeAs(
                'upload/section/image',
                $request->image_secondary->getClientOriginalName(),
                'public'
            );
            $serviceProduct->image_secondary = $path1;
        } 
         if ($request->hasFile('image_third')) {
            $path1 = $request->file('image_third')->storeAs(
                'upload/section/image',
                $request->image_third->getClientOriginalName(),
                'public'
            );
            $serviceProduct->image_third = $path1;
        }
        $res = $serviceProduct->save();
        if ($res) {
            activity('admin')->performedOn($serviceProduct)->causedBy($user)->withProperties(['data' => $request])->log('Updated Service Product #' . $serviceProduct->name . '.');
            return redirect()->back()->with('success', 'Successfully updated service product.');
        } else {
            return redirect()->back()->with('error', 'Failed to update service product. Please try again.');
        }
    }
    public function destroy(ServiceProduct $serviceProduct, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $res = $serviceProduct->delete();
        if ($res) {
            activity('admin')->performedOn($serviceProduct)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Service Product #' . $serviceProduct->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the service product.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the service product. Please try again.');
        }
    }
}
