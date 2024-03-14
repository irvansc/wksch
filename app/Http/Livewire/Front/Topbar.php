<?php

namespace App\Http\Livewire\Front;

use App\Models\LogoSekolah;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Topbar extends Component
{


    public function render()
    {
        $setting = Setting::find(1)->first();
        $sm = SocialMedia::find(1)->first();

        $logos = LogoSekolah::find(1)->first();
        return view(
            'livewire.front.topbar',
            [
                'setting' => $setting,
                'sm' => $sm,
                'logos' => $logos,
            ]
        );
    }
}
