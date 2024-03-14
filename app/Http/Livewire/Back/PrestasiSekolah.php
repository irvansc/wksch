<?php

namespace App\Http\Livewire\Back;

use App\Models\PrestasiList;
use App\Models\PrestasiSekolah as ModelsPrestasiSekolah;
use Livewire\Component;

class PrestasiSekolah extends Component
{
    public $prestasi_sekolah;
    public $title, $description;
    public $bulan, $tahun, $kegiatan, $tingkat, $juara, $link;
    public $selected_prestasi_id;
    public $updatePrestasiMode = false;

    public $listeners = [
        'resetModalForm',
        'deletePrestasiAction',
        'updatePrestasiOrdering',
    ];
    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->bulan = null;
        $this->tahun = null;
        $this->kegiatan = null;
        $this->tingkat = null;
        $this->juara = null;
        $this->link = null;
    }
    public function mount()
    {
        $this->prestasi_sekolah = ModelsPrestasiSekolah::find(1);
        $this->title = $this->prestasi_sekolah->title;
        $this->description = $this->prestasi_sekolah->description;
    }
    public function UpdatePrestasiSekolah(){
        $this->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        $update = $this->prestasi_sekolah->update([
            'title' => $this->title,
            'description' => $this->description,

        ]);
        if ($update) {
            $this->showToastr('Prestasi sekolah has been successfuly updated.', 'success');
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

    public function addPrestasi()
    {
        $this->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'kegiatan' => 'required',
            'tingkat' => 'required',
            'juara' => 'required',
        ]);
        $prestasi = new PrestasiList();
        $prestasi->bulan = $this->bulan;
        $prestasi->tahun = $this->tahun;
        $prestasi->kegiatan = $this->kegiatan;
        $prestasi->tingkat = $this->tingkat;
        $prestasi->juara = $this->juara;
        $prestasi->link = $this->link;
        $saved = $prestasi->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hidePrestasiModal');
            $this->bulan = null;
            $this->tahun = null;
            $this->kegiatan = null;
            $this->tingkat = null;
            $this->juara = null;
            $this->link = null;
            $this->showToastr('New Prestasi has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }
    public function editPrestasi($id)
    {
        $prestasi = PrestasiList::findOrFail($id);
        $this->selected_prestasi_id = $prestasi->id;
        $this->bulan = $prestasi->bulan;
        $this->tahun = $prestasi->tahun;
        $this->kegiatan = $prestasi->kegiatan;
        $this->tingkat = $prestasi->tingkat;
        $this->juara = $prestasi->juara;
        $this->link = $prestasi->link;
        $this->updatePrestasiMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showprestasiModal');
    }


    public function updatePrestasi()
    {
        if ($this->selected_prestasi_id) {
            $this->validate([
                'bulan' => 'required',
                'tahun' => 'required' ,
                'kegiatan' => 'required',
                'tingkat' => 'required',
                'juara' => 'required',
            ]);

            $prestasi = PrestasiList::findOrFail($this->selected_prestasi_id);
            $prestasi->bulan = $this->bulan;
            $prestasi->tahun = $this->tahun;
            $prestasi->kegiatan = $this->kegiatan;
            $prestasi->tingkat = $this->tingkat;
            $prestasi->juara = $this->juara;
            $prestasi->link = $this->link;
            $updated = $prestasi->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hidePrestasiModal');
                $this->updatePrestasiMode = false;
                $this->showToastr('Prestasi has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }
    public function deletePrestasi($id)
    {
        $prestasi = PrestasiList::find($id);
        $this->dispatchBrowserEvent('deletePrestasi', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $prestasi->kegiatan . '</b> Prestasi',
            'id' => $id
        ]);
    }
    public function deletePrestasiAction($id)
    {
        $prestasi = PrestasiList::where('id', $id)->first();
        $prestasi->delete();
        $this->showToastr('Prestasi has been successfuly deleted.', 'info');
    }
    public function updatePrestasiOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            PrestasiList::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Prestasi ordering has been successfuly updated.','success');
        }
    }
    public function render()
    {
        return view('livewire.back.prestasi-sekolah',[
            'prestasis'=> PrestasiList::orderBy('ordering', 'asc')->get(),
        ]);
    }
}
