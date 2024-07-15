@extends('back.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('ukm') }}" class="btn btn-secondary">< Kembali</a>
            <button class="btn btn-primary" id="btnTambah">+ Tambah admin UKM </button>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Data Akun UKM {{ $ukm->ukmNama }}</h5>
                </div>
                <div class="card-body">
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

                    <div class="table-responsive">
                        <table class="display" style="width:100%" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Jurusan</th>
                                    <th>whatsapp</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->npm }}</td>
                                        <td>{{ $item->getjurusan->nama_jurusan }}</td>
                                        <td>{{ $item->whatsapp }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="detail({{ $item->id }})" id="btnDetail">Detail</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="hapus({{ $item->id }})" id="btnHapus">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalForm" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('admin-simpan') }}" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ukm_id" value="{{ $ukm->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFullscreenLabel">Simpan Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="errorMessage d-none">
                            <div class="alert alert-danger" role="alert">
                                <strong>Error!</strong>  <span id="spanError"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>NPM <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="npm" id="npm" placeholder="Masukkan NPM" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Whatsapp <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Masukkan whatsapp" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Angkatan <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="angkatan" id="angkatan" placeholder="Masukkan angkatan" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan alamat" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Prodi <span class="text-danger">*</span></label>
                                <select class="form-control" name="prodi_id" id="prodi_id" required>
                                    <option value="">Pilih Prodi</option>
                                    @foreach ($prodi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Jurusan <span class="text-danger">*</span></label>
                                <select class="form-control" name="jurusan_id" id="jurusan_id" required>
                                    <option value="">Pilih Jurusan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Tutup</a>
                        <button type="submit" class="btn btn-primary ">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                    <div class="mt-4">
                        <h4 class="mb-3">Hapus Data!</h4>
                        <p class="text-muted mb-4"> Yakin ingin menghapus ini? </p>
                        <div class="hstack gap-2 justify-content-center">
                            <form action="{{ route('admin-hapus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="hapus_id">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#datatables').DataTable();

            $('#btnTambah').on('click', function() {
                $('#formData')[0].reset();
                $('#errorMessage').addClass('d-none');
                $("#formData :input").prop("disabled", false);
                $('.modalForm').modal('toggle');
            })
        });

        function detail(id) {
            $('#formData')[0].reset();
            var url = "{{ route('admin-show') }}" + "/" + id;

            $.ajax({
                type: "get",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    if (response.alert == '1') {
                        $('.modalForm').modal('toggle');
                        $('#errorMessage').addClass('d-none');
                        $("#formData :input").prop("disabled", false);

                        const data = response.data;
                        $('#formData')[0].reset();
                        $('#formData').attr("action", "{{ route('admin-simpan') }}" + "/" + data.id);
                        $('#email').val(data.email);
                        $('#nama_lengkap').val(data.nama_lengkap);
                        $('#npm').val(data.npm);
                        $('#jenis_kelamin').val(data.jenis_kelamin);
                        $('#whatsapp').val(data.whatsapp);
                        $('#angkatan').val(data.angkatan);
                        $('#alamat').val(data.alamat);
                        $('#prodi_id').val(data.prodi_id);
                        $('#jurusan_id').val(data.jurusan_id);
                    } else {
                        $("#formData :input").prop("disabled", true);
                        $('#errorMessage').removeClass('d-none');
                        $('#spanError').text(response.message);
                    }
                },
                error: function(response) {
                    $("#formData :input").prop("disabled", true);
                    $('#errorMessage').removeClass('d-none');
                    $('#spanError').text(response.message);
                }
            });
        }

        function hapus(id) {
            $('#hapus_id').val(id);
            $('.hapus').modal('toggle');
        }

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
@endpush
