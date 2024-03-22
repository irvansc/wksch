<div>
    <div>
        @livewire('front.ppdb-banner')
        <section id="guru" class="guru">
            <div class="container">
                <div class="section-title">
                    <h2>DIREKTORI GURU</h2>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="row">
                        <div class="col-md-6 mb-4 profile-alumni">
                            <input type="text" class="form-control" placeholder="Search..." wire:model='search'>
                        </div>
                        <div class="col-md-6 mb-4 profile-alumni">
                            <div class="d-flex">
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
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($gurus as $guru)
                        <div class="col-md-3 mb-3">
                            <div class="card shadow-sm">
                              <img src="/back/dist/img/direktori/bg-alumni.png" alt="Cover" class="card-img-top">
                              <div class="card-body text-center">
                                <img src="{{ $guru->img }}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                <h5 class="card-title">{{ $guru->name }}</h5>
                                <p class="text-secondary mb-1">Guru : {{ $guru->gtk }}</p>
                              </div>
                              <div class="card-footer">
                                <a style="background-color: #03294f; color: #fff"
                                class="btn btn-sm has-icon btn-block" type="button"
                                data-toggle="modal" data-target="#show{{ $guru->id }}"
                                >
                                <i class="fas fa-eye"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        @empty
                            <span class="text-danger">Guru Not found</span>
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
                    {{$gurus->links('pagination::bootstrap-4')}}
                </div>
            </div>

        </section>

        @foreach ($gurus as $guru)

        <div class="modal fade" id="show{{ $guru->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Alumni</h5>
                    </div>
                    <form>

                        <div class="modal-body p-4 bg-light">
                            <div class="card-body">
                                <dl class="row">
                                  <dt class="col-5">Nama Lengkap :</dt>
                                  <dd class="col-7">{{ $guru->name }}</dd>
                                  <dt class="col-5">Jenis Kelamin :</dt>
                                  <dd class="col-7">{{ $guru->jenkel }}</dd>
                                  <dt class="col-5">NIP :</dt>
                                  <dd class="col-7">{{ $guru->nip }}</dd>
                                  <dt class="col-5">Tanggal Lahir :</dt>
                                  <dd class="col-7">{{ $guru->tgl_lahir }}</dd>
                                  <dt class="col-5">Alamat :</dt>
                                  <dd class="col-7">{{ $guru->alamat }}</dd>
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
                        <button type="button" class="btn btn-dark" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
