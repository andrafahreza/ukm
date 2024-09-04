@extends('front.layouts.app')

@push('styles')
    <link rel="stylesheet" href="/front/css/profile.css" />
@endpush

@section('content')
    <section class="inner_banner" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="full">
                        <h3>Profil</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section layout_padding contact_section" style="background:#f6f6f6;">
        <div class="container rounded bg-white mt-5 mb-5">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ $errors->first() }}
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ Session::get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">
                            {{ Auth::user()->nama_lengkap }} ({{ Auth::user()->npm }})
                        </span>
                        <span class="text-black-50">
                            {{ Auth::user()->email }}
                        </span>
                        <br><br>
                        Prodi
                        <input type="text" class="form-control" placeholder="prodi"
                            value="{{ Auth::user()->prodi->nama_prodi }}" disabled>
                        <br>
                        Jurusan
                        <input type="text" class="form-control" placeholder="jurusan"
                            value="{{ Auth::user()->getjurusan->nama_jurusan }}" disabled>
                        <br>
                        @if ($ukm->count() > 0)
                            UKM yang diikuti
                            @foreach ($ukm as $item)
                                <input type="text" class="form-control"
                                value="{{ $item->ukm->ukmNama }}" disabled>
                                <a href="{{ route('cetak-kartu', ['id' => $item->ukm->id]) }}" target="_blank">Cetak Kartu</a>
                                <br>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <form action="{{ route('update-profil-mahasiswa') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Pengaturan</h4>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control"
                                        placeholder="Masukkan Nama Lengkap" value="{{ Auth::user()->nama_lengkap }}"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="Laki-Laki" @if (Auth::user()->jenis_kelamin == 'Laki-Laki') selected @endif>
                                            Laki-Laki</option>
                                        <option value="Perempuan" @if (Auth::user()->jenis_kelamin == 'Perempuan') selected @endif>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Whatsapp</label>
                                    <input type="text" name="whatsapp" class="form-control"
                                        placeholder="Masukkan No Whatsapp" value="{{ Auth::user()->whatsapp }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Angkatan</label>
                                    <input type="number" name="angkatan" class="form-control"
                                        placeholder="Masukkan Angkatan" value="{{ Auth::user()->angkatan }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat"
                                        value="{{ Auth::user()->alamat }}" required>
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('ganti-password-mahasiswa') }}" method="POST">
                        @csrf
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Ganti Password</h4>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Password Lama</label>
                                <input type="password" name="old_password" class="form-control"
                                    placeholder="Masukkan Password Lama" required>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Password Baru</label>
                                <input type="password" name="new_password" class="form-control"
                                    placeholder="Masukkan Passwoord baru" required>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Konfirmasi Password</label>
                                <input type="password" name="konfirmasi_password" class="form-control"
                                    placeholder="Masukkan Passwoord baru" required>
                            </div>
                            <div class="text-center mt-5">
                                <button class="btn btn-primary profile-button" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
