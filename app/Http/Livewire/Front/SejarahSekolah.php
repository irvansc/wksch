<?php

namespace App\Http\Livewire\Front;

use App\Models\Sejarah;
use Livewire\Component;

class SejarahSekolah extends Component
{
    // public $sejarah, $isLoading=true;

    // public function getSejarah(){
    //     $this->sejarah = Sejarah::find(1)->first();
    //     $this->isLoading= false;
    // }

    public function render()
    {

        return view('livewire.front.sejarah-sekolah',[
            'sejarah' => Sejarah::find(1)->first()
        ]);
    }
}
