@extends('front.layouts.pages-front')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'visi-misi')

@section('content')

@livewire('front.visi-misi')

@endsection
