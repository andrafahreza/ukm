@extends('back.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (Auth::user()->role == "ukm")
                <button class="btn btn-primary" id="btnTambah">+ Tambah Berita </button>
            @endif
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Data Berita</h5>
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
                                    <th>Ukm</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->ukm->ukmNama }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->isi }}</td>
                                        <td>
                                            <img src="{{ asset('berita'. $item->foto) }}" width="200">
                                        </td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @if (Auth::user()->role == "ukm")
                                                @if ($item->status == "menunggu")
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="detail({{ $item->id }})" id="btnDetail">Detail</button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="hapus({{ $item->id }})" id="btnHapus">Hapus</button>
                                                @else
                                                    {{ $item->alasan_tolak }}
                                                @endif
                                            @else
                                                @if ($item->status == "menunggu")
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="terima({{ $item->id }})" id="btnTerima">Terima</button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="tolak({{ $item->id }})" id="btnTolak">Tolak</button>
                                                @else
                                                    {{ $item->alasan_tolak }}
                                                @endif
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
                <form action="{{ route('berita-simpan') }}" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
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
                                <label>Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="judul" id="judul" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Foto <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="foto" id="foto" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Isi <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="isi" id="isi" required></textarea>
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
                            <form action="{{ route('berita-hapus') }}" method="POST">
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
    <div class="modal fade tolak" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                    <div class="mt-4">
                        <h4 class="mb-3">Tolak Data!</h4>
                        <p class="text-muted mb-4"> Yakin ingin tolak ini? </p>
                        <div class="hstack gap-2 justify-content-center">
                            <form action="{{ route('berita-tolak') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="tolak_id">
                                <textarea class="form-control" name="alasan_tolak" required placeholder="Masukkan Alasan Penolakan"></textarea> <br>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade terima" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                    <div class="mt-4">
                        <h4 class="mb-3">Terima Data!</h4>
                        <p class="text-muted mb-4"> Yakin ingin terima ini? </p>
                        <div class="hstack gap-2 justify-content-center">
                            <form action="{{ route('berita-terima') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="terima_id">
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

            $('#btnTambah').on('click', function() {
                $('#formData')[0].reset();
                $('#errorMessage').addClass('d-none');
                $("#formData :input").prop("disabled", false);
                $('.modalForm').modal('toggle');
            })
        });

        function detail(id) {
            $('#formData')[0].reset();
            var url = "{{ route('berita-show') }}" + "/" + id;

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
                        $('#formData').attr("action", "{{ route('berita-simpan') }}" + "/" + data.id);
                        $('#judul').val(data.judul);
                        $('#isi').val(data.isi);
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

        function tolak(id) {
            $('#tolak_id').val(id);
            $('.tolak').modal('toggle');
        }

        function terima(id) {
            $('#terima_id').val(id);
            $('.terima').modal('toggle');
        }
    </script>
@endpush
