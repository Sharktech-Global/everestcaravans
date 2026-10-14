@extends('layouts.front')
@section('css_after')

@endsection
@section('content')
      <!--====== About Breadcrumb Part ======-->
      <section class="abreco-inner-banner exchange-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt="">
                        </div>
                        <h1>Vehicle Exchange  Services</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Inner Services Part ======-->
    <section class="inner-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="inner-s-text inner-s-text2">
                        <h3>Exchange Your Trucks For a Brand New One</h3>
                        <p>Looking for a brand new ride? Fed up off your existing vehicle? Well then we can aid you with that problem. Our vehicle exchange service grants you what Everest Caravans believe in, full throttle customer satisfaction and being there for you. With this service we help, you to exchange your already used automobiles for a brand new vehicle from their side. This is of great deal for many reasons,  firstly, you can acquire you premium ride and have it in your hands as fast as possible. Secondly, no more obstructions or delay will be caused to your businesses or to any of your duties as our vehicle exchange service is quick. Lastly, unlike other vehicle exchange services, we proceed to execute any exchange with proper documentation and paper works. </p>
                        <div class="primary-btn-main primary-btn-services">
                            <a href="#service-booking" class=" new-btn-style">
                                <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="none">
                                    <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> 
                                <img src="{{asset('assets/abreco/images/shapes/right-white.png')}}" class="d-none white" alt="">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="inner-s-img">
                        <img src="assets/images/exchange-inner.webp" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Service Points Part ======-->
    <section class="ser-features section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="v-f-box">
                        <h3>120 Point Inspections</h3>
                        <p>A necessary step to uphold the standards and quality of the vehicles that’s going to be used. Such a visual inspection can help in finding out issues and solutions. </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="v-f-box">
                        <h3>AMC & Extended Warranty </h3>
                        <p>Any mishaps with your battery can be fixed by proper replacement. Leaked, drained or damaged batteries are all considered when replacement is processed.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="v-f-box">
                        <h3>Warranty Continuations</h3>
                        <p>Tire is an essential part of the vehicle and taking care of it is essential. So, checkups are important for your tiers to analyze the pressure and solve any other issues.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="v-f-box">
                        <h3>Finance & Insurance Support </h3>
                        <p>A constant check on the fluids are a necessity cause that can help inm the better performance of the vehicle by managing the fluid levels or replacing ir accordingly.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="v-f-box">
                        <h3>Benefits of a New Truck</h3>
                        <p>Giving the ride a new and improved look with painting service to ensure that  looks doesn’t dim as time goes by. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <h2>“Hit the” Quote</h2>
                        <h5>Time to gear up
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="21" viewBox="0 0 28 21"
                                fill="none">
                                <path d="M15.4389 0H17.609L12.606 21H10.3047L15.4389 0Z" fill="white" />
                                <path d="M25.7436 0H27.9137L22.9107 21H20.6094L25.7436 0Z" fill="white" />
                                <path d="M5.13422 0H7.30435L2.30132 21H0L5.13422 0Z" fill="white" />
                            </svg>
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
