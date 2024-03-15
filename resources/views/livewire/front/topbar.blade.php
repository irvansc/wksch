<div>
    <!-- Section topbar -->
 <section id="topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <ul class="top-contact">
                    <marquee scrolldelay="100">
                        <li>
                            <a href=""><i class="fas fa-phone"></i></a> {{ webInfo()->web_telp }}
                        </li>
                        <li>
                            <a href=""><i class="fas fa-envelope"></i></a> {{ webInfo()->web_email }}
                        </li>
                        <li>
                            <a href=""><i class="fa fa-map-marker"></i></a> {{webInfo()->web_alamat}}
                        </li>
                    </marquee>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="sosmed">
                    <li>
                        <a href="{{ webSosmed()->bsm_facebook }}"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="{{ webSosmed()->bsm_instagram }}"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="{{ webSosmed()->bsm_youtube }}"><i class="fab fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="{{ webSosmed()->bsm_twitter }}"><i class="fab fa-twitter"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="brand" style="display: flex; align-items: center">
                    <a href="/">
                        <img src="{{ webLogo()->logo_utama }}" alt="{{webInfo()->web_name }}"
                        style="width: 100px"  />
                    </a>
                    <div class="brand-name">
                        <h1>{{webInfo()->web_name }}</h1>
                        <h3>{{ webInfo()->web_tagline }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pembungkus-searchbox">
                <div class="searchbox">
                    <form method="get" action="#">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" aria-label="searc"
                                aria-describedby="my-addon" />
                            <div class="input-group-append">
                                <button class="btn btn-utama" id="my-addon">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

</div>
