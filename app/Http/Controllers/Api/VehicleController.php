<?php

namespace App\Http\Controllers\Api;

use App\AddPage;
use App\Vehicle;
use App\HomeSlider;
use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Validator;
use App\VehicleType;
use App\SubscriptionEnquiry;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class VehicleController extends Controller
{
    use SEOToolsTrait;
    public $successStatus = 200;
    public $failedStatus = 400;

    public function list(Request $request)
    {
        $type_id = $request->type_id;
        $application_id = $request->application_id;
        $query = Vehicle::select('id', 'name', 'slug', 'vehicle_type_id', 'application_id','title','image','is_booking','booking_amount')
                ->with(['vehicle_type' => function ($query) {
                            $query->select('name','slug','image','order','status');
                        },'seo' => function($query) {
                            $query->select('id', 'vehicle_id', 'title', 'description', 'keywords');
                        }])
                ->where('status', 1);
        if ($type_id) {
            $query->where('vehicle_type_id', $type_id);
        }

        if ($application_id) {
            $query->where('application_id', $application_id);
        }

        $data['vehicles'] = $query->get();

           
      
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   
    }
   
  
}
