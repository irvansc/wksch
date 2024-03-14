@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'wkng-school')


@section('content')

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                <article class="entry entry-single">

                    <h2 class="entry-title" style="font-size: 18px">
                        <a href="{{ route('read_announcement', $pengumuman->slug) }}">{{ $pengumuman->title }}</a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi
                    bi-person"></i> <a href="blog-single.html">Administrator</a></li>
                            <li class="d-flex align-items-center"><i class="bi
                    bi-clock"></i> <a href="blog-single.html"><time
                                        datetime="2020-01-01">{{($pengumuman->created_at)}}</time></a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="bi bi-eye">
                                    <a>{{ views($pengumuman)->count() }} views</a>
                                </i>
                            </li>
                        </ul>
                    </div>

                    <div class="entry-content">
                            {!! $pengumuman->description !!}
                    </div>

                </article>
            </div>
            @livewire('front.sidebar-content')
            <!-- End blog sidebar -->
        </div>
    </div>
</section>
<!-- End Blog Single Section -->

@endsection

@push('style')
<link rel="stylesheet" href="/front/assets/vendor/dist/jquery.floating-social-share.min.css">
@endpush
@push('scripts')
<script src="/front/assets/vendor/dist/jquery.floating-social-share.min.js"></script>
<script>
    $("body").floatingSocialShare({
        buttons: [
            "facebook", "whatsapp", "twitter",
        ]
        , text: "share with:"
        , url: "{{route('read_announcement', $pengumuman->slug)}}"
    });

</script>
@endpush
