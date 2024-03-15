<div>
    <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Search..." wire:model='search'>
        </div>
        <div class="col-md-2 mb-3">
            <div class="input-group">
                <button type="button" class="btn dropdown-toggle btn-bitbucket" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                    Bulk Action
                </button>
                <div class="dropdown-menu" data-popper-placement="bottom-start"
                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 38px);">
                    <a class="dropdown-item" href="#" wire:click.prevent="exportCsv">
                        Export csv
                    </a>
                    <a class="dropdown-item" href="#" wire:click.prevent="exportXlsx">
                        Export xls
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.guruexport-pdf') }}">
                        Export pdf
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            @if ($checkedGuru)
            <button class="btn btn-danger" wire:click="deleteSelectedGuru()">Delete ALL {{ count($checkedGuru)
                }}</button>
            @endif
        </div>
        <div class="col-md-2 mb-3">
            <a href="{{ route('admin.import-formguru') }}" class="btn btn-primary">
                Import Guru
            </a>
        </div>
        <div class="col-md-12">
            <div class="card card-box">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a class="btn btn-success " href="{{ route('admin.add-guru') }}">Add New Guru</a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="AllGuru">
                    <div class="table-responsive">
                        <div class="d-flex">
                            <div class="text-muted">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <select wire:model.live='perPage'>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                entries
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                    </th>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">GTK</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gurus as $e=>$guru)
                                <tr class="{{ $this->isChecked($guru->id) }}">
                                    <td>
                                        <input type="checkbox" wire:model="checkedGuru" value="{{ $guru->id }}">
                                    </td>
                                    <td>{{ $e+1 }}</td>
                                    <td>{{ $guru->name }}</td>
                                    <td>{{ $guru->nip }}</td>
                                    <td>{{ $guru->gtk }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit-guru',['guru_id'=>$guru->id]) }}"
                                            class="btn btn-sm btn-warning mx-1">
                                            Edit
                                        </a>
                                        <a href="#" type="button" class="btn btn-sm btn-info mx-1 editIcon"
                                            data-bs-toggle="modal" data-bs-target="#showGuruModal{{ $guru->id }}">
                                          View
                                        </a>
                                        <a wire:click.prevent='deleteGuru({{$guru->id}})'
                                            class=" btn btn-sm btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <span class="text-danger">Guru not recods in databases</span>
                                @endforelse
                            </tbody>
                        </table>
                        {{$gurus->links('livewire-pagination-links')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- modasl --}}
@foreach ($gurus as $guru)

<div class="modal fade" id="showGuruModal{{ $guru->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Guru</h5>
            </div>
            <form>

                <div class="modal-body p-4 bg-light">
                    <div class="card-body">
                        <dl class="row">
                          <dt class="col-5">Nama Lengkap :</dt>
                          <dd class="col-7">{{ $guru->name }}</dd>
                          <dt class="col-5">NIP :</dt>
                          <dd class="col-7">{{ $guru->nip }}</dd>
                          <dt class="col-5">Jenis Kelamin :</dt>
                          <dd class="col-7">
                            @if ($guru->jenkel == 'L')
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                          </dd>
                          <dt class="col-5">Alamat :</dt>
                          <dd class="col-7">{{ $guru->alamat }}</dd>
                          <dt class="col-5">Tanggal Lahir :</dt>
                          <dd class="col-7">{{ Illuminate\Support\Carbon::parse( $guru->tgl_lahir)->translatedFormat('l, d F Y')  }}</dd>
                          <dt class="col-5">GTK :</dt>
                          <dd class="col-7">{{ $guru->gtk }}</dd>
                          <dt class="col-5">Picture :</dt>
                          <dd class="col-7">
                            <img width="200" src="{{ $guru->img }}"
                            alt="" class="img-thumbnail">
                          </dd>
                        </dl>
                      </div>

                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
@push('scripts')
<script>
    window.addEventListener('deleteGuru', function(event){
        swal.fire({
             title:event.detail.title,
            imageWidth:48,
            imageHeight:48,
            html:event.detail.html,
            showCloseButton:true,
            showCancelButton:true,
            confirmButtonText:"Yes, Delete.",
            cancelButtonColor:'#d33',
            confirmButtonColor:'#3085d6',
            width:300,
            allowOutsideClick:false

        }).then(function(result){
            if (result.value) {
                window.Livewire.emit('deleteGuruAction',event.detail.id)
            }
        });
    });

    window.addEventListener('swal:deleteGuru', function(event){
        swal.fire({
            title:event.detail.title,
            html:event.detail.html,
            showCloseButton:true,
            showCancelButton:true,
            cancelButtonText:'No',
            confirmButtonText:'Yes',
            cancelButtonColor:'#d33',
            confirmButtonColor:'#3085d6',
            width:300,
            allowOutsideClick:false
        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteCheckedGuru',event.detail.checkedIDs);
            }
        });
    });
</script>
@endpush
