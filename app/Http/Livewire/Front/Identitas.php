<?php

namespace App\Http\Livewire\Front;

use App\Models\Idse;
use App\Models\KepalaSekolah;
use App\Models\Setting;
use Livewire\Component;

class Identitas extends Component
{
    public function render()
    {
        $idse = Idse::find(1);
        $kepala = KepalaSekolah::find(1);
        return view('livewire.front.identitas',[
            'idse'=> $idse,
            'kepala'=> $kepala,
        ]);
    }
}
