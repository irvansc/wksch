<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Str;
class PengumumanController extends Controller
{
    public function readPengumuman($slug)
    {

        if (!$slug) {
            abort(404);
        } else {
            $pengumuman = Pengumuman::where('slug', $slug)
                ->first();
            $data = [
                'pageTitle' => Str::ucfirst($pengumuman->title),
                'pengumuman' => $pengumuman,
            ];
            views($pengumuman)->record();
            return view('front.pages.single_pengumuman', $data);

        }
    }
}
