@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Direktori guru')

@section('content')


@livewire('front.guru')

@endsection
