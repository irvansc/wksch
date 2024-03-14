<?php

namespace App\Http\Livewire\Back;

use App\Models\Pengumuman;
use Livewire\Component;

class PengumumanAdd extends Component
{
    public $title, $description;
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

            return redirect()->route('admin.pengumuman');
        } else {
            $this->showToastr('Something went wrong!', 'error');
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
        return view('livewire.back.pengumuman-add')
    ;
    }
}
