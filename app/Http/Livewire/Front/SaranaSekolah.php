<?php

namespace App\Http\Livewire\Front;

use App\Models\SaranaSekolah as ModelsSaranaSekolah;
use Livewire\Component;

class SaranaSekolah extends Component
{
    public function render()
    {
        return view('livewire.front.sarana-sekolah',[
            'sarana' => ModelsSaranaSekolah::find(1)->first()
        ]);
    }
}
