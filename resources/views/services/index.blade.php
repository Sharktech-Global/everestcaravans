@extends('layouts.front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <!--====== Services Breadcrumb Part ======-->
    <section class="abreco-inner-banner services-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner bread-inner-services">
                        <div class="baner-bg-head2">
                            <!-- <img src="{{ asset('assets/abreco/images/shapes/banner-head.webp') }}" alt=""> -->
                        </div>
                        <h1>Services That We Offer</h1>
                        <!-- <div class="service-bread-btn">
                            <a href="#">Book Now</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Inner Services Part ======-->
    <!-- vehicle servies -->
    @if($services->count() > 0)
        @foreach ($services as $key => $service)
            <section class="inner-services section @if($key % 2 != 0) inner-services2 @endif">
                <div class="container">
                    <div class="row">
                        @if($key % 2 == 0)
                        <div class="col-lg-7 ">
                            <div class="inner-s-text">
                                <h3>{{@$service->title}}</h3>
                                <div class="inner-s-img mb-20 d-none d-block-575">
                                    <img src="{{asset('storage/'.$service->image)}}" alt="">
                                </div>
                                <p>{!!@$service->content!!}</p>
                                <div class="primary-btn-main primary-btn-services">
                                    <a @if($service->title == 'Financial Services')  href="{{ route('finance.show') }}" @else href="{{route('services.show',$service->slug)}}" @endif class="new-btn-style">
                                        <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="none">
                                            <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg> 
                                        <!-- <svg class="d-none white" xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="#fff">
                                            <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>  -->
                                        <img src="{{asset('assets/abreco/images/shapes/right-white.webp')}}" class="d-none white" alt="">
                                        Explore Service
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="inner-s-img d-none-575">
                                <img src="{{asset('storage/'.$service->image)}}" alt="">
                            </div>
                        </div>
                        @else
                            <div class="col-lg-5 order-2-991">
                                <div class="inner-s-img d-none-575">
                                    <img src="{{asset('storage/'.$service->image)}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 order-1-991">
                                <div class="inner-s-text">
                                    <h3>{{@$service->title}}</h3>
                                    <div class="inner-s-img mb-20 d-none d-block-575">
                                        <img src="{{asset('storage/'.$service->image)}}" alt="">
                                    </div>
                                    <p>{!!@$service->content!!}</p>
                                    <div class="primary-btn-main primary-btn-services">
                                        <a @if($service->title == 'Financial Services') href="{{ route('finance.show') }}" @else href="{{route('services.show',$service->slug)}}" @endif class=" new-btn-style">
                                            <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="none">
                                                <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg> 
                                            <img src="{{asset('assets/abreco/images/shapes/right-white.webp')}}" class="d-none white" alt="">
                                            Explore Service
                                        </a>
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

    <!--====== Assistance contact Part ======-->
    <section class="assistance-area section pt-0 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="assistance-box">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="assist-inner first">
                                    <h2><span>For assisstance on</span>
                                        Commercial vehicles & Service Booking</h2>
                                </div>
                            </div>
                            @if($settings)
                                <div class="col-lg-4">
                                    <div class="assist-inner second">
                                        <p>{{@$settings->address}}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-4">
                                <div class="assist-inner third">
                                    <p><span>Reach Us On</span> 
                                        <a href="tel: {{@$settings->mobile}}"> {{@$settings->mobile}}</a>  
                                         <!-- |   <a href="tel:{{@$settings->whatsapp}}">{{@$settings->whatsapp}}</a> -->
                                        </p>
                                </div>
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
                        <h2>Enquire Now</h2>
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
        <div class="container">
            <div class="row row-padding-mob">
                @foreach ($locations_footer as $key => $locs)
                    @php
                        $key =$key + 1;
                    @endphp
                    <div class="col-lg-3 col-6 text-center p-0-991">
                        <div class="loc-box loc-box-{{$key}} loc-box-new">
                            <div class="icon">
                                <img src="{{ asset('storage/'.$locs->banner_image) }}" alt="">
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

    </script>
@endsection
