<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Umum</title>
    <link rel="stylesheet" href="/back/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/back/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/back/css/style.css">
    <link rel="shortcut icon" href="/back/images/favicon.png" />
</head>

<body>
    <div class="container-scroller d-flex">
        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong>  {{ $errors->first() }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Sukses!</strong>  {{ Session::get('success'); }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <center>
                                <a href="{{ route('index') }}">
                                    <div class="brand-logo">
                                        <img src="/front/unika.png" alt="logo" style="width: 100px;">
                                    </div>
                                </a>
                                <h4>UNIKA</h4>
                                <h6 class="font-weight-light">Santo Thomas</h6>
                            </center>
                            <form class="pt-3" method="POST" action="{{ route('authentication') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" style="width: 100%">Sign In</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Belum punya akun? <a href="{{ route('register-umum') }}" class="text-primary">Daftar Disini</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="/back/vendors/js/vendor.bundle.base.js"></script>
    <script src="/back/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="/back/js/off-canvas.js"></script>
    <script src="/back/js/hoverable-collapse.js"></script>
    <script src="/back/js/template.js"></script>
</body>

</html>
