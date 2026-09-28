@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Material Creditors</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Material Creditors</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-5 bg-black">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/material-creditors-outstanding.pdf') }}"
                            target="_blank">
                            Material Creditors Outstanding
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')

@endsection
