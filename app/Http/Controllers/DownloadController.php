<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{

    public function download($id){
        $uploaded = DB::table('documents')->where('id', $id)->first();
        $pathToFile = $uploaded->path;
        return Response::download(public_path('storage/'.$pathToFile));

        /*if(Storage::disk('public')->exists("documents/$request->file")){

            $path = Storage::disk('public')->path("documents/$request->file");
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($path)
            ]);

            return redirect()->route('documents.index'); //with('message', 'Не удалось скачать файл')

        }*/

    }

}
