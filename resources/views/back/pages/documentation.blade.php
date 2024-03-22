@extends('back.layouts.pages-layouts')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Direktori Alumni')
@section('pageHeader')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Documentation
            </h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row gx-lg-4">
            <div class="d-none d-lg-block col-lg-3">
                <ul class="nav nav-pills nav-vertical">
                    <li class="nav-item">
                        <a href="{{ route('admin.documentation') }}" class="nav-link active">
                            Introduction
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#menu-base" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
                            Getting started
                            <span class="nav-link-toggle"></span>
                        </a>
                        <ul class="nav nav-pills collapse" id="menu-base">
                            <li class="nav-item">
                                <a href="../docs/getting-started.html" class="nav-link">
                                    Getting Started
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../docs/download.html" class="nav-link">
                                    Download
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../docs/browser-support.html" class="nav-link">
                                    Browser Support
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="../changelog.html" class="nav-link">
                            Changelog
                            <span class="badge bg-blue-lt ms-auto">1.0.0-beta5</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="markdown">
                            <div>
                                <div class="d-flex mb-3">
                                    <h1 class="m-0">Introduction</h1>
                                </div>
                            </div>
                            <p>Hai.. Terimakasih yang sudah membeli sourcecode website ini.</p>
<p>Sebelum kalian menggunakan Website ini silahkan kalian melihat video documentasi dibawah ini :</p>
                            <div class="mt-4">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/mfl4nw4gRIc?si=fAxp4rB87cVoBuEN" allowfullscreen></iframe>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
