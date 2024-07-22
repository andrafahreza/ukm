@extends('front.layouts.app')

@section('content')
    <section class="inner_banner" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="full">
                        <h3>Pendaftaran Unit Kegiatan Mahasiswa</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section layout_padding contact_section" style="background:#f6f6f6;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="full float-right_img">
                        <img src="/front/images/img10.png" alt="#">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="contact_form">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>  {{ $errors->first() }}
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sukses!</strong>  {{ Session::get('success'); }}
                            </div>
                        @endif
                        <form action="{{ route('daftar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div class="full field">
                                    <select name="ukm_id" required>
                                        <option value="">Pilih UKM</option>
                                        @foreach ($ukm as $data)
                                            <option value="{{ $data->id }}">{{ $data->ukmNama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="full field mt-4">
                                    <span>Upload dokumen pendukung </span>
                                    <input type="file" name="foto" required />
                                </div>
                                <div class="full field">
                                    <textarea name="alasan" placeholder="Alasan" required></textarea>
                                 </div>
                                <div class="full field">
                                    <div class="center">
                                        <button class="buttonCustom" type="submit">Daftar</button> &nbsp;
                                        <button class="buttonCustom"  type="reset" style="background-color: red">Reset</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section layout_padding padding_bottom-2">
        <div class="container">
            <div class="heading_main text_align_center">
                <h2>Riwayat Pendaftaran</h2>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Unit Kegiatan Mahasiswa</th>
                        <th>Alasan Ingin Bergabung</th>
                        <th>Dokumen Pendukung</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftaran as $value)
                        <tr>
                            <td>{{ $value->ukm->ukmNama }}</td>
                            <td>{!! $value->alasan !!}</td>
                            <td>
                                <a href="{{ url('foto_pendaftar'.$value->foto) }}" target="_blank">Buka Dokumen</a>
                            </td>
                            <td>
                                @if ($value->status == "menunggu")
                                    <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @elseif ($value->status == "ditolak")
                                    <span class="badge bg-danger">Ditolak</span>
                                    <p>Keterangan: {!! $value->alasan_tolak !!}</p>
                                @else
                                    <span class="badge bg-success">Diterima</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
