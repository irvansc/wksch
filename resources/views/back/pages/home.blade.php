@extends('back.layouts.pages-layouts')

@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Home')

@section('pageHeader')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
@livewire('back.home')
@endsection

<style>
    .icon {
  width: 3rem;
  height: 3rem;
}

.icon i {
  font-size: 2.25rem;
}

.icon-shape {
  display: inline-flex;
  padding: 22px;
  text-align: center;
  border-radius: 50%;
  align-items: center;
  justify-content: center;
}

.icon-shape i {
  font-size: 1.25rem;
}
</style>
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('back/vendor/boxicons-2.1.4/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendor/boxicons-2.1.4/css/animations.css') }}">
@endpush
