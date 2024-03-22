<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>@yield('pageTitle')</title>
    <link rel="shortcut icon" href="{{webLogo()->logo_favicon}}" type="image/x-icon">
    <link rel="icon" href="{{webLogo()->logo_favicon}}" type="image/x-icon">
    @stack('meta')
    @stack('meta_tags')
    <!-- boostrap -->
    <link rel="stylesheet" href="{{ asset('front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link href="{{ asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <!-- owl croussel -->
    <link rel="stylesheet" href="{{ asset('front/assets/vendor/owl-carousel/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/vendor/owl-carousel/assets/owl.theme.default.min.css') }}" />
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('front/assets/vendor/fontawesome/css/all.min.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/custom.css') }}" />
    @livewireStyles()
    @stack('style')
    <link rel="stylesheet" href="{{ asset('front/assets/vendor/lightbox/css/lightbox.min.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body onload="hide_loading();">
    <div class="loading overlay">
        <svg class="pl" viewBox="0 0 200 200" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="pl-grad1" x1="1" y1="0.5" x2="0" y2="0.5">
                    <stop offset="0%" stop-color="hsl(210, 71%, 28%, 1)" />
                    <stop offset="100%" stop-color="hsl(45, 100%, 51%, 1)" />
                </linearGradient>
                <linearGradient id="pl-grad2" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="hsl(210, 71%, 28%, 1)" />
                    <stop offset="100%" stop-color="hsl(45, 100%, 51%, 1)" />
                </linearGradient>
            </defs>
            <circle class="pl__ring" cx="100" cy="100" r="82" fill="none" stroke="url(#pl-grad1)" stroke-width="36" stroke-dasharray="0 257 1 257" stroke-dashoffset="0.01" stroke-linecap="round" transform="rotate(-90,100,100)" />
            <line class="pl__ball" stroke="url(#pl-grad2)" x1="100" y1="18" x2="100.01" y2="182" stroke-width="36" stroke-dasharray="1 165" stroke-linecap="round" />
        </svg>
    </div>

@include('front.layouts.inc.topbar')



<!-- section Menu -->

@include('front.layouts.inc.navbar')
    <!-- END SECTION -->



@yield('content')



@include('front.layouts.inc.footer')

<script src="{{ asset('front/assets/js/jquery.js') }}"></script>
<script src="{{ asset('front/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/js/main.js') }}"></script>
<script src="{{ asset('front/assets/vendor/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('front/assets/vendor/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>
<script src="{{ asset('front/assets/js/materialize.min.js') }}"></script>
<script src="{{ asset('front/assets/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('front/assets/vendor/owl-carousel/owl.carousel.js') }}"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script>
    let fadeTarget = document.querySelector('.loading');
    function show_loading() {
        fadeTarget.style.display = 'block';
    }

    function hide_loading() {
        fadeTarget.style.display = 'none';
        let fadeEffect = setInterval(() => {
            if (!fadeTarget.style.opacity) {
                fadeTarget.style.opacity = 1;
            }
            if (fadeTarget.style.opacity > 0) {
                fadeTarget.style.opacity -= 0.1;
            } else {
                clearInterval(fadeEffect);
            }
        }, 200);
    }
</script>
@livewireScripts()
@stack('scripts')
</body>

</html>




