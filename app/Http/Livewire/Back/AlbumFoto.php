<?php

namespace App\Http\Livewire\Back;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Facades\Image as Image;
class AlbumFoto extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $album_name;
    public $selected_album_id;
    public $updateAlbumMode = false;
    public $perPage = 6;

    public $title, $img, $album_id, $oldImg;
    public $selected_foto_id;
    public $updateFotoMode = false;

    public $album = null;
    public $listeners = [
        'resetModalForm',
        'deleteAlbumAction',
        'updateAlbumOrdering',
        'resetModalForm',
        'deleteFotoAction',
    ];
    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->album_name = null;
        $this->img = null;
        $this->title = null;
        $this->oldImg = null;

    }
    public function addAlbum()
    {
        $this->validate([
            'album_name' => 'required|unique:albums,album_name',
        ]);
        $album = new Album();
        $album->album_name = $this->album_name;
        $saved = $album->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideAlbumModal');
            $this->album_name = null;
            $this->showToastr('New Album has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }
    public function editAlbum($id)
    {
        $album = Album::findOrFail($id);
        $this->selected_album_id = $album->id;
        $this->album_name = $album->album_name;
        $this->updateAlbumMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showalbumModal');
    }


    public function updateAlbum()
    {
        if ($this->selected_album_id) {
            $this->validate([
                'album_name' => 'required|unique:albums,album_name,' . $this->selected_album_id,
            ]);

            $album = Album::findOrFail($this->selected_album_id);
            $album->album_name = $this->album_name;
            $updated = $album->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hideAlbumModal');
                $this->updateAlbumMode = false;
                $this->showToastr('Album has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }


    public function deleteAlbum($id)
    {
        $album = Album::find($id);
        $this->dispatchBrowserEvent('deleteAlbum', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $album->album_name . '</b> album',
            'id' => $id
        ]);
    }
    public function deleteAlbumAction($id)
    {
        $album = Album::where('id', $id)->first();
        $foto = Foto::where('album_id', $album->id)->get()->toArray();
        if (!empty($foto) && count($foto) > 0) {
            $this->showToastr('This kelas has (' . count($foto) . ') foto related it, cannot be deleted.', 'error');
        } else {
            $album->delete();
            $this->showToastr('Album has been successfuly deleted.', 'success');
        }
    }

    public function updateAlbumOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            Album::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Album ordering has been successfuly updated.','success');
        }
    }

    public function deleteFoto($id)
    {
        $foto = Foto::find($id);
        $this->dispatchBrowserEvent('deleteFoto', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $foto->title . '</b> foto',
            'id' => $id
        ]);
    }

    public function deleteFotoAction($id)
    {
        $foto = Foto::find($id);
        $path = "images/album/foto/";
        $featured_image = $foto->img;
        if ($featured_image != null && Storage::disk('public')->exists($path . $featured_image)) {
            # delete post fetaured image
            Storage::disk('public')->delete($path . $featured_image);
        }

        $delete_foto = $foto->delete();
        if ($delete_foto) {
            $this->showToastr('Foto has been successfuly deleted!', 'success');
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

        $fotos = Foto::when($this->album, function ($query) {
            $query->where('album_id', $this->album);
        })
            ->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.back.album-foto',[
            'Albums'=>  Album::orderBy('ordering', 'asc')->get(),
            'fotos'=> $fotos,
            'Albumss' => Album::all()
        ]);
    }
}
