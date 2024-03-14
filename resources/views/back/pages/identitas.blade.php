@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Identitas')

@section('pageHeader')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <div class="card card-stacked">
            <div class="card-status-top bg-primary">
                <h2 class="text-center">
                        Identitas Sekolah
                </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content')
@livewire('back.identitas-sekolah')
@endsection
