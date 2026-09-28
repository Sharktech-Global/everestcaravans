<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\CounterList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounterListController extends Controller
{
    public function index(Request $request)
    {
        $lists=CounterList::paginate(10);
        return view('admin.counter.list.index', ['lists' => $lists]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:counter_lists',
            'counter' => 'required',
            'order_by' => 'required',
            'status' => 'required',
            'plus' => 'nullable'

        ]);
        $detail = new CounterList();
        $detail->title = $validated['title'];
        $detail->counter = $validated['counter'];
        $detail->order_by = $validated['order_by'];
        $detail->status = $validated['status'];
        $detail->plus = $validated['plus'];
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->withProperties(['data' => $request])->log('New list added #' . $detail->list . '.');
            return redirect()->back()->with('success', 'Successfully added leader.');
        } else {
            return redirect()->back()->with('error', '` to add list. Please try again.');
        }
    }
    public function edit(Request $request,$id)
    {
        $list = CounterList::where('id',$id)->first();
        return view('admin.counter.list.edit', ['list' => $list]);
    }

    public function update(Request $request,$id)
    {
        $detail = CounterList::where('id',$id)->first();
        $validated = $request->validate([
            'title' => 'required|unique:counter_lists,title,' . $detail->id,
            'counter' => 'required',
            'order_by' => 'required',
            'status' => 'required',
            'plus' => 'nullable'

        ]);
        $detail->title = $validated['title'];
        $detail->counter = $validated['counter'];
        $detail->order_by = $validated['order_by'];
        $detail->status = $validated['status'];   
        $detail->plus = $validated['plus'];

        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->withProperties(['data' => $request])->log('List updated#' . $detail->title . '.');
            return redirect()->back()->with('success', 'Successfully Updated leader.');
        } else {
            return redirect()->back()->with('error', 'Failed to update leader. Please try again.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $leader = CounterList::where('id',$id)->first();
        $res = $leader->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the list.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the list. Please try again.');
        }
    }
}
