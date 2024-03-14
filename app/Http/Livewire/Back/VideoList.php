<?php

namespace App\Http\Livewire\Back;

use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;
use Str;
class VideoList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $title, $url_video;
    public $selected_video_id;
    public $search = null;
    public $updateVideoMode = false;

    public $listeners = [
        'resetModalForm',
        'deleteVideoAction',

    ];
    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->title = null;
        $this->url_video = null;
    }
    public function addVideo()
    {
        $this->validate([
            'url_video' => 'required|unique:videos,url_video',
        ]);
        $video = new Video();
        $video->title = $this->title;
        $video->slug = Str::slug($this->title);
        $video->url_video = $this->url_video;

        $saved = $video->save();

        if ($saved) {
            $this->dispatchBrowserEvent('hideVideoModal');
            $this->title = null;
            $this->url_video = null;
            $this->showToastr('New Video has been successfuly added.', 'success');
        } else {
            $this->showToastr('Something went wrong!', 'error');
        }
    }
    public function editVideo($id)
    {
        $video = Video::findOrFail($id);
        $this->selected_video_id = $video->id;
        $this->title = $video->title;
        $this->url_video = $video->url_video;
        $this->updateVideoMode = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showvideoModal');
    }


    public function updateVideo()
    {
        if ($this->selected_video_id) {
            $this->validate([
                'url_video' => 'required|unique:videos,url_video,' . $this->selected_video_id,
            ]);

            $video = Video::findOrFail($this->selected_video_id);
            $video->title = $this->title;
            $video->slug = Str::slug($this->title);
            $video->url_video = $this->url_video;
            $updated = $video->save();
            if ($updated) {
                $this->dispatchBrowserEvent('hideVideoModal');
                $this->updateVideoMode = false;
                $this->showToastr('Video has been successfuly updated.', 'success');
            } else {
                $this->showToastr('Something went wrong!', 'error');
            }
        }
    }


    public function deleteVideo($id)
    {
        $video = Video::find($id);
        $this->dispatchBrowserEvent('deleteVideo', [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $video->url_video . '</b> video',
            'id' => $id
        ]);
    }

    public function deleteVideoAction($id)
    {
        $video = Video::where('id', $id)->first();
            $video->delete();
            $this->showToastr('Video has been successfuly deleted.', 'info');
    }

    public function updateVideoOrdering($positions)
    {
        foreach ($positions as $p) {
            $index = $p[0];
            $newPosition = $p[1];
            Video::where('id', $index)->update([
                'ordering' => $newPosition,
            ]);

            $this->showToastr('Video ordering has been successfuly updated.','success');
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
        $videos = Video::search($this->search)
        ->orderBy('ordering','desc')->
        paginate($this->perPage);
        return view('livewire.back.video-list',[
            'videos' => $videos,
        ]);
    }
}
