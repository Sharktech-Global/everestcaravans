<?php

namespace App\Http\Controllers\Admin;

use App\Exchange;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        $enquiries = Exchange::search($search)->latest("updated_at")->paginate(10);
        return view('admin.exchanges.index', ['search' => $search, 'enquiries' => $enquiries]);
    }
    public function show(Request $request,$id)
    {
        $enquiries = Exchange::where('id',$id)->first();
        // dd($enquiries);
        return view('admin.exchanges.show', ['enquiries' => $enquiries]);
    }
}
