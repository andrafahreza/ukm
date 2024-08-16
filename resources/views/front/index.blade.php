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
                <div class="col-lg-12">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    @foreach ($dokumentasi as $dok)
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="full blog_img_popular">
                                                <img class="img-responsive" src="dokumentasi/{{ $dok->file }}" alt="#" style="max-width: 300px" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <h2><span>Video</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            @foreach ($video as $key => $vid)
                                <div class="carousel-item @if ($key == 0) active @endif">
                                    <div class="row">
                                        @foreach ($vid['video'] as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="full blog_img_popular">
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe class="embed-responsive-item" src="{{ $item->url }}"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
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
                            <h2><span>Pengumuman</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="full">
                        <div class="heading_main text_align_center">
                            <h2><span>Berita</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row align-items-center bg-white p-2 m-2 rounded shadow">
                        <div class="col-md-12">
                            <h2>Important Announcement</h2>
                        </div>
                    </div>
                    <div class="row align-items-center bg-white p-2 m-2 rounded shadow">
                        <div class="col-md-12">
                            <h2>Important Announcement</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row align-items-center bg-white p-2 rounded shadow">
                        <!-- Announcement Image -->
                        <div class="col-md-3">
                            <img src="https://via.placeholder.com/300" class="img-fluid rounded" alt="Announcement Image">
                        </div>
                        <!-- Announcement Content -->
                        <div class="col-md-9">
                            <h2 class="mb-2">Important Announcement</h2>
                            <a href="#" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
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
                            <h2><span>Agenda Ukm</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row align-items-center bg-white p-2 m-2 rounded shadow">
                        <div class="col-md-12">
                            <h2>Important Announcement</h2>
                        </div>
                    </div>
                    <div class="row align-items-center bg-white p-2 m-2 rounded shadow">
                        <div class="col-md-12">
                            <h2>Important Announcement</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
