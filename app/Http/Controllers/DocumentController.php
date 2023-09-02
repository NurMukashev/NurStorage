<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::all();

        return inertia('Documents/Index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Documents/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentRequest $request)
    {
        $file = $request->file('file');
        $path = $file->store('documents');
        //$path = $file->storeAs('documents', $file->getClientOriginalName());
        Document::create([
            'name' => $request->name,
            'file' => $path
        ]);

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        if(Storage::disk('public')->delete($download->path)){

            return redirect()->route('documents.index')->with('message', 'Документ удален');

        }else{

            return redirect()->route('documents.index')->with('message', 'Документ не может быть удален');

        }
    }
}
