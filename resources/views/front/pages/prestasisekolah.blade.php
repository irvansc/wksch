@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'prestasi-sekolah')

@section('content')

@livewire('front.prestasi-sekolah')

@endsection
