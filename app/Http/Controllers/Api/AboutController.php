<?php

namespace App\Http\Controllers\Api;

use App\AboutPage;
use App\AboutGroup;
use App\Http\Controllers\Controller;
use App\AboutLeader;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use SEOToolsTrait;
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['about_motors'] =AboutPage::select('id','content','banner_image')->first();
        $data['about_group'] =AboutGroup::select('id','content','banner_image')->first();
        $data['about_leaders'] =AboutLeader::select('id','name','image','mobile','email','dob','details','status')->where('status',1)->get();
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   
    }

   
}
