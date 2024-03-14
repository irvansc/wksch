<?php

namespace App\Http\Livewire\Front;

use App\Models\Pengumuman as ModelsPengumuman;
use Livewire\Component;
use Livewire\WithPagination;

class Pengumuman extends Component
{
    use WithPagination;

    public $perPage = 5;
    public function render()
    {
        return view('livewire.front.pengumuman',[
            'pengumuman' => ModelsPengumuman::orderBy('created_at','desc')->paginate($this->perPage)
        ]);
    }
}
