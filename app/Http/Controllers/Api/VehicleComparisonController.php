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

class VehicleComparisonController extends Controller
{
    use SEOToolsTrait;
    public $successStatus = 200;
    public $failedStatus = 400;

    public function list()
    {
        $data['vehicles'] = Vehicle::whereStatus(1)->with(['vehicle_type','varients',
                            'seo' => function($query) {
                                 $query->select('id', 'vehicle_id', 'title', 'description', 'keywords');
                            }])->get();
      
        if (!empty($data)) {
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
        }
        return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
   
    }
    public function single_list(Request $request)
    {
        $data =[];
        if($request->vehicle_id){
            $data['vehicles'] = Vehicle::where('id',$request->vehicle_id)->with(['vehicle_type','varients',
                            'seo' => function($query) {
                                 $query->select('id', 'vehicle_id', 'title', 'description', 'keywords');
                            }])->get();
            if (!empty($data)) {
                return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
            }
            else{
                return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);

            }
        }
        else{
            return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);

        }
       
   
    }
    public function varients(Request $request)
    {
        $data =[];
        $varient=$request->varient;
        if($request->vehicle_one_id && $request->varient){
            $data['vehicles'] = Vehicle::with('vehicle_type','varients')->where('id',$request->vehicle_one_id)
                                ->whereHas('varients', function ($query) use ($varient) {
                                $query->where('id',$varient);
                            })->get();
            if (!empty($data)) {
                return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
            }
            else{
                return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);

            }
        }
        else{
            return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);

        }
       
   
    }
   
    public function comparison(Request $request)
    {
        $data =[];
        if($request->vehicle_one_id && $request->vehicle_one_varient_id && $request->vehicle_two_varient_id && $request->vehicle_two_id){
            $vehicle_one_varient = $request->vehicle_one_varient_id;
            $vehicle_two_varient = $request->vehicle_two_varient_id;
            $data['vehicle_one'] = Vehicle::with('vehicle_type','varients')->where('id',$request->vehicle_one_id)
                                ->whereHas('varients', function ($query) use ($vehicle_one_varient) {
                                $query->where('id',$vehicle_one_varient);
                            })->get();
            $data['vehicle_two'] =Vehicle::with('vehicle_type','varients')->where('id',$request->vehicle_two_id)
                                ->whereHas('varients', function ($query) use ($vehicle_two_varient) {
                                $query->where('id',$vehicle_two_varient);
                            })->get();
            if (!empty($data)) {
                return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data], $this->successStatus);
            }
            return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
        }
        else{
            return response()->json(['code' => 404, 'message' => 'No Data Available', 'data' => $data], $this->failedStatus);
        }
    }
}
