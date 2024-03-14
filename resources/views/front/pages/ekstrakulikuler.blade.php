@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'ekstrakulikuler')

@section('content')


@livewire('front.eskul')

@endsection
