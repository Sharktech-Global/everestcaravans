@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/vehicle.css') }}">
    <style>
    .btn.explore {
        height: 65px;
        background: #fff;
        border: 0;
        min-width: 200px;
        padding: 0;
        line-height: 65px;
        cursor: pointer;
        -webkit-transition: .5s;
        transition: .5s;
        color: #000;
    }
    .btn.explore:before {
    content: '';
    width: 10px;
    height: 100%;
    background-color: #f00;
    position: absolute;
    left: 0;
    top: 0;
}
    .btn.explore:hover {
        background: #054fa1;
        color: #fff;
    }
        @media (min-width: 991px) and (max-width: 1200px) {
            .vehicle-content.even-section .row {
                flex-direction: row;
            }
            .vehicle-content.odd-section .row {
                flex-direction: row;
            }
            .vehicle-content.even-section .row .vehicle-data,
            .vehicle-content.even-section .row .vehicle-images,
            .vehicle-content.odd-section .row .vehicle-data,
            .vehicle-content.odd-section .row .vehicle-images {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        @media (max-width: 991px) {
            .vehicle-content.even-section .row {
                flex-direction: column-reverse;
            }
            .vehicle-content.odd-section .row {
                flex-direction: column;
            }
            .vehicle-content .vehicle-data .title, .vehicle-content .vehicle-data div {
                text-align: center
            }
            .btn.explore {
                height: 60px;
                line-height: 60px;
            }
            .vehicle-content.even-section .row .vehicle-data,
            .vehicle-content.even-section .row .vehicle-images,
            .vehicle-content.odd-section .row .vehicle-data,
            .vehicle-content.odd-section .row .vehicle-images {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <!-- BANNER -->
    @if($VehicleType->slug == "hatchbacks")
        <section class="page-banner" style="background: url('{{ asset('assets/images/background/hatchbacks.webp') }}') no-repeat center center; background-size: cover;">
    @elseif($VehicleType->slug == "sedans")
        <section class="page-banner" style="background: url('{{ asset('assets/images/background/sedans.webp') }}') no-repeat center center; background-size: cover;">        
    @elseif($VehicleType->slug == "vans")
        <section class="page-banner" style="background: url('{{ asset('assets/images/background/van.webp') }}') no-repeat center center; background-size: cover;">        
    @elseif($VehicleType->slug == "suvsmuvs")
        <section class="page-banner" style="background: url('{{ asset('assets/images/background/suvsmuvs.webp') }}') no-repeat center center; background-size: cover;">        
    @else
        <section class="page-banner" style="background: url('{{ asset('assets/images/background/nexa.png') }}') no-repeat center center; background-size: cover;">
    @endif  
        <div class="container text-center">
            <span class="text-white title">{{$VehicleType->name}}</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" 
                            href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                        aria-hidden="true"></i> <span>{{$VehicleType->name}}</span></p>
            </div>
        </div>
    </section>
    <!-- END OF BANNER -->

    <main class="pt-0">
        @if ($vehicles->count() > 0)
        @php
            $i=0
        @endphp
            @foreach($vehicles as $vehicle)
            @php
                $count=$i%2;
            @endphp
                <section class="@if($count == 0) even-section @else odd-section @endif vehicle-content exterior section"
                    @if($count == 0) style="background: url('{{asset('assets/front/images/interior.webp')}}') no-repeat center center; background-size: cover; background-color:#181818;" @else style="background: url('{{asset('assets/front/images/pattern-exterior.webp')}}') no-repeat center center; background-size: cover; background-color:#2c2c2c;" @endif>
                    <div class="container">
                        <div class="row">
                            @if($count == 0)
                                <div class="col-sm-6 vehicle-data">
                                    <h3 class="title text-white">{{@$vehicle->name}}</h3>
                                    <div class="text-white">
                                        {!!@$vehicle->tagline!!}
                                    </div>
                                    <div class="mt-3">
                                        <a  href="{{route('nexa.cars.view', @$vehicle->slug)}}" class="btn explore">Explore</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 vehicle-images">
                                    <img src="{{asset('storage/'.@$vehicle->image)}}" height="auto" width="100%" alt="Abreco">
                                </div>
                            @else
                                <div class="col-sm-6 vehicle-images">
                                    <img src="{{asset('storage/'.@$vehicle->image)}}" height="auto" width="100%" alt="Abreco">
                                </div>
                                <div class="col-sm-6 vehicle-data">
                                    <h2 class="title text-white">{{@$vehicle->name}}</h2>
                                    <div class="text-white">
                                        {!!@$vehicle->tagline!!}.
                                    </div>
                                    <div class="mt-3">
                                        <a  href="{{route('nexa.cars.view', @$vehicle->slug)}}" class="btn explore">Explore</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
                @php
                    $i=$i+1;;
                @endphp
            @endforeach
        @endif
    </main>
@endsection
@section('js_after')
@endsection
