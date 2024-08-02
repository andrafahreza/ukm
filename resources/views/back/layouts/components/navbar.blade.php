<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item sidebar-category">
            <p>Menu</p>
            <span></span>
        </li>
        <li class="nav-item @if ($title == 'dashboard') active @endif">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item @if ($title == 'data_pendaftaran') active @endif">
            <a class="nav-link" href="{{ route('list-pendaftaran') }}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Data Pendaftar</span>
            </a>
        </li>
        <li class="nav-item @if ($title == 'data_user') active @endif">
            <a class="nav-link" href="{{ route('list-user') }}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Data User</span>
            </a>
        </li>
        <li class="nav-item sidebar-category">
            <p>Data Master</p>
            <span></span>
        </li>
        @if (Auth::user()->role == "admin")
            <li class="nav-item @if ($title == 'ukm') active @endif">
                <a class="nav-link" href="{{ route('ukm') }}">
                    <i class="mdi mdi-view-quilt menu-icon"></i>
                    <span class="menu-title">UKM</span>
                </a>
            </li>
            <li class="nav-item @if ($title == 'prodi' || $title == 'jurusan') active @endif">
                <a class="nav-link" href="{{ route('prodi') }}">
                    <i class="mdi mdi-view-quilt menu-icon"></i>
                    <span class="menu-title">Prodi</span>
                </a>
            </li>
        @else
            <li class="nav-item @if ($title == 'profil_ukm') active @endif">
                <a class="nav-link" href="{{ route('profil-ukm') }}">
                    <i class="mdi mdi-view-quilt menu-icon"></i>
                    <span class="menu-title">Profil UKM</span>
                </a>
            </li>
            <li class="nav-item @if ($title == 'anggota_ukm') active @endif">
                <a class="nav-link" href="{{ route('anggota-ukm') }}">
                    <i class="mdi mdi-view-quilt menu-icon"></i>
                    <span class="menu-title">Anggota UKM</span>
                </a>
            </li>
            <li class="nav-item @if ($title == 'validasi_pembayaran') active @endif">
                <a class="nav-link" href="{{ route('validasi-pembayaran') }}">
                    <i class="mdi mdi-view-quilt menu-icon"></i>
                    <span class="menu-title">Validasi Pembayaran</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
