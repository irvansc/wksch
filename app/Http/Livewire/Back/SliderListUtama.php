<?php

namespace App\Http\Livewire\Back;

use App\Models\SliderUtama;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SliderListUtama extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $perPage = 10;

    public $desc, $img, $action, $action_title, $title, $oldImg;
    public $selected_slider_id;
    public $updateSliderMode = false;


    public $listeners = [
        'resetModalForm',
        'deleteSliderAction',
        'updateSliderOrdering'
    ];

    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->img = null;
        $this->desc = null;
        $this->action = null;
        $this->action_title = null;
        $this->title = null;
    }
    public function addSlider()
    {
        $this->validate([
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'img.required' => 'Image/slider wajib diisi.',
            'img.mimes' => 'Image/slider harus ber-Extensi JPG.JPEG.PNG',
            'img.max' => 'Maksimal Image/slider 2MB'
        ]);
        $slid = new SliderUtama();
        $slid->title = $this->title;
        $slid->desc = $this->desc;
        $slid->action = $this->action;
        $slid->action_title = $this->action_title;

        $path = "images/album/slider/";
        $file = $this->img;
        $filename = $file->getClientOriginalName();
        $new_filename = time() . '' . $filename;
        $img = ImageManagerStatic::make($this->img)->encode('jpg');
        $file = Storage::disk('public')->put($path . $new_filename, $img);

        $slid->img = $new_filename;
        $saved = $slid->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideSliderModal');
            $this->resetModalForm();
            $this->showToastr('New Slider has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }

    public function editSlide($id)
    {
        $foto = SliderUtama::findOrFail($id);
        $this->selected_slider_id = $foto->id;
        $this->desc = $foto->desc;
        $this->title = $foto->title;
        $this->action = $foto->action;
        $this->action_title = $foto->action_title;
        $this->oldImg = $foto->img;
        $this->updateSliderMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showsliderModal');
    }
    public function updateSlider()
    {
        $foto = SliderUtama::findOrFail($this->selected_slider_id);
        $photo = $foto->img;
        if ($this->img) {
            $this->validate([
                'img' => 'mimes:png,jpg,jpeg|max:2048',
            ], [
                'img.mimes' => 'Image/Slider harus ber-Extensi JPG.JPEG.PNG',
                'img.max' => 'Maksimal Image/Slider 2MB'
            ]);
            $path = "images/album/slider/";
            if ($photo != null && Storage::disk('public')->exists($path . $photo)) {
                Storage::disk('public')->delete($path . $photo);

            }
            $file = $this->img;
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $img = ImageManagerStatic::make($this->img)->encode('jpg');
            $file = Storage::disk('public')->put($path . $new_filename, $img);


            $updated = $foto->update([
                'desc' => $this->desc,
                'title' => $this->title,
                'action' => $this->action,
                'action_title' => $this->action_title,
                'img' => $new_filename,
            ]);
            if ($updated) {
                $this->dispatchBrowserEvent('hideSliderModal');
                $this->updateSliderMode = false;
                $this->resetModalForm();

                $this->showToastr('Slider has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        } else {
            $updated = $foto->update([
                'desc' => $this->desc,
                'title' => $this->title,
                'action' => $this->action,
                'action_title' => $this->action_title,
                'img' => $this->oldImg
            ]);
            if ($updated) {
                $this->dispatchBrowserEvent('hideSliderModal');
                $this->updateSliderMode = false;
                $this->resetModalForm();

                $this->showToastr('Slider has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }
    public function updateSliderOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            SliderUtama::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Slider ordering has been successfuly updated.', 'success');
        }
    }

    public function deleteSlide($id)
    {
        $sp = SliderUtama::find($id);
        $this->dispatchBrowserEvent('deleteSlider', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $sp->title . '</b> slider',
            'id' => $id
        ]);
    }
    public function deleteSliderAction($id)
    {
        $foto = SliderUtama::find($id);
        $path = "images/album/slider/";
        $featured_image = $foto->img;
        if ($featured_image != null && Storage::disk('public')->exists($path . $featured_image)) {
            Storage::disk('public')->delete($path . $featured_image);
        }

        $delete_foto = $foto->delete();
        if ($delete_foto) {
            $this->showToastr('Slider has been successfuly deleted!', 'success');
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
        return view('livewire.back.slider-list-utama', [
            'sliders' => SliderUtama::orderBy('ordering', 'asc')->get(),
        ]);
    }
}
