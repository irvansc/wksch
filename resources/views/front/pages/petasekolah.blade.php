@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'peta-sekolah')

@section('content')

@livewire('front.peta-sekolah')
@endsection
