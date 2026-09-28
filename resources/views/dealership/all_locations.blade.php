@extends('layouts.app_front')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/locations.css') }}">
    <style>
        .location-map {
            padding: 20px;
            margin: auto;
            width: 50%;
            position: relative;
        }
    </style>
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner"
        style="background: url('{{ asset('assets/front/banner/network.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">FIND US</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" href="{{ route('home') }}">Home</a></span> <i
                        class="mx-2 fa fa-angle-right" aria-hidden="true"></i> <span>FIND US</span></p>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <section id="find-my-locations" class="section page-content"
        style="background: url('{{asset('assets/front/images/pattern3.svg')}}') no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="ftabs">
                        @foreach ($LocationTypes as $type)
                            <div class="card">
                                <div class="card-header" id="heading-{{ $type->id }}">
                                    <button class="btn btn-link text-uppercase service-Sale-btns" data-toggle="collapse"
                                        data-target="#collapse-{{ $type->id }}" aria-expanded="true"
                                        aria-controls="collapse-{{ $type->id }}">
                                        {{ $type->name }}
                                    <i class="fa fa-angle-down"></i></button>
                                </div>
                                <div id="collapse-{{ $type->id }}" class="collapse"
                                    aria-labelledby="heading-{{ $type->id }}" data-parent="#accordion">
                                    <div class="card-body">
                                        <div id="accordion-inner">
                                            <div class="row">

                                                @php
                                                    $locations = DB::table('locations')
                                                        ->where('location_type_id', $type->id)
                                                        ->get();
                                                @endphp

                                                @foreach ($locations as $location)
                                                    <div class="col-md-6 col-lg-4 location-wrapper">
                                                        <div class="address-box">
                                                            <h5>{{ $location->name }}</h5>
                                                            <p>
                                                                {!! $location->address !!}
                                                                <a href="tel:{{@$location->phone_numbers}}"><i class="fa fa-phone" style="transform: rotate(90deg);"></i>&nbsp;{{@$location->phone_numbers}}</a>
                                                            </p>                                                            
                                                            <a class="cta" href="{{ route('dealership.view', $location->slug) }}">Contact Us <i class="fa fa-angle-right"></i></a>
                                                        </div>
                                                        {{-- <div class="location-box">
                                                            {!! @$location->map !!}
                                                        </div> --}}
                                                    </div>
                                                @endforeach

                                            </div>



                                            {{-- @foreach ($locations as $location)
                                                <div class="data">
                                                    <h5 class="mb-0">{{ $location->name }}</h5>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="p-4">
                                                                <p>{!! $location->address !!}</p>
                                                                <a href="tel:{{@$location->phone_numbers}}">{{@$location->phone_numbers}}</a>
                                                                <a href="{{ route('dealership.view', $location->slug) }}">
                                                                    Contact Us <i class="fa fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 loc-map-iframe">
                                                            {!! @$location->map !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_after')
<script>
    $('#find-my-locations .card .card-header button').click(function(){
        $(this).toggleClass('opened');
    });
</script>
@endsection