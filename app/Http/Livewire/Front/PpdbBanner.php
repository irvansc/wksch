<?php

namespace App\Http\Livewire\Front;

use App\Models\PpdbBanner as ModelsPpdbBanner;
use Livewire\Component;

class PpdbBanner extends Component
{
    public function render()
    {

        $ppdb = ModelsPpdbBanner::find(1);
        return view('livewire.front.ppdb-banner',[
            'ppdb' => $ppdb
        ]);
    }
}
