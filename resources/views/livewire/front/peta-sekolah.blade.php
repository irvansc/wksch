<div>
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>PETA SEKOLAH</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card mb-3">
                        <img class="img-thumbnail" src="storage/images/peta_images/{{ $peta->image }}" alt="" />
                        <div class="card-footer">
                            <small class="text-muted float-right">{{ date_formatter($peta->created_at) }} - Oleh Administrator </small>
                        </div>
                    </div>
                </div>
                <!-- End blog entries list -->

                @livewire('front.sidebar-content')
            </div>
        </div>
    </section>

</div>
