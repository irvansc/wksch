@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'file-download')

@section('content')


@livewire('front.file-download');
@endsection
