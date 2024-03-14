<?php

namespace App\Http\Livewire\Back;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{


    public function render()
    {
        $users = DB::table('users')->count();
        $siswa = DB::table('siswas')->count();
        $alumni = DB::table('alumnis')->count();
        $guru = DB::table('gurus')->count();

        $jenisG = DB::table('alumnis')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when jenkel = 'L' then 1 end) as Laki")
            ->selectRaw("count(case when jenkel = 'P' then 1 end) as Perempuan")
            ->first();
        $jenisI = DB::table('siswas')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when jenkel = 'L' then 1 end) as Laki")
            ->selectRaw("count(case when jenkel = 'P' then 1 end) as Perempuan")
            ->first();
            $posts = Post::orderByViews()->limit(5)->get(); // descending

        return view('livewire.back.home',[
            'users'=> $users,
            'siswa'=> $siswa,
            'alumni'=> $alumni,
            'guru'=> $guru,
            'jenisG'=> $jenisG,
            'jenisI'=> $jenisI,
            'posts'=> $posts,
        ]);
    }
}
