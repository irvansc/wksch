@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sejarah')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Sejarah</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Sejarah
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>


@endsection

@section('content')
  <div class="col-md-6">
    <div class="card">
      <div class="card-img-top img-responsive" style="background-image: url(storage/images/sejarah_images/thumbnails/resized_{{$sejarah->img}})"></div>
      <div class="card-body">
        <h3 class="card-title">Sejarah Sekolah</h3>
        <p>{!! $sejarah->description !!}</p>
      </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.edit-sejarah',['sejarah_id'=>$sejarah->id]) }}" class="btn btn-sm btn-warning">Edit</a>
    </div>
  </div>
@endsection
