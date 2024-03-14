<?php

namespace App\Http\Livewire\Back;

use App\Models\Vimi;
use Livewire\Component;

class VisiMisi extends Component
{
    public $visiMisi;

    public $visi, $misi;
    public function mount()
    {
        $this->visiMisi = Vimi::find(1);
        $this->visi = $this->visiMisi->visi;
        $this->misi = $this->visiMisi->misi;
    }
    public function UpdateVisiMisi(){
        $this->validate([
            'visi' => 'required',
            'misi' => 'required',

        ]);

        $update = $this->visiMisi->update([
            'visi' => $this->visi,
            'misi' => $this->misi,

        ]);
        if ($update) {
            $this->showToastr('Visi Misi sekolah has been successfuly updated.', 'success');
        } else {
            $this->showToastr('Something Wrong!', 'error');
        }
    }
    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
    public function render()
    {
        return view('livewire.back.visi-misi');
    }
}
