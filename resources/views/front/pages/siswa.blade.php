@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Direktori siswa')

@section('content')

@livewire('front.siswa')

@endsection
