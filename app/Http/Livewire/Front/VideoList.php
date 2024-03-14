<?php

namespace App\Http\Livewire\Front;

use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;

class VideoList extends Component
{
    use WithPagination;
    public $perPage = 6;
    public function render()
    {

        $videos = Video::orderBy('created_at','desc')->paginate($this->perPage);
        return view('livewire.front.video-list',[
            'videos' => $videos
        ]);
    }
}
