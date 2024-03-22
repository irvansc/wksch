<?php

namespace App\Http\Livewire\Front;

use App\Models\PpdbBannerSecond;
use Livewire\Component;

class SidebarContent extends Component
{
    public function render()
    {

        $ppdb = PpdbBannerSecond::find(1);
        return view('livewire.front.sidebar-content',[
            'ppdb' => $ppdb
        ]);
    }
}
