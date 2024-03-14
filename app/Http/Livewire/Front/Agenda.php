<?php

namespace App\Http\Livewire\Front;

use App\Models\Event;
use Livewire\Component;

class Agenda extends Component
{

    public $events = [];
    public function render()
    {
        $this->events = json_encode(Event::all());
        return view('livewire.front.agenda');
    }
}
