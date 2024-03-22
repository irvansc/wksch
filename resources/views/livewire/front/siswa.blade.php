
        <div>
            @livewire('front.ppdb-banner')
            <section id="guru" class="guru">
                <div class="container">
                    <div class="section-title">
                        <h2>DIREKTORI SISWA</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="row">
                            <div class="col-md-6 mb-4 profile-alumni">
                                <input type="text" class="form-control" placeholder="Search..." wire:model='search'>
                            </div>
                            <div class="col-md-6 mb-4 profile-alumni">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-muted">
                                            Show
                                            <div class="mx-2 d-inline-block">
                                                <select wire:model.live='perPage' class="form-control">
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
                                    <div class="col-md-6">
                                        <div class="">
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
                        </div>
                        <div class="row">
                            @forelse ($siswas as $siswa)
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">
                                  <img src="/back/dist/img/direktori/bg-alumni.png" alt="Cover" class="card-img-top">
                                  <div class="card-body text-center">
                                    <img src="{{ $siswa->img }}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                    <h5 class="card-title">{{ $siswa->name }}</h5>
                                    <p class="text-secondary mb-1">Kelas : {{ $siswa->kelas->kelas_name }}</p>
                                  </div>
                                  <div class="card-footer">
                                    <a style="background-color: #03294f; color: #fff"
                                    class="btn btn-sm has-icon btn-block" type="button"
                                    data-toggle="modal" data-target="#show{{ $siswa->id }}"
                                    >
                                    <i class="fas fa-eye"></i>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            @empty
                                <span class="text-danger">Siswa Not found</span>
                            @endforelse


                        </div>
                    </div>
                    <div class="row justify-content-center">
                        @push('style')
                            <style>
                                .page-link{
                                    color: #03294f;
                                }
                                .page-item.active .page-link{
                                    background-color: #03294f;
                                    color: #ffffff;
                                }
                            </style>
                        @endpush
                        {{$siswas->links('pagination::bootstrap-4')}}
                    </div>
                </div>

            </section>

            @foreach ($siswas as $s)

            <div class="modal fade" id="show{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <button type="button" class="btn btn-dark" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


