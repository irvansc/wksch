<?php

namespace App\Http\Livewire\Front;

use App\Models\Ekstra;
use Livewire\Component;

class Eskul extends Component
{
    public function render()
    {
        return view('livewire.front.eskul',[
            'eskul' => Ekstra::find(1)->first()
        ]);
    }
}
