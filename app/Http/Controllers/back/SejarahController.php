<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
class SejarahController extends Controller
{
    public function index()  {
        return view("back.pages.sejarah",[
            "sejarah"=> Sejarah::find(1)
        ]);
    }

    public function editSejarah(Request $request)
    {
        if (!request()->sejarah_id) {
            return abort(404);
        } else {
            $sejarah = Sejarah::find(request()->sejarah_id);
            $data = [
                'sejarah' => $sejarah,
                'pageTitle' => 'Edit Sejarah',
            ];
            return view('back.pages.edit-sejarah', $data);
        }
    }
    public function updateSejarah(Request $request)
    {
        if ($request->hasFile('image')) {

            $request->validate([
                'description' => 'required|unique:sejarahs,description,' . $request->sejarah_id,
                'img' => 'mimes:jpeg,png,jpg|max:1024'
            ]);

            $path = "images/sejarah_images/";
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $sejarah_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($sejarah_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($sejarah_thumbnails_path, 0755, true, true);
            }
            // create square thumbnails
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));
            // create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {

                $old_sejarah_image = Sejarah::find($request->sejarah_id)->image;
                if ($old_sejarah_image != null && Storage::disk('public')->exists($path . $old_sejarah_image)) {
                    Storage::disk('public')->delete($path . $old_sejarah_image);
                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_sejarah_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_sejarah_image);
                    }
                    if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $old_sejarah_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $old_sejarah_image);
                    }
                }

                $sejarah = Sejarah::find($request->sejarah_id);
                $sejarah->description = $request->description;
                $sejarah->img = $new_filename;
                $saved = $sejarah->save();

                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'Sejarah has been successfuly updated.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
                }
            } else {
                return response()->json(['code' => 3, 'msg' => 'Error in uploading image.']);
            }
        } else {
            $request->validate([
                'description' => 'required|unique:sejarah,description,' . $request->sejarah_id,
            ]);

            $post = Sejarah::find($request->sejarah_id);
            $post->description = $request->description;
            $saved = $post->save();
            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'Sejarah has been successfuly updated.']);

            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
            }
        }
    }
}
