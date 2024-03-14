@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Direktori foto')

@section('content')


@livewire('front.foto-list')

@endsection
