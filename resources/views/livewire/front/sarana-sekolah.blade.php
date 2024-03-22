<div>
    @livewire('front.ppdb-banner')
   <!-- content -->
   <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Sarana Prasarana</h2>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card rounded-0 border border-secondary mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Sarana Prasarana</h4>
                        <p class="card-text">{{ $sarana->title }}</p>
                        <p style="text-align: justify">
                            {!! $sarana->description !!}
                        </p>

                    </div>
                    <div class="card-footer">
                        <small class="text-muted float-right">{{ date_formatter($sarana->created_at) }} - Oleh Administrator</small>
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
