<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WarriorEnquiry;
use Illuminate\Http\Request;

class WarriorEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date_from' => 'nullable|date_format:Y-m-d',
            'date_to' => 'nullable|date_format:Y-m-d|after_or_equal:date_from',
        ]);

        $query = WarriorEnquiry::query();

        if ($request->filled('date_from')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->date_from
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->date_to
            );
        }

        $enquiries = $query
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.warrior-enquiries.index', [
            'enquiries' => $enquiries,
        ]);
    }

    public function show($id)
    {
        $enquiry = WarriorEnquiry::findOrFail($id);

        return view('admin.warrior-enquiries.show', [
            'enquiry' => $enquiry,
        ]);
    }
}