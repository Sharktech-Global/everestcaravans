<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">
    {!! SEO::generate() !!}
    <meta name="facebook-domain-verification" content="nu43u1tt4iojwnbxkfnkanqpppdosg" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="google-site-verification" content="26ZAl---uyCbz7e15k5NfHqrSJEurompyhZxt64R4Og" /> --}}
    <meta name="google-site-verification" content="lX8Nbe0qBUZ62JjzaV8NU8L8l_u-YMT3nCmfjGK-wLY" />
    <link rel="icon" href="{{ asset('storage/' . @$settings->favicon) }}" type="image/x-icon" />
    {{-- Space Grotesk is the display face used across the home page sections.
         Loaded here, not per page, because the navbar uses it on every route. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap">
    {{-- ?v=mtime so an edit is never served from the browser cache --}}
    <link rel="stylesheet" href="{{ asset('assets/abreco/css/style.css') }}?v={{ filemtime(public_path('assets/abreco/css/style.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/abreco/css/responsive.css') }}?v={{ filemtime(public_path('assets/abreco/css/responsive.css')) }}">

    <link rel="stylesheet" href="{{ asset('assets/inttel/intlTelInput.css') }}" type="text/css">
    <style>
        :root {
            --main-bg-new-color: {{ @$settings->website_color ? @$settings->website_color : '#f15336' }};
        }

        .homepage .nav-menu>li>a {
            padding: 20px 13px !important;
        }
    </style>
    @yield('css_after')
    {{-- @notifyCss --}}

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KJBT9DKM');</script>
    <!-- End Google Tag Manager -->
</head>
<!-- Header End -->
@php
    $path="";
    $url = request()->url();
    $baseUrl = config('app.url');
    $path = str_replace($baseUrl, '', $url);
@endphp
<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJBT9DKM"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="off_canvars_overlay">

    </div>
    <div class="offcanvas_menu d-none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="offcanvas-brand text-center mb-40">
                            {{-- @dd($settings); --}}
                            <img src="{{ asset('storage/' . @$settings->logo) }}" alt="">
                            {{-- <img src="{{ asset('assets/abreco/images/banner/logo.png') }}" alt=""> --}}
                            {{-- logo --}}
                        </div>
                        <div id="menu" class="text-left ">
                            @php
                                $routename = Route::currentRouteName();
                            @endphp
                            <ul class="offcanvas_main_menu">
                                <li @if ($routename == 'home') class="active" @endif>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li @if ($routename == 'our-range') class="active" @endif>
                                    <a href="{{ route('our-range') }}">Our Range</a>
                                </li>
                                <li @if ($routename == 'videos') class="active" @endif>
                                    <a href="{{ route('videos') }}">Videos</a>
                                </li>
                                <li @if ($routename == 'book_test_drive.index') class="active" @endif>
                                    <a href="{{ route('book_test_drive.index') }}">Book a Factory Visit</a>
                                </li>
                                <li @if ($routename == 'finance.show') class="active" @endif>
                                    <a href="{{ route('finance.show') }}">Finance</a>
                                </li>
                                <li @if (in_array($routename, ['blog.show', 'blog.details'])) class="active" @endif>
                                    <a href="{{ route('blog.show') }}">Blogs</a>
                                </li>
                                <li @if ($routename == 'about') class="active" @endif>
                                    <a href="{{ route('about') }}">About Us</a>
                                </li>
                                <li @if ($routename == 'contact') class="active" @endif>
                                    <a href="{{ route('contact') }}">Contact Us</a>
                                </li>
                            </ul>

                            {{-- Was nested inside the <ul>, which is invalid markup --}}
                            <div class="service-bread-btn toll-free-btn-banner toll-free-btn-banner-sidemenu">
                                <a href="tel:018008900118">
                                    <span class="toll-head">Roadside Assistance</span>
                                    <span class="toll-number">0 1800 890 0118</span>
                                </a>
                            </div>

                            {{-- Closing call to action, last item in the slide-out menu --}}
                            <a class="ev-sidecta" href="{{ route('contact') }}">
                                Submit Now
                                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== PART START ======-->

    <header class="abreco-header-area abreco-sticky">
        <!-- <div class="header-logobg"></div>
        <div class="header-logobg2"></div> -->
        <div class="container-fluid header-fluid">
            <div class="header-nav-box">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-4 col-sm-5 col-6 order-1 order-sm-1">
                        <div class="abreco-logo-box"> <!-- logo here -->
                            <a href="{{ route('home') }}">
                                {{-- Two marks stacked in one grid cell, cross-faded on .sticky:
                                     white over the hero, dark ink once the bar turns white. --}}
                                <img class="ev-logo ev-logo--light"
                                     src="{{ asset('storage/' . (@$settings->logo_secondary ?: @$settings->logo)) }}"
                                     alt="{{ config('app.name') }}">
                                <img class="ev-logo ev-logo--dark"
                                     src="{{ asset('storage/' . @$settings->logo) }}"
                                     alt="" aria-hidden="true">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 offset-lg-2 order-3 order-sm-2">
                        <div class="abreco-header-main-menu">
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}"
                                        @if ($routename == 'home') class="active" @endif>Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('our-range') }}"
                                        @if ($routename == 'our-range') class="active" @endif>Our Range</a>
                                </li>
                                <li>
                                    <a href="{{ route('factory-visit.show') }}"
                                        @if ($routename == 'book-a-factory-visit') class="active" @endif>Visit</a>
                                </li>
                                <li>
                                    <a href="{{ route('finance-partner') }}"
                                        @if ($routename == 'finance-partner') class="active" @endif>Finance</a>
                                </li>
                                <li>
                                    <a href="{{ route('videos') }}"
                                        @if ($routename == 'videos') class="active" @endif>Videos</a>
                                </li>
                                <li>
                                    <a href="{{ route('blog.show') }}"
                                        @if (in_array($routename, ['blog.show', 'blog.details'])) class="active" @endif>Blogs </a>
                                </li>
                                <li>
                                    <a href="{{ route('about') }}"
                                        @if ($routename == 'about') class="active" @endif>About Us</a>
                                </li>
                                {{-- Last item, styled as a button rather than a nav link --}}
                                <li class="ev-navcta">
                                    <a href="{{ route('contact') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <div class="toggle-btn ml-30 canvas_open d-lg-none d-block">
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    @yield('content')

    <!-- Footer Start -->

    <!--====== abreco FOOTER PART START ======-->
    <!--====== FOOTER START ======-->
    @php
        // ---- Footer content ----
        $evRange = [
            'Falcon', 'Avalanche Quad', 'Summitt', 'Calibra',
            'Nitro', 'Alpine', 'Kombat', 'S.C.O.T.A',
            'Storm', 'Ice Glider', 'Blizzard', 'Vantage',
            'Camo', 'Drifter', 'Warrior',
        ];

        // TODO: confirm real trading hours — placeholder.
        $evMeta = [
            ['label' => 'Location', 'value' => '51 Glenbarry Road, Campbellfield VIC 3061']
        ];

    @endphp

    <footer class="ev-ftr">
        <div class="ev-ftr__inner">

            {{-- Top strip: eyebrow, logo, badge, call to action --}}
            <div class="ev-ftr__top">

                <div class="ev-ftr__top-row">
                    <div class="ev-ftr__marks">
                        <a class="ev-ftr__logo" href="{{ route('home') }}">
                            {{-- logo_secondary is the white mark, for the dark panel --}}
                            <img src="{{ asset('storage/' . (@$settings->logo_secondary ?: @$settings->logo)) }}" alt="Everest Caravans">
                        </a>
                        <span class="ev-ftr__divider" aria-hidden="true"></span>
                        <img class="ev-ftr__badge" src="{{ asset('assets/abreco/images/certificate.png') }}"
                             alt="Australian Made" width="178" height="142" loading="lazy" decoding="async">
                        <span class="ev-ftr__divider" aria-hidden="true"></span>
                        {{-- Wide strip rather than a square badge, so it is sized by height --}}
                        <img class="ev-ftr__badge ev-ftr__badge--wide"
                             src="{{ asset('assets/abreco/images/newonce/warranty.svg') }}"
                             alt="Structural warranty" width="205" height="57" loading="lazy" decoding="async">
                    </div>

                    <div class="ev-ftr__cta">
                        <p class="ev-ftr__cta-title">Ready to hit the road?</p>
                        <a class="ev-ftr__btn" href="{{ route('contact') }}">
                            Enquire now
                            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main columns --}}
            <div class="ev-ftr__grid">

                <div class="ev-ftr__intro">
                    <p class="ev-ftr__about">
                        Everest Caravans is a family owned business with over 15 years in the industry —
                        premium quality, custom built vans engineered for Australian conditions and
                        checked against our own QC standard before delivery.
                    </p>

                    <dl class="ev-ftr__meta">
                        @foreach ($evMeta as $m)
                            <dt>{{ $m['label'] }}</dt>
                            <dd>{{ $m['value'] }}</dd>
                        @endforeach
                        <dt>Status</dt>
                        <dd class="ev-ftr__status"><span aria-hidden="true"></span>Taking custom builds</dd>
                    </dl>
                </div>

                <nav class="ev-ftr__col ev-ftr__col--range" aria-label="Our range">
                    <h4 class="ev-ftr__title">Our Range</h4>
                    <ul class="ev-ftr__list">
                        @foreach ($evRange as $name)
                            <li><span>{{ $name }}</span></li>
                        @endforeach
                    </ul>
                </nav>

                <nav class="ev-ftr__col" aria-label="Company">
                    <h4 class="ev-ftr__title">Company</h4>
                    <ul class="ev-ftr__list">
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('services.index') }}">Services</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>


            </div>

            {{-- Contact strip --}}
            <div class="ev-ftr__strip">
                <div class="ev-ftr__strip-item">
                    <span class="ev-ftr__label">Phone</span>
                    <a class="ev-ftr__strip-value" href="tel:+61393579440">(03) 9357 9440</a>
                </div>
                <div class="ev-ftr__strip-item">
                    <span class="ev-ftr__label">Email</span>
                    <a class="ev-ftr__strip-value" href="mailto:info@everestcaravans.com.au">info@everestcaravans.com.au</a>
                </div>

                <ul class="ev-ftr__strip-links">
                    <li><a href="{{ route('privacy.show') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms.show') }}">Terms of Use</a></li>
                </ul>

                <ul class="ev-ftr__social">
                    @if (@$settings->facebook)
                        <li><a href="{{ $settings->facebook }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if (@$settings->youtube)
                        <li><a href="{{ $settings->youtube }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                    @endif
                    @if (@$settings->instagram)
                        <li><a href="{{ $settings->instagram }}" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                    @endif
                </ul>
            </div>


        </div>
        <section class="copy-right-sec1">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-copyright d-flex align-items-center justify-content-between pt-35">
                        <div class="footer-btns-copy order-2-991">
                            <ul>


                                <li class="ml-3">
                                    <p>All Rights Reserved | Copyright © Abreco Motors {{ date('Y') }} Digitally Empowered By <a
                                            href="https://netventure.in" target="_blank">NetVenture</a></p>
                                </li>
                            </ul>
                        </div>
                        <div class="copyright-text order-1-991">
                            {{-- Creator mark. The social links live in the strip above,
                                 so this bar carries the mark instead. --}}
                            @php $evCreator = 'assets/abreco/images/newonce/creater-logo.png'; @endphp
                            @if (file_exists(public_path($evCreator)))
                                <div class="ev-ftr__creator">
                                    <img src="{{ asset($evCreator) }}" alt="Everest Caravans"
                                         width="200" height="170" loading="lazy" decoding="async">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </footer>



    <!--====== abreco BACK TO TOP PART ======-->
    <div class="back-to-top">
        <a href="#"><i class="fal fa-arrow-up"></i></a>
    </div>

    <!--====== abreco Float icons ======-->
    @if ($path !== "/service/roadside-assistance")
        <!-- <div class="float-icons">
            <a href="tel:{{ @$settings->mobile }}" class="telphone">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36"
                    fill="none">
                    <path
                        d="M27.848 27.3858C27.7571 27.139 27.542 26.96 27.2822 26.9196L17.1976 25.3259C16.9305 25.2869 16.6678 25.3909 16.5076 25.6045C16.1164 26.1227 15.8046 26.7103 15.5852 27.3281C14.2643 26.6785 13.0662 25.8167 12.011 24.7629C10.9557 23.7091 10.0954 22.5081 9.44435 21.1887C10.0651 20.9693 10.6512 20.656 11.1694 20.2648C11.3816 20.1046 11.4884 19.839 11.4465 19.5748L9.85432 9.49171C9.8139 9.23188 9.6349 9.01535 9.38805 8.92585C9.12244 8.82913 8.84528 8.74541 8.6071 8.70787C8.20868 8.6126 7.78428 8.56641 7.27616 8.56641C3.69329 8.56641 0.777344 11.4824 0.777344 15.0652C0.777344 26.6078 10.1676 35.998 21.7101 35.998C25.293 35.998 28.2089 33.082 28.2089 29.4992C28.2089 28.9882 28.1627 28.5638 28.0761 28.2144C28.027 27.9286 27.9448 27.6486 27.848 27.3858ZM21.7101 34.5544C10.9644 34.5544 2.22088 25.8109 2.22088 15.0652C2.22088 12.2777 4.48868 10.0099 7.27616 10.0099C7.66591 10.0099 7.98205 10.0417 8.32128 10.1225C8.38191 10.1326 8.44109 10.1456 8.50172 10.1601L9.95248 19.3511C9.44868 19.6658 8.88426 19.8924 8.2953 20.0122C8.0831 20.0555 7.90265 20.1912 7.8016 20.3832C7.70056 20.5738 7.69045 20.8004 7.77418 20.9996C8.52482 22.7896 9.60747 24.3977 10.9918 25.7821C12.3747 27.1664 13.9843 28.2476 15.7757 28.9997C15.9749 29.0849 16.2016 29.0733 16.3921 28.9723C16.5827 28.8712 16.7198 28.6908 16.7617 28.4786C16.8815 27.8896 17.1081 27.3238 17.4228 26.8214L26.6153 28.2736C26.6326 28.3458 26.6499 28.4237 26.6643 28.506C26.7351 28.7933 26.7668 29.1008 26.7668 29.4992C26.7654 32.2866 24.4976 34.5544 21.7101 34.5544Z"
                        fill="white" />
                    <path
                        d="M21.2906 21.1356C21.4089 21.4069 21.6745 21.5686 21.9517 21.5686C22.047 21.5686 22.1451 21.5484 22.2404 21.508C22.6056 21.3492 22.7731 20.9234 22.6128 20.5581C21.0784 17.0417 18.2952 14.26 14.7802 12.7241C14.415 12.5653 13.9891 12.7327 13.8303 13.0965C13.6701 13.4617 13.8376 13.8875 14.2028 14.0463C17.3829 15.435 19.9004 17.9525 21.2906 21.1356Z"
                        fill="white" />
                    <path
                        d="M14.7036 6.55647C14.321 6.44532 13.9197 6.66185 13.8057 7.04295C13.6916 7.42548 13.9096 7.82679 14.2907 7.94083C20.6163 9.82609 25.5157 14.7255 27.3981 21.051C27.4904 21.3643 27.7777 21.5664 28.0895 21.5664C28.1574 21.5664 28.2266 21.5563 28.2959 21.5361C28.6785 21.422 28.8964 21.0207 28.781 20.6382C26.7614 13.8463 21.4983 8.58031 14.7036 6.55647Z"
                        fill="white" />
                    <path
                        d="M34.7622 20.6874C32.5045 10.7313 24.6127 2.83657 14.6581 0.574539C14.2669 0.480709 13.8814 0.728998 13.7934 1.11875C13.7053 1.50707 13.9493 1.89393 14.3376 1.98199C23.7552 4.12131 31.2198 11.5887 33.3548 21.0064C33.4313 21.3413 33.7286 21.5694 34.0578 21.5694C34.1112 21.5694 34.1646 21.5636 34.218 21.5506C34.6063 21.4625 34.8503 21.0757 34.7622 20.6874Z"
                        fill="white" />
                </svg>
            </a>
            <a href="https://wa.me/{{ @$settings->whatsapp }}" target="_blank" class="whatsapp">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="0 0 33 34"
                    fill="none">
                    <path
                        d="M16.2513 0C7.28889 0 0 7.28889 0 16.2513C0 19.8532 1.15283 23.2533 3.33631 26.1061L0.780953 33.0338C0.685326 33.2941 0.770327 33.5703 0.950956 33.7882C1.22721 34.1175 1.62034 33.9741 1.70535 33.9369L9.28112 30.9247C11.4858 31.9766 13.8287 32.5078 16.2513 32.5078C25.2136 32.5078 32.5025 25.2189 32.5025 16.2566C32.5025 7.28889 25.2136 0 16.2513 0ZM16.2513 31.0893C13.9456 31.0893 11.7196 30.5581 9.62644 29.5168C9.44581 29.4265 9.2333 29.4159 9.04736 29.4903L2.66161 32.035L4.80259 26.2283C4.88759 25.9946 4.84509 25.7342 4.69103 25.5377C2.54474 22.8761 1.41315 19.6619 1.41315 16.2513C1.41315 8.06984 8.06984 1.41846 16.2513 1.41846C24.4327 1.41846 31.0893 8.07516 31.0893 16.2566C31.0893 24.4327 24.4327 31.0893 16.2513 31.0893Z"
                        fill="white" />
                    <path
                        d="M26.8286 22.0793C26.7701 21.8084 26.632 21.564 26.4301 21.3621L24.0182 18.9502C23.6516 18.5836 23.1098 18.4349 22.6104 18.5624C21.9994 18.7164 20.8678 19.1468 20.1453 20.3102C20.0125 20.5227 19.9063 20.7671 19.8213 21.0593C19.7256 21.3834 19.5875 21.5852 19.5025 21.6277C19.4706 21.6437 19.4122 21.6384 19.3803 21.6331C19.3591 21.6224 17.4359 20.7405 14.6149 17.9196C11.8205 15.1251 10.9226 13.2073 10.9226 13.2073C10.8961 13.1276 10.8908 13.0691 10.9067 13.0373C10.9545 12.947 11.1511 12.8088 11.4805 12.7185C11.7674 12.6335 12.0117 12.5273 12.2242 12.3998C13.3877 11.6772 13.8233 10.5457 13.9774 9.93471C14.1049 9.43533 13.9561 8.89344 13.5896 8.52687L11.1777 6.11495C10.9758 5.91307 10.7261 5.77494 10.4551 5.71651C9.03136 5.41369 7.75634 6.74715 7.66071 6.8534C5.20098 9.06876 5.63661 11.9323 5.68974 12.2351C6.29006 16.3948 8.69667 19.2849 10.9758 21.564C13.2549 23.8431 16.1503 26.255 20.2835 26.8447C20.326 26.85 20.65 26.9138 21.1547 26.9138C22.2332 26.9138 24.1085 26.6322 25.6439 24.9269C25.7979 24.7834 27.1314 23.5084 26.8286 22.0793ZM24.6398 23.9281C22.8973 25.8619 20.65 25.4688 20.5225 25.4475C16.7665 24.9109 14.0943 22.6743 11.9799 20.5599C9.86544 18.4455 7.62884 15.7733 7.09226 12.0173C7.09226 12.0066 7.08695 11.996 7.08695 11.9854C7.07101 11.8897 6.67788 9.64252 8.65417 7.85748C8.90386 7.59185 9.52012 7.09778 10.0195 7.09778C10.0726 7.09778 10.1204 7.10309 10.1736 7.11372L12.6014 9.58408C12.5005 9.98784 12.2189 10.7316 11.4752 11.1938C11.3742 11.2575 11.2467 11.3107 11.0873 11.3585C10.6039 11.4966 9.96107 11.7888 9.64762 12.3891C9.5095 12.6601 9.38199 13.1063 9.61044 13.7332C9.64762 13.8182 10.588 15.8901 13.6161 18.9236C16.6443 21.9518 18.7162 22.8922 18.8544 22.9506C19.4334 23.1578 19.8744 23.0303 20.1506 22.8921C20.751 22.584 21.0432 21.9412 21.1813 21.4577C21.2291 21.2984 21.2822 21.1709 21.346 21.0646C21.8029 20.3209 22.5519 20.0393 23.0088 19.9596L25.4367 22.3875C25.5482 22.8815 24.9798 23.6094 24.6398 23.9281Z"
                        fill="white" />
                </svg>
            </a>
            <a href="mailto:{{ @$settings->email }}" class="envelope">
                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="25" viewBox="0 0 37 25"
                    fill="none">
                    <path
                        d="M2.85817 0.683594H33.6566C34.4359 0.683594 35.1449 1.0025 35.6579 1.51555C36.1705 2.02814 36.4894 2.73712 36.4894 3.51638V22.1689C36.4894 22.9463 36.1705 23.6544 35.6579 24.1674C35.1422 24.6827 34.4341 25.0016 33.6566 25.0016H2.85817C2.07892 25.0016 1.36994 24.6827 0.857343 24.1701C0.344298 23.6571 0.0253906 22.9481 0.0253906 22.1689V3.51638C0.0253906 2.73983 0.344749 2.03219 0.857343 1.51825L0.861397 1.51419C1.37534 1.00205 2.08252 0.683594 2.85817 0.683594ZM18.2572 17.1006C23.8128 12.4661 29.368 7.83109 34.9232 3.19657C34.8647 2.96504 34.7435 2.75784 34.5796 2.59389C34.3426 2.35696 34.0156 2.20967 33.6566 2.20967H2.85817C2.49737 2.20967 2.17036 2.35606 1.93568 2.59118C1.77037 2.75604 1.64966 2.96414 1.5911 3.19657C7.14631 7.83109 12.7015 12.4661 18.2572 17.1006ZM12.2051 14.03L1.59425 22.4999C1.65416 22.7269 1.77398 22.9301 1.93568 23.0918C2.17216 23.3283 2.49918 23.4756 2.85817 23.4756H33.6566C34.0165 23.4756 34.3444 23.3287 34.5809 23.0932C34.7417 22.9319 34.8611 22.7278 34.9205 22.5004L24.3092 14.03L18.7427 18.6739C18.4536 18.914 18.0392 18.9037 17.763 18.6667L12.2051 14.03ZM1.55146 20.5856L11.0115 13.0345L1.55146 5.14244V20.5856ZM25.5029 13.0345L34.9633 20.586V5.14199L25.5029 13.0345Z"
                        fill="white" />
                </svg>
            </a>
        </div> -->

        <!-- Mobile view Float icons -->
        <div class="floatingButtonWrap d-none block-575">
            <div class="floatingButtonInner">
                <a href="#" class="floatingButton">
                    <!-- <i class="fa fa-plus icon-default"></i> -->
                    <i class="fa fa-ellipsis-h icon-default"></i>
                </a>
                <ul class="floatingMenu">
                    <li>
                        <a href="tel:{{ @$settings->mobile }}" class="telphone">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36"
                                fill="none">
                                <path
                                    d="M27.848 27.3858C27.7571 27.139 27.542 26.96 27.2822 26.9196L17.1976 25.3259C16.9305 25.2869 16.6678 25.3909 16.5076 25.6045C16.1164 26.1227 15.8046 26.7103 15.5852 27.3281C14.2643 26.6785 13.0662 25.8167 12.011 24.7629C10.9557 23.7091 10.0954 22.5081 9.44435 21.1887C10.0651 20.9693 10.6512 20.656 11.1694 20.2648C11.3816 20.1046 11.4884 19.839 11.4465 19.5748L9.85432 9.49171C9.8139 9.23188 9.6349 9.01535 9.38805 8.92585C9.12244 8.82913 8.84528 8.74541 8.6071 8.70787C8.20868 8.6126 7.78428 8.56641 7.27616 8.56641C3.69329 8.56641 0.777344 11.4824 0.777344 15.0652C0.777344 26.6078 10.1676 35.998 21.7101 35.998C25.293 35.998 28.2089 33.082 28.2089 29.4992C28.2089 28.9882 28.1627 28.5638 28.0761 28.2144C28.027 27.9286 27.9448 27.6486 27.848 27.3858ZM21.7101 34.5544C10.9644 34.5544 2.22088 25.8109 2.22088 15.0652C2.22088 12.2777 4.48868 10.0099 7.27616 10.0099C7.66591 10.0099 7.98205 10.0417 8.32128 10.1225C8.38191 10.1326 8.44109 10.1456 8.50172 10.1601L9.95248 19.3511C9.44868 19.6658 8.88426 19.8924 8.2953 20.0122C8.0831 20.0555 7.90265 20.1912 7.8016 20.3832C7.70056 20.5738 7.69045 20.8004 7.77418 20.9996C8.52482 22.7896 9.60747 24.3977 10.9918 25.7821C12.3747 27.1664 13.9843 28.2476 15.7757 28.9997C15.9749 29.0849 16.2016 29.0733 16.3921 28.9723C16.5827 28.8712 16.7198 28.6908 16.7617 28.4786C16.8815 27.8896 17.1081 27.3238 17.4228 26.8214L26.6153 28.2736C26.6326 28.3458 26.6499 28.4237 26.6643 28.506C26.7351 28.7933 26.7668 29.1008 26.7668 29.4992C26.7654 32.2866 24.4976 34.5544 21.7101 34.5544Z"
                                    fill="white" />
                                <path
                                    d="M21.2906 21.1356C21.4089 21.4069 21.6745 21.5686 21.9517 21.5686C22.047 21.5686 22.1451 21.5484 22.2404 21.508C22.6056 21.3492 22.7731 20.9234 22.6128 20.5581C21.0784 17.0417 18.2952 14.26 14.7802 12.7241C14.415 12.5653 13.9891 12.7327 13.8303 13.0965C13.6701 13.4617 13.8376 13.8875 14.2028 14.0463C17.3829 15.435 19.9004 17.9525 21.2906 21.1356Z"
                                    fill="white" />
                                <path
                                    d="M14.7036 6.55647C14.321 6.44532 13.9197 6.66185 13.8057 7.04295C13.6916 7.42548 13.9096 7.82679 14.2907 7.94083C20.6163 9.82609 25.5157 14.7255 27.3981 21.051C27.4904 21.3643 27.7777 21.5664 28.0895 21.5664C28.1574 21.5664 28.2266 21.5563 28.2959 21.5361C28.6785 21.422 28.8964 21.0207 28.781 20.6382C26.7614 13.8463 21.4983 8.58031 14.7036 6.55647Z"
                                    fill="white" />
                                <path
                                    d="M34.7622 20.6874C32.5045 10.7313 24.6127 2.83657 14.6581 0.574539C14.2669 0.480709 13.8814 0.728998 13.7934 1.11875C13.7053 1.50707 13.9493 1.89393 14.3376 1.98199C23.7552 4.12131 31.2198 11.5887 33.3548 21.0064C33.4313 21.3413 33.7286 21.5694 34.0578 21.5694C34.1112 21.5694 34.1646 21.5636 34.218 21.5506C34.6063 21.4625 34.8503 21.0757 34.7622 20.6874Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/{{ @$settings->whatsapp }}" target="_blank" class="whatsapp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="0 0 33 34"
                                fill="none">
                                <path
                                    d="M16.2513 0C7.28889 0 0 7.28889 0 16.2513C0 19.8532 1.15283 23.2533 3.33631 26.1061L0.780953 33.0338C0.685326 33.2941 0.770327 33.5703 0.950956 33.7882C1.22721 34.1175 1.62034 33.9741 1.70535 33.9369L9.28112 30.9247C11.4858 31.9766 13.8287 32.5078 16.2513 32.5078C25.2136 32.5078 32.5025 25.2189 32.5025 16.2566C32.5025 7.28889 25.2136 0 16.2513 0ZM16.2513 31.0893C13.9456 31.0893 11.7196 30.5581 9.62644 29.5168C9.44581 29.4265 9.2333 29.4159 9.04736 29.4903L2.66161 32.035L4.80259 26.2283C4.88759 25.9946 4.84509 25.7342 4.69103 25.5377C2.54474 22.8761 1.41315 19.6619 1.41315 16.2513C1.41315 8.06984 8.06984 1.41846 16.2513 1.41846C24.4327 1.41846 31.0893 8.07516 31.0893 16.2566C31.0893 24.4327 24.4327 31.0893 16.2513 31.0893Z"
                                    fill="white" />
                                <path
                                    d="M26.8286 22.0793C26.7701 21.8084 26.632 21.564 26.4301 21.3621L24.0182 18.9502C23.6516 18.5836 23.1098 18.4349 22.6104 18.5624C21.9994 18.7164 20.8678 19.1468 20.1453 20.3102C20.0125 20.5227 19.9063 20.7671 19.8213 21.0593C19.7256 21.3834 19.5875 21.5852 19.5025 21.6277C19.4706 21.6437 19.4122 21.6384 19.3803 21.6331C19.3591 21.6224 17.4359 20.7405 14.6149 17.9196C11.8205 15.1251 10.9226 13.2073 10.9226 13.2073C10.8961 13.1276 10.8908 13.0691 10.9067 13.0373C10.9545 12.947 11.1511 12.8088 11.4805 12.7185C11.7674 12.6335 12.0117 12.5273 12.2242 12.3998C13.3877 11.6772 13.8233 10.5457 13.9774 9.93471C14.1049 9.43533 13.9561 8.89344 13.5896 8.52687L11.1777 6.11495C10.9758 5.91307 10.7261 5.77494 10.4551 5.71651C9.03136 5.41369 7.75634 6.74715 7.66071 6.8534C5.20098 9.06876 5.63661 11.9323 5.68974 12.2351C6.29006 16.3948 8.69667 19.2849 10.9758 21.564C13.2549 23.8431 16.1503 26.255 20.2835 26.8447C20.326 26.85 20.65 26.9138 21.1547 26.9138C22.2332 26.9138 24.1085 26.6322 25.6439 24.9269C25.7979 24.7834 27.1314 23.5084 26.8286 22.0793ZM24.6398 23.9281C22.8973 25.8619 20.65 25.4688 20.5225 25.4475C16.7665 24.9109 14.0943 22.6743 11.9799 20.5599C9.86544 18.4455 7.62884 15.7733 7.09226 12.0173C7.09226 12.0066 7.08695 11.996 7.08695 11.9854C7.07101 11.8897 6.67788 9.64252 8.65417 7.85748C8.90386 7.59185 9.52012 7.09778 10.0195 7.09778C10.0726 7.09778 10.1204 7.10309 10.1736 7.11372L12.6014 9.58408C12.5005 9.98784 12.2189 10.7316 11.4752 11.1938C11.3742 11.2575 11.2467 11.3107 11.0873 11.3585C10.6039 11.4966 9.96107 11.7888 9.64762 12.3891C9.5095 12.6601 9.38199 13.1063 9.61044 13.7332C9.64762 13.8182 10.588 15.8901 13.6161 18.9236C16.6443 21.9518 18.7162 22.8922 18.8544 22.9506C19.4334 23.1578 19.8744 23.0303 20.1506 22.8921C20.751 22.584 21.0432 21.9412 21.1813 21.4577C21.2291 21.2984 21.2822 21.1709 21.346 21.0646C21.8029 20.3209 22.5519 20.0393 23.0088 19.9596L25.4367 22.3875C25.5482 22.8815 24.9798 23.6094 24.6398 23.9281Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ @$settings->email }}" class="envelope">
                            <svg xmlns="http://www.w3.org/2000/svg" width="37" height="25" viewBox="0 0 37 25"
                                fill="none">
                                <path
                                    d="M2.85817 0.683594H33.6566C34.4359 0.683594 35.1449 1.0025 35.6579 1.51555C36.1705 2.02814 36.4894 2.73712 36.4894 3.51638V22.1689C36.4894 22.9463 36.1705 23.6544 35.6579 24.1674C35.1422 24.6827 34.4341 25.0016 33.6566 25.0016H2.85817C2.07892 25.0016 1.36994 24.6827 0.857343 24.1701C0.344298 23.6571 0.0253906 22.9481 0.0253906 22.1689V3.51638C0.0253906 2.73983 0.344749 2.03219 0.857343 1.51825L0.861397 1.51419C1.37534 1.00205 2.08252 0.683594 2.85817 0.683594ZM18.2572 17.1006C23.8128 12.4661 29.368 7.83109 34.9232 3.19657C34.8647 2.96504 34.7435 2.75784 34.5796 2.59389C34.3426 2.35696 34.0156 2.20967 33.6566 2.20967H2.85817C2.49737 2.20967 2.17036 2.35606 1.93568 2.59118C1.77037 2.75604 1.64966 2.96414 1.5911 3.19657C7.14631 7.83109 12.7015 12.4661 18.2572 17.1006ZM12.2051 14.03L1.59425 22.4999C1.65416 22.7269 1.77398 22.9301 1.93568 23.0918C2.17216 23.3283 2.49918 23.4756 2.85817 23.4756H33.6566C34.0165 23.4756 34.3444 23.3287 34.5809 23.0932C34.7417 22.9319 34.8611 22.7278 34.9205 22.5004L24.3092 14.03L18.7427 18.6739C18.4536 18.914 18.0392 18.9037 17.763 18.6667L12.2051 14.03ZM1.55146 20.5856L11.0115 13.0345L1.55146 5.14244V20.5856ZM25.5029 13.0345L34.9633 20.586V5.14199L25.5029 13.0345Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


    <!-- Mobile view Float icons new update -->
    <div class="float-icon-bottom">
        <ul>
            <li class="tel">
                <a href="tel:{{ @$settings->mobile }}" class="telphone">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="36" viewBox="0 0 35 36"
                            fill="none">
                            <path
                                d="M27.848 27.3858C27.7571 27.139 27.542 26.96 27.2822 26.9196L17.1976 25.3259C16.9305 25.2869 16.6678 25.3909 16.5076 25.6045C16.1164 26.1227 15.8046 26.7103 15.5852 27.3281C14.2643 26.6785 13.0662 25.8167 12.011 24.7629C10.9557 23.7091 10.0954 22.5081 9.44435 21.1887C10.0651 20.9693 10.6512 20.656 11.1694 20.2648C11.3816 20.1046 11.4884 19.839 11.4465 19.5748L9.85432 9.49171C9.8139 9.23188 9.6349 9.01535 9.38805 8.92585C9.12244 8.82913 8.84528 8.74541 8.6071 8.70787C8.20868 8.6126 7.78428 8.56641 7.27616 8.56641C3.69329 8.56641 0.777344 11.4824 0.777344 15.0652C0.777344 26.6078 10.1676 35.998 21.7101 35.998C25.293 35.998 28.2089 33.082 28.2089 29.4992C28.2089 28.9882 28.1627 28.5638 28.0761 28.2144C28.027 27.9286 27.9448 27.6486 27.848 27.3858ZM21.7101 34.5544C10.9644 34.5544 2.22088 25.8109 2.22088 15.0652C2.22088 12.2777 4.48868 10.0099 7.27616 10.0099C7.66591 10.0099 7.98205 10.0417 8.32128 10.1225C8.38191 10.1326 8.44109 10.1456 8.50172 10.1601L9.95248 19.3511C9.44868 19.6658 8.88426 19.8924 8.2953 20.0122C8.0831 20.0555 7.90265 20.1912 7.8016 20.3832C7.70056 20.5738 7.69045 20.8004 7.77418 20.9996C8.52482 22.7896 9.60747 24.3977 10.9918 25.7821C12.3747 27.1664 13.9843 28.2476 15.7757 28.9997C15.9749 29.0849 16.2016 29.0733 16.3921 28.9723C16.5827 28.8712 16.7198 28.6908 16.7617 28.4786C16.8815 27.8896 17.1081 27.3238 17.4228 26.8214L26.6153 28.2736C26.6326 28.3458 26.6499 28.4237 26.6643 28.506C26.7351 28.7933 26.7668 29.1008 26.7668 29.4992C26.7654 32.2866 24.4976 34.5544 21.7101 34.5544Z"
                                fill="white" />
                            <path
                                d="M21.2906 21.1356C21.4089 21.4069 21.6745 21.5686 21.9517 21.5686C22.047 21.5686 22.1451 21.5484 22.2404 21.508C22.6056 21.3492 22.7731 20.9234 22.6128 20.5581C21.0784 17.0417 18.2952 14.26 14.7802 12.7241C14.415 12.5653 13.9891 12.7327 13.8303 13.0965C13.6701 13.4617 13.8376 13.8875 14.2028 14.0463C17.3829 15.435 19.9004 17.9525 21.2906 21.1356Z"
                                fill="white" />
                            <path
                                d="M14.7036 6.55647C14.321 6.44532 13.9197 6.66185 13.8057 7.04295C13.6916 7.42548 13.9096 7.82679 14.2907 7.94083C20.6163 9.82609 25.5157 14.7255 27.3981 21.051C27.4904 21.3643 27.7777 21.5664 28.0895 21.5664C28.1574 21.5664 28.2266 21.5563 28.2959 21.5361C28.6785 21.422 28.8964 21.0207 28.781 20.6382C26.7614 13.8463 21.4983 8.58031 14.7036 6.55647Z"
                                fill="white" />
                            <path
                                d="M34.7622 20.6874C32.5045 10.7313 24.6127 2.83657 14.6581 0.574539C14.2669 0.480709 13.8814 0.728998 13.7934 1.11875C13.7053 1.50707 13.9493 1.89393 14.3376 1.98199C23.7552 4.12131 31.2198 11.5887 33.3548 21.0064C33.4313 21.3413 33.7286 21.5694 34.0578 21.5694C34.1112 21.5694 34.1646 21.5636 34.218 21.5506C34.6063 21.4625 34.8503 21.0757 34.7622 20.6874Z"
                                fill="white" />
                        </svg>
                    </a>
            </li>
            <li class="whats">
                    <a href="https://wa.me/{{ @$settings->whatsapp }}" target="_blank" class="whatsapp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="0 0 33 34"
                            fill="none">
                            <path
                                d="M16.2513 0C7.28889 0 0 7.28889 0 16.2513C0 19.8532 1.15283 23.2533 3.33631 26.1061L0.780953 33.0338C0.685326 33.2941 0.770327 33.5703 0.950956 33.7882C1.22721 34.1175 1.62034 33.9741 1.70535 33.9369L9.28112 30.9247C11.4858 31.9766 13.8287 32.5078 16.2513 32.5078C25.2136 32.5078 32.5025 25.2189 32.5025 16.2566C32.5025 7.28889 25.2136 0 16.2513 0ZM16.2513 31.0893C13.9456 31.0893 11.7196 30.5581 9.62644 29.5168C9.44581 29.4265 9.2333 29.4159 9.04736 29.4903L2.66161 32.035L4.80259 26.2283C4.88759 25.9946 4.84509 25.7342 4.69103 25.5377C2.54474 22.8761 1.41315 19.6619 1.41315 16.2513C1.41315 8.06984 8.06984 1.41846 16.2513 1.41846C24.4327 1.41846 31.0893 8.07516 31.0893 16.2566C31.0893 24.4327 24.4327 31.0893 16.2513 31.0893Z"
                                fill="white" />
                            <path
                                d="M26.8286 22.0793C26.7701 21.8084 26.632 21.564 26.4301 21.3621L24.0182 18.9502C23.6516 18.5836 23.1098 18.4349 22.6104 18.5624C21.9994 18.7164 20.8678 19.1468 20.1453 20.3102C20.0125 20.5227 19.9063 20.7671 19.8213 21.0593C19.7256 21.3834 19.5875 21.5852 19.5025 21.6277C19.4706 21.6437 19.4122 21.6384 19.3803 21.6331C19.3591 21.6224 17.4359 20.7405 14.6149 17.9196C11.8205 15.1251 10.9226 13.2073 10.9226 13.2073C10.8961 13.1276 10.8908 13.0691 10.9067 13.0373C10.9545 12.947 11.1511 12.8088 11.4805 12.7185C11.7674 12.6335 12.0117 12.5273 12.2242 12.3998C13.3877 11.6772 13.8233 10.5457 13.9774 9.93471C14.1049 9.43533 13.9561 8.89344 13.5896 8.52687L11.1777 6.11495C10.9758 5.91307 10.7261 5.77494 10.4551 5.71651C9.03136 5.41369 7.75634 6.74715 7.66071 6.8534C5.20098 9.06876 5.63661 11.9323 5.68974 12.2351C6.29006 16.3948 8.69667 19.2849 10.9758 21.564C13.2549 23.8431 16.1503 26.255 20.2835 26.8447C20.326 26.85 20.65 26.9138 21.1547 26.9138C22.2332 26.9138 24.1085 26.6322 25.6439 24.9269C25.7979 24.7834 27.1314 23.5084 26.8286 22.0793ZM24.6398 23.9281C22.8973 25.8619 20.65 25.4688 20.5225 25.4475C16.7665 24.9109 14.0943 22.6743 11.9799 20.5599C9.86544 18.4455 7.62884 15.7733 7.09226 12.0173C7.09226 12.0066 7.08695 11.996 7.08695 11.9854C7.07101 11.8897 6.67788 9.64252 8.65417 7.85748C8.90386 7.59185 9.52012 7.09778 10.0195 7.09778C10.0726 7.09778 10.1204 7.10309 10.1736 7.11372L12.6014 9.58408C12.5005 9.98784 12.2189 10.7316 11.4752 11.1938C11.3742 11.2575 11.2467 11.3107 11.0873 11.3585C10.6039 11.4966 9.96107 11.7888 9.64762 12.3891C9.5095 12.6601 9.38199 13.1063 9.61044 13.7332C9.64762 13.8182 10.588 15.8901 13.6161 18.9236C16.6443 21.9518 18.7162 22.8922 18.8544 22.9506C19.4334 23.1578 19.8744 23.0303 20.1506 22.8921C20.751 22.584 21.0432 21.9412 21.1813 21.4577C21.2291 21.2984 21.2822 21.1709 21.346 21.0646C21.8029 20.3209 22.5519 20.0393 23.0088 19.9596L25.4367 22.3875C25.5482 22.8815 24.9798 23.6094 24.6398 23.9281Z"
                                fill="white" />
                        </svg>
                    </a>
            </li>
            <li class="env">
                <a href="mailto:{{ @$settings->email }}" class="envelope">
                        <svg xmlns="http://www.w3.org/2000/svg" width="37" height="25" viewBox="0 0 37 25"
                            fill="none">
                            <path
                                d="M2.85817 0.683594H33.6566C34.4359 0.683594 35.1449 1.0025 35.6579 1.51555C36.1705 2.02814 36.4894 2.73712 36.4894 3.51638V22.1689C36.4894 22.9463 36.1705 23.6544 35.6579 24.1674C35.1422 24.6827 34.4341 25.0016 33.6566 25.0016H2.85817C2.07892 25.0016 1.36994 24.6827 0.857343 24.1701C0.344298 23.6571 0.0253906 22.9481 0.0253906 22.1689V3.51638C0.0253906 2.73983 0.344749 2.03219 0.857343 1.51825L0.861397 1.51419C1.37534 1.00205 2.08252 0.683594 2.85817 0.683594ZM18.2572 17.1006C23.8128 12.4661 29.368 7.83109 34.9232 3.19657C34.8647 2.96504 34.7435 2.75784 34.5796 2.59389C34.3426 2.35696 34.0156 2.20967 33.6566 2.20967H2.85817C2.49737 2.20967 2.17036 2.35606 1.93568 2.59118C1.77037 2.75604 1.64966 2.96414 1.5911 3.19657C7.14631 7.83109 12.7015 12.4661 18.2572 17.1006ZM12.2051 14.03L1.59425 22.4999C1.65416 22.7269 1.77398 22.9301 1.93568 23.0918C2.17216 23.3283 2.49918 23.4756 2.85817 23.4756H33.6566C34.0165 23.4756 34.3444 23.3287 34.5809 23.0932C34.7417 22.9319 34.8611 22.7278 34.9205 22.5004L24.3092 14.03L18.7427 18.6739C18.4536 18.914 18.0392 18.9037 17.763 18.6667L12.2051 14.03ZM1.55146 20.5856L11.0115 13.0345L1.55146 5.14244V20.5856ZM25.5029 13.0345L34.9633 20.586V5.14199L25.5029 13.0345Z"
                                fill="white" />
                        </svg>
                    </a>
            </li>
        </ul>
    </div>
@endif
    @php
        $vehicles_list_form = App\Vehicle::where('status',1)->get();
        $locations_form = App\Location::where('status',1)->orderBy('order','ASC')->get();

    @endphp
    <!--====== Enquire POPUP START ======-->
    <div class="modal enq-popup fade" id="form-Popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-vehicle-form contact-form" role="document">
            <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">ENQUIRE NOW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Enquire forms -->
            <form  id="form-Popup-veh" class="js-validation-exchange"  action="{{ route('enquiry.store') }}" method="post">
                @csrf
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>{{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>{{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" value="{{ @old('name') }}" placeholder="Your Name *" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                <option value="">Select Vehicle *</option>
                                @foreach ($vehicles_list_form as $vehicle_data)
                                    {{-- <option  value="{{ $vehicle_data->id }}">{{ $vehicle_data->name }}</option> --}}
                                   <option value="{{ $vehicle_data->id }}" slug="{{ $vehicle_data->slug}}">{{ $vehicle_data->name }}</option>

                                @endforeach
                                <!-- <option value="">asdasd</option>
                                <option value="">asdasdas</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input type="tel" name="phone"  value="{{ @old('phone') }}" placeholder="Phone Number *" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input type="email" value="{{ @old('email') }}" name="email" placeholder="Email Id *" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <textarea name="message"  cols="30" rows="10" placeholder="Type your Message...." required>{{ @old('message') }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name='formPageName' class='formPageName' value=''>
                    <input type="hidden" name="refer" value='{{@$refer}}'>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <select name="location_id" id="location_id" class="form-control" required>
                                <option value="">Select Location *</option>
                                @foreach ($locations_form as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->name }}</option>
                                @endforeach
                                <!-- <option value="">asdasd</option>
                                <option value="">asdasda</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-6" style="overflow: hidden;">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display(['data-theme' => 'light', 'required' => 'required', 'id' => 're-captcha']) !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <label
                                    style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                            </span>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group form-btn-style">
                            <input type="hidden" name="popup" value="1">
                            <button type="submit" name="submit" id='submit-button' class="form-control submit-btn new-btn-style" >
                                <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="none">
                                    <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <img src="{{asset('assets/abreco/images/shapes/right-white.png')}}" class="d-none white" alt="">
                                Submit Form
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- <form>
                <div class="modal-body">
                <div class="form-group">
                    <label for="email1">Email address</label>
                    <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small>
                </div>
                <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" class="form-control" id="password1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password1">Confirm Password</label>
                    <input type="password" class="form-control" id="password2" placeholder="Confirm Password">
                </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form> -->
            </div>
        </div>
    </div>








    <!--====== jquery js ======-->
    <script src="{{ asset('assets/abreco/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/abreco/js/vendor/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('assets/abreco/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/abreco/js/vendor/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/abreco/js/main.js') }}"></script>

    <script>
        var rightImageUrl = "{{ asset('assets/abreco/images/shapes/right.svg') }}";
    </script>

@if($errors->any() && session('specificFunctionError', false))
<script>
    // Add JavaScript code to open the modal when there are validation errors
    $(document).ready(function() {
        $('#form-Popup').modal('show');
    });
</script>
@endif




    <!-- side menus call / Mail/ whatsapp -->
    <script>
        $(document).ready(function() {
            $('.floatingButton').on('click', function(e) {
                e.preventDefault();
                $(this).toggleClass('open');
                var icon = $(this).find('.fa');

                if (icon.hasClass('fa-ellipsis-h')) {
                    icon.removeClass('fa-ellipsis-h');
                    icon.addClass('fa-times');
                } else if (icon.hasClass('fa-times')) {
                    icon.removeClass('fa-times');
                    icon.addClass('fa-ellipsis-h');
                }

                $('.floatingMenu').stop().slideToggle();
            });

            $(this).on('click', function(e) {
                var container = $(".floatingButton");
                if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) {
                    if (container.hasClass('open')) {
                        container.removeClass('open');
                    }
                    var icon = container.find('.fa');
                    if (icon.hasClass('fa-times')) {
                        icon.removeClass('fa-times');
                        icon.addClass('fa-ellipsis-h');
                    }
                    $('.floatingMenu').hide();
                }

                if (!container.is(e.target) && ($('.floatingMenu').has(e.target).length > 0)) {
                    $('.floatingButton').removeClass('open');
                    $('.floatingMenu').stop().slideToggle();
                }
            });
        });
    </script>

    <!-- Megamenu hover image changing -->
    <script>
        function changeImage(imageSrc, vehicleId) {
            // alert(vehicleId)
            var menuImage = document.getElementById('menu-image-' + vehicleId);
            if (menuImage) {
                menuImage.src = imageSrc;
            }
        }
    </script>
  <script>
  $('.openPop').click(function() {
    // Find the hidden input element with class 'vehicle-id' within the modal
    var vehicleSlug = $(this).closest('.fea-inner').find('.vehicle-id').val();

   $('#vehicle_id option').each(function() {
        if ($(this).attr('slug') === vehicleSlug) {
            $(this).prop('selected', true);
        }
    });
});

</script>


    @yield('js_after')
</body>

</html>
