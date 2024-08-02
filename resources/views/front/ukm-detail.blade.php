@extends('front.layouts.app')

@section('content')
    <section class="inner_banner" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="full">
                        <h3>Unit Kegiatan Mahasiswa</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section margin-top_50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 layout_padding_2">
                    <div class="full">
                        <div class="heading_main text_align_left">
						   <h2><span>{{ $ukm->ukmNama }}</span></h2>
                        </div>
						<div class="full">
						  <p>{!! $ukm->ukmDeskripsi !!}</p>
						</div>
						<div class="full">
						   <a class="hvr-radial-out button-theme" href="{{ route('pendaftaran') }}">Daftar</a>
						</div>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="full">
                        <img src="{{ $ukm->logo }}" alt="#" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
