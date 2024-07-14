@extends('back.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary" id="btnTambah">+ Tambah Data UKM </button>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Data UKM</h5>
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
                                    <th>Nama UKM</th>
                                    <th>Deskripsi UKM</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->ukmNama }} <br>
                                            <img src="{{ $item->logo }}" width="200">
                                        </td>
                                        <td>{!! $item->ukmDeskripsi !!}</td>
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
                <form action="{{ route('ukm-simpan') }}" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFullscreenLabel">Tambah Data</h5>
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
                                <label>Nama UKM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ukmNama" id="ukmNama" placeholder="Masukkan Nama UKM" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Kontak <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="contact" id="contact" placeholder="Masukkan Nomor Kontak" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Logo <span class="text-danger logoStar">*</span></label>
                                <input type="file" class="form-control" name="logo" id="logo" required>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="ukmDeskripsi" id="ukmDeskripsi" placeholder="Masukkan Deskripsi UKM" required></textarea>
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
                            <form action="{{ route('ukm-hapus') }}" method="POST">
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
                $("#logo").prop('required', true);
                $(".logoStar").removeClass('d-none');
                $('.modalForm').modal('toggle');
            })
        });

        function detail(id) {
            $('#formData')[0].reset();
            var url = "{{ route('ukm-show') }}" + "/" + id;

            $.ajax({
                type: "get",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    if (response.alert == '1') {
                        $('.modalForm').modal('toggle');
                        $('#errorMessage').addClass('d-none');
                        $("#formData :input").prop("disabled", false);
                        $("#logo").prop('required', false);
                        $(".logoStar").addClass('d-none');

                        const data = response.data;
                        $('#formData')[0].reset();
                        $('#formData').attr("action", "{{ route('ukm-simpan') }}" + "/" + data.id);
                        $('#ukmNama').val(data.ukmNama);
                        $('#ukmDeskripsi').val(data.ukmDeskripsi);
                        $('#contact').val(data.contact);
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
    </script>
@endpush
