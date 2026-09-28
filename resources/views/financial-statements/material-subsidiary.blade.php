@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay" data-setbg="{{ asset('assets/images/background/arena.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Material Subsidiary</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Material Subsidiary</span></p>
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
                            href="{{ asset('documents/pmil-Financials-2020-21.pdf') }}" target="_blank">
                            PMML Financials 2020-2021
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/pmml-financials-2019-20.pdf') }}" target="_blank">
                            PMML Financials 2019-2020
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/pmml-financials-2018-19.pdf') }}" target="_blank">
                            PMML Financials 2018-19
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/financial-statements-2018-19.pdf') }}" target="_blank">
                            PADL Financial Statements 2018-2019
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/financials-padl20-21.pdf') }}" target="_blank">
                            PADL Financial Statements 2020-2021
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/padl-financial-statements-2019-20.pdf') }}" target="_blank">
                            PADL Financial Statements 2019-2020
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/financial-18-19.pdf') }}" target="_blank">
                            VMPL Financial Statements 2018-2019
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/vision-financials-2020-21.pdf') }}" target="_blank">
                            VMPL Financial Statements 2020-2021
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/vmpl-2019-20.pdf') }}" target="_blank">
                            VMPL Financial Statements 2019-2020
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')

@endsection
