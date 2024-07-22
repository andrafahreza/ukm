@extends('back.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Data Anggota UKM ({{ $data->count() }})</h5>
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
                                    <th>File Pendukung</th>
                                    <th>Tanggal Bergabung</th>
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
                                        <td>
                                            <a href="{{ url('foto_pendaftar'.$item->foto) }}" target="_blank">Buka Dokumen</a>
                                        </td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
    </script>
@endpush
