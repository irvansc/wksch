<div>
    <section id="guru" class="guru">
        <div class="container">
            <div class="section-title">
                <h2>DIREKTORI ALUMNI</h2>
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
                    @forelse ($alumnis as $alumni)
                    <div class="col-md-3 mb-3">
                        <div class="card shadow-sm">
                          <img src="/back/dist/img/direktori/bg-alumni.png" alt="Cover" class="card-img-top">
                          <div class="card-body text-center">
                            <img src="{{ $alumni->img }}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                            <h5 class="card-title">{{ $alumni->name }}</h5>
                            <p class="text-secondary mb-1">Alumni : {{ $alumni->thn_lulus }}</p>
                          </div>
                          <div class="card-footer">
                            <a style="background-color: #03294f; color: #fff"
                            class="btn btn-sm has-icon btn-block" type="button"
                            data-toggle="modal" data-target="#show{{ $alumni->id }}"
                            >
                            <i class="fas fa-eye"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    @empty
                        <span class="text-danger">Alumni Not found</span>
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
                {{$alumnis->links('pagination::bootstrap-4')}}
            </div>
        </div>

    </section>

    @foreach ($alumnis as $alumni)

    <div class="modal fade" id="show{{ $alumni->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                              <dd class="col-7">{{ $alumni->tgl_lahir }}</dd>
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
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
