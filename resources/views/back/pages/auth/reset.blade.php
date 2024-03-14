@extends('back.layouts.auth-layouts')




@extends('back.layouts.auth-layouts')
@section('PageTitle', isset($pageTitle) ? $pageTitle : 'Reset Password')
@section('content')
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="/" class="navbar-brand navbar-brand-autodark"><img src="{{ webLogo()->logo_utama}}" height="100"
                        alt=""></a>
            </div>
            @livewire('back.admin-reset-form')

        </div>
    </div>
@endsection
