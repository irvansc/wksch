<div >
    @livewire('front.ppdb-banner')
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>ABOUT</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 ">

                    <div class="card rounded-0 border border-secondary mb-3">
                        <div class="card-body">
                            <p class="card-text">
                                {!! kepSek()->desc !!}
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted float-right">{{ date_formatter(kepSek()->created_at) }} - Oleh Administrator</small>
                        </div>
                    </div>
                </div>
                <!-- End blog entries list -->

                    @livewire('front.sidebar-content')
            </div>
        </div>
    </section>
</div>


