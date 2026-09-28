@extends('layouts.front')
@section('content')
    <section class="abreco-inner-banner booking-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="assets/images/shapes/banner-head.png" alt="">
                        </div>
                        <h1>{{ @$page->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Refund Content START ======-->
    <section class="content-inner section pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-2">{{ @$page->title }}</h2>
                    {{-- <h3 class="mb-2">Refund Eligibility</h3>
                    <h4 class="mb-2">Refund Process</h4>
                    <h5 class="mb-2">Refund Timeframe</h5> --}}
                    <p class="mb-2">{!! @$page->content!!}</p>
                   
                </div>
            </div>
        </div>
    </section>
@endsection
