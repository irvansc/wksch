<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function download(Request $request)
    {
        $path = "folders/";
        $post_thumbnails_path = $path . $request->file_name;
        if (!Storage::disk('public')->exists($post_thumbnails_path)) {
        return response('Not found');
        }else{
            return response()->download(storage_path("app/public/folders/") . $request->filename);
        }
    }
}
