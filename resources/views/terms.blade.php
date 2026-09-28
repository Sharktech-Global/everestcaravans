@extends('layouts.front')
@section('content')
    <section class="abreco-inner-banner privacy-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt="">
                        </div>
                        <h1>{{ @$page->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Terms Content START ======-->
    <section class="content-inner section pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12 ft-pages-styles">
                    <h2 class="mb-2">{{ @$page->title }}</h2>
                    {{-- <h3 class="mb-2">Use of Our Website</h3>
                    <h4 class="mb-2">Intellectual Property</h4>
                    <h5 class="mb-2">Privacy Policy</h5> --}}
                    <p class="mb-2">{!! @$page->content !!}</p>
                    
                </div>
            </div>
        </div>
    </section>
@endsection
