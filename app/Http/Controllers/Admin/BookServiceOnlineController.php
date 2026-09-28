<?php

namespace App\Http\Controllers\Admin;

use App\BookServiceOnline;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookServiceOnlineController extends Controller
{
    public function index()
    {
        $book_service = BookServiceOnline::first();
        return view('admin.book-service.index', compact('book_service'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'content' => 'required',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',

        ]);
        $book_service = BookServiceOnline::firstOrNew();
        $book_service->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $book_service->seo_title = $validated['seo_title'];
        $book_service->seo_description = $validated['seo_description'];
        $book_service->seo_keywords = $validated['seo_keywords'];

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/site',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $book_service->banner_image = $path;
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs(
                'upload/site',
                time() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $book_service->image = $path;
        }

        $res = $book_service->save();
        if ($res) {
            activity('admin')->performedOn($book_service)->causedBy($user)->withProperties(['data' => $request])->log('Updated Book Service Online Page.');
            return redirect()->back()->with('success', 'Successfully updated Book Service Online page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Book Service Online page. Please try again.');
        }
    }
}
