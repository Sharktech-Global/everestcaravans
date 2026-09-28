<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\NewsAndEvents;
use App\NewsEventsList;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class NewsAndEventsController extends Controller
{
    use SEOToolsTrait;
    public $successStatus = 200;
    public $failedStatus = 400;

    public function index()
    {
        $data['news_events'] =NewsAndEvents::select('id','title','sub_title','content','banner_image')->first();
        $data['news_events_list'] =NewsEventsList::select('id','title','sub_title','date_of_event','slug','content','image','status')->first();

        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   
    }

   
}
