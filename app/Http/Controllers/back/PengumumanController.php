<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function editPengumuman(Request $request)
    {
        if (!request()->pengumuman_id) {
            return abort(404);
        } else {
            $pengumuman = Pengumuman::find(request()->pengumuman_id);
            $data = [
                'pengumuman' => $pengumuman,
                'pageTitle' => 'Edit Pengumuman',
            ];
            return view('back.pages.edit-pengumuman', $data);
        }
    }
    public function updatePengumuman(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:pengumumen,title,' . $request->pengumuman_id,
            'description' => 'required',
        ], [
            'title.required' => 'Title wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'title.unique' => 'Title sudah ada.'
        ]);

        $pengumuman = Pengumuman::find($request->pengumuman_id);
        $pengumuman->title = $request->title;
        $pengumuman->description = $request->description;

        $saved = $pengumuman->save();
        if ($saved) {
            return response()->json(['code' => 1, 'msg' => 'Pengumuman has been successfuly updated.']);
        } else {
            return response()->json(['code' => 3, 'msg' => 'Something went wrong, for updating post.']);
        }
    }
}
