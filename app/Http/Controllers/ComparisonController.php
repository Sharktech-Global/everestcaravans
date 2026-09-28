<?php

namespace App\Http\Controllers;

use App\CategoryType;
use App\Vehicle;
use App\VehicleCategory;
use App\VehicleVarient;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    use SEOToolsTrait;

    public function index(Request $request)
    {
        // dd($request->session()->get('vehicle1'));
        $this->seo()->setTitle("Vehicle Comparison");
        $this->seo()->setDescription("Compare vehicles based on their features and specifications.");
        SEOMeta::setKeywords([' Compare,  Comparison,  vehicles, compare vehicles, cars']);
        $this->seo()->opengraph()->setTitle("Vehicle Comparison");
        $this->seo()->opengraph()->setDescription("  Compare vehicles based on their features and specifications.");
        $this->seo()->twitter()->setTitle("Vehicle Comparison");
        $this->seo()->twitter()->setDescription("  Compare vehicles based on their features and specifications.");


         if($request->session()->has('vehicle')){
        //     echo $request->session()->get('data');
            $vehicle_id = $request->session()->get('vehicle');
            $variant_id = $request->session()->get('variant');
            $variant_name = VehicleVarient::where('id',$variant_id)->first();
            $data = Vehicle::where('id',$vehicle_id)->where('status',1)->first();
            // dd($variant_name);

        }
        if($request->session()->has('vehicle1')){
            $vehicle_id1 = $request->session()->get('vehicle1');
            $variant_id1 = $request->session()->get('variant1');
            $variant_name1 = VehicleVarient::where('id',$variant_id1)->first();
            $data1 = Vehicle::where('id',$vehicle_id1)->where('status',1)->first();
            // dd($data1);
        }
        $vehicle = Vehicle::where('status',1)->get();
        if ($request->ajax()) {
            $selected = $request->post('selected');
            if ($selected) {
                // dd($selected);
                $data['variants'] = VehicleVarient::where('vehicle_id',$selected)->get(["name","id"]);
                $data['image'] = Vehicle::where('id' ,$selected)->first(['image','name']);
                return response()->json($data);
            }else{
                    return response()->json(['status' => false]);
            }

        }
        // dd($variant_id1);
        return view('comparison.index',['vehicle' => $vehicle,'data' => @$data ,'data1' => @$data1 ,'value_variant' => @$variant_id, 'value_variant1' => @$variant_id1,'variant_name' => @$variant_name,'variant_name1' => @$variant_name1]);
    }
    public function store(Request $request)
    {
        if ($request->ajax()) {
            // dd($request);
            $number =$request->post('number');
            $vehicle = $request->post('vehicle_id');
            $variant = $request->post('variant_id');
            if($number == 1){
                if($vehicle){
                    $val = $request->session()->put('vehicle', $vehicle);
                    $request->session()->put('variant', $variant);
                    return response()->json($val);
                }else{
                    return response()->json(['status' => false]);
                }
            }elseif($number == 2){
                if($vehicle){
                    $val = $request->session()->put('vehicle1', $vehicle);
                    $request->session()->put('variant1', $variant);
                    return response()->json($val);
                }else{
                    return response()->json(['status' => false]);
                }
            }

        }
    }

    public function foreget(Request $request)
    {
        if ($request->ajax()) {
            // dd($request);
            $number =$request->post('number');
            // $vehicle = $request->post('vehicle_id');
            if($number == 1){
                if($number){
                    $val = $request->session()->forget('vehicle');
                    return response()->json($val);
                }else{
                    return response()->json(['status' => false]);
                }
            }elseif($number == 2){
                if($number){
                    $val = $request->session()->forget('vehicle1');
                    return response()->json($val);
                }else{
                    return response()->json(['status' => false]);
                }
            }
            elseif($number == 3){
                if($number){
                    $val = $request->session()->forget('vehicle');
                    $val = $request->session()->forget('vehicle1');
                    return response()->json($val);
                }else{
                    return response()->json(['status' => false]);
                }
            }

        }
    }

    public function compare(Request $request,$vehicle_id,$variant_id,$vehicle_id1,$variant_id1)
    {

        $this->seo()->setTitle("Comparison");
        $this->seo()->setDescription("Compare vehicles based on their features and specifications.");
        SEOMeta::setKeywords([' Compare,  Comparison,  vehicles, compare vehicles, cars']);
        $this->seo()->opengraph()->setTitle("Comparison");
        $this->seo()->opengraph()->setDescription("  Compare vehicles based on their features and specifications.");
        $this->seo()->twitter()->setTitle("Comparison");
        $this->seo()->twitter()->setDescription("  Compare vehicles based on their features and specifications.");


        $vehicle = Vehicle::where('id',$vehicle_id)->where('status',1)->first();
        $variant = $vehicle->varients()->where('id',$variant_id)->first();
        $vehicle1 = Vehicle::where('id',$vehicle_id1)->where('status',1)->first();
        $variant1 = $vehicle1->varients()->where('id',$variant_id1)->first();
        $vehicle_details = VehicleCategory::where('vehicle_id',$vehicle_id)->where('vehicle_variant_id',$variant_id)->get();
        // $vehicle_details = $vehicle->categories()->get();
        // $vehicle_details1 = $vehicle1->categories()->get();
        // dd($vehicle_details);
        $vehicle_details1 = VehicleCategory::where('vehicle_id',$vehicle_id1)->where('vehicle_variant_id',$variant_id1)->get();
        $category_type = CategoryType::where('status', 1)->get();
        return view('comparison.compare',['vehicle' => $vehicle,'vehicle1' => $vehicle1,'vehicle_details' => $vehicle_details ,'vehicle_details1' => $vehicle_details1,'variant' => $variant,'variant1' => $variant1 ,'category_type' => $category_type]);
    }
}
