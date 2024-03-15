<div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" placeholder="Search..." wire:model='search'>
        </div>
        <div class="col-md-2 mb-3">
            <div class="input-group">
                <button type="button" class="btn dropdown-toggle btn-bitbucket" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Bulk Action
                </button>
                <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 38px);">
                  <a class="dropdown-item" href="#" wire:click.prevent="exportCsv">
                    Export csv
                  </a>
                  <a class="dropdown-item" href="#" wire:click.prevent="exportXlsx">
                    Export xls
                  </a>
                  <a class="dropdown-item" href="{{ route('admin.alumniexport-pdf') }}" >
                    Export pdf
                  </a>
                </div>
              </div>
        </div>
        <div class="col-md-2 mb-3">
            @if ($checkedAlumni)
            <button type="button" class="btn btn-danger" wire:click="deleteSelectedAlumni()">Delete ALL {{
                count($checkedAlumni)
                }}</button>
            @endif
        </div>
        <div class="col-md-2 mb-3">
                <a href="{{ Route('admin.importForm') }}" class="btn btn-bitbucket">
                    Import Alumni
                </a>
        </div>
    </div>
    <div class="col-md-12 mb-2">
        <div class="card card-box">
            <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a class="btn btn-success " href="{{ route('admin.add-alumni') }}">Add New Alumnis</a>
                        </div>
                    </div>
            </div>
            <div class="card-body" id="AllAlumni">
                <div class="table-responsive">
                    <div class="d-flex">
                        <div class="text-muted">
                          Show
                          <div class="mx-2 d-inline-block">
                              <select wire:model.live='perPage' >
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
                                <th scope="col">NIS</th>
                                <th scope="col">Tahun Lulus</th>
                                <th scope="col">Publikasi</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alumnis as $e=>$alumni)
                            <tr class="{{ $this->isChecked($alumni->id) }}">
                                <td>
                                    <input type="checkbox" wire:model="checkedAlumni" value="{{ $alumni->id }}">
                                </td>
                                <td>{{ $e+1 }}</td>
                                <td>{{ $alumni->name }}</td>
                                <td>{{ $alumni->nis }}</td>
                                <td>{{ $alumni->thn_lulus }}</th>
                                <td>
                                    @livewire('back.alumni-status', ['model' => $alumni, 'field' => 'isActive'],
                                    key($alumni->id))
                                </td>
                                <td>
                                    <a href="{{ route('admin.edit-alumni',['alumni_id'=>$alumni->id]) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <a href="#" type="button" class="btn btn-sm btn-info mx-1 editIcon"
                                        data-bs-toggle="modal" data-bs-target="#showAlumniModal{{ $alumni->id }}">
                                        View
                                    </a>
                                    <a wire:click.prevent='deleteAlumni({{$alumni->id}})'
                                        class=" btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <span class="text-danger">Alumni not recods in databases</span>
                            @endforelse
                        </tbody>
                    </table>
                    {{$alumnis->links('livewire-pagination-links')}}
                </div>
            </div>
        </div>
    </div>
    {{-- modasl --}}
    @foreach ($alumnis as $alumni)

    <div class="modal fade" id="showAlumniModal{{ $alumni->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Alumni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>

                    <div class="modal-body p-4 bg-light">
                        <div class="card-body">
                            <dl class="row">
                              <dt class="col-5">Nama Lengkap :</dt>
                              <dd class="col-7">{{ $alumni->name }}</dd>
                              <dt class="col-5">Jenis Kelamin :</dt>
                              <dd class="col-7">{{ $alumni->jenkel }}</dd>
                              <dt class="col-5">Tahun Masuk :</dt>
                              <dd class="col-7">{{ $alumni->thn_masuk }}</dd>
                              <dt class="col-5">Tahun Lulus :</dt>
                              <dd class="col-7">{{ $alumni->thn_lulus }}</dd>
                              <dt class="col-5">NIS :</dt>
                              <dd class="col-7">{{ $alumni->nis }}</dd>
                              <dt class="col-5">Tanggal Lahir :</dt>
                              <dd class="col-7">{{ Illuminate\Support\Carbon::parse( $alumni->tgl_lahir)->translatedFormat('l, d F Y') }}</dd>
                              <dt class="col-5">E-mail :</dt>
                              <dd class="col-7">{{ $alumni->email }}</dd>
                              <dt class="col-5">WhatsAap :</dt>
                              <dd class="col-7">{{ $alumni->telp }}</dd>
                              <dt class="col-5">Alamat :</dt>
                              <dd class="col-7">{{ $alumni->alamat }}</dd>
                              <dt class="col-5">Picture :</dt>
                              <dd class="col-7">
                                <img width="200" src="{{ $alumni->img }}"
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
{{-- @livewire('back.modal-detail-alumni') --}}
@push('scripts')
<script>
    window.addEventListener('deleteAlumni', function(event){
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
                window.Livewire.emit('deleteAlumniAction',event.detail.id)
            }
        });
    });

    window.addEventListener('swal:deleteAlumni', function(event){
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
                window.livewire.emit('deleteCheckedAlumni',event.detail.checkedIDs);
            }
        });
    });
</script>
@endpush
