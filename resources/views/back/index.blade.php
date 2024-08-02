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
                    <div class="card-body py-5">
                        <div
                            class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="mdi mdi-account-multiple text-white icon-lg"></i>
                            <div class="ms-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">Data Mahasiswa</h5>
                            </div>
                        </div>
                    </div>
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
    @endif
@endsection
