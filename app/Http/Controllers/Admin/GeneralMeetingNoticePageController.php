<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GeneralMeetingNotice;

class GeneralMeetingNoticePageController extends Controller
{
    public function index()
    {
        $page = GeneralMeetingNotice::first();
        return view('admin.general-meeting-notice.index', ['page' => $page]);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'content' => 'nullable',
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'background_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $page = GeneralMeetingNotice::firstOrCreate();
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->seo_title = $validated['seo_title'];
        $page->seo_description = $validated['seo_description'];
        $page->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/slider/banner_image',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }
        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->storeAs(
                'upload/slider/background_image',
                time() . '_' . $request->background_image->getClientOriginalName(),
                'public'
            );
            $page->background_image = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated General Meeting Notice Page.');
            return redirect()->back()->with('success', 'Successfully updated General Meeting Notice page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update General Meeting Notice page. Please try again.');
        }
    }
}
