<?php

namespace App\Http\Livewire\Back;

use App\Models\KepalaSekolah as ModelsKepalaSekolah;
use Livewire\Component;

class KepalaSekolah extends Component
{
    public $kepala_sekolah;

    public $name, $nip, $serint, $akreditasi, $desc, $img, $video_url;

    public $listeners = [
        'Action',
    ];
    public function mount(){
        $this->kepala_sekolah = ModelsKepalaSekolah::find(1);
        $this->name = $this->kepala_sekolah->name;
        $this->nip = $this->kepala_sekolah->nip;
        $this->serint = $this->kepala_sekolah->serint;
        $this->akreditasi = $this->kepala_sekolah->akreditasi;
        $this->desc = $this->kepala_sekolah->desc;
        $this->img = $this->kepala_sekolah->img;
        $this->video_url = $this->kepala_sekolah->video_url;
    }

    public function UpdateKepalaSekolah()
    {

        $update = $this->kepala_sekolah->update([
            'name' => $this->name,
            'nip' => $this->nip,
            'serint' => $this->serint,
            'akreditasi' => $this->akreditasi,
            'desc' => $this->desc,
            // 'img' => $this->img,
            'video_url' => $this->video_url,
        ]);
        if ($update) {
            $this->showToastr('Kepala sekolah has been successfuly updated.', 'success');
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
        return view('livewire.back.kepala-sekolah');
    }
}
