@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')

    <section class="section page-content" style="background-color: black">
        <div id='flows'></div>
        <div class="container  pb-0">
            <div class="text-center">
                <i class="fa fa-check" style="color: #009d06;font-size: 50px;border-radius: 50px;background: #141414;padding: 15px;"></i>
                 <h1 class="text-center text-white col-md-12 mt-4">Booking Successful</h1>
                 <p class="text-white">Thank you for your booking.Our team will contact you as soon as possible. <br>

                    {{-- Cheers! --}}
                   </p>
                {{-- <div class="text-center breadcrumbs col-md-12"> 
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> 
                        <span>Thank You</span>
                    </p>
                </div> --}}
            </div>
        </div>
    </section>

@endsection
