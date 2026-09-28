<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use SEOToolsTrait;
    public $successStatus = 200;
    public $failedStatus = 400;
    public function section() 
    {
       // section 1
       $data['section'] = Section::with(['contents' => function ($query) {
                                $query->select('id', 'section_id', 'title', 'icon', 'icon_content', 'button_title', 'button_link', 'order')->where('status', 1);
                            }])
                            ->select('id', 'title','slug', 'description', 'image', 'background', 'thumbnail','link','order')
                            ->where('status', 1)
                            ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }   
}
