@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Direktori alumni')

@section('content')


@livewire('front.alumni')

@endsection
