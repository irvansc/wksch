@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'contact')

@section('content')


@livewire('front.contact')

@endsection
