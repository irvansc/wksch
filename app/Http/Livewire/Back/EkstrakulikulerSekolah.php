<?php

namespace App\Http\Livewire\Back;

use App\Models\Ekstra;
use App\Models\EkstraList;
use Livewire\Component;

class EkstrakulikulerSekolah extends Component
{

    public $ekstrakulikuler_sekolah;
    public $title, $description;
    public $ekstrakulikuler_name;
    public $selected_ekstrakulikuler_id;
    public $updateEkstrakulikulerMode = false;
    public $listeners = [
        'resetModalForm',
        'deleteEkstrakulikulerAction',
        'updateEkstrakulikulerOrdering',
    ];
    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->ekstrakulikuler_name = null;
    }
    public function mount()
    {
        $this->ekstrakulikuler_sekolah = Ekstra::find(1);
        $this->title = $this->ekstrakulikuler_sekolah->title;
        $this->description = $this->ekstrakulikuler_sekolah->description;
    }
    public function UpdateEkstrakulikulerSekolah(){
        $this->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        $update = $this->ekstrakulikuler_sekolah->update([
            'title' => $this->title,
            'description' => $this->description,

        ]);
        if ($update) {
            $this->showToastr('Ekstrakulikuler sekolah has been successfuly updated.', 'success');
        } else {
            $this->showToastr('Something Wrong!', 'error');
        }
    }

    public function addEkstrakulikuler()
    {
        $this->validate([
            'ekstrakulikuler_name' => 'required|unique:ekstra_lists,ekstrakulikuler_name',
        ]);
        $ekstrakulikuler = new EkstraList();
        $ekstrakulikuler->ekstrakulikuler_name = $this->ekstrakulikuler_name;
        $saved = $ekstrakulikuler->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideEkstrakulikulerModal');
            $this->ekstrakulikuler_name = null;
            $this->showToastr('New Ekstrakulikuler has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }
    public function editEkstrakulikuler($id)
    {
        $ekstrakulikuler = EkstraList::findOrFail($id);
        $this->selected_ekstrakulikuler_id = $ekstrakulikuler->id;
        $this->ekstrakulikuler_name = $ekstrakulikuler->ekstrakulikuler_name;
        $this->updateEkstrakulikulerMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showekstrakulikulerModal');
    }


    public function updateEkstrakulikuler()
    {
        if ($this->selected_ekstrakulikuler_id) {
            $this->validate([
                'ekstrakulikuler_name' => 'required|unique:ekstra_lists,ekstrakulikuler_name,' . $this->selected_ekstrakulikuler_id,
            ]);

            $ekstrakulikuler = EkstraList::findOrFail($this->selected_ekstrakulikuler_id);
            $ekstrakulikuler->ekstrakulikuler_name = $this->ekstrakulikuler_name;
            $updated = $ekstrakulikuler->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hideEkstrakulikulerModal');
                $this->updateEkstrakulikulerMode = false;
                $this->showToastr('Ekstrakulikuler has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }
    public function deleteEkstrakulikuler($id)
    {
        $ekstrakulikuler = EkstraList::find($id);
        $this->dispatchBrowserEvent('deleteEkstrakulikuler', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $ekstrakulikuler->category_name . '</b> Ekstrakulikuler',
            'id' => $id
        ]);
    }
    public function deleteEkstrakulikulerAction($id)
    {
        $ekstrakulikuler = EkstraList::where('id', $id)->first();
        $ekstrakulikuler->delete();
        $this->showToastr('Ekstrakulikuler has been successfuly deleted.', 'info');
    }
    public function updateEkstrakulikulerOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            EkstraList::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Ekstrakulikuler ordering has been successfuly updated.','success');
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
        return view('livewire.back.ekstrakulikuler-sekolah', [
            'ekstrakulikulers' => EkstraList::orderBy('ordering', 'asc')->get(),
        ]);
    }
}
