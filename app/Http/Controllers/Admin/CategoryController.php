<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\CategoryType;
use App\SubCategory;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    // category type
    public function index()
    {
        $category = CategoryType::get();
        return view('admin.category.index',['category' => $category]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $category_type = new CategoryType();
        $category_type->name = $validated['name'];
        $category_type->status = $validated['status'];
        $res = $category_type->save();
        if($res){
            return redirect()->back()->with('success', 'Category Type Added successfully');
        } else {
            return redirect()->back()->with('error', 'Your details update was not successful. Please try again.');
        }
    }
    public function edit($id)
    {
        $categorytype = CategoryType::findOrFail($id);
        return view('admin.category.edit', ['categorytype' => $categorytype]);
    }

    public function update(Request $request, $id)
    {

        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        $categorytype = CategoryType::findOrFail($id);
        $categorytype->name = $validated['name'];
        $categorytype->status = $validated['status'];
        $res = $categorytype->save();
        if ($res) {
            activity('admin')->performedOn($categorytype)->causedBy($user)->withProperties(['data' => $request])->log('Updated Category Type #' . $categorytype->name . '.');
            return redirect()->back()->with('success', 'Successfully updated Category Type.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Category Type. Please try again.');
        }
    }
    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $category_type = CategoryType::findOrFail($id);
        $res = $category_type->delete();
        if ($res) {
            activity('admin')->performedOn($category_type)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Category Type #' . $category_type->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the Category Type.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the Category Type. Please try again.');
        }
    }

    // category
    public function category_index($id)
    {
        $category = Category::where('category_type_id',$id)->get();
        $category_type = CategoryType::findOrFail($id);

        return view('admin.category.categories',['category' => $category,'category_type' =>$category_type]);
    }
    public function category_store(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $category_type = new Category();
        $category_type->category_type_id = $id;
        $category_type->name = $validated['name'];
        $category_type->status = $validated['status'];
        $res = $category_type->save();
        if($res){
            return redirect()->back()->with('success', 'Category Added successfully');
        } else {
            return redirect()->back()->with('error', 'Your details update was not successful. Please try again.');
        }
    }
    public function category_edit($id,$catid)
    {
        $categorytype = CategoryType::findOrFail($id);

        $category = Category::findOrFail($catid);
        return view('admin.category.categories-edit', ['categorytype' => $categorytype, 'category' => $category]);
    }

    public function category_update(Request $request, $id,$catid)
    {

        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        $category = Category::findOrFail($catid);
        $category->category_type_id = $id;
        $category->name = $validated['name'];
        $category->status = $validated['status'];
        $res = $category->save();
        if ($res) {
            activity('admin')->performedOn($category)->causedBy($user)->withProperties(['data' => $request])->log('Updated Category  #' . $category->name . '.');
            return redirect()->back()->with('success', 'Successfully updated Category .');
        } else {
            return redirect()->back()->with('error', 'Failed to update Category . Please try again.');
        }
    }
    public function category_destroy(Request $request, $id,$catid)
    {
        $user = auth()->guard('admin')->user();
        $category = Category::findOrFail($catid);
        $res = $category->delete();
        if ($res) {
            activity('admin')->performedOn($category)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Category #' . $category->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted the Category.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the Category . Please try again.');
        }
    }

    // subcategory
    public function subcategory_index($id, $catid)
    {
        $category = Category::findOrFail($catid);
        $category_type = CategoryType::findOrFail($id);
        $subcat = SubCategory::where('category_id',$catid)->get();
        return view('admin.category.subcategories',['category' => $category,'category_type' =>$category_type,'subcat' => $subcat]);
    }
    public function subcategory_store(Request $request,$id,$catid)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_similar' => 'required'
        ]);
        $subcat = new SubCategory();
        $subcat->category_id = $catid;
        $subcat->name = $validated['name'];
        $subcat->status = $validated['status'];
        $subcat->is_similar = $validated['is_similar'];
        $res = $subcat->save();
        if($res){
            return redirect()->back()->with('success', 'Sub Category Added successfully');
        } else {
            return redirect()->back()->with('error', 'Your details update was not successful. Please try again.');
        }
    }
    public function subcategory_edit($id,$catid,$subid)
    {
        $categorytype = CategoryType::findOrFail($id);
        $category = Category::findOrFail($catid);
        $subcat = SubCategory::findOrFail($subid);
        return view('admin.category.subcategories-edit', ['categorytype' => $categorytype, 'category' => $category,'subcat' => $subcat]);
    }
    public function subcategory_update(Request $request, $id,$catid,$subid)
    {

        // dd('hello');
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_similar' => 'required'
        ]);
        $subcat = SubCategory::findOrFail($subid);
        $subcat->category_id = $catid;
        $subcat->name = $validated['name'];
        $subcat->status = $validated['status'];
        $subcat->is_similar = $validated['is_similar'];
        $res = $subcat->save();
        if ($res) {
            activity('admin')->performedOn($subcat)->causedBy($user)->withProperties(['data' => $request])->log('Updated Category  #' . $subcat->name . '.');
            return redirect()->back()->with('success', 'Successfully updated Sub Category .');
        } else {
            return redirect()->back()->with('error', 'Failed to update Sub Category . Please try again.');
        }
    }
    public function subcategory_destroy(Request $request, $id,$catid,$subid)
    {
        $user = auth()->guard('admin')->user();
        $subcat = SubCategory::findOrFail($subid);
        $res = $subcat->delete();
        if ($res) {
            activity('admin')->performedOn($subcat)->causedBy($user)->withProperties(['data' => $request])->log('Deleted sub Category #' . $subcat->name . '.');
            return redirect()->back()->with('success', 'Successfully deleted Sub Category.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the Sub Category . Please try again.');
        }
    }

}
