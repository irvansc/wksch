<?php

namespace App\Http\Livewire\Back;

use App\Models\Setting;
use Livewire\Component;

class AdminGeneralSetting extends Component
{
    public $settings;

    public $web_name, $web_email, $web_email_noreply ,$web_telp, $web_tagline, $web_maps, $web_desc, $web_alamat;

    public function mount()
    {
        $this->settings = Setting::find(1);
        $this->web_name = $this->settings->web_name;
        $this->web_tagline = $this->settings->web_tagline;
        $this->web_telp = $this->settings->web_telp;
        $this->web_email = $this->settings->web_email;
        $this->web_email_noreply = $this->settings->web_email_noreply;
        $this->web_maps = $this->settings->web_maps;
        $this->web_alamat = $this->settings->web_alamat;
        $this->web_desc = $this->settings->web_desc;
    }
    public function updateGeneralSettings()
    {

        $update =  $this->settings->update([
            'web_name' => $this->web_name,
        'web_tagline' => $this->web_tagline,
        'web_telp' => $this->web_telp,
        'web_email' => $this->web_email,
        'web_email_noreply' => $this->web_email_noreply,
        'web_maps' => $this->web_maps,
        'web_alamat' => $this->web_alamat,
        'web_desc' => $this->web_desc,

        ]);
        if ($update) {
            $this->showToastr('General settings successfuly updated', 'success');
            $this->emit('updateAdminFooter');
        } else {
            $this->showToastr('Something wrong!', 'error');
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
        return view('livewire.back.admin-general-setting');
    }
}
