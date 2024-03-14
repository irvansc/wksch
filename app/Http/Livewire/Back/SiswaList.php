<?php

namespace App\Http\Livewire\Back;

use App\Exports\SiswaExport;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SiswaList extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $search = null;
    public $orderBy = null;
    public $kelas = null;
    // public $siswa = null;
    public $checkedSiswa = [];
    public bool $bulkDisabled = true;

    public $img, $name, $jenkel, $tgl_lahir, $nis, $alamat;
    protected $listeners = [
        'deleteSiswaAction',
        'deleteCheckedSiswa'
    ];

    public function updatingKelas()
    {
        $this->resetPage();
    }
    public function deleteSiswa($id)
    {
        $this->dispatchBrowserEvent('deleteSiswa', [
            'title' => 'Are you sure ?',
            'html' => 'You want to delete this siswa.',
            'id' => $id
        ]);
    }
  public function deleteSelectedSiswa(){
        $this->dispatchBrowserEvent('swal:deleteSiswa',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this Siswa',
            'checkedIDs'=>$this->checkedSiswa,
        ]);
    }

    public function deleteCheckedSiswa($ids){
        Siswa::whereKey($ids)->delete();
        $this->showToastr('Siswa has been successfuly deleted All!', 'success');
        $this->checkedSiswa = [];
    }
    public function deleteSiswaAction($id)
    {
        $siswa = Siswa::find($id);
        $path = "images/siswa_images/";
        $img = $siswa->img;
        if ($img != null && Storage::disk('public')->exists($path . $img)) {
            # delete resize image
            if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $img)) {
                Storage::disk('public')->delete($path . 'thumbnails/resized_' . $img);
            }
            # delete guru fetaured image
            Storage::disk('public')->delete($path . $img);
        }

        $delete_siswa = $siswa->delete();
        if ($delete_siswa) {
            $this->showToastr('Siswa has been successfuly deleted!', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }
    public function exportXlsx(){
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }
    public function exportCsv(){
        return Excel::download(new SiswaExport, 'Siswa.csv');
    }

    public function isChecked($siswaId){
        return in_array($siswaId, $this->checkedSiswa) ? 'bg-danger text-white' : '';
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

        $siswa = Siswa::search($this->search)
        ->when($this->kelas, function ($query) {
            $query->where('kelas_id', $this->kelas);
        })
        ->orderBy('created_at','desc')->
        paginate($this->perPage);
        return view('livewire.back.siswa-list',[
            'siswa'=>$siswa
        ]);
    }
}
