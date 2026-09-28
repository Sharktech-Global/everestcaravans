<?php

namespace App\Http\Controllers\Admin;

use App\OfferEnquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        if($request->search){
            $enquiries = OfferEnquiry::where('name', 'LIKE', '%' . $search . '%')
                                         ->latest("updated_at")->paginate(10);

        }
        else{
            $enquiries = OfferEnquiry::latest("updated_at")->paginate(10);

        }
        return view('admin.offer-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
}
