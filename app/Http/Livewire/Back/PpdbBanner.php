<?php

namespace App\Http\Livewire\Back;

use App\Models\PpdbBanner as ModelsPpdbBanner;
use App\Models\PpdbBannerSecond;
use Livewire\Component;
use Livewire\WithFileUploads;

class PpdbBanner extends Component
{
    use WithFileUploads;

    public  $img1, $oldImg1, $action,$img, $oldImg, $action1;
    public $selected_ppdb_id;
    public $updatePpdbMode = false;


    public $listeners = [
        'UpdateForm',
        'resetModalForm',
        'deletePpdbAction',
        'updatePpdbOrdering'
    ];

    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->img1 = null;
        $this->action = null;
        $this->img = null;
        $this->action1 = null;
    }
    public function UpdateForm()
    {
        $this->resetErrorBag();
        $this->img1 = null;
        $this->action = null;
        $this->img = null;
        $this->action1 = null;
    }

    public function render()
    {
        return view('livewire.back.ppdb-banner', [
            'ppdb' => \App\Models\PpdbBanner::find(1),
            'ppdbSecond' => PpdbBannerSecond::find(1),
        ]);
    }
}
