<?php

namespace App\Http\Livewire\Back;

use App\Models\User;
use Livewire\Component;

class AdminProfileHeader extends Component
{
    public $admin;

    protected $listeners = [
       'updateAdminProfileHeader'=>'$refresh'
    ];

   public function mount()
   {
      $this->admin = User::find(auth('web')->id());
   }
    public function render()
    {
        return view('livewire.back.admin-profile-header');
    }
}
