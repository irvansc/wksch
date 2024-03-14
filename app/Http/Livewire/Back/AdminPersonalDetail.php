<?php

namespace App\Http\Livewire\Back;

use App\Models\User;
use Livewire\Component;

class AdminPersonalDetail extends Component
{
    public $admin;
    public $name, $username, $email, $biography;

    public function mount()
    {
        $this->admin = User::find(auth('web')->id());
        $this->name = $this->admin->name;
        $this->username = $this->admin->username;
        $this->email = $this->admin->email;
        $this->biography = $this->admin->biography;
    }
    public function UpdateDetails()
    {
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users,username,' . auth('web')->id()
        ]);

        User::where('id', auth('web')->id())->update([
            'name' => $this->name,
            'username' => $this->username,
            'biography' => $this->biography

        ]);

        $this->emit('updateAdminProfileHeader');
        $this->emit('updateTopHeader');

        $this->showToastr('Your profile has been updated successfuly','success');
    }
    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=> $type,
            'message'=> $message
        ]);
    }
    public function render()
    {
        return view('livewire.back.admin-personal-detail');
    }
}
