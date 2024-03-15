<?php

namespace App\Http\Livewire\Back;

use App\Models\SliderAlumni;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\Facades\Image as Image;
class SliderListAlumni extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $perPage = 10;

    public $desc, $img, $action, $name, $oldImg;
    public $selected_slideralumni_id;
    public $updateSliderAlumniMode = false;


    public $listeners = [
        'resetModalForm',
        'deleteSliderAlumniAction',
        'updateSliderAlumniOrdering',

    ];

    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->img = null;
        $this->name = null;
        $this->desc = null;
        $this->oldImg = null;
    }
    public function addSliderAlumni()
    {
        $this->validate([
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'img.required' => 'Image/slider wajib diisi.',
            'img.mimes' => 'Image/slider harus ber-Extensi JPG.JPEG.PNG',
            'img.max' => 'Maksimal Image/slider 2MB'
        ]);
        $foto = new SliderAlumni();
        $foto->name = $this->name;
        $foto->desc = $this->desc;
        $path = "images/album/slider/alumni/";
        $file = $this->img;
        $filename = $file->getClientOriginalName();
        $new_filename = time() . '' . $filename;
        $img = ImageManagerStatic::make($this->img)->encode('jpg');
        $file = Storage::disk('public')->put($path . $new_filename, $img);
        $post_thumbnails_path = $path . 'thumbnails';
        if (!Storage::disk('public')->exists($post_thumbnails_path)) {
            Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
        }
        Image::make(storage_path('app/public/' . $path . $new_filename))
        ->fit(315, 315)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

        $foto->img = $new_filename;
        $saved = $foto->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideSliderAlumniModal');
            $this->resetModalForm();
            $this->showToastr('New Slider Alumni has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }

    public function editSlide($id)
    {
        $foto = SliderAlumni::findOrFail($id);
        $this->selected_slideralumni_id = $foto->id;
        $this->desc = $foto->desc;
        $this->name = $foto->name;
        $this->oldImg = $foto->img;
        $this->updateSliderAlumniMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showslideralumniModal');
    }
    public function updateSliderAlumni()
    {
        $foto = SliderAlumni::findOrFail($this->selected_slideralumni_id);
        $photo = $foto->img;
        if ($this->img) {
            $this->validate([
                'img' => 'mimes:png,jpg,jpeg|max:2048',
            ], [
                'img.mimes' => 'Image/Slider harus ber-Extensi JPG.JPEG.PNG',
                'img.max' => 'Maksimal Image/Slider 2MB'
            ]);
            $path = "images/album/slider/alumni/";
            if ($photo != null && Storage::disk('public')->exists($path . $photo)) {
                Storage::disk('public')->delete($path . $photo);
                if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $photo)) {
                    Storage::disk('public')->delete($path . 'thumbnails/resized_' . $photo);
                }
            }
            $file = $this->img;
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '' . $filename;
            $img = ImageManagerStatic::make($this->img)->encode('jpg');
            $file = Storage::disk('public')->put($path . $new_filename, $img);
            Image::make(storage_path('app/public/' . $path . $new_filename))
            ->fit(315, 315)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            $updated =  $foto->update([
                'desc' => $this->desc,
                'name' => $this->name,
                'img' => $new_filename,
            ]);
            if ($updated) {
                $this->dispatchBrowserEvent('hideSliderAlumniModal');
                $this->updateSliderAlumniMode = false;
                $this->resetModalForm();
                $this->showToastr('Slider Alumni has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        } else {
            $updated =  $foto->update([
                'desc' => $this->desc,
                'name' => $this->name,
            ]);
            if ($updated) {
                $this->dispatchBrowserEvent('hideSliderAlumniModal');
                $this->updateSliderAlumniMode = false;
                $this->resetModalForm();
                $this->showToastr('Slider Alumni has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }
    public function updateSliderAlumniOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            SliderAlumni::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Slider ordering has been successfuly updated.','success');
        }
    }


    public function deleteSlide($id)
    {
        $sp = SliderAlumni::find($id);
        $this->dispatchBrowserEvent('deleteSliderAlumni', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $sp->title . '</b> slider',
            'id' => $id
        ]);
    }
    public function deleteSliderAlumniAction($id)
    {
        $foto = SliderAlumni::find($id);
        $path = "images/album/slider/alumni/";
        $featured_image = $foto->img;
        if ($featured_image != null && Storage::disk('public')->exists($path . $featured_image)) {
            Storage::disk('public')->delete($path . $featured_image);
        }

        $delete_foto = $foto->delete();
        if ($delete_foto) {
            $this->showToastr('Slider alumni has been successfuly deleted!', 'success');
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
        return view('livewire.back.slider-list-alumni',[
            'alumnis' => SliderAlumni::orderBy('ordering', 'asc')->get(),
        ]);
    }
}
