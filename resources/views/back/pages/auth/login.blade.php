@extends('back.layouts.auth-layouts')

@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Login')
@section('content')
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ webLogo()->logo_utama }}" height="100"
                        alt=""></a>
            </div>
            @livewire('back.admin-login-form')
        </div>
    </div>
@endsection

