<?php

namespace App\Http\Livewire\Back;

use App\Models\SocialMedia;
use Livewire\Component;

class AdminSocialMediaForm extends Component
{
    public $blog_social_media;

    public $bsm_facebook, $bsm_instagram, $bsm_youtube, $bsm_web, $bsm_twitter;

    public function mount()
    {
        $this->blog_social_media = SocialMedia::find(1);
        $this->bsm_facebook = $this->blog_social_media->bsm_facebook;
        $this->bsm_instagram = $this->blog_social_media->bsm_instagram;
        $this->bsm_youtube = $this->blog_social_media->bsm_youtube;
        $this->bsm_twitter = $this->blog_social_media->bsm_twitter;
        $this->bsm_web = $this->blog_social_media->bsm_web;
    }
    public function UpdateBlogSocialMedia()
    {

        $update = $this->blog_social_media->update([
            'bsm_facebook' => $this->bsm_facebook,
            'bsm_instagram' => $this->bsm_instagram,
            'bsm_youtube' => $this->bsm_youtube,
            'bsm_twitter' => $this->bsm_twitter,
            'bsm_web' => $this->bsm_web,
        ]);
        if ($update) {
            $this->showToastr('Social media has been successfuly updated.', 'success');
        } else {
            $this->showToastr('Something Wrong!', 'error');
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
        return view('livewire.back.admin-social-media-form');
    }
}
