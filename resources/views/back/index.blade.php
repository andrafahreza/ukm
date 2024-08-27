@extends('back.layouts.app')

@section('content')
    @if (Auth::user()->role == "admin")
        <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card bg-facebook d-flex align-items-center">
                    <a href="{{ route('ukm') }}">
                        <div class="card-body py-5">
                            <div
                                class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                                <i class="mdi mdi-domain text-white icon-lg"></i>
                                <div class="ms-3 ml-md-0 ml-xl-3">
                                    <h5 class="text-white font-weight-bold">Data UKM</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card bg-google d-flex align-items-center">
                    <a href="{{ route('list-user') }}">
                        <div class="card-body py-5">
                            <div
                                class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                                <i class="mdi mdi-account text-white icon-lg"></i>
                                <div class="ms-3 ml-md-0 ml-xl-3">
                                    <h5 class="text-white font-weight-bold">Data User</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card bg-twitter d-flex align-items-center">
                    <a href="{{ route('list-mahasiswa') }}">
                        <div class="card-body py-5">
                            <div
                                class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                                <i class="mdi mdi-account-multiple text-white icon-lg"></i>
                                <div class="ms-3 ml-md-0 ml-xl-3">
                                    <h5 class="text-white font-weight-bold">Data Mahasiswa</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card bg-success d-flex align-items-center">
                    <a href="{{ route('list-pendaftaran') }}">
                        <div class="card-body py-5">
                            <div
                                class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                                <i class="mdi mdi-contact-mail text-white icon-lg"></i>
                                <div class="ms-3 ml-md-0 ml-xl-3">
                                    <h5 class="text-white font-weight-bold">Data Pendaftaran</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('cetak-laporan-mahasiswa') }}" target="_blank">Cetak Laporan </a>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Data Anggota UKM</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" style="width:100%" id="datatables">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NPM</th>
                                        <th>Nama Lengkap</th>
                                        <th>whatsapp</th>
                                        <th>Tanggal Bergabung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->npm }}</td>
                                            <td>{{ $item->user->nama_lengkap }}</td>
                                            <td>{{ $item->user->whatsapp }}</td>
                                            <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
