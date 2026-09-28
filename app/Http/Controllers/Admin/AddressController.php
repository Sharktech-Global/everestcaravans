<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    public function index()
    {
        $address = Address::get();
       return view('admin.address.index',['address' => $address]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required',            
            'status' => 'required'
        ]);
        $address = new Address;
        $address->address = $validated['address'];
        $address->status = $validated['status'];
        $res = $address->save();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully created new Address.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new Address. Please try again.');
        }
    }

    public function destroy($id, Request $request)
    {
        $address = Address::find($id);
        $res = $address->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the address.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the address. Please try again.');
        }
    }

    public function edit($id)
    {
        $address_settings = Address::find($id);
       return view('admin.address.edit',['address_settings' => $address_settings]);
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'address' => 'required',            
            'status' => 'required'
        ]);
        $address = Address::find($id);
        $address->address = $validated['address'];
        $address->status = $validated['status'];
        $res = $address->save();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully updated Address.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Address. Please try again.');
        }
    }
}
