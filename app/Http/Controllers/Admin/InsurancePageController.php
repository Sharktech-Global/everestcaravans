<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InsurancePage;
use Illuminate\Http\Request;

class InsurancePageController extends Controller
{
    public function show($slug)
    {
        $page = InsurancePage::getBySlug($slug);
        switch ($slug) {
            case 'insurance-features':
                $title = "Insurance Features Page";
                break;
            case 'why-buy-maruti-insurance':
                $title = "Why Buy Maruti Insurance Page";
                break;
            case 'advantages-of-popular':
                $title = "Advantages of Popular Page";
                break;
            case 'add-ons':
                $title = "Add ons Page";
                break;
            case 'value-added-services':
                $title = "Value Added Services";
                break;
            case 'faqs':
                $title = "FAQs";
                break;
            default:
                $title = 'Insurance Pages';
                break;
        }
        return view('admin.insurance-page.index', ['page' => $page, 'slug' => $slug, 'title' => $title]);
    }

    public function store($slug, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'background_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
            'seo_keywords' => 'nullable',
        ]);
        $page = InsurancePage::getBySlug($slug);
        $page->slug = $slug;
        $page->title = $validated['title'];
        $page->content = ($validated['content'] != '<p><br></p>') ? $validated['content'] : null;
        $page->seo_title = ($validated['seo_title']) ? $validated['seo_title'] : null;
        $page->seo_description = ($validated['seo_description']) ? $validated['seo_description'] : null;
        $page->seo_keywords = ($validated['seo_keywords']) ? $validated['seo_keywords'] : null;

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->storeAs(
                'upload/pages/' . $slug . '/banner',
                time() . '_' . $request->banner_image->getClientOriginalName(),
                'public'
            );
            $page->banner_image = $path;
        }
        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->storeAs(
                'upload/pages/' . $slug . '/background',
                time() . '_' . $request->background_image->getClientOriginalName(),
                'public'
            );
            $page->background_image = $path;
        }

        $res = $page->save();
        if ($res) {
            activity('admin')->performedOn($page)->causedBy($user)->withProperties(['data' => $request])->log('Updated Insurance Feature Page.');
            return redirect()->back()->with('success', 'Successfully updated Insurance Feature page.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Insurance Feature page. Please try again.');
        }
    }
}
