<div>
    @livewire('front.ppdb-banner')

    <section class="galery-video" id="galery-video">
        <div class="container">
            <div class="section-title">
                <h2>GALERY VIDEO</h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="row">
                        @forelse ($videos as $vid)
                        <div class="col-md-4 mb-3 videos">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $vid->url_video }}"
                                    allowfullscreen="">
                                </iframe>
                            </div>
                        </div>
                        @empty
                        <span class="text-danger">Videos Not found</span>
                        @endforelse


                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
