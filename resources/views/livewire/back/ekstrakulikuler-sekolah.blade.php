<div>
    <div class="row mt-3">
        <div class="col-md-6 mb-2">
            <div class="card card-box">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="text-muted">
                            <div class="mx-2 d-inline-block">
                                <div class="">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#ekstrakulikuler_modal" type="button">
                                        Add Ekstrakulikuler
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>Ekstrakulikuler Name</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody id="sortable_ekstrakulikuler">
                                @forelse ($ekstrakulikulers as $ekstrakulikuler)
                                <tr data-index="{{$ekstrakulikuler->id}}">
                                    <td>{{$ekstrakulikuler->ekstrakulikuler_name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#"
                                                wire:click.prevent='editEkstrakulikuler({{$ekstrakulikuler->id}})'
                                                class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                            <a href="#"
                                                wire:click.prevent='deleteEkstrakulikuler({{$ekstrakulikuler->id}})'
                                                class="btn btn-sm btn-danger">Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3"><span class="text-danger">Ekstrakulikuler Not Found!</span></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- BASE --}}
        <div class="col-md-6 mb-2">
            <div class="card card-box">
                <div class="card-header">
                    <div class="clearfix">
                        <div class="pull-left">Ekstrakulikuler Sekolah</div>

                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" wire:submit.prevent='UpdateEkstrakulikulerSekolah()'>
                        <div class="row">
                            <div class="mb-3">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Judul..." wire:model='title'>
                                <span class="text-danger">@error('title')
                                    {!!$message!!}
                                    @enderror</span>
                            </div>
                            <div class="mb-3" wire:ignore>
                                <label for="">Deskripsi</label>
                                <textarea id="description" class="form-control" name="description"
                                    wire:model='description'>
                                        {{  $description  }}
                                        </textarea>
                                @error('description')
                                <span class="text-danger">
                                    {!!$message!!}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- Modals --}}
    <div wire:ignore.self  class="modal modal-blur fade" id="ekstrakulikuler_modal" tabindex="-1" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">
                        {{$updateEkstrakulikulerMode ? 'Updated Ekstrakulikuler' : 'Add Ekstrakulikuler'}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-content" method="POST" @if ($updateEkstrakulikulerMode)
                    wire:submit.prevent='updateEkstrakulikuler()' @else wire:submit.prevent='addEkstrakulikuler()'
                    @endif>
                    <div class="modal-body">
                        @if ($updateEkstrakulikulerMode)
                        <input type="hidden" wire:model='selected_ekstrakulikuler_id'>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Ekstrakulikuler name</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter Ekstrakulikuler name" wire:model='ekstrakulikuler_name'>
                            <span class="text-danger">@error('ekstrakulikuler_name')
                                {!!$message!!}
                                @enderror</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{$updateEkstrakulikulerMode ?
                            'Update':'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
