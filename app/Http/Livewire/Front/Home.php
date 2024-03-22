<?php

namespace App\Http\Livewire\Front;

use App\Models\EkstraList;
use App\Models\Foto;
use App\Models\Guru;
use App\Models\KepalaSekolah;
use App\Models\Post;
use App\Models\SliderAlumni;
use App\Models\SliderPrestasi;
use App\Models\SliderUtama;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{

    public function render()
    {

        $su =  SliderUtama::all();
        $sp =  SliderPrestasi::all();
        $ekstra =  EkstraList::all();
        $gurus =  Guru::all();
        $alumnis =  SliderAlumni::all();
        $fotos =  Foto::all();
        $videos = DB::table('videos')->limit(1)->orderBy('created_at', 'desc')->get();
        $posts = Post::with('author')
            ->with('subcategory')
            ->limit(4)
            ->inRandomOrder()
            ->get();
        $kepala = KepalaSekolah::find(1)->first();
        $guru = DB::table('gurus')->count();

        $siswa = DB::table('siswas')
            ->where('jenkel', 'L')
            ->count();;
        $siswi = DB::table('siswas')
            ->where('jenkel', 'P')
            ->count();

        $alumni = DB::table('alumnis')->count();

        return view('livewire.front.home', [
            'su' => $su,
            'sp' => $sp,
            'kepala' => $kepala,
            'guru' => $guru,
            'siswa' => $siswa,
            'siswi' => $siswi,
            'alumni' => $alumni,
            'ekstra' => $ekstra,
            'gurus' => $gurus,
            'alumnis' => $alumnis,
            'fotos' => $fotos,
            'videos' => $videos,
            'posts' => $posts,
        ]);
    }
}
