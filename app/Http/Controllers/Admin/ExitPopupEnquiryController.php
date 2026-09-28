<?php

namespace App\Http\Controllers\Admin;

use App\ExitPopupEnquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExitPopupEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $enquiries = ExitPopupEnquiry::search($search)->latest("updated_at")->paginate(10);
        return view('admin.exit-popup-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
}
