<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Http\Controllers\Controller;
use App\Helpers\SendEmail;
use Validator;
use App\Gallery;
use Illuminate\Support\Str;
class GalleryController extends Controller
{
    public function create()
    {
        // $this->authorize('create', Admin::class); 
        $galleries = Gallery::get();
        return view('admin.gallery.index', compact('galleries'));
    }
    public function store(Request $request)
    {
       

        // $this->authorize('create', Gender::class);
        $validated = $request->validate([
            'files[]' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'seo_title' => 'nullable',
            // 'seo_keywords' => 'nullable',
            // 'seo_description' => 'nullable',
        ]);
       
        $files = $request->file('files');
        if($request->hasfile('files')) {
            foreach($files as $file){
                $path =  $file->storeAs('media/images/gallery', urlencode(time()) . '_' .$file->getClientOriginalName(),'public');
                $images = new Gallery();
                $images->uuid = (string) Str::uuid();
                $images->images = $path;
                $images->save();
            }        
        }
        // $data->seo_title = $validated['seo_title'];
        // $data->seo_keywords = $validated['seo_keywords'];
        // $data->seo_description = $validated['seo_description'];
        if ($images) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to create. Please try again'));
        }
        return redirect()->back();
    }
      // image delete
      public function image_delete(Request $request)
      {
          $gallery= Gallery::where('uuid',$request->uuid)->delete();
          return response()->json(['status' => "success"]);
      }
}
