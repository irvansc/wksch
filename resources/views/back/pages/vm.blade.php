@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Visi misi')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Visi Misi</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Visi Misi
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
    @livewire('back.visi-misi')
@endsection




