@extends('front.layouts.app')

@section('content')
    <!-- Start Banner -->
    <div class="ulockd-home-slider">
        <div class="container-fluid">
            <div class="row">
                <div class="pogoSlider" id="js-main-slider">
                    <div class="pogoSlider-slide" style="background-image:url(front/images/banner_img.png);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slide_text">
                                        <h3>SISTEM INFORMASI <br> UNIT KEGIATAN MAHASISWA</h3>
                                        <h4>Universitas Katolik Santo Thomas</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .pogoSlider -->
            </div>
        </div>
    </div>

    <div class="section layout_padding padding_bottom-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
                            <h2><span>Foto / Dokumentasi</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($ukm as $i => $uk)
                    <div class="col-lg-12">
                        <div class="container text-center my-3">
                            <div class="row mx-auto my-auto">
                                <div id="myCarousel{{ $i }}" class="carousel slide w-100" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        @php
                                            $kunci = 0;
                                            $getDok = [];
                                        @endphp
                                        @foreach ($dokumentasi->where('ukm_id', $uk->id)->get() as $key => $dok)
                                            @php
                                                if (
                                                    $key == 4 ||
                                                    $key == 8 ||
                                                    $key == 12 ||
                                                    $key == 16 ||
                                                    $key == 20 ||
                                                    $key == 24
                                                ) {
                                                    $kunci++;
                                                }

                                                $getDok[$kunci]['dokumentasi'][] = $dok;
                                            @endphp
                                        @endforeach
                                        @foreach ($getDok as $key => $value)
                                            <div class="carousel-item py-5 @if ($key == 0) active @endif">
                                                <div class="row">
                                                    @foreach ($value['dokumentasi'] as $item)
                                                        <div class="col-sm-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <a href="{{ route('list-ukm', ['id' => $item->ukm_id]) }}">
                                                                        <img src="/dokumentasi/{{ $item->file }}" width="200" height="120">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a class="carousel-control-prev text-dark" href="#myCarousel{{ $i }}" role="button"
                                        data-slide="prev">
                                        <span class="fa fa-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <span><b>{{ $uk->ukmNama }}</b></span>
                                    <a class="carousel-control-next text-dark" href="#myCarousel{{ $i }}" role="button"
                                        data-slide="next">
                                        <span class="fa fa-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="section layout_padding padding_bottom-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
                            <h2><span>Video</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            @foreach ($video as $key => $vid)
                                <div class="carousel-item @if ($key == 0) active @endif">
                                    <div class="row">
                                        @foreach ($vid['video'] as $item)
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="full blog_img_popular">
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe class="embed-responsive-item"
                                                            src="{{ $item->url }}"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="full">
                        <div class="heading_main text_align_center">
                            <a href="{{ route('list-pengumuman') }}">
                                <h2><span>Pengumuman</span></h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="full">
                        <div class="heading_main text_align_center">
                            <a href="{{ route('list-berita') }}">
                                <h2><span>Berita</span></h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    @foreach ($pengumuman as $item)
                        <a href="{{ route('list-pengumuman', ['id' => $item->id]) }}">
                            <div class="row align-items-center bg-white p-2 m-2 rounded shadow">
                                <div class="col-md-12">
                                    <h2>{{ $item->judul }}</h2>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    @foreach ($berita as $item)
                        <div class="row align-items-center bg-white p-2 rounded shadow">
                            <div class="col-md-3">
                                <img src="{{ asset('berita' . $item->foto) }}" class="img-fluid rounded"
                                    alt="Berita Image">
                            </div>
                            <!-- Announcement Content -->
                            <div class="col-md-9">
                                <h2 class="mb-2">{{ $item->judul }}</h2>
                                <a href="{{ route('list-berita', ['id' => $item->id]) }}"
                                    class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
                            <a href="{{ route('list-agenda') }}">
                                <h2><span>Agenda Ukm</span></h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($agenda as $item)
                        <a href="{{ route('list-agenda', ['id' => $item->id]) }}">
                            <div class="row align-items-center bg-white p-2 m-2 rounded shadow">
                                <div class="col-md-12">
                                    <h2>{{ $item->judul }}</h2>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
