<?php

namespace App\Http\Livewire\Front;

use App\Models\Alumni as ModelsAlumni;
use Livewire\Component;
use Livewire\WithPagination;

class Alumni extends Component
{

    use WithPagination;

    public $perPage = 8;
    public $search = null;
    public function render()
    {
        $alumnis  = ModelsAlumni::where('isActive','=', 1)->search($this->search)->orderBy('created_at','desc')->
        paginate($this->perPage);
        return view(
            'livewire.front.alumni',
            ['alumnis' => $alumnis]
        );
    }
}
