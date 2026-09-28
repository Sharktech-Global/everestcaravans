@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$brochure->banner_image ? asset('storage/' . @$brochure->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="text-center row">
                <h1 class="text-center text-white col-md-12">Brochure</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>Brochure</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-5 bg-black">

            <!-- Brochure Content -->
            <div class="container pt-5">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center text-dark">
                            {!! @$brochure->content !!}
                        </p>
                    </div>
                </div>
            </div>
            <!-- END Brochure Content -->

            <!-- CAR LIST -->
            <div class="container pt-5 mb-4">
                <div class="px-5 mx-5 row">
                    @foreach ($vehicles as $vehicle)
                        <div class="mb-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="carBoxes">
                                <img class="w-100" alt="{{ $vehicle->name }}" title="{{ $vehicle->name }}"
                                    src="{{ asset('storage/' . $vehicle->thumb) }}">
                                <div class="">
                                    <div class="float-left py-3 col-lg-6 col-md-12">
                                        <p class="pl-2 mb-0 text-white lh-15">{{ $vehicle->name }}</p>
                                    </div>
                                    <div class="float-left py-3 text-right col-lg-6 col-md-12">
                                        <a href="{{ asset('storage/' . $vehicle->brochure) }}"
                                            class="btn btn-primary">DOWNLOAD</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- END CAR LIST -->

            <!-- CARRER VACCANCIES -->
            <!-- <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <div class="masonry">
                            @foreach ($vehicles as $vehicle)
                            <div class="item">
                                <a href="{{ asset('storage/' . $vehicle->brochure) }}" target="_blank"><img
                                        src="{{ asset('storage/' . $vehicle->image) }}"></a>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div> -->
            <!-- END CARRER VACCANCIES -->

        </section>
    </main>
@endsection
