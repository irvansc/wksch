<div>
    @livewire('front.ppdb-banner')
      <!-- ======= Blog Section ======= -->
      <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="row">

                        <div class="card mb-3">
                            <article class="card article-card">
                                <a href="">
                                    <div class="card-image">
                                        <div class="post-info">
                                            <span class="text-uppercase">{{date_formatter(single_latest_post()->created_at)}}</span>
                                            <span class="text-uppercase">{{readDuration(single_latest_post()->post_title,
                                                single_latest_post()->post_content) }} @choice('min|mins',
                                                readDuration(single_latest_post()->post_title, single_latest_post()->post_content))
                                                read
                                                </span>
                                        </div>
                                        <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/resized_{{single_latest_post()->featured_image}}"
                                         class="w-100" alt="{{single_latest_post()->post_title}}">
                                    </div>
                                </a>
                                <div class="card-body px-0 pb-1">
                                    <ul class="post-meta mb-2">

                                        <li>
                                            <a href="{{ route('category_post',single_latest_post()->subcategory->slug) }}">{{single_latest_post()->subcategory->subcategory_name}}</a>
                                        </li>

                                    </ul>
                                    <h5 class="">
                                        <a class="post-title" href="{{ route('read_post', single_latest_post()->slug) }}">
                                            {{single_latest_post()->post_title}}
                                        </a></h5>
                                    <p class="card-text">{!!Str::ucfirst(words(single_latest_post()->post_content, 35))!!}</p>
                                    <div class="content float-right"> <a class="btn btn-outline-primary btn-rounded" href="{{ route('read_post', single_latest_post()->slug) }}">Read Full Article</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @foreach (lates_home_5post() as $item)
                        <div class="card mb-3">
                           <div class="container">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="/storage/images/post_images/thumbnails/resized_{{$item->featured_image}}" class="card-img" alt="{{$item->post_title}}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{ route('read_post',$item->slug) }}">{{$item->post_title}}</a></h5>
                                        <p class="card-text">{!!Str::ucfirst(words($item->post_content, 20))!!}
                                        </p>
                                        <p class="card-text"><small class="text-muted">{{date_formatter($item->created_at)}} - Oleh Administrator -
                                                <i class="fa fa-eye"></i> {{ views($item)->count() }} views</small></p>
                                    </div>
                                </div>
                            </div>
                           </div>
                        </div>
                    @endforeach


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
                                <img src="/storage/images/post_images/thumbnails/thumb_{{$item->featured_image}}" class="mr-3" alt="{{$item->post_title}}" style="max-width: 80px;">
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
    <!-- End Blog Section -->
</div>
