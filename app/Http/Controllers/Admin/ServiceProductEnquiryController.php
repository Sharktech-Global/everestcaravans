<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceProductEnquiry;
use Illuminate\Http\Request;

class ServiceProductEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $enquiries = ServiceProductEnquiry::search($search)->latest("updated_at")->paginate(10);
        return view('admin.service-product-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
}
