@extends('front.layouts.pages-front')
@php
    $title = DB::table('settings')->first();
@endphp

@section('pageTitle')
    {{ $title->web_name }}
@endsection

@push('meta_tags')
<meta name="robots" content="index, follow" />
<meta name="title" content="{{webInfo()->web_name}}" />
<meta name="description" content="{{webInfo()->web_desc}}" />
<link rel="canonical" href="{{Request::root()}}">
<meta property="og:title" content="{{webInfo()->web_name}}" />
<meta property="og:type" content="website" />
<meta property="og:description" content="{{webInfo()->web_desc}}" />
<meta property="og:url" content="{{Request::root()}}" />
<meta property="og:image" content="{{webLogo()->logo_utama}}" />
<meta content='summary' name='twitter:card' />
<meta expr:content='data:blog.pageTitle' name='twitter:title' />
<meta name='twitter:domain' content='{{Request::root()}}' />
<meta name='twitter:card' content='summary' />
<meta name='twitter:title' content="{{webInfo()->web_name}}" property="og:title" itemprop="name" />
<meta name='twitter:description' content="{{webInfo()->web_desc}}" property="og:description" itemprop="description" />
<meta name='twitter:image' content="{{webLogo()->logo_utama}}" />
@endpush

@section('content')

@livewire('front.home')

@endsection
