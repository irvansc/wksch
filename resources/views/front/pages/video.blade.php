@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Direktori video')

@section('content')

@livewire('front.video-list')

@endsection
