<div>
    @livewire('front.ppdb-banner')
    <section id="blog" class="blog">
        <div class="container" >
            <div class="section-title">
                <h2>IDENTITAS SEKOLAH</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 entries" data-aos="fade-up">
                    <div class="content-text">
                        <div id="accordion">
                            <div class="card">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Nama Sekolah
                                    </button>
                                </h5>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        {{ $idse->nama_sekolah }}
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        NSS/NDS/NPSN
                                    </button>
                                </h5>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        {{ $idse->nss }}
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Status
                                    </button>
                                </h5>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        {{ $idse->status }}
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        Nomor Keputusan dan Tanggal:
                                    </button>
                                </h5>
                                <div id="collapse4" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        {{ $idse->nokep }}
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        Luas Area
                                    </button>
                                </h5>
                                <div id="collapse5" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        {{ $idse->luas_area }}
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                        Alamat
                                    </button>
                                </h5>
                                <div id="collapse6" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        {{$idse->alamat}}

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                        Kepala Sekolah
                                    </button>
                                </h5>
                                <div id="collapse7" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <table style="width:100%">
                                            <tr>
                                                <th>Name:</th>
                                                <td>{{ $kepala->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIP:</th>
                                                <td>{{ $kepala->nip }}</td>
                                            </tr>
                                            <tr>
                                                <th>Akreditasi:</th>
                                                <td>{{ $kepala->akreditasi }} </td>
                                            </tr>
                                            <tr>
                                                <th>Sertifikat Internasional:</th>
                                                <td> {{ $kepala->serin }}</td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End blog entries list -->

                @livewire('front.sidebar-content')
                <!-- End blog sidebar -->
            </div>
        </div>
    </section>
</div>
