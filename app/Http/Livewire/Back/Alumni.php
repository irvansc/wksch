<?php

namespace App\Http\Livewire\Back;

use App\Exports\AlumniExport;
use App\Models\Alumni as ModelsAlumni;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Alumni extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = null;
    public $orderBy = null;

    public $checkedAlumni = [];

    public $img, $name, $jenkel, $tgl_lahir, $thn_lulus, $nis, $alamat, $email, $telp;
    protected $listeners = [
        'deleteAlumniAction',
        'deleteCheckedAlumni'
    ];


    public function deleteAlumni($id)
    {
        $this->dispatchBrowserEvent('deleteAlumni', [
            'title' => 'Are you sure ?',
            'html' => 'You want to delete this alumni.',
            'id' => $id
        ]);
    }

    public function deleteAlumniAction($id)
    {
        $alumni = ModelsAlumni::find($id);
        $path = "images/alumni_images/";
        $img = $alumni->img;
        if ($img != null && Storage::disk('public')->exists($path . $img)) {
            # delete resize image
            if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $img)) {
                Storage::disk('public')->delete($path . 'thumbnails/resized_' . $img);
            }
            # delete alumni fetaured image
            Storage::disk('public')->delete($path . $img);
        }

        $delete_alumni = $alumni->delete();
        if ($delete_alumni) {
            $this->showToastr('Alumni has been successfuly deleted!', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }


    public function exportXlsx(){
        // abort_if(!in_array($ext, ['csv','xls']), Response::HTTP_NOT_FOUND);
        // return (new AlumniExport($this->mySelected))->download('Alumni.'. $ext);
        return Excel::download(new AlumniExport, 'Alumni.xlsx');
    }
    public function exportCsv(){
        // abort_if(!in_array($ext, ['csv','xls']), Response::HTTP_NOT_FOUND);
        // return (new AlumniExport($this->mySelected))->download('Alumni.'. $ext);
        return Excel::download(new AlumniExport, 'Alumni.csv');
    }
    public function deleteSelectedAlumni(){
        $this->dispatchBrowserEvent('swal:deleteAlumni',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this Alumni',
            'checkedIDs'=>$this->checkedAlumni,
        ]);
    }

    public function deleteCheckedAlumni($ids){
        ModelsAlumni::whereKey($ids)->delete();
        $this->showToastr('Alumni has been successfuly deleted All!', 'success');
        $this->checkedAlumni = [];
    }
    public function isChecked($alumniId){
        return in_array($alumniId, $this->checkedAlumni) ? 'bg-danger text-white' : '';
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
        $alumnis = ModelsAlumni::search($this->search)->orderBy('created_at','desc')->
        paginate($this->perPage);
        return view('livewire.back.alumni',
        [
            'alumnis' => $alumnis,

        ]);
    }
}
