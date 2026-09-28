<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\FormExport;
use App\CareerEnquiry;
use App\OfferEnquiry;
use App\Exchange;
use App\QuickEnquiry;
use App\HomeEnquiry;
use App\InsuranceEnquiry;
use App\LocateUsEnquiry;
use App\ExitPopupEnquiry;
use App\SubscriptionEnquiry;
use App\TestDriveEnquiry;
use App\UsedcarEnquiry;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormExportController extends Controller
{
    public function index()
    {
      $to=date('Y-m-d');
      $from =date('Y-m-d', strtotime($to. ' - 30 days'));
      $start= date('m/d/Y', strtotime($to. ' - 30 days'));
      $end= date('m/d/Y');
      $exit_popup = ExitPopupEnquiry::whereBetween('created_at', [$from,$to])->get();
            $career = CareerEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $career->merge($exit_popup);
            $insurance = InsuranceEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($insurance);
            $home = HomeEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($home);
            $locate = LocateUsEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($locate);
            $offer = OfferEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($offer);
            $quick = QuickEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($quick);
            $subscription = SubscriptionEnquiry::whereBetween('created_at',[$from,$to])->get();
            $results= $results->merge($subscription);
            $test_drive = TestDriveEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($test_drive);
            $used_car = UsedcarEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($used_car);
        // $results= $results->get();
        return view('admin.ExportForm.index',compact('results','start','end'));
    }
    public function export_search(Request $request) 
    {
        if($request->from && $request->to){
            $from =date('Y-m-d', strtotime($request->from));
            $to =date('Y-m-d', strtotime($request->to));
        }
        else{
            $from=date('Y-m-d');
            $to=date('Y-m-d');
        }
        if($request->form != "All"){
            $form_name = $request->form;
            $exit_popup = ExitPopupEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $career = CareerEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $career->merge($exit_popup);
            $insurance = InsuranceEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($insurance);
            $home = HomeEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($home);
            $locate = LocateUsEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($locate);
            $offer = OfferEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($offer);
            $quick = QuickEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($quick);
            $subscription = SubscriptionEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($subscription);
            $test_drive = TestDriveEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($test_drive);
            $used_car = UsedcarEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($used_car);
        }
        else{
            $exit_popup = ExitPopupEnquiry::whereBetween('created_at', [$from,$to])->get();
            $career = CareerEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $career->merge($exit_popup);
            $insurance = InsuranceEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($insurance);
            $home = HomeEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($home);
            $locate = LocateUsEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($locate);
            $offer = OfferEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($offer);
            $quick = QuickEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($quick);
            $subscription = SubscriptionEnquiry::whereBetween('created_at',[$from,$to])->get();
            $results= $results->merge($subscription);
            $test_drive = TestDriveEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($test_drive);
            $used_car = UsedcarEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($used_car);
        }
       
        return response()->json(['data' => $results]);
    }
    public function export(Request $request) 
    {
        $current_date=date('Y-m-d');
        if($request->from && $request->to){
            $from =date('Y-m-d', strtotime($request->from));
            $to =date('Y-m-d', strtotime($request->to));
        }
        else{
            $from=date('Y-m-d');
            $to=date('Y-m-d');
        }
        if($request->form != "All"){
            $form_name = $request->form;
            $exit_popup = ExitPopupEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $career = CareerEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $career->merge($exit_popup);
            $insurance = InsuranceEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($insurance);
            $home = HomeEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($home);
            $locate = LocateUsEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($locate);
            $offer = OfferEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($offer);
            $quick = QuickEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($quick);
            $subscription = SubscriptionEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($subscription);
            $test_drive = TestDriveEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($test_drive);
            $used_car = UsedcarEnquiry::where('form_name',$form_name)->whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($used_car);
        }
        else{
            $exit_popup = ExitPopupEnquiry::whereBetween('created_at', [$from,$to])->get();
            $career = CareerEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $career->merge($exit_popup);
            $insurance = InsuranceEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($insurance);
            $home = HomeEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($home);
            $locate = LocateUsEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($locate);
            $offer = OfferEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($offer);
            $quick = QuickEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($quick);
            $subscription = SubscriptionEnquiry::whereBetween('created_at',[$from,$to])->get();
            $results= $results->merge($subscription);
            $test_drive = TestDriveEnquiry::whereBetween('created_at', [$from,$to])->get();
            $results= $results->merge($test_drive);
            $used_car = UsedcarEnquiry::whereBetween('created_at',  [$from,$to])->get();
            $results= $results->merge($used_car);
        }
        $filename="form".$current_date.".xlsx";
        return  Excel::download(new FormExport($results), $filename);

    }
}
