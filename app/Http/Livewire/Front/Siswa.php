<?php

namespace App\Http\Livewire\Front;

use App\Models\Siswa as ModelsSiswa;
use Livewire\Component;
use Livewire\WithPagination;

class Siswa extends Component
{
    use WithPagination;
    public $perPage = 8;
    public $search = null;
    public $kelas = null;
    public function render()
    {
        $siswas = ModelsSiswa::search($this->search)
        ->when($this->kelas, function ($query) {
            $query->where('kelas_id', $this->kelas);
        })
        ->orderBy('created_at','desc')->
        paginate($this->perPage);

        return view('livewire.front.siswa',[
            'siswas' => $siswas
        ]);
    }
}
