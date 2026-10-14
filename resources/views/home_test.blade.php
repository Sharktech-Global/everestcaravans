@extends('layouts.app')
@section('css_after')
    <style>
        .features.f1:hover,
        .tabbed-forms li.nav-item a#book-a-test-drive-tab.active {
            background: url("{{ asset('storage/' . @$home_settings->testdrive_image) }}") no-repeat center center;
            background-size: cover;
        }

        .features.f2:hover,
        .tabbed-forms li.nav-item a#buy-a-new-car-tab.active {
            background: url("{{ asset('storage/' . @$home_settings->exchange_image) }}") no-repeat center center;
            background-size: cover;
        }

        .features.f3:hover,
        .tabbed-forms li.nav-item a#insure-my-car-tab.active {
            background: url("{{ asset('storage/' . @$home_settings->insurance_image) }}") no-repeat bottom center;
            background-size: cover;
        }

        .features.f4:hover,
        .tabbed-forms li.nav-item a#service-booking-tab.active {
            background: url("{{ asset('storage/' . @$home_settings->service_image) }}") no-repeat center center;
            background-size: cover;
        }

    </style>
@endsection
@section('content')
    <section class="hero set-bg home" data-setbg="{{ asset('storage/' . @$home_settings->background_image) }}">
        <div class="container" style="max-width: 100%;">
            <div class="row">
                <div class="px-0 col-lg-12">
                    @if ($sliders->count())
                        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="60000">
                            <div class="carousel-inner">
                                @foreach ($sliders as $slider)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <div class="mask flex-center">
                                            <div class="container">
                                                <div class="row align-items-center pt-100">
                                                    <div class="order-1 col-md-6 col-xs-6 order-md-2">
                                                        @if ($slider->vehicle)
                                                            <a
                                                                href="/"><img
                                                                    alt="Everest"
                                                                    src="{{ asset('storage/' . $slider->image) }}"
                                                                    class="mx-auto pt-100">
                                                            @else
                                                                <a target="_blank" href="{{ $slider->explore }}"><img
                                                                        alt="Everest"
                                                                        src="{{ asset('storage/' . $slider->image) }}"
                                                                        class="mx-auto pt-100">
                                                                    @endif </a>
                                                    </div>
                                                    <div class="order-2 col-md-6 col-xs-6 order-md-1"><img alt="Everest"
                                                            src="{{ asset('storage/' . $slider->title) }}">
                                                        @if ($slider->description != '<p><br></p><h2><br></h2>')
                                                            <h5>{!! $slider->description !!}</h5>
                                                            @endif @if ($slider->vehicle)
                                                                <a class="mb-2 text-white btn-curve-right text-uppercase pl-15 pr-60"
                                                                    href="{{ route('booking.show', $slider->vehicle->slug) }}">BOOK
                                                                    NOW</a><a
                                                                    class="mb-2 text-white btn-curve-right text-uppercase pr-15 pl-60 movebtn"
                                                                    style="background: url({{ asset('assets/images/background/orange-curve-left-top.png') }}) no-repeat center left;"
                                                                    href="/">KNOW
                                                                    MORE</a>
                                                            @else
                                                                <a target="_blank"
                                                                    class="mb-2 text-white btn-curve-right text-uppercase pl-15 pr-60"
                                                                    href="{{ $slider->booking }}">BOOK NOW</a><a
                                                                    target="_blank"
                                                                    class="mb-2 text-white btn-curve-right text-uppercase pr-15 pl-60 movebtn"
                                                                    style="background: url({{ asset('assets/images/background/orange-curve-left-top.png') }}) no-repeat center left;"
                                                                    href="{{ $slider->explore }}">KNOW MORE</a>
                                                            @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                            </div> <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span
                                    class="sr-only">Previous</span> </a><a class="carousel-control-next"
                                href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon"
                                    aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                        </div>
                    @else
                        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="mask flex-center">
                                        <div class="container">
                                            <div class="row align-items-center pt-100">
                                                <div class="order-2 offset-lg-2 col-lg-4 col-md-6 col-12 order-md-1"></div>
                                                <div class="order-1 offset-lg-1 col-lg-5 col-md-6 col-12 order-md-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
                {{-- <div class="px-0 col-lg-3 bgBlackColor">
                    <section class="car-logos slider">
                        @foreach ($vehicles_filtered as $vehicle)
                            <div class="slide {{ $vehicle->name }}">
                                @if (isset($vehicle->explore))
                                    <a href="{{ $vehicle->explore }}">
                                        <h6 class='mt-3 mb-0 text-center'>{{ $vehicle->name }}</h6><img alt="Everest"
                                            src="{{ asset('storage/' . $vehicle->image) }}">
                                    </a>
                                @else
                                    <a href="{{ route('vehicles.show', $vehicle->vehicle->slug) }}">
                                        <h6 class='mt-3 mb-0 text-center'>{{ $vehicle->name }}</h6><img alt="Everest"
                                            src="{{ asset('storage/' . $vehicle->image) }}">
                                    </a>
                                @endif
                            </div>
                            @endforeach
                    </section>
                </div> --}}
            </div>
        </div>
    </section>
    <main id="content">
        <section class="bg-white" id=''>
            <div id="elementtoScrollToID"></div>
            <div class="px-0 container-fluid">
                <ul class="nav nav-tabs tabbed-forms" id=" " role="tablist">
                    <li class="nav-item"><a
                            class="nav-link @if (empty(session('tab')) || session('tab') == 'buy-a-new-car-tab') active @endif form-click"
                            id="buy-a-new-car-tab" data-toggle="tab" href="#new-car" role="tab" aria-controls="new-car"
                            aria-selected="false">BUY A NEW CAR</a></li>
                    <li class="nav-item "><a
                            class="nav-link @if (session('tab') == 'book-a-test-drive-tab') active @endif form-click"
                            id="book-a-test-drive-tab" data-toggle="tab" href="#test-drive" role="tab"
                            aria-controls="test-drive" aria-selected="true">EXCHANGE MY CAR</a></li>
                    <li class="nav-item "><a
                        class="nav-link @if (session('tab') == 'book-a-test-drive') active @endif form-click"
                        id="book-a-test-drive" data-toggle="tab" href="#test-drive-test" role="tab"
                        aria-controls="test-drive-test" aria-selected="true">TEST DRIVE</a></li>
                    <li class="nav-item"><a
                            class="nav-link @if (session('tab') == 'insure-my-car-tab') active @endif form-click"
                            id="insure-my-car-tab" data-toggle="tab" href="#insurance" role="tab" aria-controls="insurance"
                            aria-selected="false">INSURE MY CAR</a></li>
                    <li class="nav-item"><a
                            class="nav-link @if (session('tab') == 'service-booking-tab') active @endif form-click"
                            id="service-booking-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service"
                            aria-selected="false">SERVICE MY CAR</a></li>
                </ul>
                <div class="px-3 tab-content tabbed-single-form" id="myTabContent">
                    <div id="validation-error" class="d-none">
                        <div class="alert alert-danger alert-dismissable" role="alert"><button type="button"
                                class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                    </div>
                    <div class="tab-pane @if (!empty(session('tab')) && session('tab') == 'buy-a-new-car-tab') active @elseif(empty(session('tab'))) active @endif"
                        id="new-car" role="tabpanel" aria-labelledby="buy-a-new-car-tab">
                        <div id="buynewcar_mainform"> @include('forms.buynewcar_form') </div>
                    </div>
                    <div class="tab-pane fade show @if (!empty(session('tab')) && session('tab') == 'book-a-test-drive-tab') active @endif" id="test-drive"
                        role="tabpanel" aria-labelledby="book-a-test-drive-tab">
                        <div id="testdrive_mainform"> @include('forms.exchange_form') </div>
                    </div>
                    <div class="tab-pane fade show @if (!empty(session('tab')) && session('tab') == 'book-a-test-drive') active @endif" id="test-drive-test"
                        role="tabpanel" aria-labelledby="book-a-test-drive">
                        <div id="testdrive_mainform"> @include('forms.test_drive') </div>
                    </div>
                    <div class="tab-pane @if (!empty(session('tab')) && session('tab') == 'insure-my-car-tab') active @endif" id="insurance" role="tabpanel"
                        aria-labelledby="insure-my-car-tab">
                        <div id="insure_mainform"> @include('forms.insurance_form') </div>
                    </div>
                    <div class="tab-pane @if (!empty(session('tab')) && session('tab') == 'service-booking-tab') active @endif" id="service" role="tabpanel"
                        aria-labelledby="service-booking-tab">
                        <div id="service_mainform"> @include('forms.servicebooking_form') </div>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissable" role="alert" id="alert_message"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                        @endif @if (session('success'))
                            <div class="alert alert-success alert-dismissable" role="alert" id="success_message"><button
                                    type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        @endif
                </div>
            </div>
        </section>


       


        <section class="bg-989898 pt-100 pb-100"
            style="background: url({{ asset('assets/images/background/testimonial-bg.webp') }}); background-size: cover; background-repeat: no-repeat;">
            <div class="customer-feedback">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <h3 class="">TESTIMONIALS</h2>
                                    <h3 class="section-title">What our Clients Say</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel feedback-slider">
                                @foreach ($testimonials as $testimonial)
                                    <div class="feedback-slider-item">
                                        @if ($testimonial->photo)
                                            <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                                class="center-block img-circle" alt="{{ $testimonial->name }}">
                                        @else
                                            <img src="{{ asset('assets/images/avatar.webp') }}"
                                                class="center-block img-circle" alt="{{ $testimonial->name }}">
                                            @endif <h3 class="customer-name">{{ $testimonial->name }}</h3>
                                            <p> {{ str_limit(strip_tags($testimonial->message), 200) }} @if (strlen(strip_tags($testimonial->message)) > 200)
                                                    <a href="{{ route('testimonials.show') }}">read&nbsp;more</a>
                                                    @endif </p><span class="light-bg customer-rating" data-rating="5">
                                                {{ $testimonial->rating }} <i class="fa fa-star"></i></span>
                                    </div>
                                    @endforeach
                            </div>
                            @if (count($testimonials))
                                <div class="feedback-slider-thumb hidden-xs">
                                    <div class="thumb-prev"><span>
                                            @if (isset($testimonials[count($testimonials) - 1]['photo']))
                                                <img src="{{ asset('storage/' . $testimonials[count($testimonials) - 1]['photo']) }}"
                                                    alt="{{ $testimonials[count($testimonials) - 1]['name'] }}">
                                            @else
                                                <img src="{{ asset('assets/images/avatar.webp') }}"
                                                    class="center-block img-circle"
                                                    alt="{{ $testimonials[count($testimonials) - 1]['name'] }}">
                                                @endif
                                        </span><span class="light-bg customer-rating">
                                            {{ $testimonials[count($testimonials) - 1]['rating'] }} <i
                                                class="fa fa-star"></i></span></div>
                                    <div class="thumb-next"><span>
                                            @if (isset($testimonials[1]['photo']))
                                                <img src="{{ asset('storage/' . $testimonials[1]['photo']) }}"
                                                    alt="{{ $testimonials[1]['name'] }}">
                                            @else
                                                <img src="{{ asset('assets/images/avatar.webp') }}"
                                                    class="center-block img-circle" alt="{{ $testimonials[1]['name'] }}">
                                                @endif
                                        </span> <span class="light-bg customer-rating"> {{ $testimonials[1]['rating'] }}
                                            <i class="fa fa-star"></i></span></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="" class="bg-white no-bg-mobile info-section arena-cars pt-100 pb-100"
            style="background: url({{ asset('assets/images/background/black-blue-bg.webp') }}) bottom center; background-size: contain; background-repeat: no-repeat; background-attachment: fixed;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-7 hidden-xs">
                        @if ($arena_sliders->count())
                            <div id="arena-cars" style="width:1000px;height:100vh;margin:0 auto;margin-bottom: 0px;">
                                @foreach ($arena_sliders as $slider)
                                    <div style="background: rgb(0,0,0); background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 21%, rgba(255,255,255,1) 21%);"
                                        class="ls-slide"
                                        data-ls="bgsize:cover; bgposition:50% 50%; duration:4000; transition2d:5; kenburnsscale:1.2; parallaxtype:3d; parallaxdistance:4; parallaxrotate:20;">
                                        <div style="width:875px; height:410px; background:#ffffff; border-radius:10px; top:75px; left:20px;"
                                            class="ls-l"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:50% 50% -300px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:50% 50% -300px; parallax:true; parallaxlevel:20;">
                                        </div>
                                        <p style="font-weight:700;letter-spacing:-0.03em; font-size:36px; line-height:36px; color:#505050; top:129px; left:66px;"
                                            class="ls-l ls-vehicle-logo"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:78.2% 416.7% -700px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:78.2% 416.7% -700px; parallax:true; parallaxlevel:35;">
                                            @if ($slider->logo)
                                                <img src="{{ asset('storage/' . $slider->logo) }}">
                                                @endif
                                        </p>
                                        <p style="font-weight:400;width:310px; font-size:20px; line-height:28px; color:#505050; top:240px; left:69px; white-space:normal;"
                                            class="ls-l ls-vehicle-description"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:124.7% 32.5% -500px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:124.7% 32.5% -500px; parallax:true; parallaxlevel:25;">
                                            {{ $slider->description }}</p>
                                        <p style="font-weight:500;cursor:pointer; font-size:18px; line-height:45px; color:#ffffff; top:389px; left:66px;"
                                            class="ls-l ls-vehicle-call-to-actions"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:199.2% -244.4% -600px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:199.2% -244.4% -600px; hoverdurationin:300; hoveropacity:1; parallax:true; parallaxlevel:30;">
                                            <a href="{{ route('booking.show', $slider->vehicle->slug) }}"
                                                class="btn-curve-right text-uppercase pl-15 pr-60">BOOK NOW</a> <a
                                                href="/"
                                                class="text-dark text-uppercase pl-15 pr-60">EXPLORE</a> </p>
                                        @if ($slider->image)
                                            <a href="/"><img
                                                    width="618" height="304"
                                                    src="{{ asset('storage/' . $slider->image) }}"
                                                    class="ls-l" alt="Everest"
                                                    style="top:205px; left:374px;"
                                                    data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:13.2% 24.3% -1000px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:13.2% 24.3% -1000px; parallax:true; parallaxlevel:50;">
                                            </a>
                                            @endif @if ($slider->thumb1)
                                                <a style="" class="ls-l" href="#" target="_blank"
                                                    data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:-185.1% 134.1% -1400px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:-185.1% 134.1% -1400px; hover:false; hoveropacity:1; hoverscalex:0.95; hoverscaley:0.95; parallax:true; parallaxlevel:70;"><img
                                                        width="185" height="185"
                                                        src="{{ asset('storage/' . $slider->thumb1) }}"
                                                        class=" ls-imagelightbox" alt="Everest"
                                                        style="border-radius:0%; top:31px; left:798px; transform:skew(-10deg)!important;"></a>
                                                @endif @if ($slider->thumb2)
                                                    <a style="" class="ls-l" href="#" target="_blank"
                                                        data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:-149.2% 170.4% -1200px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:-149.2% 170.4% -1200px; hover:false; hoveropacity:1; hoverscalex:0.95; hoverscaley:0.95; parallax:true; parallaxlevel:60;"><img
                                                            width="125" height="125"
                                                            src="{{ asset('storage/' . $slider->thumb2) }}"
                                                            class=" ls-imagelightbox" alt="Everest"
                                                            style="border-radius:0%; top:66px; left:642px; transform:skew(-10deg)!important;">
                                                    </a>
                                                @endif
                                    </div>
                                @endforeach
                            </div>
                            @endif
                    </div>
                    <div class="col-sm-5">
                        {{-- <div class="text-right">
                            <h3 class="toleft"><span>Arena Cars</span></h3>
                            <h4>We create to inspire.</h4>
                            <h3>ARENA WORLD</h3>
                            <p>Driven by innovation, ARENA has always aspired to create exciting experiences for the world.
                                And in our bid to introduce such experiences, we keep seeking the new, the unexplored and
                                the unconventional. So, come, explore the world of ARENA. Create. Inspire.</p><a
                                class="btn-curve-left text-uppercase pr-15 pl-60" href="{{ route('about') }}">DISCOVER
                                More</a>
                        </div> --}}
                    </div>
                    <div class="col-sm-7 hidden-md pt-4">
                        @if ($arena_sliders->count())
                            <div id="arena-cars-mobile" style="width:1000px;height:100vh;margin:0 auto;margin-bottom: 0px;">
                                @foreach ($arena_sliders as $slider)
                                    <div style="background: rgb(0,0,0); background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 21%, rgba(255,255,255,1) 21%);"
                                        class="ls-slide"
                                        data-ls="bgsize:cover; bgposition:50% 50%; duration:4000; transition2d:5; kenburnsscale:1.2; parallaxtype:3d; parallaxdistance:4; parallaxrotate:20;">
                                        <div style="width:875px; height:410px; background:#ffffff; border-radius:10px; top:75px; left:20px;"
                                            class="ls-l"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:50% 50% -300px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:50% 50% -300px; parallax:true; parallaxlevel:20;">
                                        </div>
                                        <p style="font-weight:700;letter-spacing:-0.03em; font-size:36px; line-height:36px; color:#505050; top:129px; left:66px;"
                                            class="ls-l ls-vehicle-logo"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:78.2% 416.7% -700px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:78.2% 416.7% -700px; parallax:true; parallaxlevel:35;">
                                            @if ($slider->logo)
                                                <img src="{{ asset('storage/' . $slider->logo) }}" alt="Everest">
                                                @endif
                                        </p>
                                        <p style="font-weight:400;width:310px; font-size:20px; line-height:28px; color:#505050; top:240px; left:69px; white-space:normal;"
                                            class="ls-l ls-vehicle-description"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:124.7% 32.5% -500px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:124.7% 32.5% -500px; parallax:true; parallaxlevel:25;">
                                            {{ $slider->description }}</p>
                                        <p style="font-weight:500;cursor:pointer; font-size:18px; line-height:45px; color:#ffffff; top:389px; left:66px;"
                                            class="ls-l ls-vehicle-call-to-actions"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:199.2% -244.4% -600px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:199.2% -244.4% -600px; hoverdurationin:300; hoveropacity:1; parallax:true; parallaxlevel:30;">
                                            <a href="{{ route('booking.show', $slider->vehicle->slug) }}"
                                                class="btn-curve-right text-uppercase pl-15 pr-60">BOOK NOW</a> <a
                                                href="/"
                                                class="text-dark text-uppercase pl-15 pr-60">EXPLORE</a> </p>
                                        @if ($slider->image)
                                            <a href="/"><img
                                                    width="618" height="304"
                                                    src="{{ asset('storage/' . $slider->image) }}"
                                                    class="ls-l" alt="Everest"
                                                    style="top:205px; left:374px;"
                                                    data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:13.2% 24.3% -1000px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:13.2% 24.3% -1000px; parallax:true; parallaxlevel:50;"></a>
                                            @endif @if ($slider->thumb1)
                                                <a style="" class="ls-l" href="#" target="_blank"
                                                    data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:-185.1% 134.1% -1400px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:-185.1% 134.1% -1400px; hover:false; hoveropacity:1; hoverscalex:0.95; hoverscaley:0.95; parallax:true; parallaxlevel:70;"><img
                                                        width="185" height="185"
                                                        src="{{ asset('storage/' . $slider->thumb1) }}"
                                                        class=" ls-imagelightbox" alt="Everest"
                                                        style="border-radius:0%; top:31px; left:798px; transform:skew(-10deg)!important;"></a>
                                                @endif @if ($slider->thumb2)
                                                    <a style="" class="ls-l" href="#" target="_blank"
                                                        data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:-149.2% 170.4% -1200px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:-149.2% 170.4% -1200px; hover:false; hoveropacity:1; hoverscalex:0.95; hoverscaley:0.95; parallax:true; parallaxlevel:60;"><img
                                                            width="125" height="125"
                                                            src="{{ asset('storage/' . $slider->thumb2) }}"
                                                            class=" ls-imagelightbox" alt="Everest"
                                                            style="border-radius:0%; top:66px; left:642px; transform:skew(-10deg)!important;"></a>
                                                @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white info-section used-cars"
            style="background: url({{ asset('assets/images/background/road.jpg') }}) bottom center; background-size: contain; background-repeat: repeat-x; padding-top: 40px; padding-bottom: 40px;">
        </section>
        <section class="bg-white no-bg-mobile info-section nexa-cars pt-100 pb-100"
            style="background: url({{ asset('assets/images/background/blue-black-bg.webp') }}) bottom center; background-size: contain; background-repeat: no-repeat; background-attachment: fixed;">
            <div class="container py-5">
                <div class="row ">
                    <div class="col-sm-5 ">
                        <div class="text-left">
                            <h3 class="toright"><span>Nexa Cars</span></h3>
                            <h4>We create to inspire.</h4>
                            <h3>nexa WORLD</h3>
                            <p>Welcome to a New, Exclusive Automotive Experience. Everything at Nexa will ensure that you
                                have a relationship for a lifetime, hospitality that pampers you and technology that is
                                innovative. These new experiences are premium, elegant, dynamic and customised around the
                                most discerning customer in the world: You. Experience New.</p><a
                                class="btn-curve-right text-uppercase pl-15 pr-60" href="https://www.popularnexa.com/"
                                target="_blank">DISCOVER More</a>
                        </div>
                    </div>
                    <div class="col-sm-7 ">
                        @if ($nexa_sliders->count())
                            <div id="nexa-cars" style="width:1000px;height:100vh;margin:0 auto;margin-bottom: 0px;">
                                @foreach ($nexa_sliders as $slider)
                                    <div style="background: rgb(0,0,0); background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 21%, rgba(255,255,255,1) 21%);"
                                        class="ls-slide"
                                        data-ls="bgsize:cover; bgposition:50% 50%; duration:4000; transition2d:5; kenburnsscale:1.2; parallaxtype:3d; parallaxdistance:4; parallaxrotate:20;">
                                        <div style="width:875px; height:410px; background:#ffffff; border-radius:10px; top:75px; left:20px;"
                                            class="ls-l"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:50% 50% -300px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:50% 50% -300px; parallax:true; parallaxlevel:20;">
                                        </div>
                                        <p style="font-weight:700;letter-spacing:-0.03em; font-size:36px; line-height:36px; color:#505050; top:129px; left:66px;"
                                            class="ls-l ls-vehicle-logo"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:78.2% 416.7% -700px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:78.2% 416.7% -700px; parallax:true; parallaxlevel:35;">
                                            @if ($slider->logo)
                                                <img src="{{ asset('storage/' . $slider->logo) }}" alt="Everest">
                                                @endif
                                        </p>
                                        <p style="font-weight:400;width:370px; font-size:20px; line-height:28px; color:#505050; top:240px; left:69px; white-space:normal;"
                                            class="ls-l ls-vehicle-description"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:124.7% 32.5% -500px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:124.7% 32.5% -500px; parallax:true; parallaxlevel:25;">
                                            {{ $slider->description }}
                                        <p style="font-weight:500;cursor:pointer; font-size:18px; line-height:45px; color:#ffffff; top:389px; left:66px;"
                                            class="ls-l ls-vehicle-call-to-actions"
                                            data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:199.2% -244.4% -600px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:199.2% -244.4% -600px; hoverdurationin:300; hoveropacity:1; parallax:false; parallaxlevel:30;">
                                            <a href="{{ $slider->booking }}" target="_blank"
                                                class="btn-curve-right text-uppercase pl-15 pr-60" target="_blank">BOOK
                                                NOW</a><a href="{{ $slider->explore }}" target="_blank"
                                                class="text-dark text-uppercase pl-15 pr-60" target="_blank">EXPLORE</a>
                                        </p>
                                        @if ($slider->image)
                                            <a target="_blank" href="{{ $slider->explore }}"><img width="618"
                                                    height="304" src="{{ asset('storage/' . $slider->image) }}"
                                                    class="ls-l" alt="Everest"
                                                    style="top:205px; left:374px;"
                                                    data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:13.2% 24.3% -1000px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:13.2% 24.3% -1000px; parallax:true; parallaxlevel:50;"></a>
                                            @endif @if ($slider->thumb1)
                                                <a style="" class="ls-l" href="#" target="_blank"
                                                    data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:-185.1% 134.1% -1400px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:-185.1% 134.1% -1400px; hover:false; hoveropacity:1; hoverscalex:0.95; hoverscaley:0.95; parallax:true; parallaxlevel:70;">
                                                    <img width="185" height="185"
                                                        src="{{ asset('storage/' . $slider->thumb1) }}"
                                                        class=" ls-imagelightbox" alt="Everest"
                                                        style="border-radius:0%; top:31px; left:798px; transform:skew(-10deg)!important;">
                                                </a>
                                                @endif @if ($slider->thumb2)
                                                    <a style="" class="ls-l" href="#" target="_blank"
                                                        data-ls="offsetxin:-150; durationin:2000; easingin:easeOutExpo; rotateyin:-30; transformoriginin:-149.2% 170.4% -1200px; offsetxout:100; durationout:800; easingout:easeInExpo; rotateyout:30; transformoriginout:-149.2% 170.4% -1200px; hover:false; hoveropacity:1; hoverscalex:0.95; hoverscaley:0.95; parallax:true; parallaxlevel:60;"><img
                                                            width="125" height="125"
                                                            src="{{ asset('storage/' . $slider->thumb2) }}"
                                                            class=" ls-imagelightbox" alt="Everest"
                                                            style="border-radius:0%; top:66px; left:642px; transform:skew(-10deg)!important;"></a>
                                                @endif
                                    </div>
                                @endforeach
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white info-section used-cars"
            style="background: url({{ asset('assets/images/background/road.jpg') }}) bottom center; background-size: contain; background-repeat: repeat-x; padding-top: 40px; padding-bottom: 40px;">
        </section>
        <section class="bg-white no-bg-mobile info-section used-cars pt-100 pb-100"
            style="background: url({{ asset('assets/images/background/black-blue-bg.webp') }}) bottom center; background-size: contain; background-repeat: no-repeat; background-attachment: fixed;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-6 customer-choice">
                        <div class="float-left text-center w-50 p-relative"><img
                                src="{{ asset('assets/images/background/buy-a-car.webp') }}" alt="Popular Maruti"><a
                                class="bgBlackColor" href="https://usedcars.popularmaruti.com/listings/" target="_blank"
                                style="border: 2px solid;">Buy a Car</a></div>
                        <div class="float-left text-center w-50 p-relative"><img
                                src="{{ asset('assets/images/background/sell-a-car.webp') }}" alt="Popular Maruti"><a
                                class="bgBlackColor" href="https://usedcars.popularmaruti.com/sell-your-car/"
                                target="_blank" style="border: 2px solid;">Sell a Car</a></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-right">
                            <h3 class="toleft"><span>Pre-Owned Car</span></h3>
                            <h4>are you looking for a Quality</h4>
                            <h2>Pre-Owned Cars</h2>
                            <p>At Popular Maruti TrueValue we believe that all your needs should be met under one roof. Thus
                                when you visit any of the Popular Used Cars outlets, you will discover that not only do you
                                get the best value while buying, selling or exchanging but also all other car related needs.
                            </p><a class="btn-curve-left text-uppercase pl-60 pr-15"
                                href="https://usedcars.popularmaruti.com/" target="_blank">DISCOVER More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white quick-links">
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-6"><img
                            src="{{ asset('assets/images/background/service-body-shop.webp') }}" alt="Popular Maruti"
                            width="808" height="208">
                        <div class="px-3" style="margin-top: -10px;">
                            <h3 class="text-uppercase">Service and Body Shop</h3>
                            <p>With a widespread network of Service Outlets and Bodyshop (Accident repair) facilities across
                                Kerala & Chennai, we service close to 5,80,000 cars a year...</p><a
                                class="btn-curve-right text-uppercase pl-15 pr-60"
                                href="{{ route('services.show') }}">Book Now</a>
                        </div>
                    </div>
                    <div class="col-sm-6"><img src="{{ asset('assets/images/background/insurance.webp') }}"
                            alt="Popular Maruti" width="808" height="208">
                        <div class="px-3" style="margin-top: -10px;">
                            <h3 class="text-uppercase">Insurance</h3>
                            <p>Our experts can assist you in case of claim initiation, policy renewal, grievance redress,
                                changes in policy or even for general queries. Call us free 24x7 on <a
                                    href="tel:18001238090">1800 123 8090</a></p><a
                                class="btn-curve-right text-uppercase pl-15 pr-60"
                                href="{{ route('insure-my-car.show') }}">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-989898 pt-100 pb-100" id="welcomebar"
            style="background: url({{ asset('assets/images/background/welcome-bg.webp') }}); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; position: relative;">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <h2 class="section-title section-titled text-dark">POPULAR MARUTI</h2>
                            <p class="mb-4 hidden-xs">Popular Vehicles & Services Limited (“Popular Vehicles & Services” or
                                “Company”), one of the largest dealerships for Maruti <br>Suzuki India Limited (“Maruti
                                Suzuki”), in terms of sales volume in India belongs to the the Kuttukaran Group. Having
                                started <br>the business in [1939] the founder late K. P. Paul, pioneered many initiatives
                                in the automotive industry and grew rapidly in <br>strength. Popular Vehicles & Services
                                Limited is Maruti’s first Dealer in Kerala, having started its operations in 1984 at
                                <br>Thiruvananthapuram.</p>
                            <p>
                            <h4 class="text-dark">HIGHLIGHTS</h4>
                            </p>
                            <ul class="centered-list mb-5 mt-2">
                                <li><i class="fa fa-arrow-right"></i>Since 1984</li>
                                <li><i class="fa fa-arrow-right"></i>6 Lakh Happy customers</li>
                                <li><i class="fa fa-arrow-right"></i>150 Touchpoints</li>
                                <li><i class="fa fa-arrow-right"></i>24/7 customer support </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </section>
        <section class="bg-white pt-100 pb-100" style="">
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="section-title text-dark text-uppercase">Locate Us</h3>
                    </div>
                </div>
                <div class="m-auto col-sm-10">
                    <div class="row formshadow">
                        <div class="px-0 col-sm-6 hidden-xs">
                            <div id="myCarousel3" class="infoCarousel carousel slide carousel-fade" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="mask flex-center">
                                            <div class="align-items-center mt-100">
                                                <div class="order-2 order-md-2"><iframe
                                                        src="https://www.google.com/maps/d/embed?mid=1Th_WQBxs5iQLUW0vVuKI0kov820&hl=en"
                                                        width="100%" height="480"></iframe></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6"> @include('forms.quickenquiry_form') @if (session('error_message'))
                                <div class="alert alert-danger alert-dismissable" role="alert"><button type="button"
                                        class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                    <p class="mb-0">{{ session('error_message') }}</p>
                                </div>
                                @endif @if (session('success_message'))
                                    <div class="alert alert-success alert-dismissable" role="alert"><button type="button"
                                            class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span></button>
                                        <p class="mb-0">{{ session('success_message') }}</p>
                                    </div>
                                    @endif </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="ceo-message" class="bg-989898"
            style="background: url({{ asset('assets/images/background/ceo-bg.webp') }}) repeat-y; background-size: contain; background-attachment: fixed; padding-top: 60px; padding-bottom: 60px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><img src="{{ asset('assets/images/logo/ceo.webp') }}" alt="CEO"
                            style="margin: 0 auto;"></div>
                    <div class="col-md-7">
                        <h3 class="text-white">TALK TO THE CHIEF EXECUTIVE OFFICER</h3>
                        <p class="text-white">Behind the success of any organization are the valuable customers like
                            you. It <br>feels great when we are able to go beyond your expectations. We hope to retain this
                            relationship in the years to come. Any time you feel that we need to bring <br>some changes in
                            the quality of work we deliver, we would be more than happy <br>to receive your valuable
                            suggestions.</p><a class="btn-curve-right pl-15 pr-60"
                            href="{{ route('talk-to-ceo') }}">Please feel free to interact with me</a>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')
    <script src="{{ asset('assets/js/layerslider/layerslider.utils.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/layerslider/layerslider.transitions.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/layerslider/layerslider.kreaturamedia.jquery.js') }}" type="text/javascript">
    </script>
    <script>
        $('.form-click').click(function() {
            var id = $(this).attr('id');
            if (id) {
                $('.formPageName').val(id);
            }
        });
        $(document).ready(function() {
            $('.formPageName').val("new-car");
            $(".service-book-select").select2();
            $("#insurance-location").select2();
            $("#buynewcarloc").select2();
            $("#exchangelocation").select2();
            $(".service_date").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0,
                autoSize: true,
                changeMonth: true,
                changeYear: true,
                yearRange: "-0:+5",
                onClose: function() {
                    $(this).parsley().validate();
                }
            });
        });
        jQuery(document).ready(function($) {
            var feedbackSlider = $('.feedback-slider');
            feedbackSlider.owlCarousel({
                items: 1,
                nav: true,
                dots: true,
                autoplay: true,
                loop: true,
                mouseDrag: true,
                touchDrag: true,
                navText: ["<i class='fa fa-long-arrow-left'></i>",
                    "<i class='fa fa-long-arrow-right'></i>"
                ],
                responsive: {
                    767: {
                        nav: true,
                        dots: false
                    }
                }
            });
            feedbackSlider.on("translate.owl.carousel", function() {
                $(".feedback-slider-item h3").removeClass("animated fadeIn").css("opacity", "0");
                $(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating").removeClass(
                    "animated zoomIn").css("opacity", "0");
            });
            feedbackSlider.on("translated.owl.carousel", function() {
                $(".feedback-slider-item h3").addClass("animated fadeIn").css("opacity", "1");
                $(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating").addClass(
                    "animated zoomIn").css("opacity", "1");
            });
            feedbackSlider.on('changed.owl.carousel', function(property) {
                var current = property.item.index;
                var prevThumb = $(property.target).find(".owl-item").eq(current).prev().find("img").attr(
                    'src');
                var nextThumb = $(property.target).find(".owl-item").eq(current).next().find("img").attr(
                    'src');
                var prevRating = $(property.target).find(".owl-item").eq(current).prev().find('span').attr(
                    'data-rating');
                var nextRating = $(property.target).find(".owl-item").eq(current).next().find('span').attr(
                    'data-rating');
                $('.thumb-prev').find('img').attr('src', prevThumb);
                $('.thumb-next').find('img').attr('src', nextThumb);
                $('.thumb-prev').find('span').next().html(prevRating + '<i class="fa fa-star"></i>');
                $('.thumb-next').find('span').next().html(nextRating + '<i class="fa fa-star"></i>');
            });
            $('.thumb-next').on('click', function() {
                feedbackSlider.trigger('next.owl.carousel', [300]);
                return false;
            });
            $('.thumb-prev').on('click', function() {
                feedbackSlider.trigger('prev.owl.carousel', [300]);
                return false;
            });
        });
        $(document).ready(function() {
            $('#arena-cars').layerSlider({
                sliderVersion: '6.0.0',
                responsiveUnder: 0,
                maxRatio: 1,
                hideUnder: 0,
                hideOver: 100000,
                skin: 'outline',
                sliderFadeInDuration: 800,
                tnContainerWidth: '100%',
                tnWidth: 170,
                tnHeight: 100,
                skinsPath: '../../layerslider/skins/',
                height: 600
            });
            $('#arena-cars-mobile').layerSlider({
                sliderVersion: '6.0.0',
                responsiveUnder: 0,
                maxRatio: 1,
                hideUnder: 0,
                hideOver: 100000,
                skin: 'outline',
                sliderFadeInDuration: 800,
                tnContainerWidth: '100%',
                tnWidth: 170,
                tnHeight: 100,
                skinsPath: '../../layerslider/skins/',
                height: 600
            });
        });
        $(document).ready(function() {
            $('#nexa-cars').layerSlider({
                sliderVersion: '6.0.0',
                responsiveUnder: 0,
                maxRatio: 1,
                hideUnder: 0,
                hideOver: 100000,
                skin: 'outline',
                sliderFadeInDuration: 800,
                tnContainerWidth: '100%',
                tnWidth: 170,
                tnHeight: 100,
                skinsPath: '../../layerslider/skins/',
                height: 600
            });
        });
        $('#used-cars-slider').layerSlider({
            sliderVersion: '6.6.4',
            maxRatio: 1,
            fitScreenWidth: false,
            autoStart: false,
            startInViewport: false,
            keybNav: false,
            touchNav: false,
            skin: 'noskin',
            globalBGSize: 'cover',
            navPrevNext: false,
            hoverPrevNext: false,
            navStartStop: false,
            navButtons: false,
            showCircleTimer: false,
            thumbnailNavigation: 'disabled',
            skinsPath: '../../layerslider/skins/'
        });
    </script>
@endsection
