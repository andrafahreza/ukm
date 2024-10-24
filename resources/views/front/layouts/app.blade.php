<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>Sistem Informasi Unit Kegiatan Mahasiswa</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/front/css/bootstrap.min.css" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="/front/css/pogo-slider.min.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="/front/css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/front/css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/front/css/custom.css" />

    @stack('styles')

</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="/front/images/loader.gif" alt="#" />
        </div>
    </div>
    <!-- end loader -->
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('index') }}"><img src="/front/logo-1.png" alt="image"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd"
                    aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active" href="{{ route('index') }}">Home</a></li>
                        <li><a class="nav-link" href="{{ route('list-pengumuman') }}">Pengumuman</a></li>
                        <li><a class="nav-link" href="{{ route('list-berita') }}">Berita</a></li>
                        <li><a class="nav-link" href="{{ route('list-agenda') }}">Agenda</a></li>
                        <li><a class="nav-link" href="{{ route('list-ukm') }}">Ukm</a></li>
                        @if (Auth::check())
                            @if (Auth::user()->role == 'mahasiswa')
                                <li><a class="nav-link" href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
                            @endif
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->nama_lengkap }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('profil-mahasiswa') }}">Profil</a>
                                    <a class="dropdown-item" href="{{ route('pembayaran') }}">Pembayaran UKM</a>
                                    <a class="dropdown-item" href="{{ route('sertifikat-mahasiswa') }}">Sertifikat</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                </div>
                            </div>
                        @else
                            <li><a class="nav-link" href="{{ route('login') }}">Login Mahasiswa</a></li>
                            <li><a class="nav-link" href="{{ route('login-umum') }}">Login Umum</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- End header -->

    @yield('content')

    <footer class="footer-box">
        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="footer_blog">
                        <div class="full margin-bottom_30">
                            <img src="https://ust.ac.id/wp-content/uploads/2021/04/logo-Footer-300x300.png" alt="#" />
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="footer_blog footer_menu white_fonts">
                        <h3>Kampus I</h3>
                        <p><small>Jalan Setia Budi No.479 F, Tanjung Sari Medan <br>
                        Telepon : (061) 821 0161 <br>
                        Fax : (061) 821 3269 </small></p>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="footer_blog full white_fonts">
                        <h3>Kampus II</h3>
                        <p><small>Jalan Mataram No. 21 Perisah Hulu, Medan Baru - Kota Medan <br>
                            Telepon : (061) 821 0161 <br>
                            Fax : (061) 821 3269 </small></p>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="footer_blog full white_fonts">
                        <h3>Sosial Media</h3>
                        <ul class="full">
                            <li><a href="https://www.facebook.com/UNIKASANTOTHOMAS/" target="_blank"><i class="fa fa-facebook"></i> UNIKASANTOTHOMAS</a></li>
                            <li><a href="https://www.youtube.com/@unikasantothomas" target="_blank"><i class="fa fa-youtube"></i> unikasantothomas</a></li>
                            <li><a href="https://www.instagram.com/unika.santothomas/" target="_blank"><i class="fa fa-instagram"></i> unika.santothomas</a></li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </footer>
    <!-- End Footer -->

    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="crp">© Copyrights 2024 </p>
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="/front/js/jquery.min.js"></script>
    <script src="/front/js/popper.min.js"></script>
    <script src="/front/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="/front/js/jquery.magnific-popup.min.js"></script>
    <script src="/front/js/jquery.pogo-slider.min.js"></script>
    <script src="/front/js/slider-index.js"></script>
    <script src="/front/js/isotope.min.js"></script>
    <script src="/front/js/images-loded.min.js"></script>
    <script src="/front/js/custom.js"></script>

    @stack('scripts')
</body>

</html>
