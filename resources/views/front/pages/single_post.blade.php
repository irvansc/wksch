@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'wkng-school')

@push('meta')
{!! SEO::generate() !!}
@endpush
@section('content')

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                <article class="entry entry-single">

                    <div class="entry-img">
                        <img src="/storage/images/post_images/{{$posts->featured_image}}" alt="{{ $posts->post_title }}"
                            class="img-fluid">
                    </div>

                    <h2 class="entry-title">
                        <a href="blog-single.html">{{ $posts->post_title }}</a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi
                    bi-person"></i> <a href="blog-single.html">{{ $posts->author->name }}</a></li>
                            <li class="d-flex align-items-center"><i class="bi
                    bi-clock"></i> <a href="blog-single.html"><time
                                        datetime="2020-01-01">{{date_formatter($posts->created_at)}}</time></a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="bi bi-eye">
                                    <a>{{ views($posts)->count() }} views</a>
                                </i>
                            </li>
                        </ul>
                    </div>

                    <div class="entry-content">
                        {!! $posts->post_content !!}
                    </div>

                    <div class="entry-footer">
                        <i class="bi bi-folder"></i>
                        <ul class="cats">
                            <li><a
                                    href="{{ route('category_post',$posts->subcategory->slug) }}">{{$posts->subcategory->subcategory_name}}</a>
                            </li>
                        </ul>
                        @if ($posts->post_tags)
                        @php
                        $tagsString =$posts->post_tags;
                        $tagsArray = explode(',',$tagsString);
                        @endphp
                        <i class="bi bi-tags"></i>
                        <ul class="tags">
                            @foreach ($tagsArray as $tag)
                            <li><a href="{{ route('tag_post',$tag) }}">#{{$tag}}</a></li>
                            @endforeach

                        </ul>
                        @endif

                    </div>

                </article>
                <div class="mt-5">
                    <div id="disqus_thread"></div>
                    <script>
                        var disqus_config = function() {
                            this.page.url = "{{route('read_post',$posts->slug)}}"; // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = "{{$posts->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document
                                , s = d.createElement('script');
                            s.src = 'https://larablog-site-8.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();

                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
            <div class="col-md-4 sid">
                @livewire('front.component-side')
                <div class="card mt-3">
                    <div class="card-header" style="background-color:
                            #15477A;color: #fff;">
                        Related posts
                    </div>
                    <div class="card-body">
                        @if (count($related_post) > 0)
                        @foreach ($related_post as $item )

                        <div class="media">
                            <img src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}"
                                class="mr-3" alt="{{$item->post_title}}" style="max-width: 80px;">
                            <div class="media-body recent">
                                <h5 class="mt-0"><a
                                        href="{{ route('read_post', $item->slug) }}">{{$item->post_title}}</a></h5>
                                <h6>{!!Str::ucfirst(words($item->post_content, 10))!!}</h6>
                            </div>
                        </div>
                        @endforeach

                        @endif
                    </div>
                </div>
            </div>
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
        , url: "{{route('read_post', $posts->slug)}}"
    });

</script>
@endpush
