<div>
   <!-- hero -->

<section id="hero-area">
    <div id="slider-hero-nav"></div>
    <div class="owl-carousel" id="slider-hero">
    @foreach ($su as $slider)

        <div class="slider-item">
            <div class="slider-item-img">
                <img src="storage/images/album/slider/{{ $slider->img }}" alt="" />
            </div>
            @if ($slider->title != null)
            <div class="slider-item-content">
                <h2>{!! $slider->desc !!}</h2>
                <p>{{ $slider->title }}</p>
                @if ($slider->action != null)
                <a href="{{ $slider->action }}" class="btn btn-utama">{{ $slider->action_title }}</a>
                @else

                @endif
            </div>
                @else

                @endif

        </div>
    @endforeach

        <!--slider item-->
    </div>
</section>

<!-- video -->
<section id="sambutan">
    <div class="container-md">
        <div class="row">
            <div class="col-md-6">
                <div class="video-wrapper">
                    <div class="embed-responsive embed-responsive-16by9">
                        @if ($kepala->url_video == null)
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/mCaMibzEtrI?si=cNnQJwrxMMZojoTa"></iframe>
                        @else
                        <iframe class="embed-responsive-item" src="{{ $kepala->video_url }}"></iframe>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <h2>Sambutan Kepala Sekolah</h2>
                <p>
                    {!! Str::limit($kepala->desc, 200, '...') !!}
                </p>
                <a href="{{ route('about') }}" class="btn btn-utamar" style="margin-top: 30px;">Read More</a>
            </div>
        </div>
    </div>
</section>
<!-- END video -->
<section id="counts" class="counts">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #f2c808;"></i>
                    <div>
                        <span class="counter" data-count-start="0" data-count-end="{{ $guru }}" data-speed="10">{{ $guru }}</span>
                        <p>Guru & Tendik</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #f2c808;"></i>
                    <div>
                        <span class="counter" data-count-start="0" data-count-end="{{ $guru }}" data-speed="10">{{ $siswa }}</span>
                        <p>Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #f2c808;"></i>
                    <div>
                        <span class="counter" data-count-start="0" data-count-end="{{ $siswi }}" data-speed="10">{{ $siswi }}</span>
                        <p>Siswi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #f2c808;"></i>
                    <div>
                        <span class="counter" data-count-start="0" data-count-end="{{ $alumni }}" data-speed="10">{{ $alumni }}</span>
                        <p>Alumni</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="hero-pres">
    <div id="slider-tools-4"></div>
    <div class="container">
        <div class="section-title">
            <h2>PRESTASI</h2>
        </div>
        <div id="sync1" class="owl-carousel">
            @foreach ($sp as $item)
            <div class="item">
                <div class="item-img">
                    <img src="storage/images/album/slider/prestasi/{{ $item->img }}" alt="" />
                </div>

                @if ($item->desc == null)

                @else
                <div class="item-content">
                    <h2>{{ $item->desc }}</h2>
                   @if ($item->action == null)

                   @else
                   <a href="{{ $item->action }}" class="btn btn-utamar">{{ $item->action_title }}</a>
                   @endif
                </div>
                @endif
            </div>
            @endforeach

        </div>
        <div class="tombol-selengkapnya mt-3">
            <a href="" class="btn btn-more">Lihat Prestasi Lainnya</a>
        </div>
    </div>
</section>
<!-- EKSTRAKULIKULER -->

<section id="features" class="features">

    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>EKSTRAKULIKULER</h2>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <img src="{{ asset('front/assets/img/features.png') }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                <div class="row align-self-center gy-4">
@foreach ($ekstra as $item)

                    <div class="col-md-6 aos-init aos-animate" data-aos="zoom-out" data-aos-delay="200">
                        <div class="feature-box d-flex align-items-center">
                            <i class="bi bi-check"></i>
                            <h3>{{ $item->ekstrakulikuler_name }}</h3>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div> <!-- / row -->

    </div>

</section>
<!-- END SEKSTRAKULIKULER -->

<!-- SECTION PDDK -->

<section id="pendidik" style="margin-top: 10px">
    <div class="card_wrapper">
        <div class="container">
            <div class="section-title" style="margin-top: 10px;">
                <h2>Tenaga Pendidik</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel slider_carousel">
                        @foreach ($gurus as $guru)

                        <div class="card_box">
                            <img class="img-fluid w-100" src="{{ $guru->img }}" alt="">
                            <div class="card_text">
                                <h4>{{ $guru->name }}</h4>
                                <p>{{ $guru->gtk }}</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- END SECTION PDDK -->

<!-- TESTIMONIALS -->
<section class="testimonials">
    <div class="container">
        <div class="section-title">
            <h2>KATA ALUMNI</h2>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div id="customers-testimonials" class="owl-carousel">

                    <!--TESTIMONIAL 1 -->
                    @foreach ($alumnis as $item)

                    <div class="item">
                        <div class="shadow-effect">
                            <img class="img-circle"
                                src="{{ $item->img }}" alt="">
                            <p>
                                {{$item->desc}}
                            </p>
                        </div>
                        <div class="testimonial-name">{{ $item->name }}</div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- END OF TESTIMONIALS -->

<!-- section GALERY -->
<section>
    <div class="container com-sp">

        <div class="row">
            <div class="col-md-4">
                <div class="bot-gal h-gal ho-event-mob-bot-sp">
                    <h4>Photo Gallery</h4>
                    <ul>
                        @foreach ($fotos->take(6) as $foto)

                        <a href="storage/images/album/foto/{{ $foto->img }}" data-lightbox="models"
                            data-title="{{ $foto->title }}">
                            <li><img src="storage/images/album/foto/thumbnails/thumb_{{ $foto->img }}" alt="">
                            </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bot-gal h-vid ho-event-mob-bot-sp">
                    <h4>Video Gallery</h4>
                    @foreach ($videos as $item)

                    <iframe src="{{ $item->url_video }}"
                        allowfullscreen></iframe>
                        @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-3 mb-3">

                    <div class="card-header" style="background-color: #15477a; color: #fff">
                        Recent Post
                    </div>
                    <div class="card-body">
                        @foreach (lates_home_5post() as $item )
                        <div class="media">
                            <img src="/storage/images/post_images/thumbnails/resized_{{$item->featured_image}}"
                            class="mr-3" alt="{{ $item->post_title }}" style="max-width: 80px" />
                            <div class="media-body recent">
                                <h5 class="mt-0"><a href="{{ route('read_post', $item->slug) }}">{{ Str::limit($item->post_title, 25, '...') }}</a></h5>
                                <h6>
                                    {!! Str::limit($item->post_content, 30, '...') !!}
                                </h6>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION GALERY  -->
</div>
