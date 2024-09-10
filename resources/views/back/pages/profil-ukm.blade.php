@extends('back.layouts.app')

@section('content')
    <div class="row">
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">
                                <img src="{{ $ukm->logo }}" alt="profile" class="img-lg mb-3" />
                                <div class="mb-3">
                                    <h3>{{ $ukm->ukmNama }}</h3>
                                </div>
                                <p class="w-75 mx-auto mb-3">{!! $ukm->ukmDeskripsi !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-pengurus-tab" data-bs-toggle="pill" href="#pills-pengurus"
                                        role="tab" aria-controls="pills-pengurus" aria-selected="true">Pengurus</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-pengurus" role="tabpanel"
                                    aria-labelledby="pills-pengurus-tab">
                                    <form action="{{ route('pengurus-simpan') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Ketua Umum</label>
                                                <input type="text" class="form-control" name="ketua_umum" value="{{ $pengurus != null ? $pengurus->ketua_umum : '' }}" required>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <label>Wakil Ketua Umum</label>
                                                <input type="text" class="form-control" name="wakil_ketua_umum" value="{{ $pengurus != null ? $pengurus->wakil_ketua_umum : '' }}" required>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <label>Sekretaris</label>
                                                <input type="text" class="form-control" name="sekretaris" value="{{ $pengurus != null ? $pengurus->sekretaris : '' }}" required>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <label>Wakil Sekretaris</label>
                                                <input type="text" class="form-control" name="wakil_sekretaris" value="{{ $pengurus != null ? $pengurus->wakil_sekretaris : '' }}" required>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <label>Bendahara</label>
                                                <input type="text" class="form-control" name="bendahara" value="{{ $pengurus != null ? $pengurus->bendahara : '' }}" required>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <label>Wakil Bendahara</label>
                                                <input type="text" class="form-control" name="wakil_bendahara" value="{{ $pengurus != null ? $pengurus->wakil_bendahara : '' }}" required>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mt-4" type="submit" style="width: 100%;">Simpan</button>
                                    </form>
                                </div>
                                {{-- <div class="tab-pane fade" id="pills-prestasi" role="tabpanel"
                                    aria-labelledby="pills-prestasi-tab">

                                </div>
                                <div class="tab-pane fade" id="pills-kegiatan" role="tabpanel"
                                    aria-labelledby="pills-kegiatan-tab">

                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
