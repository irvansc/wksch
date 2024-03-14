<div>
    <form method="POST" wire:submit.prevent='UpdateBlogSocialMedia()'>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Facebook</label>
                    <input type="text" class="form-control" placeholder="Facebook page url" wire:model='bsm_facebook'>
                    <span class="text-danger">@error('bsm_facebook')
                        {!!$message!!}
                        @enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Instagram</label>
                    <input type="text" class="form-control" placeholder="Instagram url" wire:model='bsm_instagram'>
                    <span class="text-danger">@error('bsm_instagram')
                        {!!$message!!}
                        @enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Youtube</label>
                    <input type="text" class="form-control" placeholder="Youtube url" wire:model='bsm_youtube'>
                    <span class="text-danger">@error('bsm_youtube')
                        {!!$message!!}
                        @enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Twitter</label>
                    <input type="text" class="form-control" placeholder="Twitter url" wire:model='bsm_twitter'>
                    <span class="text-danger">@error('bsm_twitter')
                        {!!$message!!}
                        @enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Web</label>
                    <input type="text" class="form-control" placeholder="web url" wire:model='bsm_web'>
                    <span class="text-danger">@error('bsm_web')
                        {!!$message!!}
                        @enderror</span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
