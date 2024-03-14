@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'sejarah-sekolah')

@section('content')

<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="row">
                    @forelse ($posts as $item)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <article class="card article-card">
                                <a href="">
                                    <div class="card-image">
                                        <div class="post-info">
                                            <span
                                                class="text-uppercase">{{date_formatter($item->created_at)}}</span>
                                            <span
                                                class="text-uppercase">{{readDuration($item->post_title, $item->post_content) }} @choice('min|mins',
                                                readDuration($item->post_title, $item->post_content)) read
                                            </span>
                                        </div>
                                        <img loading="lazy" decoding="async"
                                            src="/storage/images/post_images/thumbnails/resized_{{$item->featured_image}}"
                                            class="w-100" alt="{{$item->post_title}}">
                                    </div>
                                </a>
                                <div class="card-body px-0 pb-1">
                                    <ul class="post-meta mb-2">

                                        <li>
                                            <a
                                                href="{{ route('category_post',$item->subcategory->slug) }}">{{$item->subcategory->subcategory_name}}</a>
                                        </li>

                                    </ul>
                                    <h5 class="">
                                        <a class="post-title"
                                            href="{{ route('read_post',$item->slug) }}">
                                            {{$item->post_title}}
                                        </a>
                                    </h5>
                                    <p class="card-text">{!!Str::ucfirst(words($item->post_content, 20))!!}</p>
                                    <div class="content float-right"> <a class="btn btn-outline-primary btn-rounded btn-sm"
                                            href="{{ route('read_post',$item->slug) }}">Read Full
                                            Article</a>
                                    </div>
                                    <div class="content float-left">
                                        <p class="card-text"><small class="text-muted">{{date_formatter($item->created_at)}} -
                                            <i class="fa fa-eye"></i> {{ views($item)->count()}} kali</small></p>
                                    </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    @empty
                    <span class="text-danger">Posts not found.</span>
                    @endforelse
                </div>
                <div class="blog-pagination mb-3">
                    <ul class="justify-content-center">
                        <style>
                            .page-item.active .page-link{
                                background-color: #15477A;
                                border-color :#15477A;
                            }
                        </style>
                        {{$posts->appends(request()->input())->links('vendor.pagination.bootstrap-4')}}
                    </ul>
                </div>
            </div>
            <!-- End blog entries list -->


            <!-- End blog sidebar -->
            <div class="col-md-4 sid">
                @livewire('front.component-side')
                <div class="card mt-3">
                    <div class="card-header" style="background-color:
                            #15477A;color: #fff;">
                        Recommended
                    </div>
                    <div class="card-body">
                        @if (recommended_post() )
                        @foreach (recommended_post() as $item)

                        <div class="media">
                            <img src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}"
                                class="mr-3" alt="{{$item->post_title}}" style="max-width: 80px;">
                            <div class="media-body recent">
                                <h5 class="mt-0"><a href="">{{$item->post_title}}</a></h5>
                                <h6>{!!Str::ucfirst(words($item->post_content, 10))!!}</h6>
                            </div>
                        </div>
                        @endforeach

                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

@endsection
