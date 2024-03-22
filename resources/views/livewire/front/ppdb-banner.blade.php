<div>
   @if ($ppdb->isActive == 0)
   @else
   <section id="ppdb">
    <div class="container" data-aos="zoom-in">
        <div class="row">
          <a href="{{ $ppdb->action }}"><img class='img-fluid w-100 ppdb' src="storage/images/album/slider/{{ $ppdb->img1 }}" alt="{{ webInfo()->web_name }}" /></a>
        </div>
      </div>
    </section>
   @endif



</div>
