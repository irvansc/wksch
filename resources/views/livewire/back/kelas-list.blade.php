<div>
    <div class="col-md-6">
        <div class="mb-3">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kelas_modal" type="button">
                Add Kelas
            </a>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-status-start bg-green"></div>
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="header-title">
                            <h2 class="">Kelas</h2>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Kelas Name</th>
                                    <th>N. Of Siswa</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelas as $ke)
                                <tr data-index="{{$ke->id}}">
                                    <td>{{$ke->id}}</td>
                                    <td>{{$ke->kelas_name}}</td>
                                    <td class="text-muted">
                                        {{$ke->siswa->count()}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" wire:click.prevent='editKelas({{$ke->id}})'
                                                class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                            <a href="#" wire:click.prevent='deleteKelas({{$ke->id}})'
                                                class="btn btn-sm btn-danger">Delete</a>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3"><span class="text-danger">Kelas Not Found!</span></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- Modals --}}
    <div wire:ignore.self class="modal fade" id="kelas_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">
                        {{$updateKelasMode ? 'Updated Kelas' : 'Add Kelas'}}
                    </h5>
                </div>
                <form class="modal-content" method="POST" @if ($updateKelasMode) wire:submit.prevent='updateKelas()'
                    @else wire:submit.prevent='addKelas()' @endif>
                    <div class="modal-body">
                        @if ($updateKelasMode)
                        <input type="hidden" wire:model='selected_kelas_id'>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Kelas name</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Enter kelas name" wire:model='kelas_name'>
                            <span class="text-danger">@error('kelas_name')
                                {!!$message!!}
                                @enderror</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning " data-bs-dismiss="modal" aria-hidden="true">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">{{$updateKelasMode ? 'Update':'Save'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
