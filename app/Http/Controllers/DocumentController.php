<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function upload()
    {
        return view('documents.upload');
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:docx,pdf|max:2048'
        ]);
        $model = new Document();
        $document = $request->file('file');
        $documentName = $document->getClientOriginalName();
        $document->move(public_path('documents'), $documentName);
        $model->document = $documentName;
        $model->save();
        return back()->with('success', '');
    }
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }
    public function preview($document)
    {
        // $document = Document::find($id);
        $path = public_path('/documents' . '/' . $document);
        // return response()->file('/public/documents' . $document);
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $document . '"'
        ];
        return response()->file($path, $header);
    }
}
