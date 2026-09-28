@extends('layouts.app_front')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner"
        style="background: url('{{ asset('assets/images/background/default.png') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">LOCATION MAP</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" 
                            href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                        aria-hidden="true"></i> <span>LOCATION MAP</span></p>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-0 bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-white hero__form carBooking">
                            <h3><span class="text-primary text-uppercase">Address</span></h3>
                            <div class="mb-5 text-center">
                                {!! @$location->address !!}
                            </div>
                            <div class="mb-5 text-center loc-map-iframe">
                            {!! @$location->map !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <section class="section" id="career_mainform">
                            <div class="container">
                                <h3><span class="text-primary text-uppercase">GET IN TOUCH</span></h3>

                                {{-- <h3 class="title text-white text-center mb-4">BOOK A SERVICE</h3> --}}
                                <div class="hero__form carBooking">
                                    <div>
                                        @include('forms.getintouch_location_form')
                                    </div>
                                    {{-- <div class="d-none" id="service-otp-div">
                                        @include('forms.otp_form')
                                    </div> --}}
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissable" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>{{ session('error') }}
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissable" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>{{ session('success') }}
                                        </div>
                                    @endif
                                    <div id="validation-error" class="d-none">
                                        <div class="alert alert-danger alert-dismissable" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <p class="mb-0">{{ session('error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')
    <script>
       
    </script>
@endsection
