@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'identitas-sekolah')

@section('content')

@livewire('front.identitas')

@endsection
