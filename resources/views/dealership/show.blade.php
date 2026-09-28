@extends('layouts.app_front')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner"
        style="background: url('{{ asset('assets/front/banner/network.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">{{$location->name}}</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" href="{{ route('home') }}">Home</a></span> 
                    <i class="mx-2 fa fa-angle-right" aria-hidden="true"></i> <span><a class="text-white" href="{{ route('dealership.all_locations') }}">FIND US</a></span>
                    <i class="mx-2 fa fa-angle-right" aria-hidden="true"></i> <span>{{$location->name}}</span></p>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <section id="find-my-locations" class="section page-content"
        style="background: url('{{ asset('assets/front/images/BGpattern.svg') }}') no-repeat center center;background-size: cover;background-color: #000;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="hero__form carBooking bg-transparent px-0 mt-0">
                        <div class="mb-5 text-center text-white showroom-location">
                            <b>Abreco CARS</b><br>
                            {!! @$location->address !!}
                            <br>
                            <i class="fa fa-phone" style="transform: rotate(90deg);"></i>&nbsp;<a class="text-white" href="tel:{{@$location->phone_numbers}}">{{@$location->phone_numbers}}</a>
                        </div>
                        <div class="mb-5 text-center loc-map-iframe showroom-location-iframe">
                        {!! @$location->map !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <div class="hero__form carBooking mt-0">
                        <h2 class="title text-white">Get in touch</h2>
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
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_after')
    <script>
       
    </script>
@endsection
