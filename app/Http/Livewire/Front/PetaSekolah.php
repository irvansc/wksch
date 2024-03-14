<?php

namespace App\Http\Livewire\Front;

use App\Models\PetaSekolah as ModelsPetaSekolah;
use Livewire\Component;

class PetaSekolah extends Component
{
    public function render()
    {
        return view('livewire.front.peta-sekolah',[
            'peta' => ModelsPetaSekolah::find(1)->first()
        ]);
    }
}
