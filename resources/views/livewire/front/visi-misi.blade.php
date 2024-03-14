<div>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>VISI & MISI</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 ">

                    <div class="card  mb-3">
                        <div class="card-body">
                            <div id="accordion">
                                <div class="card">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            VISI
                                        </button>
                                    </h5>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            {!! $visi->visi !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                           MISI
                                        </button>
                                    </h5>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            {!! $visi->misi !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted float-right">{{ date_formatter($visi->created_at) }} - Oleh Administrator</small>
                        </div>
                    </div>
                </div>
                <!-- End blog entries list -->

                    @livewire('front.sidebar-content')
                    <!-- End blog sidebar -->
                    <!-- IKLAN -->
                    {{-- <div class="card  mb-3 mt-3">
                        <a href="#">
                            <img class="card-img-top" src="./assets/img/ami/1.jpg" alt="Card image cap">
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</div>
