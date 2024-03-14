<?php

namespace App\Http\Livewire\Back;

use App\Models\SliderPrestasi;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SliderListPrestasi extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $perPage = 10;

    public $desc, $img, $action, $action_title, $title, $oldImg;
    public $selected_sliderprestasi_id;
    public $updateSliderPrestasiMode = false;


    public $listeners = [
        'resetModalForm',
        'deleteSliderPrestasiAction',
        'updateSliderPrestasiOrdering',

    ];

    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->img = null;
        $this->title = null;
        $this->desc = null;
        $this->action = null;
        $this->action_title = null;
    }
    public function addSliderPrestasi()
    {
        $this->validate([
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'img.required' => 'Image/slider wajib diisi.',
            'img.mimes' => 'Image/slider harus ber-Extensi JPG.JPEG.PNG',
            'img.max' => 'Maksimal Image/slider 2MB'
        ]);
        $foto = new SliderPrestasi();
        $foto->title = $this->title;
        $foto->desc = $this->desc;
        $foto->action = $this->action;
        $foto->action_title = $this->action_title;

        $path = "images/album/slider/prestasi/";
        $file = $this->img;
        $filename = $file->getClientOriginalName();
        $new_filename = time() . '' . $filename;
        $img = ImageManagerStatic::make($this->img)->encode('jpg');
        $file = Storage::disk('public')->put($path . $new_filename, $img);

        $foto->img = $new_filename;
        $saved = $foto->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideSliderPrestasiModal');
            $this->resetModalForm();
            $this->showToastr('New Slider Prestasi has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }

    public function editSlide($id)
    {
        $foto = SliderPrestasi::findOrFail($id);
        $this->selected_sliderprestasi_id = $foto->id;
        $this->desc = $foto->desc;
        $this->title = $foto->title;
        $this->action = $foto->action;
        $this->action_title = $foto->action_title;
        $this->oldImg = $foto->img;
        $this->updateSliderPrestasiMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showsliderprestasiModal');
    }
    public function updateSliderPrestasi()
    {
        $foto = SliderPrestasi::findOrFail($this->selected_sliderprestasi_id);
        $photo = $foto->img;
        if ($this->img) {
            $this->validate([
                'img' => 'mimes:png,jpg,jpeg|max:2048',
            ], [
                'img.mimes' => 'Image/Slider harus ber-Extensi JPG.JPEG.PNG',
                'img.max' => 'Maksimal Image/Slider 2MB'
            ]);
            $path = "images/album/slider/prestasi/";
            if ($photo != null && Storage::disk('public')->exists($path . $photo)) {
                Storage::disk('public')->delete($path . $photo);

            }
            $file = $this->img;
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $img = ImageManagerStatic::make($this->img)->encode('jpg');
            $file = Storage::disk('public')->put($path . $new_filename, $img);


            $updated =  $foto->update([
                'desc' => $this->desc,
                'title' => $this->title,
                'action' => $this->action,
                'action_title' => $this->action_title,
                'img' => $new_filename,
            ]);
            if ($updated) {
                $this->dispatchBrowserEvent('hideSliderPrestasiModal');
                $this->updateSliderPrestasiMode = false;
                $this->resetModalForm();
                $this->showToastr('Slider Prestasi has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        } else {
            $updated =  $foto->update([
                'desc' => $this->desc,
                'title' => $this->title,
                'action' => $this->action,
                'action_title' => $this->action_title,
                'img' => $this->oldImg
            ]);
            if ($updated) {
                $this->dispatchBrowserEvent('hideSliderPrestasiModal');
                $this->updateSliderPrestasiMode = false;
                $this->resetModalForm();
                $this->showToastr('Slider Prestasi has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }
    public function updateSliderPrestasiOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            SliderPrestasi::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Slider ordering has been successfuly updated.','success');
        }
    }


    public function deleteSlide($id)
    {
        $sp = SliderPrestasi::find($id);
        $this->dispatchBrowserEvent('deleteSliderPrestasi', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $sp->title . '</b> slider',
            'id' => $id
        ]);
    }
    public function deleteSliderPrestasiAction($id)
    {
        $foto = SliderPrestasi::find($id);
        $path = "images/album/slider/prestasi/";
        $featured_image = $foto->img;
        if ($featured_image != null && Storage::disk('public')->exists($path . $featured_image)) {
            Storage::disk('public')->delete($path . $featured_image);
        }

        $delete_foto = $foto->delete();
        if ($delete_foto) {
            $this->showToastr('Slider prestasi has been successfuly deleted!', 'success');
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
        return view('livewire.back.slider-list-prestasi',[
            'sliders' => SliderPrestasi::orderBy('ordering', 'asc')->get(),
        ]);
    }
}
