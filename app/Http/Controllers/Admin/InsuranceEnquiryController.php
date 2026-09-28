<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InsuranceEnquiry;

class InsuranceEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        if($request->search){
            $enquiries = InsuranceEnquiry::where('name', 'LIKE', '%' . $search . '%')
                                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                                        ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                                         ->latest("updated_at");

        }
        else{
            $enquiries = InsuranceEnquiry::latest("updated_at");

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
        
        $enquiries = $enquiries->get();
        
        return view('admin.insurance-enquries.index', ['search' => $search, 'enquiries' => $enquiries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
