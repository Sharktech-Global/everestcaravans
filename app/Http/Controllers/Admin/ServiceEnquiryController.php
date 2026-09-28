<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceEnquiry;
use Illuminate\Http\Request;

class ServiceEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $enquiries = ServiceEnquiry::search($search)->latest("updated_at");
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
        
        $enquiries = $enquiries->with('service')->get();
        
      
        return view('admin.service-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
}
