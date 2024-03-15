<?php

namespace App\Http\Livewire\Front;

use App\Models\Folder;
use Livewire\Component;

class FileDownload extends Component
{
    public function render()
    {
        return view('livewire.front.file-download',[
            'folders' => Folder::orderBy('created_at', 'asc')->get(),
        ]);
    }
}
