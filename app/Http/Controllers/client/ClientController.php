<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function file($id)
    {
        $file = DB::table('files')->where('id', $id)->where('user_id', Auth::id())->first();
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
            'Content-Disposition' => 'attachment; filename="'.$file->path.'"',
        ]);
    }
}
