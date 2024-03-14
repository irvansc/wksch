<?php

namespace App\Http\Livewire\Back;

use App\Models\Folder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FolderList extends Component
{
    use WithFileUploads;

    public $file_name, $file_size, $file_ext, $doc, $file_ket;
    public $selected_folder_id;
    public $updateFolderMode = false;

    public $listeners = [
        'resetModalForm',
        'deleteFolderAction',
        'updateFolderOrdering',
    ];
    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->file_name = null;
        $this->file_size = null;
        $this->file_ext = null;
        $this->doc = null;
        $this->file_ket = null;
    }








    public function deleteFolder($id)
    {
        $folder = Folder::find($id);
        $this->dispatchBrowserEvent('deleteFolder', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $folder->title . '</b> file',
            'id' => $id
        ]);
    }

    public function deleteFolderAction($id)
    {
        $folder = Folder::find($id);
        $path = "folders/";
        $featured_image = $folder->file_name;
        if ($featured_image != null && Storage::disk('public')->exists($path . $featured_image)) {
            Storage::disk('public')->delete($path . $featured_image);
        }

        $delete_post = $folder->delete();
        if ($delete_post) {
            $this->showToastr('File has been successfuly deleted!','success' );
        } else {
            $this->showToastr('Something went wrong!','error');
        }
    }

    public function updateFolderOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            Folder::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Categories ordering has been successfuly updated.', 'success');
        }
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
    public function download($file_name)
    {

        return response()->download(storage_path("app/public/folders/" . $file_name));
    }


    public function render()
    {
        return view('livewire.back.folder-list',[
            'folders' => Folder::orderBy('created_at', 'asc')->get(),
        ]);
    }
}
