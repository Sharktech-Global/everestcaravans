<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate() !!}
    <!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-5WZ23Q7');</script>

<!-- End Google Tag Manager -->
    <link rel="icon" href="{{ asset('storage/' . @$settings->favicon) }}" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/style.min.css?v=1.0.11') }}" type="text/css"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/layerslider/layerslider.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/inttel/intlTelInput.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        :root {
            /* --button-on-hover_new: #2fc5ff ; */
            --main-bg-new-color: {{ @$settings->website_color ? $settings->website_color : '#f15336' }};

        }
        .location-car-logos .slick-track {
            top: 0;
        }
        .locationradio ul.parsley-errors-list {
            position: absolute;
            bottom: -10px;
            margin-bottom: -1px;
        }
        section.hero.set-bg.min-height-450.overlay:before {
            content: '' !important;
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100%;
            background: #000;
        }
        .row.rowRight {
            display: inline-block;
        }

        .row.rowRight .col-sm-7.rowRight {
            float: right;
        }

        .row.rowRight .col-sm-5.rowLeft {
            display: inline-block;
            align-items: center;
        }

        .tabbed-single-form.location-page-forms .form-group.col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        li.parsley-required {
            list-style-type: none;
            color: #f00 !important;
            float: left;
            width: 100%;
            text-align: left;
        }
        div#ui-datepicker-div {
            z-index: 999!important;
        }
        .about-gallery p.img-description {
            position: absolute;
            top: 50%;
            width: 100%;
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 10px;
            font-size: 14px;
            line-height: 18px;
            transition: .5s;
            display: none;
            transform: translate(-50%, -50%);
            left: 50%;
            vertical-align: middle;
        }
        .about-gallery .img-wrapper:hover p.img-description {
            display: block;
        }
        .about-gallery .img-wrapper {
            overflow: hidden;
        }
        .about-gallery .img-wrapper a img {
                transition: transform .5s ease;
        }
        .about-gallery .img-wrapper:hover a img {
            transform: scale(1.5);
        }
        .about-gallery .img-wrapper:hover .img-overlay {
            background: rgba(0, 0, 0, 0.5);
            opacity: 1;
        }
        #sticky li.parsley-required {
            font-size: 15px;
        }
        .form-group label.form-check-label {
            font-size: 15px;
        }
        .homepage header.header_area:after {
            display: none;
        }

        @media (min-width: 992px) {
            .videoTestimonial {
                max-width: 50%;
                margin: 0 auto;
            }
            div#testdrive-otp-div, div#buynewcar-otp-div, div#insure-otp-div, div#service-otp-div, div#offer-otp-div, div#exchange-otp-div, .enter-otp-div {
                max-width: 50%;
                margin: 0 auto;
            }
        }

        @media (max-width: 767px) {
            .form-group label.form-check-label {
                font-size: 10px;
                position: relative;
    top: -3px;
            }
            .about-gallery .img-wrapper:hover .img-overlay {
                opacity: 0;
            }
            .about-gallery p.img-description {
                position: relative;
                top: unset;
                color: #020202;
                display: block;
                transform: unset;
                left: unset;
            }
            .about-gallery .img-wrapper:hover a img {
                transform: scale(1);
            }
            .innerpage section.hero.set-bg.min-height-450.overlay h1 {
                position: absolute;
                top: 50%;
                left: 50%;
                bottom: 0;
                transform: translate(-50%, -50%);
            }

            .text-center.breadcrumbs.col-md-12 {
                display: none;
            }

            #sticky,
            .fixed-tabbed-single-form {
                width: 100%;
            }

            .vehiclepage h2 {
                text-align: center;
                font-size: 24px;
            }

            #sticky1.stick1 {
                display: none;
            }

            .pt-2.vehicle-data-tabs ul li {
                width: 33%;
                text-align: center;
            }

            .pt-2.vehicle-data-tabs ul li a {
                font-size: 10px;
            }

            .info-section.used-cars img {
                width: 100%;
                height: 100%;
            }

            .customer-choice .float-left.text-center.w-50.p-relative {
                width: 50% !important;
            }

            .info-section .customer-choice a {
                line-height: 36px;
            }

            .info-section .customer-choice {
                padding-top: 0;
                padding-bottom: 40px;
            }

            .info-section h3.toleft {
                margin-bottom: 30px;
                text-align: right;
            }

            .info-section h3.toright {
                margin-bottom: 30px;
            }

            .pb-100 {
                padding-bottom: 50px !important;
            }

            .quick-links {
                padding-top: 0;
                padding-bottom: 0px;
            }

            section.bg-white.quick-links .col-sm-6 {
                margin-bottom: 50px;
            }

            #welcomebar p br {
                display: none;
            }

            section#welcomebar {
                padding-bottom: 0 !important;
            }

            section#ceo-message img {
                max-width: 50%;
                margin-bottom: 15px;
            }

            ul.float-left.mobapplinks li {
                width: 50%;
                padding: 4px;
            }

            .footer__widget.quicklinks.firstchildd {
                text-align: center;
            }

            .footer__widget.quicklinks.firstchildd h3 {
                width: 100%;
            }

            .quick-links h3 {
                padding: 10px 15px;
                font-size: 14px;
            }

            #ftabs1 .nav-tabs .nav-link,
            #ftabs .nav-tabs .nav-link,
            #ftabs1 .nav-tabs .nav-link,
            #ftabs .nav-tabs .nav-link h3 {
                font-size: 16px;
                padding: 0;
            }

            .ls-vehicle-logo img {
                width: 100px;
            }

            p.ls-vehicle-call-to-actions.ls-layer a {
                height: auto !important;
                line-height: 27px;
                font-size: 10px;
                padding-right: 40px !important;
                padding-left: 10px !important;
            }

            p.ls-vehicle-call-to-actions.ls-layer a.text-dark.text-uppercase.pl-15.pr-60 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }

            body .no-bg-mobile {
                background: none !important;
            }

            .row.formshadow label.float-left.text-left.checkbox-inline.w-50 {
                width: 50% !important;
                text-align: left !important;
                font-size: 11px;
            }

            #myCarousel .row.align-items-center.pt-100 {
                position: relative !important;
                left: 0;
                margin: 0;
            }

            #myCarousel p,
            #myCarousel h5 {
                color: #ffffff;
            }

            ul.slick-dots {
                text-align: center;
            }

            ul.slick-dots li button {
                margin: 0 4px;
            }

            .form-group.form-check.col-md-12 label {
                font-size: 12px;
                position: relative;
                bottom: 3px;
            }
            .customer-feedback .owl-dots {
                display: none;
            }
            a.scrollup {
                display: none !important;
            }
            .hero.set-bg h1 {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            #myCarousel h2 {
                font-size: 26px;
                font-weight: 800;
            }
            #myCarousel p {
                font-size: 17px;
                margin-bottom: 5px;
            }
            #myCarousel p:after {
                font-size: 8px;
                padding: 0px 10px;
            }
            #myCarousel .carousel-item .mask {
                text-align: center;
            }
            #button {
                height: 50px;
                right: 0;
                left: 0;
            }
            section#choose-color {
                padding-top: 0 !important;
            }
            section#choose-color .pt-5.mb-5.col-lg-8.col-md-8.col-sm-7.col-xs-12 {
                padding-top: 0 !important;
            }
            section#choose-color .pt-5.mt-5.mb-5.col-lg-4.col-md-4.col-sm-5.col-xs-12 {
                margin-top: 0 !important;
                padding-top: 0 !important;
            }
            #button a {
                line-height: 50px;
            }
            ul.slick-dots {
                display: none;
            }
            .header__logo {
                margin: 0 auto !important;
                text-align: center !important;
            }
            .header__top {
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }
        }
        header {
            position: fixed !important;
            top: 0;
            background: #000;
        }
        #sticky1.stick1 {
            top: 60px;
        }
        #quicklinkstab ul li a {
            background: #f05336;
        }
        .header__menu ul li a {
            padding: 9px 10px 10px 50px !important;
        }
        .header__logo {
            padding: 5px 0 !important;
        }
        .fixmenu {
            position: relative;
            top: -90px;
        }
        #getintouch.fixmenu {
            position: relative;
            top: -120px;
        }
        #sticky1 {
            position: fixed;
            top: 60px;
            z-index: 9999;
        }
        #sticky-anchor1 {
            height: 63px;
        }

        @media (min-width: 767px) {
            .hidden-md {
                display: none;
            }
        }


    </style>
    <style>
        table.table-responsive.detailedtable th,
        table.table-responsive.detailedtable td {
            padding: 10px;
        }

        table.table-responsive.detailedtable {
            background: #e6e6e6;
        }

    </style>
</head>

<body @if (Route::current()->getName() == 'home') class="homepage" @else class="innerpage" @endif>
<!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5WZ23Q7"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- End Google Tag Manager (noscript) -->
    <div id="warning-message">
        <p>
            <img src="{{ asset('assets/images/landscape.png') }}" alt="Everest" width="70"><br>
            Landscape mode is disabled<br>Please rotate your device
        </p>
    </div>
    <div class="main-div">

        <header class="header">
            <div class="container" style="max-width: 100%;">
                <div class="row">
                    <div class="px-0 col-lg-12 fullwidthmenu">
                        <div class="header__top">
                            <div class="container">
                                <div class="px-0 row">
                                    <div class="col-lg-4 primarylogo">
                                        @if (Route::current()->getName() == 'home')
                                            <div class="1 header__logo  hidden-xs">
                                                <a href="{{ route('home') }}">
                                                    {{-- <img alt="{{ config('app.name') }} logo" title="{{ config('app.name') }} logo" src="{{ asset('assets/images/logo/premier-honda-logo.png')}}"> --}}
                                                    <img alt="{{ config('app.name') }} logo"
                                                        title="{{ config('app.name') }} logo"
                                                        src="{{ asset('storage/' . @$settings->logo) }}">
                                                </a>
                                            </div>
                                        @else
                                            <div class="2 header__logo hidden-xs">
                                                <a href="{{ route('home') }}">
                                                    {{-- <img alt="{{ config('app.name') }} logo" title="{{ config('app.name') }} logo" src="{{ asset('assets/images/logo/premier-honda-logo.png')}}"> --}}
                                                    <img alt="{{ config('app.name') }} logo"
                                                        title="{{ config('app.name') }} logo"
                                                        src="{{ asset('storage/' . @$settings->logo_fourth) }}">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 secondary-logo text-center">
                                        @if (Route::current()->getName() == 'home')
                                            <div class="3 header__logo">
                                                <a href="{{ route('home') }}">
                                                    {{-- <img alt="Logo" title="Logo"  src="{{ asset('assets/images/logo/logo.png') }}"> --}}
                                                    <img class="hidden-xs" alt="Logo" title="Popularmaruti Logo"
                                                        src="{{ asset('storage/' . @$settings->logo_secondary) }}">
                                                        <img class="hidden-md" alt="Logo" title="Popularmaruti Logo"
                                                        src="{{ asset('storage/' . @$settings->logo_third) }}">
                                                </a>
                                            </div>
                                        @else
                                            <div class="4 header__logo">
                                                <a href="{{ route('home') }}">
                                                    {{-- <img alt="Logo" title="Logo"  src="{{ asset('assets/images/logo/logo.png') }}"> --}}
                                                    <img alt="Popularmaruti Logo" title="Logo"
                                                        src="{{ asset('storage/' . @$settings->logo_third) }}">
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="pt-0 text-center header__nav" style='display: block;padding: 0;'>
                                            <nav class="bg-transparent header__menu w-100">
                                                <ul class="float-right">
                                                    <li><a style="background: url({{ asset('assets/images/background/orange-curve-left.png') }}) no-repeat right center;background-size: cover" target="_blank" href="tel:7034572222" class="wpapp hidden-xs">
                                                            <i class="fa fa-phone"></i> 703 457 2222</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>

    {{-- START MENU FIXED TOP --}}
    <div id="containerfix"></div>
    {{-- END MENU FIXED TOP --}}


    <section>

        {{-- START STICKY MENU --}}
        <div class="px-0 container-fluid">
            <div id="sticky-anchor1"></div>
            <div id="sticky1">
                <nav class="navbar navbar-expand-md navbar-light" id="navigation">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav">
                            @if ($vehicle->colors()->count())
                                <a href="#choosecolor" class="nav-item nav-link">COLORS</a>
                            @endif
                            @foreach ($vehicle->sections()->orderBy('order')->get() as $section)
                                <a href="#{{ $section->slug }}"
                                    class="nav-item nav-link">{{ strtoupper($section->title) }}</a>
                            @endforeach
                            <a href="#features-specifications" class="nav-item nav-link">FEATURES & SPECIFICATIONS</a>
                            <a href="#getintouch" class="nav-item nav-link" style="background: url({{ asset('assets/images/background/orange-curve-left.png') }}) no-repeat right center;background-size: contain;padding-left: 45px;">BOOK NOW</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        {{-- END STICKY MENU --}}

        <main id="content" class="mobilecenter vehiclepage">


            {{-- START VEHICLE COLOR --}}
            @if ($vehicle->colors()->count())
                <div class="fixmenu" id="choosecolor"></div>
                <section class="bg-dark" id="choose-color" style="padding-top: 4rem;">
                    <div class="container">
                        <div class="row">
                            <div class="pt-5 mb-5 col-lg-8 col-md-8 col-sm-7 col-xs-12">
                                <h2 class="pt-5 mb-3 text-white">COLORS</h2>
                                <div id="tabs">
                                    <div class="px-3 tab-content px-sm-0" id="nav-tabContent1">
                                        @foreach ($vehicle->colors()->orderBy('order')->get() as $color)
                                            <div class="tab-pane fade show @if ($loop->first) active @endif" id="nav-{{ $color->id }}"
                                                role="tabpanel" aria-labelledby="nav-{{ $color->id }}-tab">
                                                <img src="{{ asset('storage/' . $color->image) }}"
                                                    alt="{{ $color->name }}" title="{{ $color->name }}">
                                                <small class="float-left text-center w-100">{{ $color->name }}</small>
                                            </div>
                                        @endforeach
                                    </div>
                                    <nav class="float-left mt-2 w-100">
                                        <div class="text-center d-inline-block nav nav-tabs nav-fill w-100" id="nav-tab"
                                            role="tablist">
                                            @foreach ($vehicle->colors()->orderBy('order')->get() as $color)
                                                <a style="flex: unset;" class="d-inline-block nav-item nav-link @if ($loop->first) active @endif"
                                                    id="nav-{{ $color->id }}-tab" data-toggle="tab"
                                                    href="#nav-{{ $color->id }}"
                                                    role="tab" aria-controls="nav-{{ $color->id }}"
                                                    aria-selected="true">
                                                    {{-- {{dd($color->color)}} --}}
                                                    @if (count($color->color) == 1)
                                                        <div class="single-color"
                                                            style="background: {{ $color->color[1] }};width: 45px; height: 45px;">
                                                        </div>
                                                    @elseif(count($color->color) == 2)
                                                        <div class="dual-color"
                                                            style="border-top: 45px solid {{ $color->color[1] }};border-right: 45px solid {{ $color->color[2] }};">
                                                        </div>
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <div class="pt-5 mt-5 mb-5 col-lg-4 col-md-4 col-sm-5 col-xs-12">

                                <div class="fixmenu" id="getintouch"></div>
                                <div id="sticky">
                                    <!-- sticky -->

                                    <ul class="nav nav-tabs fixed-tabbed-forms" id=" " role="tablist">
                                        <li class="nav-item" style="background: #403f3f;font-size: 24px;padding: 12px 5px;">
                                        GET IN TOUCH
                                        </li>
                                    </ul>
                                    <div class="tab-content fixed-tabbed-single-form" id="myTabContent">
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissable" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <p class="mb-0">{{ session('error') }}</p>
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissable" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <p class="mb-0">{{ session('success') }}</p>
                                            </div>
                                        @endif
                                        <div id="validation-error" class="d-none">
                                            <div class="alert alert-danger alert-dismissable" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <p class="mb-0">{{ session('error') }}</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="book-now" role="tabpanel"
                                            aria-labelledby="book-now-tab">
                                            @include('forms.getintouch_form')
                                        </div>
                                        <div class="d-none" id="getintouch-otp-div">
                                            @include('forms.otp_form')
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <div id="sticky-anchor"></div>

            {{-- END VEHICLE COLOR --}}
            @if ($vehicle->sections()->count())
                @foreach ($vehicle->sections()->orderBy('order')->get() as $section)
                    @if ($section->has_tab == 0)
                        <div class="fixmenu" id="{{ $section->slug }}"></div>
                        <section class="py-2 my-4 @if ($section->background == 'black') bg-dark @endif">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="mb-3 text-uppercase">{{ $section->title }}</h2>
                                        <p>{{ htmlspecialchars_decode(strip_tags($section->description)) }}</p>
                                        <div class="">

                                            <div class="about-gallery">
                                                <div class="image-gallery">
                                                    <div class="items">
                                                        @php $i = 1; @endphp
                                                        @foreach ($section->images()->orderBy('order')->get() as $image)
                                                            <div class="card img-wrapper">
                                                                <div class="media media-2x1 gd-primary">
                                                                    <img alt="Everest" class="profile-image"
                                                                        src="{{ asset('storage/' . $image->image) }}">
                                                                    <div class="img-overlay"></div>
                                                                    @if ($image->description)
                                                                        <p class="img-description">
                                                                            {!! $image->description !!}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @php $i++; @endphp
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @elseif($section->has_tab ==1)
                        <section class="py-5 bg-dark" id="{{ $section->slug }}">
                            <div class="container py-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="mb-3 text-white text-uppercase">{{ $section->title }}</h2>
                                        <p class="text-white">
                                            {{ htmlspecialchars_decode(strip_tags($section->description)) }}
                                        </p>
                                        @if ($section->images()->count())
                                            <div class="pt-2 vehicle-data-tabs">
                                                <ul class="nav nav-pills">
                                                    @foreach ($section->images()->orderBy('order')->get() as $image)
                                                        <li class="nav-item">
                                                            <a class="nav-link  @if ($loop->first) active @endif" data-toggle="pill"
                                                                href="#nav-{{ $image->id }}" role="tab"
                                                                aria-controls="pills-nav-{{ $image->id }}"
                                                                aria-selected="true">{{ $image->title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="mt-3 tab-content">
                                                    @foreach ($section->images()->orderBy('order')->get() as $image)
                                                        <div class="text-white row tab-pane fade show @if ($loop->first) active @endif" id="nav-{{ $image->id }}"
                                                            role="tabpanel" aria-labelledby="nav-{{ $image->id }}-tab">
                                                            <div class="float-left col-md-4"><img alt="Everest" class="w-100"
                                                                    src="{{ asset('storage/' . $image->image) }}">
                                                            </div>
                                                            @if ($image->description)
                                                                <div class="float-left py-5 col-md-8">
                                                                    {{ htmlspecialchars_decode(strip_tags($image->description)) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endforeach
            @endif
            {{-- START FEATURES & SPECIFICATIONS --}}
            @if ($vehicle->categories()->count())
                <section class="py-5 bg-dark" id="features-specifications">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div id="accordionCarCategories">
                                    @foreach ($category_types as $category_type)
                                        <h2 class="mt-3 mb-3 text-white text-uppercase">{{ $category_type->name }}</h2>
                                        <div class="card">
                                            @foreach ($category_type->categories()->where('status', 1)->orderBy('name')->get() as $category)
                                                @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->count())
                                                    <div class="card-header" id="heading{{ $category->id }}">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link w-100" data-toggle="collapse"
                                                                data-target="#collapse{{ $category->id }}"
                                                                aria-expanded="true"
                                                                aria-controls="collapse{{ $category->id }}">{{ $category->name }}</button>
                                                        </h5>
                                                    </div>

                                                    <div id="collapse{{ $category->id }}" class="collapse"
                                                        aria-labelledby="heading{{ $category->id }}"
                                                        data-parent="#accordionCarCategories">
                                                        <div class="card-body">
                                                            <table class="table table-responsive">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="1"></td>
                                                                        @foreach ($vehicle->varients()->get() as $varient)
                                                                            <th>{{ $varient->name }}</th>
                                                                        @endforeach
                                                                    </tr>
                                                                    @foreach ($category->subCategories()->where('status', 1)->orderBy('name')->get() as $subcat)
                                                                        @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->where('sub_category_id', $subcat->id)->count())
                                                                            <tr>
                                                                                <td colspan="1" class="text-left">
                                                                                    {{ @$subcat->name }}</td>
                                                                                @foreach ($vehicle->varients()->get() as $variant)
                                                                                    @php
                                                                                        $details = $vehicle_details
                                                                                            ->where('category_type_id', $category_type->id)
                                                                                            ->where('category_id', $category->id)
                                                                                            ->where('sub_category_id', $subcat->id)
                                                                                            ->where('vehicle_variant_id', $variant->id)
                                                                                            ->first();
                                                                                    @endphp
                                                                                    @if (@$details->is_boolean == 1)
                                                                                        <td>
                                                                                            @if (@$details->status == 0)
                                                                                                <i class="fa fa-check primaryColor"
                                                                                                    aria-hidden="true"></i>
                                                                                            @elseif(@$details->status ==
                                                                                                1)
                                                                                                <i class="fa fa-minus "
                                                                                                    aria-hidden="true"></i>
                                                                                            @endif
                                                                                        </td>
                                                                                    @else
                                                                                        <td>
                                                                                            <p class="text-white">
                                                                                                @if (@$details->details)
                                                                                                    {{ @$details->details }}
                                                                                                @else
                                                                                                    --
                                                                                                @endif
                                                                                            </p>
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            {{-- END FEATURES & SPECIFICATIONS --}}

            <div class="bottomMenu">
                <div id="center">
                    <div id="button">
                        <a href='{{ route('booking.show', $vehicle->slug) }}'>BOOK NOW</a>
                    </div>
                </div>
            </div>

        </main>
    </section>

        <!-- FOOTER -->
        <footer id="footer" class="pt-0 footer" style='position: fixed;bottom: 0;z-index: 99;'>
            <div class="container-fluid" id="quicklinkstab">
                <div class="row">
                    <ul class="d-inline-block w-100">
                        <li class="w-100 hidden-xs">
                            <a href="#getintouch" class="py-2 w-100 d-block">Limited Offer! Reach Us Now! (*T&C Apply)</a>
                        </li>
                        <li class="w-100 hidden-md">
                            <a href="#getintouch" class="py-3 w-100 d-block">BOOK NOW</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
        <!-- END FOOTER -->

    </div>

    {{-- {{ TawkTo::widgetCode() }} --}}


    {{-- <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/js/ninja-slider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="{{ asset('assets/inttel/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/inttel/utils.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
         $(document).ready(function() {
            $('.formPageName').val("landing/{{$vehicle->slug}}");
            $('.formPageAdd').val("googlead");
        });
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.scrollup').fadeIn();
                } else {
                    $('.scrollup').fadeOut();
                }
            });
            $('.scrollup').click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });

            // $('.phone_number_mask').inputmask("+\\919999999999");
            $('.js-validation-popup').validate({
                ignore: [],
                errorClass: 'invalid-feedback animated fadeInDown',
                errorElement: 'label',
                errorPlacement: (error, e) => {
                    $(e).parents('.form-group').append(error);
                },
                highlight: e => {
                    $(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                },
                success: e => {
                    $(e).closest('.form-group').removeClass('is-invalid');
                    $(e).remove();
                },
                messages: {
                    name: {
                        pattern: "Name should not contain numbers or special characters."
                    },
                    email: {
                        pattern: "Please enter a valid email address."
                    },
                    phone: {
                        pattern: "Please enter a valid phone number."
                    },
                }
            });

            var mouseX = 0;
            var mouseY = 0;
            var popupCounter = 0;
            document.addEventListener("mousemove", function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });
            $(document).mouseleave(function() {
                if (mouseY < 100) {
                    if (popupCounter < 1) {
                        $("#exitPopup").modal('show');
                    }
                    popupCounter++;
                }
            });
        });
        $(".phone").intlTelInput({
            formatOnDisplay: false,
            autoPlaceholder: "off",
            nationalMode: false,
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
        });
    </script>



    <script>
        !(function(n, i, e, a) {
            (n.navigation = function(t, s) {
                var o = {
                        responsive: !0,
                        mobileBreakpoint: 991,
                        showDuration: 200,
                        hideDuration: 200,
                        showDelayDuration: 0,
                        hideDelayDuration: 0,
                        submenuTrigger: "hover",
                        effect: "fade",
                        submenuIndicator: !0,
                        submenuIndicatorTrigger: !1,
                        hideSubWhenGoOut: !0,
                        visibleSubmenusOnMobile: !1,
                        fixed: !1,
                        overlay: !0,
                        overlayColor: "rgba(0, 0, 0, 0.5)",
                        hidden: !1,
                        hiddenOnMobile: !1,
                        offCanvasSide: "left",
                        offCanvasCloseButton: !0,
                        animationOnShow: "",
                        animationOnHide: "",
                        onInit: function() {},
                        onLandscape: function() {},
                        onPortrait: function() {},
                        onShowOffCanvas: function() {},
                        onHideOffCanvas: function() {}
                    },
                    r = this,
                    u = Number.MAX_VALUE,
                    d = 1,
                    l = "click.nav touchstart.nav",
                    f = "mouseenter focusin",
                    c = "mouseleave focusout";
                r.settings = {};
                var t = (n(t), t);
                n(t).find(".nav-search").length > 0 &&
                    n(t)
                    .find(".nav-search")
                    .find("form")
                    .prepend(
                        "<span class='nav-search-close-button' tabindex='0'>&#10005;</span>"
                    ),
                    (r.init = function() {
                        (r.settings = n.extend({}, o, s)),
                        r.settings.offCanvasCloseButton &&
                            n(t)
                            .find(".nav-menus-wrapper")
                            .prepend(
                                "<span class='nav-menus-wrapper-close-button'>&#10005;</span>"
                            ),
                            "right" == r.settings.offCanvasSide &&
                            n(t)
                            .find(".nav-menus-wrapper")
                            .addClass("nav-menus-wrapper-right"),
                            r.settings.hidden &&
                            (n(t).addClass("navigation-hidden"),
                                (r.settings.mobileBreakpoint = 99999)),
                            v(),
                            r.settings.fixed && n(t).addClass("navigation-fixed"),
                            n(t)
                            .find(".nav-toggle")
                            .on("click touchstart", function(n) {
                                n.stopPropagation(),
                                    n.preventDefault(),
                                    r.showOffcanvas(),
                                    s !== a && r.callback("onShowOffCanvas");
                            }),
                            n(t)
                            .find(".nav-menus-wrapper-close-button")
                            .on("click touchstart", function() {
                                r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas");
                            }),
                            n(t)
                            .find(".nav-search-button, .nav-search-close-button")
                            .on("click touchstart keydown", function(i) {
                                i.stopPropagation(), i.preventDefault();
                                var e = i.keyCode || i.which;
                                "click" === i.type ||
                                    "touchstart" === i.type ||
                                    ("keydown" === i.type && 13 == e) ?
                                    r.toggleSearch() :
                                    9 == e && n(i.target).blur();
                            }),
                            n(t).find(".megamenu-tabs").length > 0 && y(),
                            n(i).resize(function() {
                                r.initNavigationMode(C()), O(), r.settings.hiddenOnMobile && m();
                            }),
                            r.initNavigationMode(C()),
                            r.settings.hiddenOnMobile && m(),
                            s !== a && r.callback("onInit");
                    });
                var h = function() {
                        n(t)
                            .find(".nav-submenu")
                            .hide(0),
                            n(t)
                            .find("li")
                            .removeClass("focus");
                    },
                    v = function() {
                        n(t)
                            .find("li")
                            .each(function() {
                                n(this).children(".nav-dropdown,.megamenu-panel").length > 0 &&
                                    (n(this)
                                        .children(".nav-dropdown,.megamenu-panel")
                                        .addClass("nav-submenu"),
                                        r.settings.submenuIndicator &&
                                        n(this)
                                        .children("a")
                                        .append(
                                            "<span class='submenu-indicator'><span class='submenu-indicator-chevron'></span></span>"
                                        ));
                            });
                    },
                    m = function() {
                        n(t).hasClass("navigation-portrait") ?
                            n(t).addClass("navigation-hidden") :
                            n(t).removeClass("navigation-hidden");
                    };
                (r.showSubmenu = function(i, e) {
                    C() > r.settings.mobileBreakpoint &&
                        n(t)
                        .find(".nav-search")
                        .find("form")
                        .fadeOut(),
                        "fade" == e ?
                        n(i)
                        .children(".nav-submenu")
                        .stop(!0, !0)
                        .delay(r.settings.showDelayDuration)
                        .fadeIn(r.settings.showDuration)
                        .removeClass(r.settings.animationOnHide)
                        .addClass(r.settings.animationOnShow) :
                        n(i)
                        .children(".nav-submenu")
                        .stop(!0, !0)
                        .delay(r.settings.showDelayDuration)
                        .slideDown(r.settings.showDuration)
                        .removeClass(r.settings.animationOnHide)
                        .addClass(r.settings.animationOnShow),
                        n(i).addClass("focus");
                }),
                (r.hideSubmenu = function(i, e) {
                    "fade" == e
                        ?
                        n(i)
                        .find(".nav-submenu")
                        .stop(!0, !0)
                        .delay(r.settings.hideDelayDuration)
                        .fadeOut(r.settings.hideDuration)
                        .removeClass(r.settings.animationOnShow)
                        .addClass(r.settings.animationOnHide) :
                        n(i)
                        .find(".nav-submenu")
                        .stop(!0, !0)
                        .delay(r.settings.hideDelayDuration)
                        .slideUp(r.settings.hideDuration)
                        .removeClass(r.settings.animationOnShow)
                        .addClass(r.settings.animationOnHide),
                        n(i)
                        .removeClass("focus")
                        .find(".focus")
                        .removeClass("focus");
                });
                var p = function() {
                        n("body").addClass("no-scroll"),
                            r.settings.overlay &&
                            (n(t).append("<div class='nav-overlay-panel'></div>"),
                                n(t)
                                .find(".nav-overlay-panel")
                                .css("background-color", r.settings.overlayColor)
                                .fadeIn(300)
                                .on("click touchstart", function(n) {
                                    r.hideOffcanvas();
                                }));
                    },
                    g = function() {
                        n("body").removeClass("no-scroll"),
                            r.settings.overlay &&
                            n(t)
                            .find(".nav-overlay-panel")
                            .fadeOut(400, function() {
                                n(this).remove();
                            });
                    };
                (r.showOffcanvas = function() {
                    p(),
                        "left" == r.settings.offCanvasSide ?
                        n(t)
                        .find(".nav-menus-wrapper")
                        .css("transition-property", "left")
                        .addClass("nav-menus-wrapper-open") :
                        n(t)
                        .find(".nav-menus-wrapper")
                        .css("transition-property", "right")
                        .addClass("nav-menus-wrapper-open");
                }),
                (r.hideOffcanvas = function() {
                    n(t)
                        .find(".nav-menus-wrapper")
                        .removeClass("nav-menus-wrapper-open")
                        .on(
                            "webkitTransitionEnd moztransitionend transitionend oTransitionEnd",
                            function() {
                                n(t)
                                    .find(".nav-menus-wrapper")
                                    .css("transition-property", "none")
                                    .off();
                            }
                        ),
                        g();
                }),
                (r.toggleOffcanvas = function() {
                    C() <= r.settings.mobileBreakpoint &&
                        (n(t)
                            .find(".nav-menus-wrapper")
                            .hasClass("nav-menus-wrapper-open") ?
                            (r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas")) :
                            (r.showOffcanvas(), s !== a && r.callback("onShowOffCanvas")));
                }),
                (r.toggleSearch = function() {
                    "none" ==
                    n(t)
                        .find(".nav-search")
                        .find("form")
                        .css("display") ?
                        (n(t)
                            .find(".nav-search")
                            .find("form")
                            .fadeIn(200),
                            n(t)
                            .find(".nav-search")
                            .find("input")
                            .focus()) :
                        (n(t)
                            .find(".nav-search")
                            .find("form")
                            .fadeOut(200),
                            n(t)
                            .find(".nav-search")
                            .find("input")
                            .blur());
                }),
                (r.initNavigationMode = function(i) {
                    r.settings.responsive ?
                        (i <= r.settings.mobileBreakpoint &&
                            u > r.settings.mobileBreakpoint &&
                            (n(t)
                                .addClass("navigation-portrait")
                                .removeClass("navigation-landscape"),
                                S(),
                                s !== a && r.callback("onPortrait")),
                            i > r.settings.mobileBreakpoint &&
                            d <= r.settings.mobileBreakpoint &&
                            (n(t)
                                .addClass("navigation-landscape")
                                .removeClass("navigation-portrait"),
                                k(),
                                g(),
                                r.hideOffcanvas(),
                                s !== a && r.callback("onLandscape")),
                            (u = i),
                            (d = i)) :
                        (n(t).addClass("navigation-landscape"),
                            k(),
                            s !== a && r.callback("onLandscape"));
                });
                var b = function() {
                        n("html").on("click.body touchstart.body", function(i) {
                            0 === n(i.target).closest(".navigation").length &&
                                (n(t)
                                    .find(".nav-submenu")
                                    .fadeOut(),
                                    n(t)
                                    .find(".focus")
                                    .removeClass("focus"),
                                    n(t)
                                    .find(".nav-search")
                                    .find("form")
                                    .fadeOut());
                        });
                    },
                    C = function() {
                        return (
                            i.innerWidth || e.documentElement.clientWidth || e.body.clientWidth
                        );
                    },
                    w = function() {
                        n(t)
                            .find(".nav-menu")
                            .find("li, a")
                            .off(l)
                            .off(f)
                            .off(c);
                    },
                    O = function() {
                        if (C() > r.settings.mobileBreakpoint) {
                            var i = n(t).outerWidth(!0);
                            n(t)
                                .find(".nav-menu")
                                .children("li")
                                .children(".nav-submenu")
                                .each(function() {
                                    n(this)
                                        .parent()
                                        .position().left +
                                        n(this).outerWidth() >
                                        i ?
                                        n(this).css("right", 0) :
                                        n(this).css("right", "auto");
                                });
                        }
                    },
                    y = function() {
                        function i(i) {
                            var e = n(i)
                                .children(".megamenu-tabs-nav")
                                .children("li"),
                                a = n(i).children(".megamenu-tabs-pane");
                            n(e).on("click.tabs touchstart.tabs", function(i) {
                                i.stopPropagation(),
                                    i.preventDefault(),
                                    n(e).removeClass("active"),
                                    n(this).addClass("active"),
                                    n(a)
                                    .hide(0)
                                    .removeClass("active"),
                                    n(a[n(this).index()])
                                    .show(0)
                                    .addClass("active");
                            });
                        }
                        if (n(t).find(".megamenu-tabs").length > 0)
                            for (var e = n(t).find(".megamenu-tabs"), a = 0; a < e.length; a++)
                                i(e[a]);
                    },
                    k = function() {
                        w(),
                            h(),
                            navigator.userAgent.match(/Mobi/i) ||
                            navigator.maxTouchPoints > 0 ||
                            "click" == r.settings.submenuTrigger ?
                            n(t)
                            .find(".nav-menu, .nav-dropdown")
                            .children("li")
                            .children("a")
                            .on(l, function(e) {
                                if (
                                    (r.hideSubmenu(
                                            n(this)
                                            .parent("li")
                                            .siblings("li"),
                                            r.settings.effect
                                        ),
                                        n(this)
                                        .closest(".nav-menu")
                                        .siblings(".nav-menu")
                                        .find(".nav-submenu")
                                        .fadeOut(r.settings.hideDuration),
                                        n(this).siblings(".nav-submenu").length > 0)
                                ) {
                                    if (
                                        (e.stopPropagation(),
                                            e.preventDefault(),
                                            "none" ==
                                            n(this)
                                            .siblings(".nav-submenu")
                                            .css("display"))
                                    )
                                        return (
                                            r.showSubmenu(n(this).parent("li"), r.settings.effect),
                                            O(),
                                            !1
                                        );
                                    if (
                                        (r.hideSubmenu(n(this).parent("li"), r.settings.effect),
                                            "_blank" === n(this).attr("target") ||
                                            "blank" === n(this).attr("target"))
                                    )
                                        i.open(n(this).attr("href"));
                                    else {
                                        if (
                                            "#" === n(this).attr("href") ||
                                            "" === n(this).attr("href") ||
                                            "javascript:void(0)" === n(this).attr("href")
                                        )
                                            return !1;
                                        i.location.href = n(this).attr("href");
                                    }
                                }
                            }) :
                            n(t)
                            .find(".nav-menu")
                            .find("li")
                            .on(f, function() {
                                r.showSubmenu(this, r.settings.effect), O();
                            })
                            .on(c, function() {
                                r.hideSubmenu(this, r.settings.effect);
                            }),
                            r.settings.hideSubWhenGoOut && b();
                    },
                    S = function() {
                        w(),
                            h(),
                            r.settings.visibleSubmenusOnMobile ?
                            n(t)
                            .find(".nav-submenu")
                            .show(0) :
                            (n(t)
                                .find(".submenu-indicator")
                                .removeClass("submenu-indicator-up"),
                                r.settings.submenuIndicator && r.settings.submenuIndicatorTrigger ?
                                n(t)
                                .find(".submenu-indicator")
                                .on(l, function(i) {
                                    return (
                                        i.stopPropagation(),
                                        i.preventDefault(),
                                        r.hideSubmenu(
                                            n(this)
                                            .parent("a")
                                            .parent("li")
                                            .siblings("li"),
                                            "slide"
                                        ),
                                        r.hideSubmenu(
                                            n(this)
                                            .closest(".nav-menu")
                                            .siblings(".nav-menu")
                                            .children("li"),
                                            "slide"
                                        ),
                                        "none" ==
                                        n(this)
                                        .parent("a")
                                        .siblings(".nav-submenu")
                                        .css("display") ?
                                        (n(this).addClass("submenu-indicator-up"),
                                            n(this)
                                            .parent("a")
                                            .parent("li")
                                            .siblings("li")
                                            .find(".submenu-indicator")
                                            .removeClass("submenu-indicator-up"),
                                            n(this)
                                            .closest(".nav-menu")
                                            .siblings(".nav-menu")
                                            .find(".submenu-indicator")
                                            .removeClass("submenu-indicator-up"),
                                            r.showSubmenu(
                                                n(this)
                                                .parent("a")
                                                .parent("li"),
                                                "slide"
                                            ),
                                            !1) :
                                        (n(this)
                                            .parent("a")
                                            .parent("li")
                                            .find(".submenu-indicator")
                                            .removeClass("submenu-indicator-up"),
                                            void r.hideSubmenu(
                                                n(this)
                                                .parent("a")
                                                .parent("li"),
                                                "slide"
                                            ))
                                    );
                                }) :
                                n(t)
                                .find(".nav-menu, .nav-dropdown")
                                .children("li")
                                .children("a")
                                .on(l, function(e) {
                                    if (
                                        (e.stopPropagation(),
                                            e.preventDefault(),
                                            r.hideSubmenu(
                                                n(this)
                                                .parent("li")
                                                .siblings("li"),
                                                r.settings.effect
                                            ),
                                            r.hideSubmenu(
                                                n(this)
                                                .closest(".nav-menu")
                                                .siblings(".nav-menu")
                                                .children("li"),
                                                "slide"
                                            ),
                                            "none" ==
                                            n(this)
                                            .siblings(".nav-submenu")
                                            .css("display"))
                                    )
                                        return (
                                            n(this)
                                            .children(".submenu-indicator")
                                            .addClass("submenu-indicator-up"),
                                            n(this)
                                            .parent("li")
                                            .siblings("li")
                                            .find(".submenu-indicator")
                                            .removeClass("submenu-indicator-up"),
                                            n(this)
                                            .closest(".nav-menu")
                                            .siblings(".nav-menu")
                                            .find(".submenu-indicator")
                                            .removeClass("submenu-indicator-up"),
                                            r.showSubmenu(n(this).parent("li"), "slide"),
                                            !1
                                        );
                                    if (
                                        (n(this)
                                            .parent("li")
                                            .find(".submenu-indicator")
                                            .removeClass("submenu-indicator-up"),
                                            r.hideSubmenu(n(this).parent("li"), "slide"),
                                            "_blank" === n(this).attr("target") ||
                                            "blank" === n(this).attr("target"))
                                    )
                                        i.open(n(this).attr("href"));
                                    else {
                                        if (
                                            "#" === n(this).attr("href") ||
                                            "" === n(this).attr("href") ||
                                            "javascript:void(0)" === n(this).attr("href")
                                        )
                                            return !1;
                                        i.location.href = n(this).attr("href");
                                    }
                                }));
                    };
                (r.callback = function(n) {
                    s[n] !== a && s[n].call(t);
                }),
                r.init();
            }),
            (n.fn.navigation = function(i) {
                return this.each(function() {
                    if (a === n(this).data("navigation")) {
                        var e = new n.navigation(this, i);
                        n(this).data("navigation", e);
                    }
                });
            });
        })(jQuery, window, document);



        (function($) {
            'use strict';

            var $window = $(window);

            if ($.fn.navigation) {
                $("#navigation1").navigation();
                $("#always-hidden-nav").navigation({
                    hidden: true
                });
            }

            $window.on('load', function() {
                $('#preloader').fadeOut('slow', function() {
                    $(this).remove();
                });
            });

        })(jQuery);

        function loadlocation(mode, state) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $options = $('<option value="">Select location</option>');
            $(".location").html("");
            $.ajax({
                type: 'POST',
                url: "{{ route('getlocation') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    mode: mode
                },
                success: function(data) {
                    if (data.status) {
                        jQuery.each(data.locations, function(index, item) {
                            $options = $options.add(
                                $('<option>').attr('value', item.id).html(item.name)
                            );
                        });
                        $(".location").html($options);
                    }
                }
            });
        }
    </script>

    <script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
    <script>
        $(function() {
            $('a[href*=\\#]:not([href=\\#])').on('click', function() {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.substr(1) + ']');
                if (target.length) {
                    if (target.get(0).tagName == 'SECTION') {
                        $('html,body').animate({
                            scrollTop: target.offset().top - 20
                        }, 1000);
                        return false;
                    }
                }
            });
        });
        /*$(document).ready(function() {
            $('#navigation a, #fixedbar a').on('click', function(e) {
                e.preventDefault();
            });
            $(window).on('scroll', function() {
                var scrolltop = $(this).scrollTop();
                var $nav = $("#navigation");
                if (scrolltop >= $nav.offset().top + $nav.height()) {
                    $('#fixedbar').fadeIn(250);
                } else {
                    $('#fixedbar').fadeOut(250);
                }
            });
        });*/

        /*function sticky_relocate() {
            var window_top = $(window).scrollTop();
            var footer_top = $("#call-to-action").offset().top;
            var div_top = $('#sticky-anchor').offset().top;
            var div_height = $("#sticky").height();
            if (window_top + div_height > footer_top)
                $('.bottomMenu').fadeOut();
            else if (window_top > div_top) {
                $('.bottomMenu').fadeIn();
            } else {
                $('.bottomMenu').fadeOut();
            }
        }
        $(function() {
            $(window).scroll(sticky_relocate);
            sticky_relocate();
        });

        function sticky_relocate1() {
            var window_top1 = $(window).scrollTop();
            var footer_top1 = $("#footer").offset().top;
            var div_top1 = $('#sticky-anchor1').offset().top;
            var div_height1 = $("#sticky1").height();
            if (window_top1 + div_height1 > footer_top1)
                $('#sticky1').removeClass('stick1');
            else if (window_top1 > div_top1) {
                $('#sticky1').addClass('stick1');
            } else {
                $('#sticky1').removeClass('stick1');
            }
        }
        $(function() {
            $(window).scroll(sticky_relocate1);
            sticky_relocate1();
        });*/

        $(document).ready(function() {
            $('table').each(function() {
                $(this).addClass('table-responsive detailedtable')
            });
            $('#getintouch-form').parsley();
            $('#getintouch-form').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                if ($('#getintouch-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('sent_otp_get_in_touch') }}",
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.status) {
                                $("#getintouch-otp-div").removeClass("d-none");
                                $("#book-now").addClass("d-none");
                                $(".mode").val(data.mode);
                                $(".enquiry_id").val(data.id);
                            } else {
                                var validation = '';
                                jQuery.each(data.message, function(index, item) {
                                    validation = validation +
                                        '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p class="mb-0">' +
                                        item + '</p></div>';
                                });
                                $("#validation-error").removeClass("d-none");
                                $("#validation-error").html(validation);
                            }
                        }
                    });
                }
            });
        });



        $(document).ready(function() {
            $('.items').slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 800,
                autoplay: true,
                autoplaySpeed: 2000,
                slidesToShow: 3,
                slidesToScroll: 1,
                pauseOnHover: true,
                touchThreshold: 5,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>
