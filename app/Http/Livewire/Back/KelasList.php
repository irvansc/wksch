<?php

namespace App\Http\Livewire\Back;

use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Component;

class KelasList extends Component
{
    public $kelas_name;
    public $selected_kelas_id;
    public $updateKelasMode = false;

    public $listeners = [
        'resetModalForm',
        'deleteKelasAction',
    ];
    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->kelas_name = null;
    }
    public function addKelas()
    {
        $this->validate([
            'kelas_name' => 'required|unique:kelas,kelas_name',
        ]);
        $kelas = new Kelas();
        $kelas->kelas_name = $this->kelas_name;
        $saved = $kelas->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideKelasModal');
            $this->kelas_name = null;
            $this->showToastr('New Kelas has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }
    public function editKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $this->selected_kelas_id = $kelas->id;
        $this->kelas_name = $kelas->kelas_name;
        $this->updateKelasMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showkelasModal');
    }


    public function updateKelas()
    {
        if ($this->selected_kelas_id) {
            $this->validate([
                'kelas_name' => 'required|unique:kelas,kelas_name,' . $this->selected_kelas_id,
            ]);

            $kelas = Kelas::findOrFail($this->selected_kelas_id);
            $kelas->kelas_name = $this->kelas_name;
            $updated = $kelas->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hideKelasModal');
                $this->updateKelasMode = false;
                $this->showToastr('Kelas has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }

    public function deleteKelas($id)
    {
        $kelas = Kelas::find($id);
        $this->dispatchBrowserEvent('deleteKelas', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $kelas->kelas_name . '</b> kelas',
            'id' => $id
        ]);
    }


    public function deleteKelasAction($id)
    {
        $kelas = Kelas::where('id', $id)->first();
        $siswa = Siswa::where('kelas_id', $kelas->id)->get()->toArray();
        if (!empty($siswa) && count($siswa) > 0) {
            $this->showToastr('This kelas has (' . count($siswa) . ') siswa related it, cannot be deleted.', 'error');
        } else {
            $kelas->delete();
            $this->showToastr('Album has been successfuly deleted.', 'success');
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
        return view('livewire.back.kelas-list', [
            'kelas' => Kelas::orderBy('id', 'asc')->get(),
        ]);
    }
}
