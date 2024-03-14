<?php

namespace App\Http\Livewire\Front;

use App\Models\PrestasiList;
use App\Models\PrestasiSekolah as ModelsPrestasiSekolah;
use Livewire\Component;

class PrestasiSekolah extends Component
{

    public function render()
    {
        return view('livewire.front.prestasi-sekolah',[
            'pres' => ModelsPrestasiSekolah::find(1)->first(),
            'prestasis' => PrestasiList::all()
        ]);
    }
}
