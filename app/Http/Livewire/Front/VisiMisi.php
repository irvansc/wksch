<?php

namespace App\Http\Livewire\Front;

use App\Models\Vimi;
use Livewire\Component;

class VisiMisi extends Component
{
    public function render()
    {
        return view('livewire.front.visi-misi',[
            'visi' => Vimi::find(1)->first()
        ]);
    }
}
