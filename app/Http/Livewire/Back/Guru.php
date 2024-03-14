<?php

namespace App\Http\Livewire\Back;

use App\Exports\GuruExport;
use App\Models\Guru as ModelsGuru;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Guru extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = null;
    public $orderBy = null;

    public $checkedGuru = [];

    public $img, $name, $jenkel, $tgl_lahir, $gtk, $nip, $alamat;
    protected $listeners = [
        'deleteGuruAction',
        'deleteCheckedGuru'
    ];


    public function deleteGuru($id)
    {
        $this->dispatchBrowserEvent('deleteGuru', [
            'title' => 'Are you sure ?',
            'html' => 'You want to delete this alumni.',
            'id' => $id
        ]);
    }

    public function deleteGuruAction($id)
    {
        $guru = ModelsGuru::find($id);
        $path = "images/guru_images/";
        $img = $guru->img;
        if ($img != null && Storage::disk('public')->exists($path . $img)) {
            # delete resize image
            if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $img)) {
                Storage::disk('public')->delete($path . 'thumbnails/resized_' . $img);
            }
            # delete guru fetaured image
            Storage::disk('public')->delete($path . $img);
        }

        $delete_guru = $guru->delete();
        if ($delete_guru) {
            $this->showToastr('Guru has been successfuly deleted!', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }


    public function exportXlsx(){
        return Excel::download(new GuruExport, 'Guru.xlsx');
    }
    public function exportCsv(){
        return Excel::download(new GuruExport, 'Guru.csv');
    }
    public function deleteSelectedGuru(){
        $this->dispatchBrowserEvent('swal:deleteGuru',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this Guru',
            'checkedIDs'=>$this->checkedGuru,
        ]);
    }

    public function deleteCheckedGuru($ids){
        ModelsGuru::whereKey($ids)->delete();
        $this->showToastr('Guru has been successfuly deleted All!', 'success');
        $this->checkedGuru = [];
    }
    public function isChecked($guruId){
        return in_array($guruId, $this->checkedGuru) ? 'bg-danger text-white' : '';
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
        $gurus = ModelsGuru::search($this->search)->orderBy('created_at','desc')->
        paginate($this->perPage);
        return view('livewire.back.guru',
        [
            'gurus' => $gurus,

        ]);
    }
}
