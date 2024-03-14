@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'sarana-sekolah')

@section('content')

@livewire('front.sarana-sekolah')
@endsection
