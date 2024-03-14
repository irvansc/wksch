<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('pageTitle')</title>
    <base href="/">
    <link rel="shortcut icon" href="{{ webLogo()->logo_favicon }}" type="image/x-icon">

    <link href="{{ asset('back/assets/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back/assets/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    @stack('stylesheets')
    @livewireStyles
    <style>
        .swal2-popup {
            font-size: .85rem;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('back/vendor/ijabo/ijabo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendor/ijaboCropTool/ijaboCropTool.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendor/jquery-ui-1.13.2/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendor/jquery-ui-1.13.2/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendor/jquery-ui-1.13.2/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendor/amsify/amsify.suggestags.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('back.layouts.inc.header')
        @include('back.layouts.inc.navbar')
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                @yield('pageHeader')
            </div>
            <div class="page-body">
                <div class="container-xl">
                   @yield('content')
                </div>
            </div>
           @include('back.layouts.inc.footer')
        </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('back/vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('back/vendor/ijabo/ijabo.min.js') }}"></script>
    <script src="{{ asset('back/vendor/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('back/vendor/ijaboViewer/jquery.ijaboViewer.min.js') }}"></script>
    <script src="{{ asset('back/vendor/jquery-ui-1.13.2/jquery-ui.min.js') }}"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('back/vendor/amsify/jquery.amsify.suggestags.js') }}"></script>
    <script src="{{ asset('back/assets/dist/js/tabler.min.js') }}"></script>
    @stack('scripts')
    @livewireScripts
    <script src="{{ asset('back/assets/dist/js/demo.min.js') }}"></script>
    <script>
           $('input[name="post_tags"]').amsifySuggestags({
            type: 'amsify'
        });

        window.addEventListener('showToastr', function(event) {
            toastr.remove();
            if (event.detail.type === 'info') {
                toastr.info(event.detail.message);
            } else if (event.detail.type === 'success') {
                toastr.success(event.detail.message);
            } else if (event.detail.type === 'warning') {
                toastr.warning(event.detail.message);
            } else if (event.detail.type === 'error') {
                toastr.error(event.detail.message);
            } else {
                return false;
            }


        });

    </script>
</body>

</html>
