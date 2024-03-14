<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/">
    <link rel="shortcut icon" href="/back/dist/img/logo-favicon/{{\App\Models\LogoSekolah::find(1)->logo_favicon}}" type="image/x-icon">
    <link href="/back/assets/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="/back/assets/dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="/back/assets/dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="/back/assets/dist/css/tabler-vendors.min.css" rel="stylesheet" />
    @stack('stylesheets')
    @livewireStyles
    <link href="/back/assets/dist/css/demo.min.css" rel="stylesheet" />

</head>

<body class=" border-top-wide border-primary d-flex flex-column">
    @yield('content')
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/back/assets/dist/js/tabler.min.js"></script>
    @stack('scripts')
    @livewireScripts
    <script src="/back/assets/dist/js/demo.min.js"></script>
</body>

</html>
