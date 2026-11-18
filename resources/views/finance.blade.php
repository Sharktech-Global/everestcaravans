@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    <section class="abreco-inner-banner finance-page-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner bread-inner-services">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.webp') }}" alt="">
                        </div>
                        <h1>Financing Options Available</h1>
                        <div class="service-bread-btn">
                            <a href="#service-booking">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Financce Options START ======-->
    <section class="show-contact finance-opt pt-120 pb-0 p-relative">
        <div class="left-contact-img left-contact-img2">
            <svg xmlns="http://www.w3.org/2000/svg" width="216" height="88" viewBox="0 0 216 88" fill="none">
                <path d="M3.21515 4V88H0V0H216V4H3.21515Z" fill="url(#paint0_linear_238_968)" />
                <defs>
                    <linearGradient id="paint0_linear_238_968" x1="4.09201" y1="44" x2="177.71" y2="44"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#B1BDFF" />
                        <stop offset="1" stop-color="#CECECE" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="right-top-img">
            <svg xmlns="http://www.w3.org/2000/svg" width="216" height="88" viewBox="0 0 216 88" fill="none">
                <path d="M212.785 4V88H216V0H0V4H212.785Z" fill="url(#paint0_linear_238_980)" />
                <defs>
                    <linearGradient id="paint0_linear_238_980" x1="211.908" y1="44" x2="38.2896" y2="44"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#B1BDFF" />
                        <stop offset="1" stop-color="#CECECE" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="right-contact-img right-contact-img2">
            <svg xmlns="http://www.w3.org/2000/svg" width="216" height="88" viewBox="0 0 216 88" fill="none">
                <path d="M212.785 84V0H216V88H0V84H212.785Z" fill="url(#paint0_linear_238_990)" />
                <defs>
                    <linearGradient id="paint0_linear_238_990" x1="211.908" y1="44" x2="38.2896" y2="44"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#B1BDFF" />
                        <stop offset="1" stop-color="#CECECE" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="left-bottom-img">
            <svg xmlns="http://www.w3.org/2000/svg" width="216" height="88" viewBox="0 0 216 88" fill="none">
                <path d="M3.21515 84V0H0V88H216V84H3.21515Z" fill="url(#paint0_linear_238_989)" />
                <defs>
                    <linearGradient id="paint0_linear_238_989" x1="4.09201" y1="44" x2="177.71" y2="44"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#B1BDFF" />
                        <stop offset="1" stop-color="#CECECE" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="container">

            @foreach ($image as $category)
                <div class="row">
                    <div class="col-12">
                        <div class="show-cont-head">
                            {{--  <h1>Financing Options we offered is with</h1>  --}}
                            <h1>{{ @$category->title }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">

                    @foreach ($category->finance as $key => $finance)
                        <div class="col-lg-2 col-md-4 col-6 text-center">
                            @php
                                $key = $key + 1;
                            @endphp
                            <div class="fin-box fin-box-{{ $key }}">
                                <img src="{{ asset('storage/' . @$finance->image) }}"alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
    <!--====== Contact PART START ======-->
    <section class="contact-section section" id="service-booking">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-1-991">
                    <div class="contact-head">
                    <h2>Enquire now</h2>
                        <h5>Time to gear up
                        </h5>
                        <p>Now let’s start this new venture together and experience the seamless services and rides of
                            Abreco with all its premium quality. Commence this journey to find your smooth ride.</p>
                        <!-- <h2>Working Hours</h2>
                        <ul>
                            <li>Monday 9:00 AM to 9:00 PM</li>
                            <li>Tuesday 9:00 AM to 9:00 PM</li>
                            <li>Wednesday 9:00 AM to 9:00 PM</li>
                            <li>Thursday 9:00 AM to 9:00 PM</li>
                            <li>Friday 9:00 AM to 9:00 PM</li>
                            <li>Saturday 9:00 AM to 9:00 PM</li>
                        </ul> -->
                    </div>
                </div>
                <div class="col-lg-8 order-2-991">
                    <div class="contact-form">
                        @if($service->title == "Service Booking")
                            @include('forms.services_form')
                        @else
                            @include('forms.services_form_one')
                            
                        @endif
                        
                    </div>
                </div>
               
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script></script>
@endsection
