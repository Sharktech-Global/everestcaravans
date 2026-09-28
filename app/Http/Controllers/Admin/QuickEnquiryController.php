<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\QuickEnquiry;
use Illuminate\Http\Request;

class QuickEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $enquiries = QuickEnquiry::search($search)->latest("updated_at")->paginate(10);
        return view('admin.quick-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
}
