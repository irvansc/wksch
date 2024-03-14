<div>
    <form wire:submit.prevent='addPengumuman()' method="post">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Pengumuman Title</label>
                            <input type="text" class="form-control @error('title')
                                is-invalid
                            @enderror" wire:model='title' placeholder="Enter pengumuman title">
                            @error('title')
                            <span class="invalid-feedback">
                                    {{ $message }}
                             </span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pengumuman Content</label>
                            <textarea wire:ignore class=" form-control @error('description')
                            is-invalid
                        @enderror" name="description"
                                id="description" wire:model='description'>
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback">
                                    {{ $message }}
                             </span>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save</span>
                            <span wire:loading>Saving..</span>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </form>
</div>
@push('stylesheets')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@endpush

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
