@extends('back.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Data User</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sukses!</strong> {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="display" style="width:100%" id="datatables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->email }}
                                            @if ($item->status == 'active')
                                                <span class="badge bg-success"> aktif</span>
                                            @else
                                                <span class="badge bg-danger"> nonaktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->npm }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="detail({{ $item->id }})" id="btnDetail">Detail</button>
                                            <button type="button" class="btn btn-sm btn-secondary" onclick="resetPassword({{ $item->id }})" id="btnResetPassword">Reset Password</button>

                                            @if ($item->status == 'active')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="nonactive({{ $item->id }})" id="btnNonactive">Nonaktifkan</button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-success" onclick="activeModal({{ $item->id }})" id="btnActive">Aktifkan</button>
                                            @endif
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
                <form id="formData">
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
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Tutup</a>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade nonactive" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                    <div class="mt-4">
                        <h4 class="mb-3">Nonaktifkan akun!</h4>
                        <p class="text-muted mb-4"> Yakin ingin menonaktifkan akun ini? </p>
                        <div class="hstack gap-2 justify-content-center">
                            <form action="{{ route('nonactive-user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="nonactive_id">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade resetPassword" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                    <div class="mt-4">
                        <h4 class="mb-3">Reset password!</h4>
                        <p class="text-muted mb-4"> Yakin ingin mereset password akun ini? </p>
                        <div class="hstack gap-2 justify-content-center">
                            <form action="{{ route('reset-user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="reset_id">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade activeModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                    <div class="mt-4">
                        <h4 class="mb-3">Aktifkan akun!</h4>
                        <p class="text-muted mb-4"> Yakin ingin mengaktifkan akun ini? </p>
                        <div class="hstack gap-2 justify-content-center">
                            <form action="{{ route('active-user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="active_id">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Ya</button>
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
                        $("#formData :input").prop("disabled", true);

                        const data = response.data;
                        $('#formData')[0].reset();
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

        function nonactive(id) {
            $('#nonactive_id').val(id);
            $('.nonactive').modal('toggle');
        }

        function activeModal(id) {
            $('#active_id').val(id);
            $('.activeModal').modal('toggle');
        }

        function resetPassword(id) {
            $('#reset_id').val(id);
            $('.resetPassword').modal('toggle');
        }
    </script>
@endpush
