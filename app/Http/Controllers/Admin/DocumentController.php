<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;

class DocumentController extends Controller
{
    public function index()
    {
        return view('admin.documents.index', ['documents' => Document::latest("updated_at")->paginate(10)]);
    }
    public function store(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $validated = $request->validate([
            'name' => 'required|unique:documents,name',
            'document' => 'required|mimes:pdf|max:30000',
        ]);
        $doc = new Document();
        $doc->name = $validated['name'];
        if ($request->hasFile('document')) {
            $path = $request->file('document')->storeAs(
                'upload/documents',
                $request->name.'.pdf',
                'public'
            );
            $doc->document = $path;
        }
        $res = $doc->save();
        if ($res) {
            activity('admin')->performedOn($doc)->causedBy($user)->withProperties(['data' => $request])->log('Created New Document Type.');
            return redirect()->back()->with('success', 'Successfully created new document type.');
        } else {
            return redirect()->back()->with('error', 'Failed to create new document type. Please try again.');
        }
    }
    public function destroy($id, Request $request)
    {
        $user = auth()->guard('admin')->user();
        $document = Document::find($id);
        $res = $document->delete();
        if ($res) {
            activity('admin')->performedOn($document)->causedBy($user)->withProperties(['data' => $request])->log('Deleted Document');
            return redirect()->back()->with('success', 'Successfully deleted the document.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the document. Please try again.');
        }
    }
}
