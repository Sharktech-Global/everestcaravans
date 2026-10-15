<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Storage;
use App\Http\Controllers\Controller;
use App\NewsEventsList;

class NewsAndEventsListController extends Controller
{
    public function index(Request $request)
    {
        $lists=NewsEventsList::paginate(10);
        return view('admin.news-events.list.index', ['lists' => $lists]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required|unique:news_events_lists',
            'sub_title' => 'nullable',
            'date_of_event' => 'nullable',
            'details' => 'nullable',
            'images' => 'nullable',
            'status' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'

        ]);
        $detail = new NewsEventsList();
        $detail->title = $validated['title'];
        $detail->sub_title = $validated['sub_title'];
        $detail->date_of_event = $validated['date_of_event'];
        $detail->content = $validated['details'];
        $detail->status = $validated['status'];
        if ($request->hasFile('image')) {

            $path = $request->file('image')->storeAs(
                'upload/blogs/image',
                $request->file('image')->getClientOriginalName(),
                'public'
            );

            $detail->image = $path;
        }
        $res = $detail->save();
        if ($res) {
            activity('admin')->performedOn($detail)->causedBy($user)->withProperties(['data' => $request])->log('Added Image to news and events #' . $detail->title . '.');
            return redirect()->back()->with('success', 'Successfully added list.');
        } else {
            return redirect()->back()->with('error', 'Failed to add list. Please try again.');
        }
    }
     
    public function edit(Request $request,$id)
    {
        $list = NewsEventsList::where('id',$id)->first();
        return view('admin.news-events.list.edit', ['list' => $list]);
    }

    
public function update(Request $request, $id)
{
    $detail = NewsEventsList::findOrFail($id);
    $user = auth()->guard('admin')->user();

    $validated = $request->validate([
        'title' => 'required|unique:news_events_lists,title,' . $detail->id,
        'sub_title' => 'nullable',
        'date_of_event' => 'nullable',
        'content' => 'nullable',
        'status' => 'required',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $detail->title = $validated['title'];
    $detail->sub_title = $validated['sub_title'] ?? null;
    $detail->date_of_event = $validated['date_of_event'] ?? null;
    $detail->status = $validated['status'];
    $detail->content = $validated['content'] ?? null;

    // Update image only when a new image is uploaded
    if ($request->hasFile('images')) {

        $path = $request->file('images')->store(
            'upload/blogs/images',
            'public'
        );

        // Delete previous image only if it exists
        if (!empty($detail->image)) {
            Storage::disk('public')->delete($detail->image);
        }

        $detail->image = $path;
    }

    $res = $detail->save();

    if ($res) {
        activity('admin')
            ->performedOn($detail)
            ->causedBy($user)
            ->withProperties(['data' => $request->except('images')])
            ->log('Updated News & Events #' . $detail->title . '.');

        return redirect()->back()
            ->with('success', 'Successfully updated News & Events.');
    }

    return redirect()->back()
        ->with('error', 'Failed to update News & Events. Please try again.');
}


    public function destroy(Request $request, $id)
    {
        $user = auth()->guard('admin')->user();
        $blog = NewsEventsList::where('id',$id)->first();
        $res = $blog->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the list.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the list. Please try again.');
        }
    }
}
