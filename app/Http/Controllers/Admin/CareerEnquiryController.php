<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\CareerDataTable;
use App\CareerAbrecco;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerEnquiryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $search = ($request->search) ? $request->search : null;
    //     $enquiries = CareerAbrecco::with('career')->search($search)->latest("updated_at")->paginate(10);
    //     return view('admin.career-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    // }
    public function index(CareerDataTable $dataTable)
    {
        
        return $dataTable->render('admin.career-enquries.career');
    }
    public function show($id)
    { 
        $data= CareerAbrecco::where('id',$id)->first();     
        return view('admin.career-enquries.view', compact('data'));
    }
}
