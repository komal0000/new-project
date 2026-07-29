<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    // public function index(Request $request){
    //     $filename=urldecode($request->filename);
    //     if (!Storage::exists($filename)) {
    //         abort(404);
    //     }
    //     $mimeType = Storage::mimeType($filename);
    //     return response()->file(storage_path('app/'.$filename), ['Content-Type' => $mimeType]);
    // }

    public function index($id)
    {
        $file = DB::table('files')->where('id', $id)->first();
        if ($file == null) {
            abort(404);
        }
        $relativePath = 'submissions'.DIRECTORY_SEPARATOR.$file->path; // Path relative to the storage disk
        $fullPath = storage_path($relativePath);

        if (! file_exists($fullPath)) {
            abort(404);
        }

        $mimeType = mime_content_type($fullPath);

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
        ]);
    }
}
