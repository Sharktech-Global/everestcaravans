@extends('layouts.front')

@section('content')
    {{-- @dd($settings); --}}
    <!--====== Banner Part START ======-->
    <section id="web-banner" class="abreco-hero-area header slider-fade">
        <div class="owl-carousel owl-theme">
            @if ($sliders->count())
                @foreach ($sliders as $data)
                    <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
                    <div class="item bg-img bg-img-{{ $loop->iteration }}"
                        style="background-image: url({{ asset('storage/' . $data->image) }});">
                        <div class="caption">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="banner-inner">
                                            <div class="baner-bg-head">
                                                <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}"
                                                    alt="">
                                            </div>
                                            <h1 class="">{{ @$data->title }}<br><span>{{ @$data->sub_title }}</span>
                                            </h1>

                                            <div class="butn-light mt-30 mb-30">
                                                {{-- <a href="{{ route('vehicles.show', $data->vehicle->slug) }}">Enquire Now</a> --}}
                                                {{-- <a href="{{ route('vehicles.show', ['slug' => $data->vehicle->slug, 'id' => 'your_identifier']) }}">Enquire Now</a> --}}
                                                <a href="{{ route('vehicles.show', $data->vehicle->slug) }}#your_identifier">Enquire Now</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->vehicle)
                                    <div class="truck-name">
                                        <h3>{{ @$data->vehicle->name }}</h3>
                                        <p>{!! @$data->description !!}</p>
                                    </div>
                                @endif
                                <div class="scroll-baner">
                                    <a href="#Features">Scroll</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <!-- Counter Number -->
        <div class="slide-counter">01/{{ $sliders->count() }}</div>
        <!-- Booking Search -->
        <div class="booking-wrapper">
            <form action="{{ route('vehicle_search') }}" method="POST">
                @csrf
                <div class="form-control">
                    <select name="type" id="vehicle_type" required>
                        <option value="">Select Type</option>
                        @foreach ($vehicle_types_data as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control d-none" id="vehicleApp">
                    <select name="vehicleApplications" id="vehicleApplications">
                        <option value="">Select Application</option>

                    </select>
                </div>
                <div class="form-control form-control-submit">
                    <input type="submit" value="Search" name="submit">
                </div>
            </form>
        </div>
    </section>

    <!--====== Mobile Banner START ======-->
    <section id="mobile-banner" class="abreco-hero-area header slider-fade d-none">
        <div class="owl-carousel owl-theme">
            @if ($sliders->count())
                @foreach ($sliders as $data)
                    <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
                    <div class="item bg-img bg-img-1"
                        style="background-image: url({{ asset('storage/' . $data->image) }});">
                        <div class="overlay"></div>
                        <div class="caption">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="banner-inner">
                                            <div class="baner-bg-head">
                                                <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}"
                                                    alt="">
                                            </div>
                                            <h1 class="">{{ @$data->title }}<br><span>{{ @$data->sub_title }}</span>
                                            <div class="butn-light mt-30 mb-30">
                                                <a href="{{ route('vehicles.show', $data->vehicle->slug) }}">Enquire Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->vehicle)
                                    <div class="truck-name">
                                        <h3>{{ $data->vehicle->name }}</h3>
                                        <p class="">{{ $data->description }}</p>
                                    </div>
                                @endif
                                <div class="scroll-baner">
                                    <a href="#Features">Scroll</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Counter Number -->
        <div class="slide-counter">01/03</div>
        <!-- Booking Search -->
        <div class="booking-wrapper">
            <form action="{{ route('vehicle_search') }}" method="POST">

                @csrf
                <div class="form-control">
                    <select name="type" id="vehicle_type_mobile" required>
                        <option value="">Select Type</option>
                        @foreach ($vehicle_types_data as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control d-none" id="vehicleAppMobile">
                    <select name="vehicleApplications" id="vehicleApplicationsmobile">
                        <option value="">Select Application</option>
                    </select>
                </div>
                <div class="form-control form-control-submit">
                    {{-- <button type="submit" name="submit">Search</button> --}}
                    <input type="submit" value="Search">
                </div>
            </form>
        </div>
    </section>

    <!--====== abreco FEATURES PART START ======-->
    <section class="abreco-features-area pt-130 pb-100" id="Features">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-3">
                    <div class="abreco-features-tabs-btn aftb">

                        <div class="nav nav-pills flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($vehicle_types_data as $type)
                                <a class="nav-link type-cliker  @if ($loop->first) first-nav-link active @else nav-link-{{ $loop->iteration }} @endif"
                                    id="v-pills-{{ $type->slug }}-tab " clicker="{{ $type->slug }}" data-toggle="pill"
                                    href="#v-pills-{{ $type->slug }}" role="tab"
                                    aria-controls="v-pills-{{ $type->slug }}" aria-selected="true">
                                    <span>{{ $type->name }}</span>
                                </a>
                            @endforeach

                        </div>

                    </div>

                    <!-- Mobile view header vehicle Menus -->
                    <div class="abreco-features-tabs-btn aftb dropdown dropdown-border drop-991 d-none mb-40">
                                                <!-- <button class="btn dropdown-toggle drop-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Choose Your Vehicles
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <a class="dropdown-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Truck & Trailers</a>
                                                      <a class="dropdown-item" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Passenger Vehicles</a>
                                                </div> -->
                                                <!-- <select class="mobile-dropdown" id="mobile-select">
                                                        @foreach ($vehicle_types_data as $type)
                                                        <option value="v-pills-{{ $type->slug }}">{{ $type->name }}</option>
                                                        @endforeach
                                                </select>  -->
                        <div class="nav nav-pills flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($vehicle_types_data as $type)
                                <a class="nav-link type-cliker  @if ($loop->first) first-nav-link active @else nav-link-{{ $loop->iteration }} @endif"
                                    id="v-pills-{{ $type->slug }}-tab " clicker="{{ $type->slug }}"
                                    data-toggle="pill" href="#v-pills-{{ $type->slug }}" role="tab"
                                    aria-controls="v-pills-{{ $type->slug }}" aria-selected="true">
                                    <span>{{ $type->name }}</span>
                                </a>
                            @endforeach

                            <!-- <div class="columns">
                                    <a href="#" class="trcuk"><span>truck</span></a>
                                    <a href="#" class="vans"><span>vans</span></a>
                                    <a href="#" class="tipper"><span>tipper</span></a>
                                </div> -->

                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        @foreach ($vehicle_types_data as $type)
                            <!-- 1st Tab -->
                            <div class="tab-pane fade @if ($loop->first) show active @else fade @endif "
                                id="v-pills-{{ $type->slug }}" role="tabpanel"
                                aria-labelledby="v-pills-{{ $type->slug }}-tab">
                                <div class="row" id="content">
                                    {{-- Filter vehicles for the current type --}}
                                    @php
                                        $vehicles_under_type = App\Vehicle::where('vehicle_type_id', $type->id)
                                            ->select('slug', 'tagline', 'name', 'image')
                                            ->where('status', 1)
                                            ->orderBy('order','ASC')
                                            ->take(8)
                                            ->get();
                                    @endphp
                                    {{-- Display vehicles for the current type --}}
                                    @foreach ($vehicles_under_type as $vehicle_data)
                                        <div class="col-lg-4 mb-3 box">
                                            <div class="fea-inner">
                                                <div class="img">
                                                   <a href="{{ route('vehicles.show', @$vehicle_data->slug) }}">
                                                   <img src="{{ asset('storage/' . @$vehicle_data->image) }}"
                                                        alt="abreco">
                                                   </a>
                                                </div>
                                                <div class="inner-details">
                                                    <h3><a href="{{ route('vehicles.show', @$vehicle_data->slug) }}">{{ @$vehicle_data->name }}</a></h3>
                                                    <p>{!! \Illuminate\Support\Str::limit(@$vehicle_data->tagline, $limit = 80, $end = '...') !!}</p>
                                                    {{-- <p>{!! @$vehicle_data->tagline !!}</p> --}}
                                                    <div class="inner-btn flex-wrap mt-3">
                                                        <a href="{{ route('vehicles.show', @$vehicle_data->slug) }}"
                                                            class="first-btn">View More</a>
                                                        <!-- <a href="{{ route('enquiry.index', @$vehicle_data->slug) }}"
                                                            class="sec-btn">Enquire Now</a> -->
                                                            <a href="#" class="sec-btn openPop" data-toggle="modal" data-target="#form-Popup" >Enquire Now</a>
                                                            <input type='hidden' class='vehicle-id' value="{{$vehicle_data->slug}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="feature-mobile-btn mt-60 mb-40">
                                <!-- <button id="load-more">Load More</button> -->
                                <div class="primary-btn-main">
                                    @php
                                        $type_first = @$vehicle_types_data[0];
                                    @endphp
                                    <a href="{{ route('vehicle_type', @$type_first->slug) }}" class=" new-btn-style"
                                        id="viewMore">
                                        <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21"
                                            height="14" viewBox="0 0 21 14" fill="none">
                                            <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <img src="{{ asset('assets/abreco/images/shapes/right-white.png') }}"
                                            class="d-none white" alt="">
                                        View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco About PART START ======-->
    {{-- section order 1 --}}
    <section class="abreco-service-area">
        @if ($about_section)
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="abt-logo d-flex">
                            <div class="logo">
                                <span>
                                    <img src="{{ asset('assets/abreco/images/shapes/1.png') }}" class="none-991"
                                        alt="">
                                    <img src="{{ asset('assets/abreco/images/shapes/1-white.png') }}"
                                        class="d-none block-991" alt="">
                                </span>
                            </div>
                            <div class="title">
                                <h2>{{ @$about_section->title }}</h2>
                                {{-- <p> {!! \Illuminate\Support\Str::limit( @$about_section->sub_title , $limit = 80, $end = '...') !!}</p> --}}
                                <p>{{ @$about_section->sub_title }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 p-0-575">
                        <div class="abt-titlte p-15-575">
                            <p>{{ @$about_section->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center border-top-bottom">
                    <div class="col-lg-10">
                        <div class="abt-bg">
                            <img src="{{ asset('storage/' . @$group->content_image_one) }}" alt="">
                            <div class="abt-video">
                                <a href="{{ @$group->link }}" data-fancybox="images">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="48"
                                        viewBox="0 0 36 48" fill="none">
                                        <path
                                            d="M2 42.0457V5.95431C2 2.66657 5.74609 0.782778 8.3853 2.74334L32.6775 20.789C34.8305 22.3884 34.8305 25.6116 32.6775 27.211L8.3853 45.2566C5.74609 47.2172 2 45.3334 2 42.0457Z"
                                            fill="white" stroke="white" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!--====== abreco Counter PART START ======-->
    @if ($counters->count() > 0)
        <section class="counter-area pb-80">
            <div class="container">
                <div class="row bottom-line">
                    @foreach ($counters as $key => $data)
                        <div class="col-lg-3 col-md-6 col-6 p-0-991">
                            @php
                                $key = $key + 1;
                            @endphp
                            <div class="conter-box conter-box{{ $key }}">
                                <div class="count d-flex mt-2">

                                    @if ($data->counter < 10)
                                        <span class="zero">0</span>
                                    @endif

                                    <div class="counter-item">

                                        {{ @$data->counter }}</div>
                                    <span>{{ $data->plus }}</span>
                                </div>
                                <div class="title">
                                    <h4>{{ $data->title }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!--====== Services PART START ======-->
    @if ($services->count() > 0)
        <section class="services-areas section pt-30 pb-70">
            <div class="container">
                <div class="row mb-60 align-items-center">
                    <div class="col-lg-9">
                        <div class="abreco-section-title">
                            <h3 class="abreco-title">“Top Gear” Services</h3>
                            <p>Providing world class services that can enhance the customer’s experience efficiently.</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="">
                            <div class="primary-btn-main mt-0 service-btn01">
                                <a href="{{ route('services.index') }}" class=" new-btn-style">
                                    <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                        viewBox="0 0 21 14" fill="none">
                                        <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <img src="{{ asset('assets/abreco/images/shapes/right.svg') }}" class="d-none white"
                                        alt="">
                                    Explore Services</a>
                            </div>
                            <!-- <a href="{{ route('services.index') }}">
                                        <div class="icons">
                                            <img src="{{ asset('assets/abreco/images/shapes/2.png') }}" alt="">
                                            <img src="{{ asset('assets/abreco/images/shapes/3.png') }}" alt="">
                                        </div>
                                        Explore More
                                    </a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-service none-991">
                <div class="row">
                    <div class="col-12">
                        <div class="service-slider owl-carousel">
                            @foreach ($services as $service)
                                <div class="service-item">
                                    <a  @if ($service->title == 'Financial Services') href="{{ route('finance.show') }}" @else href="{{ route('services.show', $service->slug) }}" @endif>
                                        <div class="img">
                                            <div class="overlay">
                                                <span>Learn More</span>
                                            </div>
                                            <img src="{{ asset('storage/' . $service->image) }}" alt="">
                                        </div>
                                        <div class="text">
                                            <h3>{{ @$service->title }}</h3>
                                            <span> {!! \Illuminate\Support\Str::limit($service->content, $limit = 80, $end = '...') !!}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Services -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="accordion accordion-home-services d-none block-991 mt-30" id="accordionExample">
                            @foreach ($services as $key => $service)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $key }}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse{{ $key }}"
                                                aria-expanded="true" aria-controls="collapse{{ $key }}">
                                                {{ @$service->title }}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse{{ $key }}"
                                        class="collapse @if ($key == 0) show @endif"
                                        aria-labelledby="heading{{ $key }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            {{ @$service->content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!--====== Truck PART 01 START (SCV) ======-->
    @if ($products->count() > 0)
        @foreach ($products as $key => $product)
            <section
                class="solid-vehicles @if ($key % 2 == 0) solid-vehicles-one @else solid-vehicles-two @endif section pb-180 pt-50">
                @if ($key % 2 == 0)
                    <div class="left-img d-flex">
                        <img src="{{ asset('assets/abreco/images/trucks/left-img.png') }}" alt="">
                    </div>
                @else
                    <div class="left-img left-img2 d-flex sadfs">
                        <img src="{{ asset('assets/abreco/images/shapes/trek-rightside.webp') }}" alt="">
                    </div>
                @endif
                <div class="container">
                    <div class="row">
                        @if ($key % 2 == 0)
                            <div class="col-lg-5">
                                <div class="slider-sec">
                                    <div @if ($key == 0) id="slider" @else id="slider2" @endif>
                                        <div class="slider-wrap">
                                            <div
                                                @if ($key == 0) id="intro-slider"  @else id="intro-slider2" @endif>
                                                <div @if ($key == 0) class="intro-slide" @else class="intro-slide2" @endif
                                                    data-class="1" data-position="1">
                                                    <div class="slide-overlay"></div>
                                                    <div class="poster-box poster-box-22">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div @if ($key == 0) class="intro-slide" @else class="intro-slide2" @endif
                                                    data-class="2" data-position="2">
                                                    <div class="slide-overlay"></div>
                                                    <div class="poster-box poster-box-22">
                                                        <img src="{{ asset('storage/' . $product->image_secondary) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div @if ($key == 0) class="intro-slide" @else class="intro-slide2" @endif
                                                    data-class="3" data-position="3">
                                                    <div class="slide-overlay"></div>
                                                    <div class="poster-box poster-box-22">
                                                        <img src="{{ asset('storage/' . $product->image_third) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <span
                                                @if ($key == 0) class="slider-next" @else class="slider-next2" @endif>
                                                <img src="{{ asset('assets/abreco/images/shapes/left.svg') }}">
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="solid-text">
                                    <h2>{{ @$product->name }}</h2>
                                    <p><span>{!! @$product->description !!}</span></p>
                                    <div class="primary-btn-main primary-btn-main-desktop">
                                        <a href="{{ $product->button_link }}" class=" new-btn-style">
                                            <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21"
                                                height="14" viewBox="0 0 21 14" fill="none">
                                                <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <!-- <img src="{{ asset('storage/' . $product->image) }}"
                                                        class="d-none white" alt=""> -->
                                            <img src="{{ asset('assets/abreco/images/shapes/right.svg') }}"
                                                class="d-none white" alt="">
                                            Explore Products</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-7 order-2-991">
                                <div class="solid-text solid-text2 solid-text23">
                                    <h2>{{ @$product->name }}</h2>
                                    <p><span>{!! @$product->description !!}</span></p>
                                    <div class="primary-btn-main primary-btn-main-desktop mt-40">
                                        <a href="{{ $product->button_link }}" class=" new-btn-style">
                                            <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21"
                                                height="14" viewBox="0 0 21 14" fill="none">
                                                <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <img src="{{ asset('assets/abreco/images/shapes/right.svg') }}"
                                                class="d-none white" alt="">
                                            Explore Products</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 order-1-991">
                                <div class="slider-sec">

                                    <div id="slider3" class="slider3-secondline-slider">
                                        <div class="slider-wrap slider-wrap2">
                                            <div id="intro-slider3">
                                                <div class="intro-slide3" data-class="1" data-position="1">
                                                    <div class="slide-overlay"></div>
                                                    <div class="poster-box poster-box2 poster-box-222 bigguns-iframe">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="intro-slide3" data-class="2" data-position="2">
                                                    <div class="slide-overlay"></div>
                                                    <div class="poster-box poster-box2 poster-box-222 bigguns-iframe">
                                                        <img src="{{ asset('storage/' . $product->image_secondary) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="intro-slide3" data-class="3" data-position="3">
                                                    <div class="slide-overlay"></div>
                                                    <div class="poster-box poster-box2 poster-box-222 bigguns-iframe">
                                                        <img src="{{ asset('storage/' . $product->image_third) }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="slider-next3">
                                                <img src="{{ asset('assets/abreco/images/shapes/right.svg') }}"
                                                    alt="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            @php
                $key = $key + 1;
            @endphp
        @endforeach
    @endif


    <!--====== Testimonials PART START ======-->
    @if ($testimonials)
        <section class="testimonials-section section pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="testi-head">
                            <h1>Abreco In The Limelight</h1>
                            <p>We assure our customers with world-class services and guarantee quality and standard in our
                                products but its always better to hear from our customers on who we are and our capability.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ">
                        <div class="owl-carousel testi-slider">
                            @foreach ($testimonials as $testimonial)
                                <div class="item-testi">
                                    <div class="left-side">
                                        <div class="img">
                                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="">
                                        </div>
                                        <div class="name">
                                            <h2>{{ @$testimonial->name }}</h2>
                                            <span>{{ @$testimonial->designation }}</span>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <!-- <div class="quote-icon">
                                                        <img src="{{ asset('assets/abreco/images/shapes/quote.svg') }}" alt="" style="max-width: 100px;">
                                                    </div> -->
                                        <div class="text">
                                            <div class="qt-icon">
                                                <img src="{{ asset('assets/abreco/images/shapes/quotes.png') }}"
                                                    alt="">
                                            </div>
                                            <p>{!! @$testimonial->message !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!--====== abreco BLOG PART START ======-->
    <section class="abreco-blog-area pt-90 pb-95">
        <div class="container">
            @if ($blogs->count() > 0)
                <div class="row">
                    <div class="col-lg-9">
                        <div class="abreco-section-title">
                            <h3 class="abreco-title">Drift Across Our Blogs</h3>
                            <p>We have jot together our stories and knowledge to keep you updated. Give it a quick drift....
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="primary-btn-main expl-btn service-btn01">
                            <a href="{{ route('blog.show') }}" class=" new-btn-style">
                                <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                    viewBox="0 0 21 14" fill="none">
                                    <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <img src="{{ asset('assets/abreco/images/shapes/right-white.png') }}"
                                    class="d-none white" alt="">
                                Explore More</a>
                        </div>
                        <!-- <div class="expl-btn">
                                    <a href="{{ route('blog.show') }}">
                                        <div class="icons">
                                            <img src="{{ asset('assets/abreco/images/shapes/2.png') }}" alt="">
                                            <img src="{{ asset('assets/abreco/images/shapes/3.png') }}" alt="">
                                        </div>
                                        Explore More
                                    </a>
                                </div> -->
                    </div>
                </div>
                <div class="row mt-575-20">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-6 col-md-12">
                            <div class="abreco-blog-item mt-30">
                                <div class="thumb">
                                    <a href="{{ route('blog.details', $blog->slug) }}">
                                    <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <h3 class="title"><a
                                            href="{{ route('blog.details', $blog->slug) }}">{{ @$blog->title }}</a></h3>
                                    <p>{!! \Illuminate\Support\Str::limit(@$blog->details, $limit = 150, $end = '...') !!}</p>
                                    <a href="{{ route('blog.details', $blog->slug) }}" class="blog-btn-home"><span>Read More</span> <i
                                            class="fal fa-chevron-right"></i><i class="fal fa-chevron-right"></i>
                                        <i class="fal fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!--====== abreco Gallery PART START ======-->
    <section class="gallery-home pt-100 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="abreco-section-title">
                        <h3 class="abreco-title">Gallery</h3>
                        <p>Let’s roll Across the snaps 
                        </p>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="primary-btn-main expl-btn service-btn01">
                        <a href="{{ route('gallery.index') }}" class=" new-btn-style">
                            <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                viewBox="0 0 21 14" fill="none">
                                <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <img src="{{ asset('assets/abreco/images/shapes/right-white.png') }}" class="d-none white"
                                alt="">
                            View More</a>
                    </div>
                </div>
            </div>
                @if ($galleries->count() > 0)
                    <div class="row mt-30" id="content">
                        @foreach ($galleries as $key => $gallery)
                            <div class="col-md-3 col-6 box @if ($key >= 12) hidden @endif">
                                <div class="card home-galery">
                                    <div class="card-image">
                                        <a href="{{ asset('storage/' . $gallery->images) }}" data-fancybox="gallery" class="plus">
                                        <img src="{{ asset('storage/' . $gallery->images) }}">
                                    </a>
                                        <!-- <div class="overlay-box">
                                            <div class="overlay-content">
                                                <a href="{{ asset('storage/' . $gallery->images) }}" data-fancybox="gallery" class="plus">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
        </div>
    </section>

    <!--====== Experts PART START ======-->
    <section class="expert-section pt-30 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="expert-areas d-flex">
                        <div class="expert-inner">
                            <h1>Talk to the Experts</h1>
                            <p>We are always privileged to get you onboarded and give you the perfect ride of your desire.
                                So if you are interested, hit the breaks and get in touch with our experts to
                                know what’s in store for you.</p>
                        </div>
                        <div class="">
                            <!-- <a href="{{ route('contact') }}">Get in Touch</a> -->
                            <div class="primary-btn-main primary-btn-main-desktop primary-btn-main-40 mt-40">
                                <a href="{{ route('contact') }}#contact-identifier" class=" new-btn-style">
                                    <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                        viewBox="0 0 21 14" fill="none">
                                        <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <img src="{{ asset('assets/abreco/images/shapes/right.svg') }}" class="d-none white"
                                        alt="">
                                    Get in Touch</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Contact PART START ======-->
    <section class="contact-section section">
        <div class="container">
            <div class="row">




                <div class="col-lg-4 order-1-991">
                    <div class="contact-head">
                        <h2>Enquire now</h2>
                        <h5>Time to gear up
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="28" height="21" viewBox="0 0 28 21"
                                    fill="none">
                                    <path d="M15.4389 0H17.609L12.606 21H10.3047L15.4389 0Z" fill="white" />
                                    <path d="M25.7436 0H27.9137L22.9107 21H20.6094L25.7436 0Z" fill="white" />
                                    <path d="M5.13422 0H7.30435L2.30132 21H0L5.13422 0Z" fill="white" />
                                </svg> -->
                        </h5>
                        <p>Now let’s start this new venture together and experience the seamless services and rides of
                            Abreco with all its premium quality. Commence this journey to find your smooth ride.</p>
                    </div>
                </div>

                @include('forms.contactus_form')

            </div>
        </div>
        <!-- Locations Areas -->
        <div class="container">
            <div class="row row-padding-mob">
                @foreach ($locations_footer as $key => $locs)
                    @php
                        $key = $key + 1;
                    @endphp
                    <div class="col-lg-3 col-6 text-center p-0-991">
                        <div class="loc-box loc-box-{{ $key }} loc-box-new">
                            <div class="icon">
                                <img src="{{ asset('storage/' . $locs->banner_image) }}" alt="">
                            </div>
                            <h4>{{ $locs->name }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    
@endsection

@section('js_after')
    <script>
        var rightImageUrl = "{{ asset('assets/abreco/images/shapes/right.svg') }}";
    </script>
    <!-- Frist truck slider -->
    <script>
        //  $('#form-Popup-veh').submit(function(event) {
                 
        //         var response = grecaptcha.getResponse();
        //         alert(response);
        //             if (response.length === 0) {
        //                 alert("Please complete the reCAPTCHA before submitting the form.");
        //                 event.preventDefault(); // Prevent form submission
        //             }
        //     });


        (function($) {
            $.fn.stack_slider = function(options) {
                // Sldier core functions
                $(".slider-next").click(function() {
                    var total = $(".intro-slide").length;
                    $("#intro-slider .intro-slide:first-child")
                        .hide()
                        .appendTo("#intro-slider")
                        .fadeIn();
                    $.each($(".intro-slide"), function(index, dp_item) {
                        $(dp_item).attr("data-position", index + 1);
                    });
                });
                $("body").on(
                    "click",
                    "#intro-slider .intro-slide:not(:first-child)",
                    function() {
                        var get_slide = $(this).attr("data-class");
                        console.log(get_slide);
                        $("#intro-slider .intro-slide[data-class=" + get_slide + "]")
                            .hide()
                            .prependTo("#intro-slider")
                            .fadeIn();
                        $.each($(".intro-slide"), function(index, dp_item) {
                            $(dp_item).attr("data-position", index + 1);
                        });
                    }
                );
                // Drag
                $.fn.swipe = function(callback) {
                    var touchDown = false,
                        originalPosition = null,
                        $el = jQuery(this);

                    function swipeInfo(event) {
                        var x = event.originalEvent.pageX,
                            y = event.originalEvent.pageY,
                            dx;

                        dx = x > originalPosition.x ? "right" : "left";

                        return {
                            direction: {
                                x: dx
                            },
                            offset: {
                                x: x - originalPosition.x
                            }
                        };
                    }

                    $el.on("touchstart mousedown", function(event) {
                        touchDown = true;
                        originalPosition = {
                            x: event.originalEvent.pageX,
                            y: event.originalEvent.pageY
                        };
                    });

                    $el.on("touchend mouseup", function() {
                        touchDown = false;
                        originalPosition = null;
                        flag = true;
                    });

                    $el.on("touchmove mousemove", function(event) {
                        if (!touchDown) {
                            return;
                        }
                        var info = swipeInfo(event);
                        callback(info.direction, info.offset);
                    });

                    return true;
                };
                // disabel image drag
                $("#slider img").on("dragstart", function(event) {
                    event.preventDefault();
                });
                // Slider Methods
                // This is the easiest way to have default options.
                var settings = $.extend({
                        // These are the defaults.
                        color: "transparent",
                        background: "transparent",
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        dots: true,
                        arrows: true,
                        drag: true,
                        direction: "horizontal"
                    },
                    options
                );

                // dots
                if (settings.dots !== true) {
                    $("#dp-dots").hide();
                }
                // drag
                if (settings.drag == true) {
                    // trigger next prev on drag
                    var flag = true;
                    jQuery(".intro-slide").swipe(function(direction, offset) {
                        if (offset.x > 30 && flag) {
                            flag = false;
                            $(".slider-next").click();
                        }
                        if (offset.x < -30 && flag) {
                            flag = false;
                            $(".slider-prev").click();
                        }
                    });
                }
                // arrows
                if (settings.arrows !== true) {
                    $(".slider-next, .slider-prev").hide();
                }
                // slider autoplay
                if (settings.autoPlay == true) {
                    setInterval(function() {
                        $(".slider-next").click();
                    }, settings.autoPlaySpeed);
                }

                //slider direction
                if (settings.direction == "vertical") {
                    $(".slider-wrap").addClass("vertical");
                }

                // stack_slider the collection based on the settings variable.
                return this.css({
                    color: settings.color,
                    background: settings.background
                });
            };
        })(jQuery);

        $("#slider").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: true,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });
    </script>

    <!-- Second Truck Slider -->
    <script>
        (function($) {
            $.fn.stack_slider = function(options) {
                // Sldier core functions
                $(".slider-next2").click(function() {
                    var total = $(".intro-slide2").length;
                    $("#intro-slider2 .intro-slide2:first-child")
                        .hide()
                        .appendTo("#intro-slider2")
                        .fadeIn();
                    $.each($(".intro-slide2"), function(index, dp_item) {
                        $(dp_item).attr("data-position", index + 1);
                    });
                });
                $("body").on(
                    "click",
                    "#intro-slider2 .intro-slide2:not(:first-child)",
                    function() {
                        var get_slide = $(this).attr("data-class");
                        console.log(get_slide);
                        $("#intro-slider2 .intro-slide2[data-class=" + get_slide + "]")
                            .hide()
                            .prependTo("#intro-slider2")
                            .fadeIn();
                        $.each($(".intro-slide2"), function(index, dp_item) {
                            $(dp_item).attr("data-position", index + 1);
                        });
                    }
                );
                // Drag
                $.fn.swipe = function(callback) {
                    var touchDown = false,
                        originalPosition = null,
                        $el = jQuery(this);

                    function swipeInfo(event) {
                        var x = event.originalEvent.pageX,
                            y = event.originalEvent.pageY,
                            dx;

                        dx = x > originalPosition.x ? "right" : "left";

                        return {
                            direction: {
                                x: dx
                            },
                            offset: {
                                x: x - originalPosition.x
                            }
                        };
                    }

                    $el.on("touchstart mousedown", function(event) {
                        touchDown = true;
                        originalPosition = {
                            x: event.originalEvent.pageX,
                            y: event.originalEvent.pageY
                        };
                    });

                    $el.on("touchend mouseup", function() {
                        touchDown = false;
                        originalPosition = null;
                        flag = true;
                    });

                    $el.on("touchmove mousemove", function(event) {
                        if (!touchDown) {
                            return;
                        }
                        var info = swipeInfo(event);
                        callback(info.direction, info.offset);
                    });

                    return true;
                };
                // disabel image drag
                $("#slider img").on("dragstart", function(event) {
                    event.preventDefault();
                });
                // Slider Methods
                // This is the easiest way to have default options.
                var settings = $.extend({
                        // These are the defaults.
                        color: "transparent",
                        background: "transparent",
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        dots: true,
                        arrows: true,
                        drag: true,
                        direction: "horizontal"
                    },
                    options
                );

                // dots
                if (settings.dots !== true) {
                    $("#dp-dots").hide();
                }
                // drag
                if (settings.drag == true) {
                    // trigger next prev on drag
                    var flag = true;
                    jQuery(".intro-slide2").swipe(function(direction, offset) {
                        if (offset.x > 30 && flag) {
                            flag = false;
                            $(".slider-next2").click();
                        }
                        if (offset.x < -30 && flag) {
                            flag = false;
                            $(".slider-prev").click();
                        }
                    });
                }
                // arrows
                if (settings.arrows !== true) {
                    $(".slider-next2, .slider-prev").hide();
                }
                // slider autoplay
                if (settings.autoPlay == true) {
                    setInterval(function() {
                        $(".slider-next2").click();
                    }, settings.autoPlaySpeed);
                }

                //slider direction
                if (settings.direction == "vertical") {
                    $(".slider-wrap").addClass("vertical");
                }

                // stack_slider the collection based on the settings variable.
                return this.css({
                    color: settings.color,
                    background: settings.background
                });
            };
        })(jQuery);

        $("#slider2").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: true,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });
    </script>

    <!-- Third Truck Slider -->
    <!-- <script>
        (function($) {
            $.fn.stack_slider = function(options) {
                $(".slider-next3").click(function() {
                    var total = $(".intro-slide3").length;
                    $("#intro-slider3 .intro-slide3:first-child")
                        .hide()
                        .appendTo("#intro-slider3")
                        .fadeIn();
                    $.each($(".intro-slide3"), function(index, dp_item) {
                        $(dp_item).attr("data-position", index + 1);
                    });
                });
                $("body").on(
                    "click",
                    "#intro-slider3 .intro-slide3:not(:first-child)",
                    function() {
                        var get_slide = $(this).attr("data-class");
                        console.log(get_slide);
                        $("#intro-slider3 .intro-slide3[data-class=" + get_slide + "]")
                            .hide()
                            .prependTo("#intro-slider3")
                            .fadeIn();
                        $.each($(".intro-slide3"), function(index, dp_item) {
                            $(dp_item).attr("data-position", index + 1);
                        });
                    }
                );
                $.fn.swipe = function(callback) {
                    var touchDown = false,
                        originalPosition = null,
                        $el = jQuery(this);

                    function swipeInfo(event) {
                        var x = event.originalEvent.pageX,
                            y = event.originalEvent.pageY,
                            dx;

                        dx = x > originalPosition.x ? "right" : "left";

                        return {
                            direction: {
                                x: dx
                            },
                            offset: {
                                x: x - originalPosition.x
                            }
                        };
                    }

                    $el.on("touchstart mousedown", function(event) {
                        touchDown = true;
                        originalPosition = {
                            x: event.originalEvent.pageX,
                            y: event.originalEvent.pageY
                        };
                    });

                    $el.on("touchend mouseup", function() {
                        touchDown = false;
                        originalPosition = null;
                        flag = true;
                    });

                    $el.on("touchmove mousemove", function(event) {
                        if (!touchDown) {
                            return;
                        }
                        var info = swipeInfo(event);
                        callback(info.direction, info.offset);
                    });

                    return true;
                };
                $("#slider img").on("dragstart", function(event) {
                    event.preventDefault();
                });
                var settings = $.extend({
                        color: "transparent",
                        background: "transparent",
                        autoPlay: false,
                        autoPlaySpeed: 3000,
                        dots: true,
                        arrows: true,
                        drag: true,
                        direction: "horizontal"
                    },
                    options
                );

                if (settings.dots !== true) {
                    $("#dp-dots").hide();
                }
                if (settings.drag == true) {
                    var flag = true;
                    jQuery(".intro-slide3").swipe(function(direction, offset) {
                        if (offset.x > 30 && flag) {
                            flag = false;
                            $(".slider-next3").click();
                        }
                        if (offset.x < -30 && flag) {
                            flag = false;
                            $(".slider-prev").click();
                        }
                    });
                }
                if (settings.arrows !== true) {
                    $(".slider-next3, .slider-prev").hide();
                }
                if (settings.autoPlay == false) {
                    setInterval(function() {
                        $(".slider-next3").click();
                    }, settings.autoPlaySpeed);
                }
                if (settings.direction == "vertical") {
                    $(".slider-wrap").addClass("vertical");
                }
                return this.css({
                    color: settings.color,
                    background: settings.background
                });
            };
        })(jQuery);

        $("#slider3").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: false,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });
    </script> -->
    <script>
        (function ($) {
            $.fn.stack_slider = function (options) {
            // Sldier core functions
            $(".slider-next3").click(function () {
                var total = $(".intro-slide3").length;
                $("#intro-slider3 .intro-slide3:first-child")
                .hide()
                .appendTo("#intro-slider3")
                .fadeIn();
                $.each($(".intro-slide3"), function (index, dp_item) {
                $(dp_item).attr("data-position", index + 1);
                });
            });
            $("body").on(
                "click",
                "#intro-slider3 .intro-slide3:not(:first-child)",
                function () {
                var get_slide = $(this).attr("data-class");
                console.log(get_slide);
                $("#intro-slider3 .intro-slide3[data-class=" + get_slide + "]")
                    .hide()
                    .prependTo("#intro-slider3")
                    .fadeIn();
                $.each($(".intro-slide3"), function (index, dp_item) {
                    $(dp_item).attr("data-position", index + 1);
                });
                }
            );
            // Drag
            $.fn.swipe = function (callback) {
                var touchDown = false,
                originalPosition = null,
                $el = jQuery(this);
        
                function swipeInfo(event) {
                var x = event.originalEvent.pageX,
                    y = event.originalEvent.pageY,
                    dx;
        
                dx = x > originalPosition.x ? "right" : "left";
        
                return {
                    direction: {
                    x: dx
                    },
                    offset: {
                    x: x - originalPosition.x
                    }
                };
                }
        
                $el.on("touchstart mousedown", function (event) {
                touchDown = true;
                originalPosition = {
                    x: event.originalEvent.pageX,
                    y: event.originalEvent.pageY
                };
                });
        
                $el.on("touchend mouseup", function () {
                touchDown = false;
                originalPosition = null;
                flag = true;
                });
        
                $el.on("touchmove mousemove", function (event) {
                if (!touchDown) {
                    return;
                }
                var info = swipeInfo(event);
                callback(info.direction, info.offset);
                });
        
                return true;
            };
            // disabel image drag
            $("#slider img").on("dragstart", function (event) {
                event.preventDefault();
            });
            // Slider Methods
            // This is the easiest way to have default options.
            var settings = $.extend(
                {
                // These are the defaults.
                color: "transparent",
                background: "transparent",
                autoPlay: true,
                autoPlaySpeed: 3000,
                dots: true,
                arrows: true,
                drag: true,
                direction: "horizontal"
                },
                options
            );
        
            // dots
            if (settings.dots !== true) {
                $("#dp-dots").hide();
            }
            // drag
            if (settings.drag == true) {
                // trigger next prev on drag
                var flag = true;
                jQuery(".intro-slide3").swipe(function (direction, offset) {
                if (offset.x > 30 && flag) {
                    flag = false;
                    $(".slider-next3").click();
                }
                if (offset.x < -30 && flag) {
                    flag = false;
                    $(".slider-prev").click();
                }
                });
            }
            // arrows
            if (settings.arrows !== true) {
                $(".slider-next3, .slider-prev").hide();
            }
            // slider autoplay
            if (settings.autoPlay == true) {
                setInterval(function () {
                $(".slider-next3").click();
                }, settings.autoPlaySpeed);
            }
        
            //slider direction
            if (settings.direction == "vertical") {
                $(".slider-wrap").addClass("vertical");
            }
        
            // stack_slider the collection based on the settings variable.
            return this.css({
                color: settings.color,
                background: settings.background
            });
            };
        })(jQuery);
        
        $("#slider3").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: false,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });

    </script>
    <script type="text/javascript">
        jQuery('#home-slider-carousel').carousel({
            interval: 3000,
            autoplay: true
        });

        // FIXED HEADER
        $(document).ready(function() {

            var header = $(".header_area");
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= 1) {
                    header.addClass("cbp-af-header-shrink");
                } else {
                    header.removeClass("cbp-af-header-shrink");
                }
            });

            var header1 = $(".menu-section");
            $(window).scroll(function() {
                var scroll1 = $(window).scrollTop();
                if (scroll1 >= 1) {
                    header1.addClass("cbp-af-header-shrink");
                } else {
                    header1.removeClass("cbp-af-header-shrink");
                }
            });

        });
    </script>
    <script>
       $(document).ready(function() {
            // alert(1);
            // Listen for change event on the first select element
            
            $('#vehicle_type').on('change', function() { 
                $('#vehicleApp').removeClass('d-none');
                var selectedType = $(this).val();
                
                // alert(selectedType);
                // Make an Ajax request to fetch vehicles based on the selected type
                if(selectedType){
                        $.ajax({
                         url: '{{ route('get-vehicle-application', ':type') }}'.replace(':type',
                        selectedType),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Clear the current options in the second select element
                            $('#vehicleApplications').removeClass('d-none');
                            $('#vehicleApplications').empty();
                            $('#vehicleApplications').append(
                                '<option value="">Select Application</option>');

                            // Populate the second select element with retrieved vehicles
                            $.each(data, function(index, vehicle) {
                                $('#vehicleApplications').append('<option value="' + vehicle
                                    .id + '">' + vehicle.name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Error loading vehicle application.');
                        }
                    });
                }
                
            });

            $('#vehicle_type_mobile').on('change', function() {
                $('#vehicleAppMobile').removeClass('d-none');
                var selectedType = $(this).val();
                // alert(selectedType);
                // Make an Ajax request to fetch vehicles based on the selected type
                if(selectedType){
                    $.ajax({
                        url: '{{ route('get-vehicle-application', ':type') }}'.replace(':type',
                            selectedType),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Clear the current options in the second select element
                            $('#vehicleApplicationsmobile').empty();
                            $('#vehicleApplicationsmobile').append(
                                '<option value="">Select Application</option>');
                            // Populate the second select element with retrieved vehicles
                            $.each(data, function(index, vehicle) {
                                $('#vehicleApplicationsmobile').append('<option value="' +
                                    vehicle.id + '">' + vehicle.name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Error loading vehicle application.');
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('.type-cliker').click(function() {
                // Get the value of the clicker-value attribute
                var customValue = $(this).attr('clicker');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('createslugfromvalue') }}', // Replace with the actual route to retrieve the new URL
                    data: {
                        customValue: customValue
                    },
                    success: function(newUrl) {

                        // Update the href attribute of the anchor element
                        $("#viewMore").attr("href", newUrl);
                    },
                    error: function() {
                        // Handle errors here
                    }
                });
            });
        });
    </script>
@endsection
