<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return view('admin.faq.index',['faqs' => Faq::latest("updated_at")->paginate(10)]);
    }

    public function store(Request $request)
    {
        // return 1
        // $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        $faq = new Faq();
        $faq->title = $validated['title'];
        $faq->description = $validated['description'];
        $faq->status = $validated['status'];
        //  dd($faq)
        $res = $faq->save();
        if ($res) {
            // activity('admin')->performedOn($faq)->causedBy($user)->withProperties(['data' => $request])->log('Created New Faq.');
            return redirect()->back()->with('success', 'Successfully created new Faq.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new Faq. Please try again.');
        }
    }


    // public function show(Faq $faq)
    // {
    //     return redirect()->route('admin.faq.edit', $faq->id);
    // }



    public function edit(Request $request,$id)
    {
        $faq = Faq::where('id',$id)->first();
        return view('admin.faq.edit', ['faq' => $faq]);
    }

    public function update(Request $request,$id)
    {
        $detail = Faq::where('id',$id)->first();
        // $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',

        ]);
        $detail->title = $validated['title'];
        $detail->description = $validated['description'];
        $detail->status = $validated['status'];
       
        $res = $detail->save();
        if ($res) {
            // activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to vehicle feature #' . $detail->title . '.');
            return redirect()->back()->with('success', 'Successfully Updated blog.');
        } else {
            return redirect()->back()->with('error', 'Failed to update blog. Please try again.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $faq = Faq::where('id',$id)->first();
        $res = $faq->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the blog.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the blog. Please try again.');
        }
    }
    
}
