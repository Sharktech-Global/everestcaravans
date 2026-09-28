<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TalkToCEO;

class TalkToCEOAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = ($request->search) ? $request->search : null;
        if($request->search){
            $talktoceo = TalkToCEO::where('name', 'LIKE', '%' . $search . '%')
                                    ->orWhere('subject', 'LIKE', '%' . $search . '%')
                                    ->orWhere('message', 'LIKE', '%' . $search . '%')
                                    ->latest("updated_at")->get();
        }
        else{
            $talktoceo = TalkToCEO::latest("updated_at")->get();
        }
        return view('admin.talktoceo.index', ['search' => $search, 'talktoceo' => $talktoceo]);
    }
}
