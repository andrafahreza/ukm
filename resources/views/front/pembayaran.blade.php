@extends('front.layouts.app')

@section('content')
    <section class="inner_banner" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="full">
                        <h3>Pembayaran UKM</h3>
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
                        <img src="/front/images/p3.png" alt="#" height="500">
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

                        <form action="{{ route('bayar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div class="full field">
                                    <select name="ukm_id" required>
                                        <option value="">Pilih UKM</option>
                                        @foreach ($ukmUser as $data)
                                            <option value="{{ $data->ukm->id }}">{{ $data->ukm->ukmNama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="full field mt-4">
                                    <span>Tujuan Pembayaran </span>
                                    <input type="text" name="tujuan_pembayaran" placeholder="Cth: Uang Kas" required />
                                </div>
                                <div class="full field mt-4">
                                    <span>Upload bukti pembayaran </span>
                                    <input type="file" name="bukti" required />
                                </div>
                                <div class="full field">
                                    <div class="center">
                                        <button class="buttonCustom" type="submit">Bayar</button> &nbsp;
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
                <h2>Riwayat Pembayaran</h2>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Unit Kegiatan Mahasiswa</th>
                        <th>Tujuan Pembayaran</th>
                        <th>Bukti</th>
                        <th>Tgl Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaran as $value)
                        <tr>
                            <td>{{ $value->ukm->ukmNama }}</td>
                            <td>{!! $value->tujuan_pembayaran !!}</td>
                            <td>
                                <a href="{{ url('bukti'.$value->bukti) }}" target="_blank">Buka Dokumen</a>
                            </td>
                            <td>{{ date('d-m-Y H:i', strtotime($value->tgl_bayar)) }}</td>
                            <td>
                                @if ($value->validasi == "menunggu")
                                    <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                @elseif ($value->validasi == "ditolak")
                                    <span class="badge bg-danger">Ditolak</span>
                                    <p>Keterangan: {!! $value->keterangan !!}</p>
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
