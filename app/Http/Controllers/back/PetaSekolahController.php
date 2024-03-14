<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\PetaSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
class PetaSekolahController extends Controller
{
    public function index(){
        return view("back.pages.peta-sekolah",[
            "peta"=> PetaSekolah::find(1)
        ]);
    }

    public function editPeta(Request $request)
    {
        if (!request()->peta_id) {
            return abort(404);
        } else {
            $peta = PetaSekolah::find(request()->peta_id);
            $data = [
                'peta' => $peta,
                'pageTitle' => 'Edit Peta',
            ];
            return view('back.pages.edit-peta', $data);
        }
    }

    public function updatePeta(Request $request)
    {
        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:1024'
            ]);

            $path = "images/peta_images/";
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            $peta_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($peta_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($peta_thumbnails_path, 0755, true, true);
            }
            // create square thumbnails
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(200, 200)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));
            // create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(500, 350)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {

                $old_peta_image = PetaSekolah::find($request->peta_id)->image;
                if ($old_peta_image != null && Storage::disk('public')->exists($path . $old_peta_image)) {
                    Storage::disk('public')->delete($path . $old_peta_image);
                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_peta_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_peta_image);
                    }
                    if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $old_peta_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $old_peta_image);
                    }
                }

                $peta = PetaSekolah::find($request->peta_id);
                $peta->desc = $request->desc;
                $peta->title = $request->title;
                $peta->image = $new_filename;
                $saved = $peta->save();

                if ($saved) {
                    return response()->json(['code' => 1, 'msg' => 'Peta Sekolah has been successfuly updated.']);
                } else {
                    return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
                }
            } else {
                return response()->json(['code' => 3, 'msg' => 'Error in uploading image.']);
            }
        } else {


            $post = PetaSekolah::find($request->peta_id);
            $post->desc = $request->desc;
            $post->title = $request->title;
            $saved = $post->save();
            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'Peta Sekolah has been successfuly updated.']);

            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
            }
        }
    }
}
