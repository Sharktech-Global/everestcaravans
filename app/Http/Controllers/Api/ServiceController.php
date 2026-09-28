<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 400;
    public function index() 
    {
       // section 1
       $data['services'] = Service::select('id', 'title','sub_title','slug', 'content', 'image', 'banner_image','seo_title','seo_description','seo_keywords')
                            ->where('status', 1)
                            ->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }   
}
