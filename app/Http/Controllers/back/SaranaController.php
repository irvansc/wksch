<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\SaranaSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
class SaranaController extends Controller
{
    public function index()  {
        return view("back.pages.sarana",[
            "sarana"=> SaranaSekolah::find(1)
        ]);
    }
    public function editSarana(Request $request)
    {
        if (!request()->sarana_id) {
            return abort(404);
        } else {
            $sarana = SaranaSekolah::find(request()->sarana_id);
            $data = [
                'sarana' => $sarana,
                'pageTitle' => 'Edit Sarpras',
            ];
            return view('back.pages.edit-sarana', $data);
        }
    }
    public function updateSarana(Request $request)
    {
            $request->validate([
                'description' => 'required'
            ]);

            $post = SaranaSekolah::find($request->sarana_id);
            $post->title = $request->title;
            $post->description = $request->description;
            $saved = $post->save();
            if ($saved) {
                return response()->json(['code' => 1, 'msg' => 'Sarpras has been successfuly updated.']);

            } else {
                return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
            }
    }
}
