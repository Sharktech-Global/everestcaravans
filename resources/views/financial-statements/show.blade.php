@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ asset('assets/images/background/board.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Financial statements of the company</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Financial statements of the company</span></p>
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
                            href="{{ asset('documents/pvsl-2020-21.pdf') }}"
                            target="_blank">
                            PVSL 2020-2021
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/pvsl-2019-20.pdf') }}"
                            target="_blank">
                            PVSL 2019-2020
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/pvsl-2018-19.pdf') }}"
                            target="_blank">
                            PVSL 2018-2019
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')

@endsection
