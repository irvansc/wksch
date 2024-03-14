@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'pengumuman')

@section('content')


@livewire('front.pengumuman')

@endsection
