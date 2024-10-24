<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
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
                                    <strong>Error!</strong> {{ $errors->first() }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <center>
                                <h4>Register Page</h4>
                            </center>
                            <form class="pt-3" action="{{ route('registered-umum') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="nama_lengkap" name="nama_lengkap"
                                        placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="radio" name="jenis_kelamin" value="Laki-Laki" required>
                                            Laki-Laki &nbsp;
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="whatsapp"
                                        id="no_whatsapp" placeholder="No. Whatsapp" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email"
                                        id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="alamat"
                                        id="alamat" placeholder="Alamat" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" name="password" placeholder="Password" required>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        style="width: 100%">Register</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Sudah memiliki akun? <a href="{{ route('login-umum') }}" class="text-primary">Login
                                        Disini</a>
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
