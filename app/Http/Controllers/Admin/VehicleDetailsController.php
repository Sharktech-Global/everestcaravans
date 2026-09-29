<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryType;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleCategory;
use Illuminate\Support\Facades\Validator;
use App\VehicleVarient;
use Illuminate\Support\Facades\Session;

class VehicleDetailsController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $category_type = CategoryType::where('status', 1)->get();
        $vehicle_detail = VehicleCategory::where('vehicle_id', $vehicle->id)->get();
        // $category = Category::where('status',1)->get();
        // dd($category_type);
        // dd($details);
        return view('admin.vehicles.details.index', ['vehicle' => $vehicle, 'category_type' => $category_type, 'vehicle_detail' => $vehicle_detail]);
    }
    public function store(Request $request, $vehicle)
    {
        // $user = auth()->guard('admin')->user();
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'details' => 'nullable',
                'details.*.*.*.*.is_boolean' => 'sometimes|integer',
                'details.*.*.*.*.text' => 'sometimes|required_if:details.*.*.*.*.is_boolean,0',
                'details.*.*.*.*.status' => 'nullable',
                'details.*.*.*.check_similar' => 'nullable'

            ]);
            if ($validator->fails()) {
                $data = (object) [];
                return response()->json([ 'message' => $validator->errors()->first(), 'data' => $data]);
            } else {
                if (isset($request->details)) {
                    foreach ($request->details as $key => $value) {
                        if (is_array($value)) {
                            foreach ($value as $key1 => $value1) {
                                if (is_array($value1)) {
                                    foreach ($value1 as $key2 => $value2) {
                                        if (is_array($value2)) {
                                            // dd($value2);

                                            foreach ($value2 as $key3 => $value3) {
                                                $category_types = $key;
                                                $categories = $key1;
                                                $sub_categories = $key2;
                                                // if($key3 == 'check_similar'){
                                                //     dd($key2);
                                                // } else{ 
                                                //     dd($key3
                                                // );
                                                $variants = $key3;

                                                // if (isset($value3['text']) || isset($value3['is_boolean'])) {
                                                    $detail = VehicleCategory::getByDetails($vehicle, $variants, $category_types, $categories, $sub_categories);
                                                    $detail->vehicle_id = $vehicle;
                                                    $detail->vehicle_variant_id = $key3;
                                                    $detail->category_type_id = $key;
                                                    $detail->category_id = $key1;
                                                    $detail->sub_category_id = $key2;
                                                    $detail->check_similar = (isset($value2['check_similar'])) ? $value2['check_similar'] : null;
                                                    $detail->is_boolean = (isset($value3['is_boolean'])) ? $value3['is_boolean'] : null;
                                                    $detail->details = (!isset($value3['is_boolean'])) ? isset($value3['text']) : null;
                                                    $detail->status = (isset($value3['status'])) ? $value3['status'] : null;
                                                    $res = $detail->save();
                                                    if ($res) {
                                                        activity('admin')->performedOn($detail)->withProperties(['data' => $request])->log('Added Details to Vehicle.');
                                                    }
                                                // }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if ($res) {
                    return response()->json(['success'=>'Successfully added details to vehicle !']);
                } else {
                    return response()->json(['error'=>'Failed to add details to vehicle !']);
                }
            }
        }
    }
}
