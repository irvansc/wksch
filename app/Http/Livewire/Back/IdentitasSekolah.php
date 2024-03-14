<?php

namespace App\Http\Livewire\Back;

use App\Models\Idse;
use Livewire\Component;

class IdentitasSekolah extends Component
{


    public $identitas_sekolah;
    public $nama_sekolah, $nss, $akreditasi, $status, $nokep, $luas_area, $alamat;
    public function mount()
    {
        $this->identitas_sekolah = Idse::find(1);
        $this->nama_sekolah = $this->identitas_sekolah->nama_sekolah;
        $this->nss = $this->identitas_sekolah->nss;
        $this->akreditasi = $this->identitas_sekolah->akreditasi;
        $this->status = $this->identitas_sekolah->status;
        $this->nokep = $this->identitas_sekolah->nokep;
        $this->luas_area = $this->identitas_sekolah->luas_area;
        $this->alamat = $this->identitas_sekolah->alamat;
    }

    public function UpdateIdentitasSekolah(){
        $this->validate([
            'nama_sekolah' => 'required',
            'nss' => 'required',
            'akreditasi' => 'required',
            'status' => 'required',
            'nokep' => 'required',
            'luas_area' => 'required',
            'alamat' => 'required',
        ]);

        $update = $this->identitas_sekolah->update([
            'nama_sekolah' => $this->nama_sekolah,
            'nss' => $this->nss,
            'akreditasi' => $this->akreditasi,
            'status' => $this->status,
            'nokep' => $this->nokep,
            'luas_area' => $this->luas_area,
            'alamat' => $this->alamat,
        ]);
        if ($update) {
            $this->showToastr('Identitas sekolah has been successfuly updated.', 'success');
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
        return view('livewire.back.identitas-sekolah');
    }
}
