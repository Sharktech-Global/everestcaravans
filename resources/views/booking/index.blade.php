@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
    <style>
        @keyframes float {
            0% {
                box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
                transform: translatey(0px);
            }
            50% {
                box-shadow: 0 25px 15px 0px rgba(0,0,0,0.2);
                transform: translatey(-20px);
            }
            100% {
                box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
                transform: translatey(0px);
            }
        }


        .avatar {
            box-sizing: border-box;
            border: 5px white solid;
            overflow: hidden;
            box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
            transform: translatey(0px);
            animation: float 6s ease-in-out infinite;
            img { width: 100%; height: auto; }
        }
        .border_data{
            background: #eee;
            border: 1px solid transparent;
        }
        </style>
@endsection
@section('content')
 <!-- BANNER -->
 <section class="page-banner" style="background: url('{{ asset('assets/front/banner/online_booking.webp') }}') no-repeat center center; background-size: cover;">
    <div class="container text-center">
        <span class="text-white title">BOOK ONLINE</span>
        <div class="text-center breadcrumbs col-md-12">
            <p class="text-white"> <span><a class="text-white"
                        href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                    aria-hidden="true"></i> <span>BOOK ONLINE</span></p>
        </div>
    </div>
</section>
<!-- END BANNER -->

    <main id="content">
        <section class="section" style="background: url('{{ asset('assets/front/images/grey-toplrft-bottoright.webp') }}') top left;background-color: #fff;">
            <div class="container">
                <div class="row">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>{{ session('error') }}
                    </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-5 col-lg-12">
                        <h3 class="title text-center">ARENA CARS</h3>
                    </div>
                    @if($arena_vehicles->count() > 0)
                        @foreach ($arena_vehicles as $vehicle)
                            <div class="mb-5 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="carBoxes" @if($vehicle->online_image) style="background: url( {{ asset('storage/' . $vehicle->online_image) }} ) center center;" @else style="background: url( {{ asset('storage/' . $vehicle->image) }} ) center center;" @endif >
                                    <span>{{ $vehicle->name }}</span>
                                    <div class="cta-links">
                                        @if($vehicle->vehicle_type->slug == "nexa")
                                            <a  href="{{ route('vehicles.nexa.show', $vehicle->slug) }}" class="btn btnview">View Details</a>
                                        @elseif($vehicle->vehicle_type->slug == "cng-models")
                                            <a  href="{{ route('cng-models.show') }}" class="btn btnview">View Details</a>
                                        @else
                                            <a  href="#" class="btn btnview">View Details</a>
                                        @endif
                                      <a href="{{ route('booking.show', $vehicle->slug) }}" class="btn">BOOK NOW</a>
                                         {{-- <a  href="{{ route('buy-new-car.show') }}?vehicle={{ $vehicle->slug }}" class="btn">SEND ENQUIRY</a>  --}}


                                        {{-- <div class="float-left py-3 col-lg-6 col-md-12">
                                            <p class="pl-2 mb-0 text-white lh-15 text-uppercase">{{ $vehicle->name }}</p>
                                            <small class="pl-2 text-primary"><a
                                                    href="#"
                                                    class="text-primary">View
                                                    Details</a></small>
                                        </div>
                                        <div class="float-left py-3 text-right col-lg-6 col-md-12">
                                            <a href="{{ route('booking.show', $vehicle->slug) }}" class="btn btn-primary text-white">BOOK
                                                NOW</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <section class="section" style="background: url('{{ asset('assets/front/images/pattern-exterior.webp') }}') top left;background-color: #728497;">
            <div class="container">
                <div class="row">
                    <div class="mb-5 col-lg-12">
                        <h3 class="title text-center text-white">NEXA CARS</h3>
                    </div>
                    @if($nexa_vehicles->count() > 0)
                        @foreach ($nexa_vehicles as $vehicle)
                            <div class="mb-5 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="carBoxes" @if($vehicle->online_image) style="background: url( {{ asset('storage/' . $vehicle->online_image) }} ) center center;" @else style="background: url( {{ asset('storage/' . $vehicle->image) }} ) center center;" @endif >
                                    <span>{{ $vehicle->name }}</span>
                                    <div class="cta-links">
                                        @if($vehicle->vehicle_type->slug == "nexa")
                                            <a  href="{{ route('vehicles.nexa.show', $vehicle->slug) }}" class="btn btnview">View Details</a>
                                        @elseif($vehicle->vehicle_type->slug == "cng-models")
                                            <a  href="{{ route('cng-models.show') }}" class="btn btnview">View Details</a>
                                        @else
                                            <a  href="#" class="btn btnview">View Details</a>
                                        @endif
                                        <!-- <a href="{{ route('booking.show', $vehicle->slug) }}" class="btn">BOOK NOW</a> -->
                                         <a  href="{{ route('buy-new-car.show') }}?vehicle={{ $vehicle->slug }}" class="btn">SEND ENQUIRY</a>


                                        {{-- <div class="float-left py-3 col-lg-6 col-md-12">
                                            <p class="pl-2 mb-0 text-white lh-15 text-uppercase">{{ $vehicle->name }}</p>
                                            <small class="pl-2 text-primary"><a
                                                    href="#"
                                                    class="text-primary">View
                                                    Details</a></small>
                                        </div>
                                        <div class="float-left py-3 text-right col-lg-6 col-md-12">
                                            <a href="{{ route('booking.show', $vehicle->slug) }}" class="btn btn-primary text-white">BOOK
                                                NOW</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- END CAR LIST -->

        </section>
    </main>
@endsection
