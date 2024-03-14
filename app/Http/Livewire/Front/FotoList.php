<?php

namespace App\Http\Livewire\Front;

use App\Models\Foto;
use Livewire\Component;
use Livewire\WithPagination;

class FotoList extends Component
{
    use WithPagination;
    public $perPage = 8;
    public $search = null;
    public $album = null;
    public function render()
    {
        $fotos = Foto::when($this->album, function ($query) {
            $query->where('album_id', $this->album);
        })
        ->orderBy('created_at','desc')->
        paginate($this->perPage);

        return view('livewire.front.foto-list',[
            'fotos' => $fotos
        ]);
    }
}
