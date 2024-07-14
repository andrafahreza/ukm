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
        <li class="nav-item @if ($title == 'ukm') active @endif">
            <a class="nav-link" href="{{ route('ukm') }}">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Data Master</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/back/index.html">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Data Pendaftar</span>
            </a>
        </li>
    </ul>
</nav>
