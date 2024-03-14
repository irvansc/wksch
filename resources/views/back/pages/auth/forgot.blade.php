


@extends('back.layouts.auth-layouts')

@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Forgot Password')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
      <div class="text-center mb-4">
        <a href="/" class="navbar-brand navbar-brand-autodark">
            <img src="{{ webLogo()->logo_utama }}" height="100" alt=""></a>
      </div>
      @livewire('back.admin-forgot-form')
      <div class="text-center text-muted mt-3">
        Forget it, <a href="{{ route('admin.login') }}">send me back</a> to the sign in screen.
      </div>
    </div>
  </div>
@endsection
