<?php

namespace App\Http\Livewire\Back;

use App\Models\Pengumuman;
use Livewire\Component;
use Livewire\WithPagination;

class PengumumanSekolah extends Component
{

    use WithPagination;
    public $perPage = 5;
    public $title, $description;
    public $selected_pengumuman_id;
    public $updatePengumumanMode = false;

    public $listeners = [
        'resetModalForm',
        'deletePengumumanAction',
    ];
    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->title = null;
        $this->description = null;
    }
    public function addPengumuman()
    {
        $this->validate([
            'title' => 'required|unique:pengumumen,title',
            'description' => 'required'
        ]);
        $item = new Pengumuman();
        $item->title = $this->title;
        $item->description = $this->description;
        $saved = $item->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hidePengumumanModal');
            $this->title = null;
            $this->description = null;
            $this->showToastr('New Pengumuman has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }
    public function editPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $this->selected_pengumuman_id = $pengumuman->id;
        $this->title = $pengumuman->title;
        $this->description = $pengumuman->description;
        $this->updatePengumumanMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showpengumumanModal');
    }


    public function updatePengumuman()
    {
        if ($this->selected_pengumuman_id) {
            $this->validate([
                'title' => 'required|unique:pengumumen,title,' . $this->selected_pengumuman_id,
                'description' => 'required'
            ]);

            $item = Pengumuman::findOrFail($this->selected_pengumuman_id);
            $item->title = $this->title;
            $item->description = $this->description;
            $updated = $item->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hidePengumumanModal');
                $this->updatePengumumanMode = false;
                $this->showToastr('Pengumuman has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }

    public function deletePengumuman($id)
    {
        $this->dispatchBrowserEvent('deletePengumuman', [
            'title' => 'Are you sure ?',
            'html' => 'You want to delete this Pengumuman.',
            'id' => $id
        ]);
    }

    public function deletePengumumanAction($id)
    {
        $pengumuman = Pengumuman::find($id);
        $delete_pengumuman = $pengumuman->delete();
        if ($delete_pengumuman) {
            $this->showToastr('pengumuman has been successfuly deleted!','success' );
        } else {
            $this->showToastr('Something went wrong!','error');
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
        return view('livewire.back.pengumuman-sekolah',[
            'pengumumans'=> Pengumuman::paginate($this->perPage)
        ]);
    }
}
