@extends('layouts.front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <!-- BANNER -->
    {{-- <section class="vehicles-banner" style="background: url('{{asset('assets/images/background/default.png')}}') no-repeat center center; background-size: cover;min-height:500px;">
        <div class="container-fluid" >
        </div>
    </section> --}}

    <!--====== Breadcrumb Part ======-->
    {{--  <section class="abreco-inner-banner career-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner bread-inner-contact">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt="">
                            
                        </div>
                        <h1>Thank You</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>  --}}

    <!--====== Thankyou  Part ======-->
    <section class="section page-content thank-section pt-200 pb-100" style="background-color: rgba(234, 242, 255, 1)">
        <div id='flows'></div>
        <div class="container section pb-0">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 ">
                    <div class="text-center thank-box">
                        <i class="fa fa-check" style="color: #fff;font-size: 50px;border-radius: 50px;background: #9D166C;padding: 15px;"></i>
                        <h1>Thank You </h1>
                        <!-- <p class=""> Dear @if(isset($customer)) {{@$customer}} @else Customer @endif, <br> -->
                        <p class="">
                            Thanks for reaching out! We have recieved your enquiry, Our team will contact you as soon as possible . <br>

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
            </div>
        </div>
    </section>

@endsection

@section('js_after')
    <script>
    //    $(document).ready(function () {
    // // Handler for .ready() called.
    // $('html, body').animate({
    //     scrollTop: $('#flows').offset().top
    // }, 'slow');
// });
        /*function lightbox(idx) {
            var ninjaSldr = document.getElementById("ninja-slider");
            ninjaSldr.parentNode.style.display = "block";
            nslider.init(idx);
            var fsBtn = document.getElementById("fsBtn");
            fsBtn.click();
        }

        function fsIconClick(isFullscreen, ninjaSldr) {
            if (isFullscreen) {
                ninjaSldr.parentNode.style.display = "none";
            }
        }*/
        
    </script>
@endsection
