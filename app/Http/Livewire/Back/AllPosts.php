<?php

namespace App\Http\Livewire\Back;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search = null;
    public $category = null;
    public $author = null;
    public $orderBy = null;
    protected $listeners = ['deletePostAction'];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCategory()
    {
        $this->resetPage();
    }
    public function updatingAuthor()
    {
        $this->resetPage();
    }
    // public function updatingorderBy() {
    //     $this->resetPage();
    // }
    public function deletePost($id)
    {
        $this->dispatchBrowserEvent('deletePost', [
            'title' => 'Are you sure ?',
            'html' => 'You want to delete this post.',
            'id' => $id
        ]);
    }

    public function deletePostAction($id)
    {
        $post = Post::find($id);
        $path = "images/post_images/";
        $featured_image = $post->featured_image;
        if ($featured_image != null && Storage::disk('public')->exists($path . $featured_image)) {
            # delete resize image
            if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $featured_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/resized_' . $featured_image);
            }
            # delete thumbnails
            if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $featured_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $featured_image);
            }
            # delete post fetaured image
            Storage::disk('public')->delete($path . $featured_image);
        }

        $delete_post = $post->delete();
        if ($delete_post) {
            $this->showToastr('Post has been successfuly deleted!','success' );
        } else {
            $this->showToastr('Something went wrong!','error');
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
        return view('livewire.back.all-posts'
        , [
            'posts' => auth()->user()->type == 1 ?
                Post::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage) :
                Post::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })
                ->where('author_id', auth()->id())
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage)
        ]
    );
    }
}
