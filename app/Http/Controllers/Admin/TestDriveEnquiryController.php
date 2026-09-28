<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\TestDriveDataTable;
use App\Http\Controllers\Controller;
use App\TestDriveEnquiry;
use Illuminate\Http\Request;

class TestDriveEnquiryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $search = ($request->search) ? $request->search : null;
    //     if($request->search){
    //         $enquiries = TestDriveEnquiry::where('name', 'LIKE', '%' . $search . '%')
    //                                      ->latest("updated_at")->paginate(10);

    //     }
    //     else{
    //         $enquiries = TestDriveEnquiry::latest("updated_at")->paginate(10);

    //     }
    //     return view('admin.test-drive-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    // }
    public function index(TestDriveDataTable $dataTable)
    {
        
        return $dataTable->render('admin.test-drive-enquries.test');
    }
    public function show($id)
    { 
       
        $data= TestDriveEnquiry::where('id',$id)->first();     
        return view('admin.test-drive-enquries.view', compact('data'));
    }
   
}
