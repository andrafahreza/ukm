@extends('back.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Data Pendaftaran</h5>
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
                                    <th>Mahasiswa</th>
                                    <th>Tujuan Pembayaran</th>
                                    <th>Bukti</th>
                                    <th>Tgl Bayar</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $item->user->nama_lengkap }}
                                            <br>
                                            ({{ $item->user->npm }})
                                        </td>
                                        <td>{!! $item->tujuan_pembayaran !!}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->tgl_bayar)) }}</td>
                                        <td>
                                            <a href="{{ url('bukti'.$item->bukti) }}" target="_blank">Buka Dokumen</a>
                                        </td>
                                        <td>
                                            @if ($item->validasi == "menunggu")
                                                <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                            @elseif ($item->validasi == "ditolak")
                                                <span class="badge bg-danger">Ditolak</span>
                                                <p>Keterangan: {!! $item->alasan_tolak !!}</p>
                                            @else
                                                <span class="badge bg-success">Diterima</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == "ukm" && $item->validasi == "menunggu")
                                                <button type="button" class="btn btn-sm btn-success"
                                                    onclick="terima({{ $item->id }}, {{ $item->user_id }})" id="btnTerima">Terima</button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="tolak({{ $item->id }})" id="btnTolak">Tolak</button>
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

    <div class="modal fade terima" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="bi bi-exclamation-triangle text-warning display-5"></i>
                    <div class="mt-4">
                        <h4 class="mb-3">Terima Pembayaran</h4>
                        <p class="text-muted mb-4"> Yakin ingin menerima mahasiswa ini untuk masuk ke dalam UKM? </p>
                        <div class="hstack gap-2 justify-content-center">
                            <form action="{{ route('terima-pembayaran') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="terima_id">
                                <input type="hidden" name="user_id" id="user_id">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Ya</button>
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
                        <form action="{{ route('tolak-pembayaran') }}" method="POST">
                            <h4 class="mb-3">Tolak Pembayaran</h4>
                            <p class="text-muted mb-4"> Yakin ingin menolak pembayaran mahasiswa ini? </p>
                            <textarea class="form-control" name="keterangan" placeholder="Masukkan alasan penolakan" required></textarea>
                            <div class="hstack gap-2 justify-content-center mt-4">
                                @csrf
                                <input type="hidden" name="id" id="tolak_id">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">Ya</button>
                            </div>
                        </form>
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

        function terima(id, user_id) {
            $('#terima_id').val(id);
            $('#user_id').val(user_id);
            $('.terima').modal('toggle');
        }

        function tolak(id) {
            $('#tolak_id').val(id);
            $('.tolak').modal('toggle');
        }
    </script>
@endpush
