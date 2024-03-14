<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class FotoController extends Controller
{
    public function index() {

        $albums = Album::all();
        return view('back.pages.add-foto',[
            'albums' => $albums
        ]);
    }

    public function StoreFoto(Request $request)
    {

        // dd($request->all());
            if($request->hasFile("img")){

                foreach($request->file('img') as $key => $file)
                {
                    // $path = $file->storeAs('images/album/foto');
                    // $name = $file->getClientOriginalName();
                    $path = "images/album/foto/";
                    $filename = $file->getClientOriginalName();
                    $new_filename = time() . '' . $filename;
                    $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

                    $insert[$key]['img'] = $new_filename;
                    $insert[$key]['title'] = $filename;
                    $insert[$key]['album_id'] = $request->album_id;
                }
                Foto::insert($insert);
            }
            return redirect()->back();
    }



}
