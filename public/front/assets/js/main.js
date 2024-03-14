$(document).ready(function () {
  $("#slider-hero").owlCarousel({
    loop: true,
    nav: true,
    items: 1,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    navContainer: "#slider-hero-nav",
  });
  $("#slider-hero-prestasi").owlCarousel({
    loop: true,
    nav: true,
    items: 1,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    navContainer: "slider-hero-nav-p",
  });

  $("#tenaga-pendidik-slider").owlCarousel({
    loop: true,
    items: 3,
    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    margin: 20,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    navContainer: "#slider-tools-1",
  });
  $("#alumni-slider").owlCarousel({
    loop: true,
    items: 2,
    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    margin: 20,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    navContainer: "#slider-tools-2",
  });
  $("#prestasi-slider").owlCarousel({
    loop: true,
    items: 2,
    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    margin: 20,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    navContainer: "#slider-tools-4",
  });
  $("#galery-slider").owlCarousel({
    loop: true,
    items: 3,
    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    margin: 20,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    navContainer: "#slider-tools-3",
  });

  var sync1 = $("#sync1");
  var slidesPerPage = 4; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1.owlCarousel({
    loop: true,
    nav: true,
    items: 1,
    dots: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    navText: [
      "<i class='fas fa-angle-left'></i>",
      "<i class='fas fa-angle-right'></i>",
    ],
    navContainer: "#slider-tools-4",
  });

  var counter = document.querySelectorAll(".counter");

  window.addEventListener(
    "load",
    function () {
      counter.forEach(function (k, v) {
        var start = counter[v].getAttribute("data-count-start");
        var end = counter[v].getAttribute("data-count-end");
        var speed = counter[v].getAttribute("data-speed");

        setInterval(function () {
          start++;
          if (start > end) {
            return false;
          }
          counter[v].innerText = start;
        }, speed);
      });
    },
    false
  );

  function slider_carouselInit() {
    $(".owl-carousel.slider_carousel").owlCarousel({
      dots: false,
      loop: true,
      margin: 30,
      stagePadding: 2,
      autoplay: false,
      nav: true,
      navText: [
        "<i class='far fa-arrow-alt-circle-left'></i>",
        "<i class='far fa-arrow-alt-circle-right'></i>",
      ],
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 2,
        },
        992: {
          items: 5,
        },
      },
    });
  }
  slider_carouselInit();

  //  TESTIMONIALS CAROUSEL HOOK
  $("#customers-testimonials").owlCarousel({
    loop: true,
    center: true,
    items: 3,
    margin: 0,
    autoplay: true,
    dots: true,
    autoplayTimeout: 8500,
    smartSpeed: 450,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      1170: {
        items: 3,
      },
    },
  });

  
});
