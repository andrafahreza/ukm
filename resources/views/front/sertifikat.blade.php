@extends('front.layouts.app')

@section('content')
    <section class="inner_banner" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="full">
                        <h3>Sertifikat</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section layout_padding padding_bottom-2">
        <div class="container">
            <div class="heading_main text_align_center">
                <h2>List Sertifikat</h2>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Unit Kegiatan Mahasiswa</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sertifikat as $value)
                        <tr>
                            <td>{{ $value->ukm->ukmNama }}</td>
                            <td>
                                <a href="{{ url('sertifikat'.$value->file) }}" target="_blank">Buka Dokumen</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
