    <div class="col-md-4 sid">
        <div class="card mb-3 mt-3">
            <img class="card-img-top" src="{{ kepSek()->img }}" alt="{{ kepSek()->name }}">
            <div class="card-body">
                <h5 class="card-title text-center text-uppercase">{{ kepSek()->name }}</h5>
                <p class="card-text text-center mt-0 text-muted">- Kepala Sekolah -</p>
                <p class="card-text text-justify">Selamat datang di website {{ webInfo()->web_name }}</p>
            </div>
            <div class="card-footer text-center">
                <small class="text-muted text-uppercase"><a href="/"
                        class="btn btn-utama">Selengkapnya</a></small>
            </div>
        </div>
        <div class="card mt-3">
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
