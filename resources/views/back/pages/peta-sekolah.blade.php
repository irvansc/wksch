@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Peta sekolah')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Peta sekolah</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Peta sekolah
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12 col-md-12 col-lg-8 mb-30">
    <div class="card card-box">
        <img class="card-img-top" src="storage/images/peta_images/thumbnails/resized_{{ $peta->image }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title weight-500">{{ $peta->title }}</h5>
            <p class="card-text">
                {!! $peta->desc !!}
            </p>

        </div>
        <div class="card-footer">
            <a href="{{ route('admin.edit-peta',['peta_id'=>$peta->id]) }}" class="btn btn-sm btn-warning">Edit</a>
        </div>
    </div>
</div>

</div>
@endsection

@push('scripts')
<script src="/ckeditor/ckeditor.js"></script>

@endpush
