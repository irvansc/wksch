<div>

    <div class="row mt-3">
        <div class="col-md-8 mb-2">
            <div class="card card-box">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <h4>Pengumuman</h4>
                        <li class="nav-item ms-auto">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.add-pengumuman') }}">
                                Add Pengumuman
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat:</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengumumans as $e=>$pengumuman)
                                <tr data-index="{{$pengumuman->id}}">
                                    <td>{{ $e+1 }}</td>
                                    <td>{{$pengumuman->title}}</td>
                                    <td>{!! Str::limit($pengumuman->description, 20, '...')!!}</td>
                                    <td>{{$pengumuman->created_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.edit-pengumuman',['pengumuman_id'=>$pengumuman->id]) }}"
                                                class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                            <a href="#" wire:click.prevent='deletePengumuman({{$pengumuman->id}})'
                                                class="btn btn-sm btn-danger">Delete</a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#view{{$pengumuman->id  }}"
                                                class="btn btn-sm btn-success" style="margin-left: 3px">View</a>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4"><span class="text-danger">Pengumuman Not Found!</span></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row mt-4">
                            {{$pengumumans->links('livewire::bootstrap')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modals --}}
    @foreach ($pengumumans as $pengumuman)
    <div class="modal modal-blur fade" id="view{{ $pengumuman->id }}" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-5">Title :</dt>
                            <dd class="col-7">{{ $pengumuman->title }}</dd>
                            <dt class="col-5">Pengumuman :</dt>
                            <dd class="col-7">{!! $pengumuman->description !!}</dd>
                            <dt class="col-5">Dibuat :</dt>
                            <dd class="col-7">{{ $pengumuman->created_at }}</dd>
                            <dt class="col-5">Diperbarui :</dt>
                            <dd class="col-7">{{ $pengumuman->updated_at }}</dd>

                        </dl>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
