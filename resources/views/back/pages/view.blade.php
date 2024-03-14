@extends('back.layouts.pages-layouts')

@section('pageTitle',isset($pageTitle) ? $pageTitle : 'Home')


@section('pageHeader')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Home
                </div>
                <h2 class="page-title">
                    {{ $post->post_title }}
                </h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-lg-8">
        <div class="card card-lg">
            <div class="card-body">
                <div class="markdown">
                    {!! $post->post_content !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <!-- Download SVG icon from http://tabler-icons.io/i/scale -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="7" y1="20" x2="17" y2="20"></line>
                            <path d="M6 6l6 -1l6 1"></path>
                            <line x1="12" y1="3" x2="12" y2="20"></line>
                            <path d="M9 12l-3 -6l-3 6a3 3 0 0 0 6 0"></path>
                            <path d="M21 12l-3 -6l-3 6a3 3 0 0 0 6 0"></path>
                        </svg>
                    </div>
                    <div>
                        <small class="text-muted">tabler/tabler is licensed under the</small>
                        <h3 class="lh-1">MIT License</h3>
                    </div>
                </div>
                <div class="text-muted mb-3">
                    A short and simple permissive license with conditions only requiring preservation of copyright and
                    license notices. Licensed works, modifications, and larger works may be distributed under different
                    terms
                    and without source code.
                </div>
                <h4>Permissions</h4>
                <ul class="list-unstyled space-y-1">
                    <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                        Commercial use
                    </li>
                    <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                        Modification
                    </li>
                    <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                        Distribution
                    </li>
                    <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                        Private use
                    </li>
                </ul>
                <h4>Limitations</h4>
                <ul class="list-unstyled space-y-1">
                    <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Liability
                    </li>
                    <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Warranty
                    </li>
                </ul>
                <h4>Conditions</h4>
                <ul class="list-unstyled space-y-1">
                    <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/info-circle -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-blue" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            <polyline points="11 12 12 12 12 16 13 16"></polyline>
                        </svg>
                        License and copyright notice
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                This is not legal advice.
                <a href="#" target="_blank">Learn more about repository licenses.</a>
            </div>
        </div>
    </div>
</div>
@endsection
