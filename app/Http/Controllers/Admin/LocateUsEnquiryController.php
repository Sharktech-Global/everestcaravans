<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LocateUsEnquiry;

class LocateUsEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        if($request->search){
            $enquiries = LocateUsEnquiry::where('name', 'LIKE', '%' . $search . '%')
                                            ->orWhere('service', 'LIKE', '%' . $search . '%')
                                            ->latest("updated_at");
        }
        else{
            $enquiries = LocateUsEnquiry::latest("updated_at");
        }
        if ($request->date_from) {
            $enquiries = $enquiries->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->date_from)));
            if ($request->start_time) {
                $enquiries = $enquiries->whereTime('created_at', '>=', date("H:i", strtotime($request->start_time)));
            }
        }
        if ($request->date_to) {
            $enquiries = $enquiries->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->date_to)));
            if ($request->end_time) {
                $enquiries = $enquiries->whereTime('created_at', '<=',  date("H:i", strtotime($request->end_time)));
            }
        }
        
        $enquiries = $enquiries->paginate(10);
        
        return view('admin.locate-us-enquiries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
}
