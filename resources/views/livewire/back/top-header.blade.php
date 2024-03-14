<div>
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal">
                <a href="{{ route('admin.home') }}">
                    <img src="{{ webLogo()->logo_utama }}" width="150" height="50" alt="Tabler" class="navbar-brand-image">
                </a>
                {{ WebInfo()->web_name }}
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                            style="background-image: url({{ $admin->picture }})"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ $admin->name }}</div>
                            <div class="mt-1 small text-muted">{{ $admin->adminType->name }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile & account</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        >Logout</a>
                        <form action="{{ route('admin.logout') }}" id="logout-form" method="POST">@csrf</form>
                    </div>
                </div>

            </div>
        </div>
    </header>
</div>
