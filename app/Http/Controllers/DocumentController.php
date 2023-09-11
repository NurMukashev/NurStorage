<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $path = $file->store('documents');

        if(substr($file->getMimeType(), 0, 5) == 'image'){

            $crop_image = Image::make($file)->resize(100, 100);
            $crop_path = 'cropped/'.time().'-'.$file_name;

            $crop_image->save('storage/'.$crop_path, 70, 'jpg');

        }

        Document::create([
            'name' => $request->name,
            'file_name' => $file_name,
            'extension' => $extension,
            'size' => $size,
            'path' => $path,
            'crop_path' => $crop_path,
        ]);

        return redirect()->route('documents.index')->with('message', "Документ добавлен");
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
        $document_edit = $document; //Неудачно назвал модель, не могу применять props с названием document, имя зарезервировано
        return inertia('Documents/Edit', compact('document_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //dd($request->name);

        $document = Document::find($document->id);
        $document->name = $request->name;

        if($request->file('file')){

            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $path = $file->store('documents');

            //Удаляю предыдущие файлы
            $previous_file_path = $document->path;
            Storage::disk('public')->delete($previous_file_path);

            $previous_crop_path = $document->crop_path;
            if($previous_crop_path){
                Storage::delete($previous_crop_path);
            }

            $document->path = $path;
            $document->file_name = $file_name;
            $document->extension = $extension;
            $document->size = $size;

            if(substr($file->getMimeType(), 0, 5) == 'image'){

                $crop_image = Image::make($file)->resize(100, 100);
                $crop_path = 'cropped/'.time().'-'.$file_name;

                $crop_image->save($crop_path, 70, 'jpg');

                $document->crop_path = $crop_path;

            }

        }

        $document->save();

        return redirect()->route('documents.index')->with('message', 'Документ обновлен');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $file_delete = Storage::disk('public')->delete($document->path);
        $crop_path_for_delete = $document->crop_path;
        if($crop_path_for_delete) {
            Storage::delete($crop_path_for_delete);
        }

        $document_delete = $document->delete();

        if($file_delete && $document_delete){

            return redirect()->route('documents.index')->with('message', 'Документ с файлом удален');

        }elseif($document_delete){

            return redirect()->route('documents.index')->with('message', 'Документ удален, а файл не может быть удален');

        }
    }
}
