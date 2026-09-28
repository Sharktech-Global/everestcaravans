<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $enquiries = Booking::with(['payments', 'cod'])->search($search)->latest("updated_at")->paginate(10);
        return view('admin.bookings.index', ['search' => $search, 'enquiries' => $enquiries]);
    }

    public function show($id)  {
        $enquiry = Booking::where('id',$id)->with(['payments', 'cod'])->first();
        // dd($enquiry);
        return view('admin.bookings.show', [ 'enquiry' => $enquiry]);
    }
}
