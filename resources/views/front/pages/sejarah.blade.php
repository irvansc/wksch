@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'sejarah-sekolah')

@section('content')

@livewire('front.sejarah-sekolah')

@endsection
