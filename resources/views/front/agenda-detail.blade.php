@extends('front.layouts.app')

@section('content')
    <section class="inner_banner" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="full">
                        <h3>Agenda UKM</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section margin-top_50">
        <div class="container">
            <div class="row">
                <div class="col-md-12 layout_padding_2">
                    <div class="full">
                        <div class="heading_main text_align_left">
						   <h2><span>{{ $agenda->judul }}</span></h2>
                        </div>
						<div class="full">
						  <p>{!! $agenda->isi !!}</p>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
