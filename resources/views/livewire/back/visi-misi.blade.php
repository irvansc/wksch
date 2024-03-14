<div>
    <form method="POST" wire:submit.prevent='UpdateVisiMisi()'>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <div wire:ignore>
                                <textarea id="visi"
                                wire:model="visi"
                                class="form-control" name="visi">
                                {{  $visi  }}
                                </textarea>
                            </div>
                            <span class="text-danger error-text visi_error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Misi</label>
                            <div wire:ignore>
                                <textarea id="misi"
                                wire:model="misi"
                                 class="form-control" name="misi">
                                {{  $misi  }}
                                </textarea>
                            </div>
                            <span class="text-danger error-text misi_error"></span>
                        </div>
                        <button type="submit" id="my-submit" class="btn btn-primary">Save</button>
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
        .create(document.querySelector('#visi'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('visi', editor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#misi'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('misi', editor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
