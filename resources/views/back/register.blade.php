<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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
                            <form class="pt-3" action="{{ route('registered') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="nama_lengkap" name="nama_lengkap"
                                        placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg" name="npm"
                                        id="npm" placeholder="NPM" required>
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
                                    <input type="text" class="form-control form-control-lg" name="angkatan"
                                        id="angkatan" placeholder="Angkatan" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="alamat"
                                        id="alamat" placeholder="Alamat" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="prodi_id" id="prodi_id"
                                        required>
                                        <option value="">Pilih Prodi</option>
                                        @foreach ($prodi as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="jurusan_id" id="jurusan_id"
                                        required>
                                        <option value="">Pilih Jurusan</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        style="width: 100%">Register</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary">Login
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

    <script>
        $('#prodi_id').on('change', function() {
            var value = $(this).val();
            $.ajax({
                type: "get",
                url: "{{ route('jurusan-get') }}" + "/" + value,
                dataType: "JSON",
                success: function(response) {
                    if (response.alert == '1') {
                        $('#jurusan_id')
                            .find('option')
                            .remove()
                            .end()
                            .append('<option value="">Pilih Jurusan</option>')
                            .val('')

                        const data = response.data;

                        data.forEach(element => {
                            console.log(element);
                            $('#jurusan_id').append($('<option>', {
                                value: element.id,
                                text: element.nama_jurusan
                            }));
                        });
                    } else {
                        $('#jurusan_id')
                            .find('option')
                            .remove()
                            .end()
                            .append('<option value="">Pilih Jurusan</option>')
                            .val('')

                        alert('gagal mengambil data jurusan')
                    }
                },
                error: function(response) {
                    alert(response.message)
                }
            });
        })
    </script>
</body>

</html>
