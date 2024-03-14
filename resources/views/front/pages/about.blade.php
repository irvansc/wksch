@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'about')

@section('content')

@livewire('front.about')

@endsection
