<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::get();
       return view('admin.contact.index',['contact' => $contact]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'name' => 'required',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'status' => 'required',
        ]);
        $contact = new Contact;
        $contact->name = $validated['name'];
        $contact->phone = $validated['phone'];
        $contact->email =  $validated['email'];
        $contact->status = $validated['status'];
        $res = $contact->save();
        if($res){
            return redirect()->back()->with('success', 'Contact Added successfully');
        } else {
            return redirect()->back()->with('error', 'Your details update was not successful. Please try again.');
        }
    }

    public function destroy($id, Request $request)
    {
        $Contact = Contact::find($id);
        $res = $Contact->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully deleted the Contact.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the Contact. Please try again.');
        }
    }
    public function edit($id)
    {
        $contacts = Contact::where('id',$id)->firstOrFail();
        //  dd($contact);
       return view('admin.contact.edit',['contacts' => $contacts]);
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'phone' => 'required|regex:/\+(?:[0-9] ?){6,14}[0-9]$/',
            'name' => 'required',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'status' => 'required',
        ]);
        $contact = Contact::find($id);

        $contact->name = $validated['name'];
        $contact->phone = $validated['phone'];
        $contact->email =  $validated['email'];
        $contact->status = $validated['status'];
        $res = $contact->save();
        if ($res) {
            return redirect()->back()->with('success', 'Successfully updated Contact.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Contact. Please try again.');
        }
    }

}
