@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'pendaftaran alumni')

@section('content')

@livewire('front.alumni-form')

@endsection
