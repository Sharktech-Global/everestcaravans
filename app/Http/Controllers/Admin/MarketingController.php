<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marketing;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Marketing::get();
        return view('admin.marketing.index', compact('data'));
    }
    public function create()
    {
        return view('admin.marketing.create');
    }


    public function store(Request $request)
    {
        // dd($request);
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([

            'tag' => 'required|string:255',
            'values' => 'required',
            'content' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);

        $marketing = new Marketing();
        $marketing->tag = $validated['tag'];
        $marketing->values = $validated['values'];
        $marketing->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $marketing->seo_title = $validated['seo_title'];
        $marketing->seo_description = $validated['seo_description'];
        $marketing->seo_keywords = $validated['seo_keywords'];

        $res = $marketing->save();
        if ($res) {
            activity('admin')->performedOn($marketing)->causedBy($user)->withProperties(['data' => $request])->log('Created New marketing page.');
            return redirect()->back()->with('success', 'Successfully created new marketing page.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new marketing page. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Marketing::where('id',$id)->first();
        return view('admin.marketing.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'tag' => 'required|string:255',
            'values' => 'required',
            'content' => 'required',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',

        ]);
        $marketing = Marketing::findOrFail($id);
        $marketing->tag = $validated['tag'];
        $marketing->values = $validated['values'];
        $marketing->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $marketing->seo_title = $validated['seo_title'];
        $marketing->seo_description = $validated['seo_description'];
        $marketing->seo_keywords = $validated['seo_keywords'];

        $res = $marketing->save();
        if ($res) {
            activity('admin')->performedOn($marketing)->causedBy($user)->withProperties(['data' => $request])->log('Updated marketing');
            return redirect()->back()->with('success', 'Successfully updated the marketing details.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the marketing details. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        $user = auth()->guard('admin')->user();
        $marketing = Marketing::findOrFail($id);
        $res = $marketing->delete();
        if ($res) {
            activity('admin')->performedOn($marketing)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Marketing tag.');
            return redirect()->back()->with('success', 'Successfully deleted.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete. Please try again.');
        }
    }
}
