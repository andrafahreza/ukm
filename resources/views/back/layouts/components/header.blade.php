<!-- partial:./partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row" style="background-image: url('/front/images/banner_img.png') !important">
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
            data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="{{ route('home') }}">
                <img src="/front/unika.png" alt="logo" width="50" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
                <img src="/front/unika.png" alt="logo" /></a>
        </div>
        <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Universitas Katolik Santo Thomas</h4>
        <div class="navbar-nav navbar-nav-right"></div>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Selamat Datang, {{ Auth::user()->role }}"
                        aria-label="search" aria-describedby="search" readonly>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="/back/#" data-bs-toggle="dropdown"
                    id="profileDropdown">
                    <img src="/back/images/faces/face5.jpg" alt="profile" />
                    <span class="nav-profile-name">{{ Auth::user()->nama_lengkap }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                    aria-labelledby="profileDropdown">
                    <a href="{{ route('profil-setting') }}" class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Profile
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
