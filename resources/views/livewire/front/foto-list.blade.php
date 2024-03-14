<div>
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>GALERY FOTO</h2>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div>
                        <select wire:model='album' id="" class="form-control">
                            <option value="">-- ALL foto --</option>
                            @foreach (\App\Models\Album::whereHas('foto')->get() as $al)
                            <option value="{{$al->id}}">{{$al->album_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-5 gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                @forelse ($fotos as $foto)
                  <div class="col-sm-2 col-lg-2 mb-2">
                    <div class="card card-sm">
                      <a href="storage/images/album/foto/{{ $foto->img }}" class="d-block" data-id="{{ $foto->id }}" data-fancybox="gallery" data-caption="{{ $foto->title }}">
                        <img src="storage/images/album/foto/thumbnails/thumb_{{ $foto->img }}" class="card-img-top">
                        </a>
                    </div>
                </div>
                  @empty
                    <span class="text-danger">Not foto fond(s)</span>
                  @endforelse

            </div>
            <div class="row justify-content-center">
                @push('style')
                    <style>
                        .page-link{
                            color: #03294f;
                        }
                        .page-item.active .page-link{
                            background-color: #03294f;
                            color: #ffffff;
                        }
                    </style>
                @endpush
                {{$fotos->links('pagination::bootstrap-4')}}
            </div>
        </div>

    </section>
</div>

@push('style')
<link rel="stylesheet" href="/back/vendor/fancybox/dist/jquery.fancybox.min.css"/>

@endpush
@push('scripts')
<script src="/back/vendor/fancybox/dist/jquery.fancybox.min.js"></script>

<script>
    // Fancybox Config
$('[data-fancybox="gallery"]').fancybox({
  buttons: [
    "slideShow",
    "thumbs",
    "zoom",
    "fullScreen",
    "share",
    "close"
  ],
  loop: false,
  protect: true
});
</script>
@endpush
