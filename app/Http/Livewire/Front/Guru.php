<?php

namespace App\Http\Livewire\Front;

use App\Models\Guru as ModelsGuru;
use Livewire\Component;
use Livewire\WithPagination;

class Guru extends Component
{
    use WithPagination;

    public $perPage = 8;
    public $search = null;
    public function render()
    {
        $gurus  = ModelsGuru::search($this->search)->orderBy('created_at','desc')->
        paginate($this->perPage);
        return view('livewire.front.guru',[
            'gurus' => $gurus
        ]);
    }
}
