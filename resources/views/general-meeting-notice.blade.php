@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">General Meeting Notice</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>General Meeting Notice</span></p>
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
                            href="{{ asset('documents/EGM-DEFERMENT-2nd-notice.docx.pdf') }}"
                            target="_blank">
                            Notice of Deferment of Extraordinary General Meeting
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/PVSL-EGM-Notice-02.04.2020.pdf') }}"
                            target="_blank">
                            PVSL EGM Notice 02/04/2020
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/Notice-for-Deferment-of-EGM-dtd-02nd-April-2020.pdf') }}"
                            target="_blank">
                            Notice for Deferment of EGM dtd 02nd April 2020
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="px-3 py-5 mb-3 text-center d-block bgLightOrange"
                            href="{{ asset('documents/NOTICE-OF-36TH-ANNUAL-GENERAL-MEETING.pdf') }}"
                            target="_blank">
                            Notice of Annual General Meeting
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')

@endsection
