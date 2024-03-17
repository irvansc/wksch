<?php

namespace App\Http\Livewire\Front;

use App\Models\Alumni;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image as Image;
class AlumniForm extends Component
{
    use WithFileUploads;

    public $name, $email,$nis, $tgl_lahir, $thn_masuk, $thn_lulus,$jenkel, $alamat, $telp, $img;

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->name = null;
        $this->img = null;
        $this->email = null;
        $this->nis = null;
        $this->tgl_lahir = null;
        $this->thn_masuk = null;
        $this->thn_lulus = null;
        $this->jenkel = null;
        $this->alamat = null;
        $this->telp = null;
    }
    public function addAlumni()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'nis' => 'required|numeric',
            'tgl_lahir' => 'required',
            'thn_masuk' => 'required|numeric',
            'thn_lulus' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric',
            'img' => 'required|mimes:jpg,png,jpeg|max:2048|image'
        ],
        [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.numeric' => 'NIS wajib Number.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
            'thn_masuk.required' => 'Tahun masuk wajib diisi',
            'thn_lulus.required' => 'Tahun lulus wajib diisi',
            'jenkel.required' => 'Jenis kelamin wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'telp.required' => 'Telpon/WhatsAap wajib diisi.',
            'img.required' => 'Foto wajib diisi.',
            'img.mimes' => 'Foto harus extensi JPG.PNG.JPEG',
            'img.max' => 'Foto maksimal 2mb',
        ]);

        $foto = new Alumni();
        $foto->name = $this->name;
        $foto->email = $this->email;
        $foto->nis = $this->nis;
        $foto->jenkel = $this->jenkel;
        $foto->tgl_lahir = $this->tgl_lahir;
        $foto->thn_masuk = $this->thn_masuk;
        $foto->thn_lulus = $this->thn_lulus;
        $foto->alamat = $this->alamat;
        $foto->telp = $this->telp;
        $path = "images/alumni_images/";
        $file = $this->img;
        $filename = $file->getClientOriginalName();
        $new_filename = time() . '' . $filename;
        $img = ImageManagerStatic::make($this->img)->encode('jpg');
        $file = Storage::disk('public')->put($path . $new_filename, $img);

        $alumni = $path . 'thumbnails';
        if (!Storage::disk('public')->exists($alumni)) {
            Storage::disk('public')->makeDirectory($alumni, 0755, true, true);
        }

        Image::make(storage_path('app/public/' . $path . $new_filename))
        ->fit(315, 315)->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));


        $foto->img = $new_filename;
        $foto->save();
        session()->flash('message', 'Data alumni terkirim. Mohon menunggu Admin mereview data anda.');
        $this->emit('alert_remove');
        $this->resetForm();
    }
    public function render()
    {
        return view('livewire.front.alumni-form');
    }
}
