<div >
    @livewire('front.ppdb-banner')
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>PRESTASI</h2>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card rounded-0 border border-secondary mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Prestasi</h4>
                            <p class="card-text">{{ $pres->title }}</p>
                            <p style="text-align: justify">
                                {!! $pres->description !!}
                            <table class="table table-bordered table-responsive">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Tingkat</th>
                                        <th scope="col">Juara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestasis as $e=>$pres)
                                    <tr>
                                        <th scope="row">{{ $e+1 }}</th>
                                        <td>{{ $pres->bulan }}</td>
                                        <td>{{ $pres->tahun }}</td>
                                        <td><a href="{{ $pres->link }}">{{ $pres->kegiatan }}</a></td>
                                        <td>{{ $pres->tingkat }}</td>
                                        <td>{{ $pres->juara }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted float-right">{{ date_formatter($pres->created_at) }} - Oleh Administrator</small>
                        </div>
                    </div>
                </div>
                <!-- End blog entries list -->

                <!-- End blog sidebar -->
                @livewire('front.sidebar-content')
            </div>
        </div>
    </section>
    <!-- end content -->
</div>
