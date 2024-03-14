<div>
    <div class="row">
        <div class="row g-2 align-items-center mb-n3">
            <div class="col-8 col-sm-6 col-md-4 col-xl mb-3">
              <div class="btn-group dropdown">
                <button type="button" class="btn  btn-light dropdown-toggle waves-effect" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Export Action <span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                    <button wire:click.prevent="exportCsv" class="dropdown-item" href="#">Export csv</button>
                    <button wire:click.prevent="exportXlsx" class="dropdown-item" href="#">Export xls</button>
                    <a href="{{ route('admin.siswaexport-pdf') }}" class="dropdown-item" href="#">Export pdf</a>
                </div>
            </div>
            </div>
            <div class="col-8 col-sm-6 col-md-4 col-xl mb-3">
              @if ($checkedSiswa)
              <button class="btn  btn-danger" wire:click="deleteSelectedSiswa()">Bulk Delete{{
                  count($checkedSiswa)
                  }}</button>
              @endif
            </div>
            <div class="col-8 col-sm-6 col-md-4 col-xl mb-3">
              <a class="btn  btn-success " href="{{ route('admin.add-siswa') }}">Add New Siswa</a>
            </div>
            <div class="col-8 col-sm-6 col-md-4 col-xl mb-3">
              <a href="{{ route('admin.import-formsiswa') }}" class="btn  btn-primary">
                Import Siswa
            </a>
            </div>
            <div class="col-8 col-sm-6 col-md-4 col-xl mb-3">
                <div class="mb-3">


                  </div>
            </div>

          </div>
        <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <div class="d-flex">
                    <div class="text-muted">
                      <div class="mx-2 d-inline-block">
                        <h3 class="card-title">Siswa</h3>
                      </div>
                    </div>
                    <div class="ms-auto text-muted">
                      <div class="ms-2 d-inline-block">
                        <input type="search" class="form-control" placeholder="Search" wire:model='search'>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-body border-bottom py-3">
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
                  </div>
                  <div class="ms-auto text-muted">
                    <div class="ms-2 d-inline-block">
                        <select wire:model='kelas' class="form-select form-control">
                            <option value="">-- Filter Kelas --</option>
                            @foreach (\App\Models\Kelas::whereHas('siswa')->get() as $kelas)
                            <option value="{{$kelas->id}}">{{$kelas->kelas_name}}</option>
                            @endforeach
                            </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                  <thead>

                    <tr>
                      <th></th>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">NIS</th>
                      <th scope="col">KELAS</th>
                      <th scope="col">Action</th>
                    </tr>

                  </thead>
                  <tbody>
                      @forelse ($siswa as $e=>$ss)
                      <tr>
                      <td>
                        <input type="checkbox" wire:model="checkedSiswa" value="{{ $ss->id }}">
                      </td>
                      <td>{{ $e+1 }}</td>
                      <td>{{ $ss->name }}</td>
                      <td>{{ $ss->nis }}</td>
                      <td>{{ $ss->kelas->kelas_name }}</td>
                      <td >
                            <a href="{{ route('admin.edit-siswa',['siswa_id'=>$ss->id]) }}" class="btn btn-sm btn-warning mx-1">
                              Edit
                            </a>
                            <a href="#" type="button" class="btn btn-sm btn-info mx-1 editIcon" data-bs-toggle="modal"
                              data-bs-target="#showSiswaModal{{ $ss->id }}">
                              View
                            </a>
                            <a wire:click.prevent='deleteSiswa({{$ss->id}})' class=" btn btn-sm btn-danger">
                              Delete
                            </a>
                        </tr>
                      </td>
                      @empty
                      <span class="text-danger">Siswa not recods in databases</span>
                      @endforelse
                  </tbody>
                </table>
                {{$siswa->links('livewire-pagination-links')}}
              </div>

            </div>
          </div>

          {{-- modasl --}}
@foreach ($siswa as $s)

<div class="modal fade" id="showSiswaModal{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Siswa</h5>
            </div>
            <form>

                <div class="modal-body p-4 bg-light">
                    <div class="card-body">
                        <dl class="row">
                          <dt class="col-5">Nama Lengkap :</dt>
                          <dd class="col-7">{{ $s->name }}</dd>
                          <dt class="col-5">Kelas :</dt>
                          <dd class="col-7">{{ $s->kelas->kelas_name }}</dd>
                          <dt class="col-5">Jenis Kelamin :</dt>
                          <dd class="col-7">
                            @if ($s->jenkel == 'L')
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                          </dd>
                          <dt class="col-5">NIS :</dt>
                          <dd class="col-7">{{ $s->nis }}</dd>
                          <dt class="col-5">Tanggal Lahir :</dt>
                          <dd class="col-7">{{ Illuminate\Support\Carbon::parse($s->tgl_lahir)
                                ->translatedFormat('l, d F Y') }}</dd>
                          <dt class="col-5">Alamat :</dt>
                          <dd class="col-7">{{ $s->alamat }}</dd>
                          <dt class="col-5">Picture :</dt>
                          <dd class="col-7">
                            <img width="200" src="{{ $s->img }}"
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
        window.addEventListener('deleteSiswa', function(event){
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
                window.Livewire.emit('deleteSiswaAction',event.detail.id)
            }
        });
    });

    window.addEventListener('swal:deleteSiswa', function(event){
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
                window.livewire.emit('deleteCheckedSiswa',event.detail.checkedIDs);
            }
        });
    });
    </script>
    @endpush
