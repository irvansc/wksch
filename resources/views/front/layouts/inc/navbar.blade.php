<nav class="navbar navbar-expand-lg navbar-dark bg-biru">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#my-nav"
            aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="my-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <div class="nav-item dropdown

                ">
                    <a class="nav-link dropdown-toggle {{
                        Route::is('identitas-sekolah') ||
                        Route::is('sejarah-sekolah') ||
                        Route::is('visi-misi') ||
                        Route::is('peta-sekolah')
                        ? 'active' : ''}}" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SEKOLAH
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item {{ Route::is('identitas-sekolah') ? 'active' : '' }} " href="{{ route('identitas-sekolah') }}">Identitas Sekolah</a>
                        <a class="dropdown-item {{ Route::is('sejarah-sekolah') ? 'active' : '' }} " href="{{ route('sejarah-sekolah') }}">Sejarah</a>
                        <a class="dropdown-item {{ Route::is('visi-misi') ? 'active' : '' }} " href="{{ route('visi-misi') }}">Visi & Misi</a>
                        <a class="dropdown-item {{ Route::is('peta-sekolah') ? 'active' : '' }} " href="{{ route('peta-sekolah') }}">Peta Sekolah</a>
                    </div>
                </div>
                <div class="nav-item dropdown

                ">
                    <a class="nav-link dropdown-toggle {{
                        Route::is('sarana-sekolah') ||
                        Route::is('ekstrakulikuler') ||
                        Route::is('prestasi-sekolah')
                        ? 'active' : ''}}" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        KATEGORI
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('sarana-sekolah') }}">Sarana Sekolah</a>
                        <a class="dropdown-item" href="{{ route('ekstrakulikuler') }}">Ekstrakulikuler</a>
                        <a class="dropdown-item" href="{{ route('prestasi-sekolah') }}">Prestasi Sekolah</a>
                    </div>
                </div>
                <div class="nav-item dropdown

                ">
                    <a class="nav-link dropdown-toggle {{
                        Route::is('article') ||
                        Route::is('pengumuman') ||
                        Route::is('events.index')
                        ? 'active' : ''}}" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        INFORMASI
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('article') }}">Article</a>
                        <a class="dropdown-item" href="{{ route('pengumuman') }}">Pengumuman</a>
                        <a class="dropdown-item" href="{{ route('events.index') }}">Agenda</a>
                    </div>
                </div>
                <div class="nav-item dropdown

                ">
                    <a class="nav-link dropdown-toggle {{
                        Route::is('alumni-form') ||
                        Route::is('alumni') ||
                        Route::is('guru')
                        ? 'active' : ''}}" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        DIREKTORI
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('alumni-form') }}">Pendaftaran Alumni</a>
                        <a class="dropdown-item" href="{{ route('alumni') }}">Direktori Alumni</a>
                        <a class="dropdown-item" href="{{ route('guru') }}">Direktori guru</a>
                        <a class="dropdown-item" href="{{ route('siswa') }}">Direktori Siswa</a>
                    </div>
                </div>
                <div class="nav-item dropdown

                ">
                    <a class="nav-link dropdown-toggle {{ Route::is('foto') || Route::is('video') ? 'active' : '' }}" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        GALERY
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item {{ Route::is('foto') ? 'active' : '' }} " href="{{ route('foto') }}">Galery Foto</a>
                        <a class="dropdown-item {{ Route::is('video') ? 'active' : '' }} " href="{{ route('video') }}">Galery Video</a>
                    </div>
                </div>
                <li class="nav-item  {{
                    Route::is('contact')
                    ? 'active' : ''}}">
                    <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">CONTACT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
