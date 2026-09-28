<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;


class BlogController extends Controller
{
    use SEOToolsTrait;
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        // dd(90);
        $data['blog'] = Blog::where('status',1)->get();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
    }
}
