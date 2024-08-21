@extends('front.layouts.app')

@section('content')
    <section class="inner_banner" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="full">
                        <h3>Berita</h3>
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
						   <h2><span>List Berita</span><br> UKM</h2>
                        </div>
					  </div>
                </div>
                @foreach ($berita as $value)
                    <div class="col-md-4">
                        <a href="{{ route('list-berita', ['id' => $value->id]) }}">
                            <div class="full blog_img_popular">
                            <img class="img-responsive" src="/berita{{ $value->foto }}" alt="#" />
                            <h4>{{ $value->judul }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
