@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
    <style>
    .cta-links a {
        flex-basis: 100% !important;
    }
    </style>
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner" style="background: url('{{ @$page->banner_image ? asset('storage/' . @$page->banner_image) : asset('assets/images/background/cng-models.webp') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">CNG MODELS</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                        aria-hidden="true"></i> <span>CNG MODELS</span></p>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-5 bg-black">
            
            <div class="container pt-5 mt-4">
                {{-- @foreach ($vehicles->chunk(3) as $chunk) --}}
                    <div class="row">
                        @foreach ($vehicles as $vehicle)
                            <div class="mb-5 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="carBoxes" style="background: url( {{ asset('storage/' . $vehicle->image) }} ) center center;">
                                    <span>{{ $vehicle->name }}</span>
                                    <div class="cta-links">
                                        <a href="{{ route('buy-new-car.show') }}?vehicle={{ $vehicle->slug }}" class="button button-block">SEND ENQUIRY</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                {{-- @endforeach --}}
            </div>

        </section>
    </main>
@endsection
@section('js_after')

@endsection