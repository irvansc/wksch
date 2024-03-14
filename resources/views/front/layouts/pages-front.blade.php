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

</head>
<body>


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
@livewireScripts()
@stack('scripts')
</body>

</html>




