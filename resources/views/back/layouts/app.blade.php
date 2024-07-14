<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Informasi Unit Kegiatan Mahasiswa</title>
    <!-- base:css -->
    <link rel="stylesheet" href="/back/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/back/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/back/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/back/images/favicon.png" />
    @stack('styles')
</head>

<body>
    <div class="container-scroller d-flex">
        @include('back.layouts.components.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('back.layouts.components.header')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                @include('back.layouts.components.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="/back/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="/back/vendors/chart.js/Chart.min.js"></script>
    <script src="/back/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/back/js/off-canvas.js"></script>
    <script src="/back/js/hoverable-collapse.js"></script>
    {{-- <script src="/back/js/template.js"></script> --}}
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="/back/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="/back/js/dashboard.js"></script>
    <!-- End custom js for this page-->

    @stack('scripts')
</body>

</html>
