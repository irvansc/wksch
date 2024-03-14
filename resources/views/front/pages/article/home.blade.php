@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'article')

@section('content')

@livewire('front.article')
@endsection
