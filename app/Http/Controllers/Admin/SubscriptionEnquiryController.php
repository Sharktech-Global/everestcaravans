<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubscriptionEnquiry;

class SubscriptionEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $enquiries = SubscriptionEnquiry::search($search)->latest("updated_at")->paginate(10);
        return view('admin.subscription-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
}
