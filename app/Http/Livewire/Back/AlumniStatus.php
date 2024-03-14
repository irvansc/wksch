<?php

namespace App\Http\Livewire\Back;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class AlumniStatus extends Component
{
    public Model $model;

    public $field;

    public $isActive;

    public function mount()
    {
        $this->isActive = (bool) $this->model->getAttribute($this->field);
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
        $this->showToastr('Alumni has been successfuly updated', 'success');

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
        return view('livewire.back.alumni-status');
    }
}
