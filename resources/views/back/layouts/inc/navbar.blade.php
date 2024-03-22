<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Route::is('admin.home') ? 'active' : '' }}">
                        <a class="nav-link " href="{{ route('admin.home') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Home
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown {{
                    Route::is('admin.posts.all_posts') ||
                    Route::is('admin.posts.add-post') ||
                    Route::is('admin.posts.categories')
                    ? 'active' : ''}}">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <line x1="9" y1="9" x2="10" y2="9" />
                                    <line x1="9" y1="13" x2="15" y2="13" />
                                    <line x1="9" y1="17" x2="15" y2="17" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Article
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.posts.add-post') }}">
                                Add post
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.posts.all_posts') }}">
                                All Post
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.posts.categories') }}">
                                Categories
                            </a>
                        </div>
                    </li>
                    @if (Auth::user()->type != 1)

                    @else
                    <li class="nav-item {{ Route::is('admin.admins') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.admins') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/users -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Users
                            </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('admin.inbox') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.inbox') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                    <path d="M4 13h3l3 3h4l3 -3h3" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Inbox
                                @php
                                $inbox = DB::table('contacts')->where('isActive', false)->count();
                                @endphp
                                <span class="badge bg-green">{{ $inbox }}</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown
                    {{
                        Route::is('admin.identitas') ||
                        Route::is('admin.sejarah') ||
                        Route::is('admin.vm') ||
                        Route::is('admin.peta-sekolah') ||
                        Route::is('admin.sarana') ||
                        Route::is('admin.pengumuman') ||
                        Route::is('admin.agenda') ||
                        Route::is('admin.alumni') ||
                        Route::is('admin.guru') ||
                        Route::is('admin.siswa-list') ||
                        Route::is('admin.kelas') ||
                        Route::is('admin.ekstrakulikuler') ||
                        Route::is('admin.ekstrakulikuler-list') ||
                        Route::is('admin.prestasi') ||
                        Route::is('admin.prestasi-list')

                        ? 'active' : ''}}
                        ">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                    <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                AKADEMIK
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item active" href="{{ route('admin.identitas') }}">
                                        Identitas Sekolah
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.sejarah') }}">
                                        Sejarah
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.vm') }}">
                                        Visi/Misi
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.peta-sekolah') }}">
                                        Peta Sekolah
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.sarana') }}">
                                        Sarana Prasana
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.pengumuman') }}">
                                        Pengumuman
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.events.index') }}">
                                        Agenda
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.alumni') }}">
                                        Alumni
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.guru') }}">
                                        Guru
                                    </a>

                                </div>
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('admin.ekstrakulikuler') }}">
                                        Ekstakulikuler
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.prestasi') }}">
                                        Prestasi
                                    </a>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-error"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                            aria-expanded="false">
                                            Siswa
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('admin.kelas') }}" class="dropdown-item">Kelas</a>
                                            <a href="{{ route('admin.siswa-list') }}" class="dropdown-item">Siswa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown
                    {{
                        Route::is('admin.album-foto') ||
                        Route::is('admin.video-list') ||
                        Route::is('admin.folders')


                        ? 'active' : ''}}
                    ">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-heart"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 8h.01" />
                                    <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5" />
                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l1.5 1.5" />
                                    <path
                                        d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                GALERY
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.album-foto') }}">
                                Album Foto
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.video-list') }}">
                                Video
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.folders') }}">
                                File
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown
                    {{
                        Route::is('admin.settings') ||
                        Route::is('admin.kepsek') ||
                        Route::is('admin.slider-utama')||
                        Route::is('admin.slider-prestasi')||
                        Route::is('admin.slider-alumni')


                        ? 'active' : ''}}
                    ">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                SETTINGS
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                General Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.kepsek') }}">
                                Kepala Sekolah
                            </a>
                            <div class="dropend">
                                <a class="dropdown-item dropdown-toggle" href="#sidebar-error" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    Slider
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.slider-utama') }}" class="dropdown-item">Slider Utama</a>
                                    <a href="{{ route('admin.slider-prestasi') }}" class="dropdown-item">Slider
                                        Prestasi</a>
                                    <a href="{{ route('admin.slider-alumni') }}" class="dropdown-item">Slider Alumni</a>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('admin.ppdb-banner') }}">
                                PPDB Banner
                            </a>
                        </div>
                    </li>
                    @endif
                </ul>

            </div>
        </div>
    </div>
</div>
