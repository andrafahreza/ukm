@extends('back.layouts.app')

@section('content')
<div class="row">
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

    <div class="col-lg-6">
        <div class="card mt-4">
            <div class="card-header">
                <h5>Profil</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update-profil') }}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control"
                                placeholder="Masukkan Nama Lengkap" value="{{ Auth::user()->nama_lengkap }}"
                                required>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label class="labels">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="Laki-Laki" @if (Auth::user()->jenis_kelamin == 'Laki-Laki') selected @endif>
                                    Laki-Laki</option>
                                <option value="Perempuan" @if (Auth::user()->jenis_kelamin == 'Perempuan') selected @endif>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label class="labels">Whatsapp</label>
                            <input type="text" name="whatsapp" class="form-control"
                                placeholder="Masukkan No Whatsapp" value="{{ Auth::user()->whatsapp }}">
                        </div>
                        <div class="col-md-12 mt-4">
                            <label class="labels">Angkatan</label>
                            <input type="number" name="angkatan" class="form-control"
                                placeholder="Masukkan Angkatan" value="{{ Auth::user()->angkatan }}">
                        </div>
                        <div class="col-md-12 mt-4">
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
    </div>
    <div class="col-lg-6">
        <div class="card mt-4">
            <div class="card-header">
                <h5>Ganti Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ganti-password-profil') }}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Password Lama</label>
                            <input type="password" name="old_password" class="form-control"
                                placeholder="Masukkan Password Lama" required>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label class="labels">Password Baru</label>
                            <input type="password" name="new_password" class="form-control"
                                placeholder="Masukkan Passwoord baru" required>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label class="labels">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password" class="form-control"
                                placeholder="Masukkan Passwoord baru" required>
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
    </div>
</div>
@endsection
