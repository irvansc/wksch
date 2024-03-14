<div>
    <!-- content -->
    <section id="pengumuman" class="pengumuman">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>PENGUMUMAN</h2>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 ">
                    @forelse ($pengumuman as $item)
                    <div class="card mb-2">
                        <div class="card-header">
                            <i class="bi bi-megaphone"></i>
                            Pengumuman
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                               {!! Str::limit($item->description, 25, '...') !!}
                            </p>

                        </div>
                        <div class="card-footer">
                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href=">Administrator</a></li>
                                <li class=" d-flex align-items-center"><i class="bi bi-clock"></i> <a href=""><time
                                                    datetime="2020-01-01">
                                                    {{ $item->created_at}}
                                                </time></a>
                                    </li>
                                    <li class="d-flex
                                            align-items-center"><i class="bi
                                                bi-eye"></i>
                                        <a href="blog-single.html">{{ views($item)->count() }}
                                            views</a>
                                    </li>
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-utama float-right"><a
                                    href="{{ route('read_announcement', $item->slug) }}">Selengkapnya</a></button>
                        </div>
                    </div>
                    @empty
                    <span class="text-danger">Pengumuman Not found</span>
                    @endforelse

                    <div class="blog-pagination mb-3">
                        <ul class="justify-content-center">
                            <style>
                                .page-item.active .page-link {
                                    background-color: #15477A;
                                    border-color: #15477A;
                                }
                            </style>
                            {{$pengumuman->links('livewire-pagination-links')}}

                        </ul>
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
