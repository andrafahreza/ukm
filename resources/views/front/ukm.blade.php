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

    <div class="section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
						   <h2><span>List Unit Kegiatan</span><br> Mahasiswa</h2>
                        </div>
					  </div>
                </div>
                @foreach ($ukm as $value)
                    <div class="col-md-4">
                        <div class="full blog_img_popular">
                        <img class="img-responsive" src="{{ $value->logo }}" alt="#" />
                        <h4>{{ $value->ukmNama }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
