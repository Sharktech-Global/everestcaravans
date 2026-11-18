@extends('layouts.front')

@section('content')
    <section class="abreco-inner-banner privacy-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                        <img src="{{ asset('assets/abreco/images/shapes/banner-head.webp') }}" alt="">
                            
                        </div>
                        <h1>{{ @$page->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Privacy Content START ======-->
    <section class="content-inner section pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12 ft-pages-styles">
                    <h2 class="mb-2">{{ @$page->title }}</h2>
                    {{-- <h3 class="mb-2">Privacy Eligibility</h3>
                    <h4 class="mb-2">Privacy Process</h4>
                    <h5 class="mb-2">Privacy Timeframe</h5> --}}
                    <p class="mb-2">{!! @$page->content!!}</p>
                    {{-- <ul class="inner-ul">
                        <li>The product must have manufacturing defects or damage upon delivery.</li>
                        <li>You must notify us of the issue within [X] days of receiving the product.</li>
                        <li>The product must be returned in its original condition, including all accessories and packaging.
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
