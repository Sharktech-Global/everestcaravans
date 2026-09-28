







 
 @extends('layouts.front')

 @section('content')
 <!--====== Booking Breadcrumb Part ======-->
    <section class="abreco-inner-banner booking-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="assets/images/shapes/banner-head.png" alt="">
                        </div>
                        <h1>Book Your Vehicle Today</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco test drive Booking START ======--> 
    <section class="contact-section section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-2-991">
                    <div class="contact-form">
                        @include('forms.vehicle_enquiry')
                    </div>
                </div>
                <div class="col-lg-4 order-1-991">
                    <div class="contact-head">
                        <h2>Enquire now</h2>
                        <h5>Time to gear up
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="21" viewBox="0 0 28 21" fill="none">
                                <path d="M15.4389 0H17.609L12.606 21H10.3047L15.4389 0Z" fill="white"/>
                                <path d="M25.7436 0H27.9137L22.9107 21H20.6094L25.7436 0Z" fill="white"/>
                                <path d="M5.13422 0H7.30435L2.30132 21H0L5.13422 0Z" fill="white"/>
                            </svg>
                        </h5>
                        <p>Now let’s start this new venture together and experience the seamless services and rides of Abreco with all its premium quality. Commence this journey to find your smooth ride.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
@section('js_after')
@endsection

