@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sarpas')
@section('pageHeader')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Sarpas</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Sarana Prasarana
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
      {{-- <div class="card-img-top img-responsive" style="background-image: url(storage/images/sejarah_images/thumbnails/resized_{{$sejarah->img}})"></div> --}}
      <div class="card-body">
        <h3 class="card-title">Sarana Sekolah</h3>
        <p>{!! $sarana->description !!}</p>
      </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.edit-sarana',['sarana_id'=>$sarana->id]) }}" class="btn btn-sm btn-warning">Edit</a>
    </div>
  </div>
@endsection
