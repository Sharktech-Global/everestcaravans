<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">{!! SEO::generate() !!}
    <meta name="facebook-domain-verification" content="nu43u1tt4iojwnbxkfnkanqpppdosg" />
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5WZ23Q7');
    </script>
    <link rel="icon" href="{{asset('storage/' . @$settings->favicon)}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('assets/inttel/intlTelInput.css')}}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        :root {
            --main-bg-new-color: {{(@$settings->website_color) ? @$settings->website_color: '#f15336' }};
        }

        .homepage .nav-menu>li>a {
            padding: 20px 13px !important;
        }
    </style> @yield('css_after') 
    @notifyCss
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/layerslider/layerslider.css')}}" type="text/css">
</head>

<body @if (Request::is( '/')) class="homepage" @else class="innerpage" @endif> 
    {{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5WZ23Q7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> --}}
    <div id="warning-message">
        <p> <img src="{{asset('assets/images/landscape.png')}}" alt="Abreco" width="70"><br>Landscape mode is disabled<br>Please rotate your device </p>
    </div>
    <div class="main-div">
        <div class="offcanvas-menu-overlay"></div>
        <div class="offcanvas-menu-wrapper">
            <nav class="offcanvas__menu mobile-menu">
                <ul>
                    <li> <a href="{{route('home')}}"> <img alt="{{config('app.name')}}logo" title="{{config('app.name')}}logo" src="{{asset('storage/' . @$settings->logo_secondary)}}"> </a> </li>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="#">Corporate</a>
                        <ul class="dropdown">
                            <li><a href="{{route('about')}}">About</a></li>                           
                            <li><a href="{{route('career')}}">Careers</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Find us</a>
                        <ul class="dropdown">
                            <li><a href="{{route('network.show')}}">Network</a></li>
                            <li><a href="{{route('location_map.show')}}">Location Map</a></li>
                        </ul>
                    </li>
                    <li> <a href="#">New Cars</a>
                        <ul class="dropdown"> @foreach ($vehicle_types as $type) @if ($type->name !=='Nexa')
                            <li><a href="">{{$type->name}}</a>
                                <ul class="dropdown"> @foreach ($type->vehicles()->whereStatus(1)->get() as $vehicle) @if ($type->has_sales_page)
                                    <li><a href="{{url($type->sales_page)}}">{{$vehicle->name}}</a> </li>@else
                                    <li><a href="{{route('vehicles.show', $vehicle->slug)}}">{{$vehicle->name}}</a> </li>@endif @endforeach </ul>
                            </li>@endif @endforeach                            
                        </ul>
                    </li>
                    <li><a href="#">Own a car</a>
                        <ul class="dropdown">
                            <li><a href="{{route('booking.index')}}">Book now</a></li>
                            <li><a href="{{route('exchange.show')}}">Exchange My Car</a></li>
                            <li><a href="{{route('finance.index')}}">Finance</a></li>
                            <li><a href="{{route('subscribe.show')}}">Subscription</a></li>
                        </ul>
                    </li>
                    <li class=""><a href="{{route('services.show')}}">Service</a>
                        <ul class="dropdown">
                            <li class=""><a href="{{route('our-services.show')}}">Services</a></li>
                            <li class=""><a href="{{route('services.show')}}">Book your Service</a> </li>
                            <li class=""><a href="{{route('our-services.show')}}">Services Offered</a>
                                <ul class="dropdown">
                                    <li class=""><a href="{{route('addPage.view', 'periodic-maintenance-service')}}">Periodic Maintenance</a></li>                                   
                            </li>                           
                        </ul>
                    </li>
                    <li class=""><a href="{{route('coming-soon.show')}}">TIPS / FAQ</a></li>
                    </ul>
                    </li>
                    <li><a href="#">Insurance</a>
                        <ul class="dropdown">
                            <li><a href="{{route('insure-my-car.show')}}">Insure my car</a></li>
                            <li><a href="{{route('insurance-features.show')}}">Insurance Features</a></li>
                            <li><a href="{{route('coming-soon.show')}}">Value Added Services</a></li>
                            <li><a href="{{route('coming-soon.show')}}">TIPS / FAQ</a></li>
                        </ul>
                    </li>
                    {{-- <li><a href="#">Offers</a>
                        <ul class="dropdown">
                            <li><a href="{{route('offers.show', 'kerala-offers')}}">Kerala Offers</a></li>
                            <li><a href="{{route('offers.show', 'chennai-offers')}}">Chennai Offers</a></li>
                        </ul>
                    </li> --}}
             
                    <li><a href="{{route('contact')}}">Contact us</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
            <ul class="offcanvas__widget d-inline-block">
                <li> <a href="tel:{{@$settings->mobile}}"><i class="fa fa-phone"></i>{{@$settings->mobile}}</a><br><a target="_blank" href="https://web.whatsapp.com/send?phone={{@$settings->whatsapp}}" class="wpapp hidden-xs"> <i class="fa fa-whatsapp"></i>{{@$settings->whatsapp}}</a>                    <a href="whatsapp://send?phone={{@$settings->whatsapp}}" class="wpapp hidden-lg hidden-md hidden-sm"> <i class="fa fa-whatsapp"></i>{{@$settings->whatsapp}}</a> </li>
            </ul>
        </div>
        <header class="header">
            <div class="container" style="max-width: 100%;">
                <div class="row">
                    <div class="px-0 col-lg-9 fullwidthmenu">
                        <div class="header__top desktop-menu-header-top">
                            <div class="container">
                                <div class="px-0 row">
                                    <div class="text-center col-lg-3 primarylogo"> @if (Request::is('/'))
                                        <div class="1 header__logo"> <a href="{{route('home')}}"> <img class="hidden-xs" alt="Popularmaruti Logo" title="Logo" src="{{asset('storage/' . @$settings->logo_secondary)}}"> </a> </div>@else
                                        <div class="2 header__logo"> <a href="{{route('home')}}"> <img alt="Logo" title="Popularmaruti Logo" src="{{asset('storage/' . @$settings->logo_third)}}"> </a> </div>@endif </div>
                                    <div class="text-center col-lg-3 secondary-logo"> @if (Request::is('/'))
                                        <div class="3 header__logo"> <a href="{{route('home')}}"> <img alt="{{config('app.name')}}logo" title="{{config('app.name')}}logo" src="{{asset('storage/' . @$settings->logo)}}"> </a> </div>@else
                                        <div class="4 header__logo"> <a href="{{route('home')}}"> <img alt="{{config('app.name')}}logo" title="{{config('app.name')}}logo" src="{{asset('storage/' . @$settings->logo_fourth)}}"> </a> </div>@endif </div>
                                    <div class="col-lg-6">
                                        <div class="pt-0 text-center header__nav">
                                            <nav class="bg-transparent header__menu w-100">
                                                <ul class="float-right">
                                                    <li> <a href="tel:{{@$settings->mobile}}"><i class="fa fa-phone"></i>{{format_phone_number(@$settings->mobile, 'tollfree')}}</a> </li>
                                                    <li><a target="_blank" href="https://web.whatsapp.com/send?phone={{@$settings->whatsapp}}" class="wpapp hidden-xs"> <i class="fa fa-whatsapp"></i>{{format_phone_number(@$settings->whatsapp, 'number')}}</a>                                                        <a href="whatsapp://send?phone={{@$settings->whatsapp}}" class="wpapp hidden-lg hidden-md hidden-sm"> <i class="fa fa-whatsapp"></i>{{format_phone_number(@$settings->whatsapp, 'number')}}</a> </li>
                                                    <li
                                                        class="{{request()->is('contact-us') ? 'active' : ''}}"> <a href="{{route('contact')}}">Contact us</a> </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header__top mobile-menu-header-top">
                            <div class="container">
                                <div class="px-0 row">
                                    <div class="text-center col-lg-3 primarylogo">
                                        <div class="1 header__logo"> <a href="{{route('home')}}"> <img class="hidden-d" alt="Logo" title="Logo" src="{{asset('storage/' . @$settings->logo_third)}}"> </a> </div>
                                        <ul class=" hidden-md">
                                            <li class="px-2 d-inline-block" style="font-size: 25px;"> <a class="blackColor" href="tel:{{@$settings->mobile}}"><i class="fa fa-phone"></i></a> </li>
                                            <li class="px-2 d-inline-block" style="font-size: 25px;"> <a href="https://wa.me/{{@$settings->whatsapp}}" class="blackColor wpapp hidden-lg hidden-md hidden-sm"> <i class="fa fa-whatsapp"></i></a> </li>
                                        </ul>
                                    </div>
                                    <div class="text-center col-lg-3 secondary-logo">
                                        <div class="3 header__logo">
                                            <div class="canvas__open"> <span class="fa fa-bars"></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mainmenu">
                            <header class="header_area">
                                <div class="main_header_area animated">
                                    <div class="containersss px-0">
                                        <nav id="navigation1" class="navigation">
                                            <div class="nav-menus-wrapper">
                                                <ul id="nav-menu" class="nav-menu align-to-right" style="padding-left: 30px !important;">
                                                    <li class="{{request()->is('/') ? 'active' : ''}}"><a href="{{route('home')}}"><img src="{{asset('assets/images/logo/home.png')}}" alt="Abreco"></a></li>
                                                    <li class=""><a href="#">Corporate</a>
                                                        <ul class="nav-dropdown">
                                                            <li class="{{request()->is('about') ? 'active' : ''}}"> <a href="{{route('about')}}">About</a> </li>                                                           
                                                            <li class="{{request()->is('career') ? 'active' : ''}}"> <a href="{{route('career')}}">Careers</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class=""><a href="#">Find us</a>
                                                        <ul class="nav-dropdown">
                                                            <li class="{{request()->is('network') ? 'active' : ''}}"> <a href="{{route('network.show')}}">Network</a> </li>
                                                            <li class=""><a href="{{route('location_map.show')}}">Location Map</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class=""><a href="#">new cars</a>
                                                        <div class="megamenu-panel">
                                                            <div class="megamenu-lists"> @foreach ($vehicle_types as $type) @if ($type->name !=='Nexa')
                                                                <ul class="megamenu-list list-col-5">
                                                                    <p class="px-3 primaryColor w-100 loat-left text-uppercase font-weight-bold">{{$type->name}}</p>@foreach ($type->vehicles()->whereStatus(1)->get() as $vehicle) @if ($type->has_sales_page)
                                                                    <li> <a href="{{url($type->sales_page)}}">{{$vehicle->name}}</a> </li>@else
                                                                    <li class="{{request()->is('vehicles/' . $vehicle->slug) ? 'active' : ''}}"> <a href="{{route('vehicles.show', $vehicle->slug)}}">{{$vehicle->name}}</a> </li>@endif @endforeach </ul> @endif @endforeach
                                                               
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class=""><a href="#">Own a car</a>
                                                        <ul class="nav-dropdown">
                                                            <li class="{{request()->is('book-online') ? 'active' : ''}}"> <a href="{{route('booking.index')}}">Book now</a> </li>
                                                            <li class="{{request()->is('exchange') ? 'active' : ''}}"> <a href="{{route('exchange.show')}}">Exchange My Car</a> </li>
                                                            <li class=""><a href="{{route('finance.index')}}">Finance </a></li>
                                                            <li class=""><a href="{{route('subscribe.show')}}">Subscription</a> </li>
                                                        </ul>
                                                    </li>
                                                    <li class=""><a href="{{route('services.show')}}">Service</a>
                                                        <ul class="nav-dropdown">
                                                            <li class=""><a href="{{route('our-services.show')}}">Services</a> </li>
                                                            <li class=""><a href="{{route('services.show')}}">Book your Service</a></li>
                                                            <li class=""><a href="{{route('our-services.show')}}">Services Offered</a>
                                                                <ul class="nav-dropdown">
                                                                    <li class=""><a href="{{route('addPage.view', 'periodic-maintenance-service')}}">Periodic Maintenance</a></li>                                                                    
                                                                </ul>
                                                            </li>
                                                            <li class=""><a href="{{route('coming-soon.show')}}">TIPS / FAQ</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class=""><a href="#">Insurance</a>
                                                        <ul class="nav-dropdown">
                                                            <li class=""><a href="{{route('insure-my-car.show')}}">Insure my car</a></li>
                                                           
                                                            <li class=""><a href="{{route('faqs.show')}}">FAQs</a></li>
                                                        </ul>
                                                    </li>
                                                    {{-- <li class=""><a href="#">Offers</a>
                                                        <ul class="nav-dropdown">
                                                            <li class="{{request()->is('offers/kerala-offers') ? 'active' : ''}}"> <a href="{{route('offers.show', 'kerala-offers')}}">Kerala Offers</a> </li>
                                                            <li class="{{request()->is('offers/chennai-offers') ? 'active' : ''}}"> <a href="{{route('offers.show', 'chennai-offers')}}">Chennai Offers</a> </li>
                                                        </ul>
                                                    </li> --}}
                                                   
                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </header>
                        </div>
                    </div>
                    <div class="px-0 col-lg-3"> </div>
                </div>
            </div>
        </header> @yield('content')
        <footer id="footer" class="pt-0 footer pos-rel">
            <div class="container-fluid" id="quicklinkstab">
                <div class="row">
                    <ul class="d-inline-block w-100">
                        <li class="d-inline-block"><a href="{{route('buy-new-car.show')}}" class="py-4 w-100 d-block">BUY A NEW CAR</a></li>
                        <li class="d-inline-block"><a href="{{route('exchange.show')}}" class="py-4 w-100 d-block">EXCHANGE MY CAR</a></li>
                        <li class="d-inline-block"><a href="{{route('insure-my-car.show')}}" class="py-4 w-100 d-block">INSURE MY CAR</a></li>
                        <li class="d-inline-block"><a href="{{route('services.show')}}" class="py-4 w-100 d-block">SERVICE MY CAR</a></li>
                    </ul>
                </div>
            </div>
            <div class="container pt-4 pb-4" id="brandlogos" style="border-bottom: 1px solid #e2e2e2;">
                <div class="row">
                    <ul class="d-inline-block">
                        <li class="d-inline-block">
                            <a target="_blank" href="#"><img src="{{asset('assets/images/logo/thumb-nexa.webp')}}" alt="marutisuzuki nexa"></a>
                        </li>
                        <li class="d-inline-block">
                            <a target="_blank" href="#"><img src="{{asset('assets/images/logo/msarenalogo.webp')}}" alt="marutisuzuki arena"></a>
                        </li>
                        <li class="d-inline-block">
                            <a target="_blank" href="#"><img src="{{asset('assets/images/logo/thumb-ms-commercial.webp')}}" alt="marutisuzuki commercial"></a>
                        </li>
                        <li class="d-inline-block">
                            <a target="_blank" href="#"><img src="{{asset('assets/images/logo/thumb-ms-ds.webp')}}" alt="marutisuzuki driving school"></a>
                        </li>
                        <li class="d-inline-block">
                            <a target="_blank" href="#"><img src="{{asset('assets/images/logo/thumb-truevalue.webp')}}" alt="marutisuzuki true value"></a>
                        </li>
                        <li class="d-inline-block">
                            <a target="_blank" href="#"><img src="{{asset('assets/images/logo/thumb-mga.webp')}}" alt="marutisuzuki mga"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container mt-5" id="footer-widgets-container">
                <div class="row">
                    <div class="mb-2 col-lg-2 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <div class="footer__widget quicklinks firstchildd">
                                <ul class="float-left w-100">
                                    <li class="float-left w-100">
                                        <a target="_blank" href="#"><img alt="Abreco" src="{{asset('assets/images/logo/kuttukkaran-logo.webp')}}"></a> 
                                    </li>
                                </ul>
                                <h3 class="primaryColor w-100">DOWNLOAD THE APP NOW</h3>
                                <ul class="float-left mobapplinks">
                                    <li class="float-left"><a target="_blank" href="#"><img alt="appstore" src="{{asset('assets/images/logo/appstore.webp')}}"></a></li>
                                    <li class="float-left"><a target="_blank" href="#"><img alt="playstore" src="{{asset('assets/images/logo/playstore.webp')}}"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6 col-sm-6 d-sm-none d-md-block"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <div class="footer__widget quicklinks">
                                <h4 class="my-3 primaryColor text-uppercase togglehead">Quick Links</h4>
                                <ul class="float-left w-50 togglelist">
                                    <li class="float-left w-100"><a href="{{route('home')}}">Home</a></li>
                                    <li class="float-left w-100"><a href="{{route('about')}}">About Us</a></li>
                                    <li class="float-left w-100"><a href="{{route('buy-new-car.show')}}">Book Now</a></li>
                                    <li class="float-left w-100"><a href="{{route('home')}}">own a car</a></li>
                                    <li class="float-left w-100"><a href="{{route('cng-models.show')}}">CNG Models</a></li>
                                    <li class="float-left w-100"><a href="{{route('enquiry')}}">Enquiry</a></li>
                                    <li class="float-left w-100"><a href="{{route('contact')}}">contact us</a> </li>
                                </ul>
                                <ul class="float-left w-50 togglelist">
                                    <li class="float-left w-100"><a href="{{route('career')}}">Careers</a></li>
                                    <li class="float-left w-100"><a href="{{route('testimonials.show')}}">testimonials</a></li>
                                    <li class="float-left w-100"><a href="{{route('location_map.show')}}">Location Map</a></li>
                                    <li class="float-left w-100"><a href="{{route('brochures.show')}}">brochure</a></li>
                                    <li class="float-left w-100"><a href="{{route('terms.show')}}">terms & conditions</a></li>
                                    <li class="float-left w-100"><a href="{{route('refund-policy.show')}}">refund policy</a></li>
                                    <li class="float-left w-100"><a href="{{route('privacy.show')}}">privacy policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer__widget">
                            <div class="footer__widget quicklinks">
                                <h4 class="my-3 primaryColor text-uppercase togglehead">Dealerships</h4>
                                <ul class="float-left w-100 togglelist">
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-trivandrum')}}">TRIVANDRUM</a> </li>
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-kottayam')}}">KOTTAYAM</a> </li>
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-ernakulam')}}">ERNAKULAM</a> </li>
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-thrissur')}}">THRISSUR</a> </li>
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-calicut')}}">CALICUT</a></li>
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-kannur')}}">KANNUR</a></li>
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-chennai-anna-nagar')}}">ANNANAGAR</a> </li>
                                    <li class="float-left w-100"><a href="{{route('dealership.show', 'arena-chennai-pallikaranai')}}">PALLIKARANAI</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-left footer__copyright w-100">
                <div class="mb-0 footer__widget">
                    <div class="mb-0 footer__widget sociallinks">
                        <ul class="w-100">
                            <li class=""><a target="_blank" href="#"><i class="fa fa-facebook"></i> facebook</a></li>
                            <li class=""><a target="_blank" href="#"><i class="fa fa-twitter"></i> twitter</a></li>
                            <li class=""><a target="_blank" href="#"><i class="fa fa-youtube"></i> youtube</a></li>
                            <li class=""><a target="_blank" href="#"><i class="fa fa-linkedin"></i> linkedin</a></li>
                            <li class=""><a target="_blank" href="#"><i class="fa fa-pinterest"></i> pinterest</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="float-left container-fluid" id="quicklinkstab">
                <div class="row">
                    <ul class="d-inline-block w-100 copyrighttext">
                        <li class="px-1 d-inline-block w-50">
                            <p class="py-4 mb-0 text-white"><span>&copy;{{date('Y')}} - {{config('app.name')}} | All rights reserved</span></p>
                        </li>
                        <li class="px-1 d-inline-block w-50">
                            <p class="py-4 mb-0 text-white"><span>Crafted with <i class="fa fa-heart fa-beat red" aria-hidden="true"></i>&nbsp;&nbsp;by top <a class="text-hov-cl" href="https://netventure.in" target="_blank">web development company </a> NetVenture</span></p>
                        </li>
                    </ul>
                </div>
            </div><a href="#" class="scrollup"></a> </footer> @if (@$settings->popup==1)
        <div id="exitPopup" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> </div>
                    <div class="pt-0 text-center modal-body footer__widget">
                        <h5>QUICK ENQUIRY</h5>
                        <form action="{{route('exit-popup')}}" class="call__form js-validation-popup" method="post"> @csrf
                            <div class="pb-1 form-group col-lg-12"> <input type="text" autocomplete="off" class="form-control bg-F4F4F4 @error('name') is-invalid @enderror" placeholder="Name" name="name" value="" required pattern="^[a-zA-Z\s]+$" minlength="3"> @error('name')
                                <div class="invalid-feedback">{{$message}}</div>@enderror </div>
                            <div class="pb-1 form-group col-lg-12"> <input type="email" autocomplete="off" class="form-control bg-F4F4F4 @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="" required pattern="^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$"> @error('email')
                                <div class="invalid-feedback">{{$message}}</div>@enderror </div>
                            <div class="pb-1 form-group col-lg-12"> <input type="text" autocomplete="off" class="form-control bg-F4F4F4 @error('phone') is-invalid @enderror" placeholder="Phone Number" name="phone" value="" required pattern="^\+(?:[0-9]●?){6,14}[0-9]$"> @error('phone')
                                <div
                                    class="invalid-feedback">{{$message}}</div>@enderror </div>
                    <div class="pb-1 form-group col-lg-12"> <input type="text" autocomplete="off" class="form-control bg-F4F4F4 @error('location') is-invalid @enderror" placeholder="Location" name="location" value="" required pattern="^[a-zA-Z\s]+$" minlength="3"> @error('location')
                        <div class="invalid-feedback">{{$message}}</div>@enderror </div>
                    <div class="form-group col-lg-12">{!! NoCaptcha::renderJs() !!}{!! NoCaptcha::display() !!}@if ($errors->has('g-recaptcha-response')) <span class="help-block"> <label style="color:red">{{$errors->first('g-recaptcha-response')}}</label> </span> @endif </div>
                    <div class="text-center"><button type="submit" class="site-btn">SUBMIT</button></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer"> </div>
    </div>@endif </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/ninja-slider.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="{{asset('assets/inttel/intlTelInput.min.js')}}"></script>
    <script src="{{asset('assets/inttel/utils.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        
        /* FONT AWESOME GENERIC BEAT */ 
        .fa-beat {
          animation:fa-beat 2.5s ease infinite;
        }
        @keyframes fa-beat {
          0% {
            transform:scale(1);
          }
          5% {
            transform:scale(1.25);
          }
          20% {
            transform:scale(1);
          }
          30% {
            transform:scale(1);
          }
          35% {
            transform:scale(1.25);
          }
          50% {
            transform:scale(1);
          }
          55% {
            transform:scale(1.25);
          }
          70% {
            transform:scale(1);
          }
        }
        
        
            </style>
    <script>
        $(function() {
            $('img').Lazy();
        });
    </script>
    <script>
        $("#buynewcarloc").select2();
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
                n(t).find(".nav-search").length > 0 && n(t).find(".nav-search").find("form").prepend("<span class='nav-search-close-button' tabindex='0'>&#10005;</span>"), (r.init = function() {
                    (r.settings = n.extend({}, o, s)), r.settings.offCanvasCloseButton && n(t).find(".nav-menus-wrapper").prepend("<span class='nav-menus-wrapper-close-button'>&#10005;</span>"), "right" == r.settings.offCanvasSide && n(t).find(".nav-menus-wrapper").addClass("nav-menus-wrapper-right"), r.settings.hidden && (n(t).addClass("navigation-hidden"), (r.settings.mobileBreakpoint = 99999)), v(), r.settings.fixed && n(t).addClass("navigation-fixed"), n(t).find(".nav-toggle").on("click touchstart", function(n) {
                        n.stopPropagation(), n.preventDefault(), r.showOffcanvas(), s !== a && r.callback("onShowOffCanvas");
                    }), n(t).find(".nav-menus-wrapper-close-button").on("click touchstart", function() {
                        r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas");
                    }), n(t).find(".nav-search-button, .nav-search-close-button").on("click touchstart keydown", function(i) {
                        i.stopPropagation(), i.preventDefault();
                        var e = i.keyCode || i.which;
                        "click" === i.type || "touchstart" === i.type || ("keydown" === i.type && 13 == e) ? r.toggleSearch() : 9 == e && n(i.target).blur();
                    }), n(t).find(".megamenu-tabs").length > 0 && y(), n(i).resize(function() {
                        r.initNavigationMode(C()), O(), r.settings.hiddenOnMobile && m();
                    }), r.initNavigationMode(C()), r.settings.hiddenOnMobile && m(), s !== a && r.callback("onInit");
                });
                var h = function() {
                        n(t).find(".nav-submenu").hide(0), n(t).find("li").removeClass("focus");
                    },
                    v = function() {
                        n(t).find("li").each(function() {
                            n(this).children(".nav-dropdown,.megamenu-panel").length > 0 && (n(this).children(".nav-dropdown,.megamenu-panel").addClass("nav-submenu"), r.settings.submenuIndicator && n(this).children("a").append("<span class='submenu-indicator'><span class='submenu-indicator-chevron'></span></span>"));
                        });
                    },
                    m = function() {
                        n(t).hasClass("navigation-portrait") ? n(t).addClass("navigation-hidden") : n(t).removeClass("navigation-hidden");
                    };
                (r.showSubmenu = function(i, e) {
                    C() > r.settings.mobileBreakpoint && n(t).find(".nav-search").find("form").fadeOut(), "fade" == e ? n(i).children(".nav-submenu").stop(!0, !0).delay(r.settings.showDelayDuration).fadeIn(r.settings.showDuration).removeClass(r.settings.animationOnHide).addClass(r.settings.animationOnShow) : n(i).children(".nav-submenu").stop(!0, !0).delay(r.settings.showDelayDuration).slideDown(r.settings.showDuration).removeClass(r.settings.animationOnHide).addClass(r.settings.animationOnShow), n(i).addClass("focus");
                }), (r.hideSubmenu = function(i, e) {
                    "fade" == e ? n(i).find(".nav-submenu").stop(!0, !0).delay(r.settings.hideDelayDuration).fadeOut(r.settings.hideDuration).removeClass(r.settings.animationOnShow).addClass(r.settings.animationOnHide) : n(i).find(".nav-submenu").stop(!0, !0).delay(r.settings.hideDelayDuration).slideUp(r.settings.hideDuration).removeClass(r.settings.animationOnShow).addClass(r.settings.animationOnHide), n(i).removeClass("focus").find(".focus").removeClass("focus");
                });
                var p = function() {
                        n("body").addClass("no-scroll"), r.settings.overlay && (n(t).append("<div class='nav-overlay-panel'></div>"), n(t).find(".nav-overlay-panel").css("background-color", r.settings.overlayColor).fadeIn(300).on("click touchstart", function(n) {
                            r.hideOffcanvas();
                        }));
                    },
                    g = function() {
                        n("body").removeClass("no-scroll"), r.settings.overlay && n(t).find(".nav-overlay-panel").fadeOut(400, function() {
                            n(this).remove();
                        });
                    };
                (r.showOffcanvas = function() {
                    p(), "left" == r.settings.offCanvasSide ? n(t).find(".nav-menus-wrapper").css("transition-property", "left").addClass("nav-menus-wrapper-open") : n(t).find(".nav-menus-wrapper").css("transition-property", "right").addClass("nav-menus-wrapper-open");
                }), (r.hideOffcanvas = function() {
                    n(t).find(".nav-menus-wrapper").removeClass("nav-menus-wrapper-open").on("webkitTransitionEnd moztransitionend transitionend oTransitionEnd", function() {
                        n(t).find(".nav-menus-wrapper").css("transition-property", "none").off();
                    }), g();
                }), (r.toggleOffcanvas = function() {
                    C() <= r.settings.mobileBreakpoint && (n(t).find(".nav-menus-wrapper").hasClass("nav-menus-wrapper-open") ? (r.hideOffcanvas(), s !== a && r.callback("onHideOffCanvas")) : (r.showOffcanvas(), s !== a && r.callback("onShowOffCanvas")));
                }), (r.toggleSearch = function() {
                    "none" == n(t).find(".nav-search").find("form").css("display") ? (n(t).find(".nav-search").find("form").fadeIn(200), n(t).find(".nav-search").find("input").focus()) : (n(t).find(".nav-search").find("form").fadeOut(200), n(t).find(".nav-search").find("input").blur());
                }), (r.initNavigationMode = function(i) {
                    r.settings.responsive ? (i <= r.settings.mobileBreakpoint && u > r.settings.mobileBreakpoint && (n(t).addClass("navigation-portrait").removeClass("navigation-landscape"), S(), s !== a && r.callback("onPortrait")), i > r.settings.mobileBreakpoint && d <= r.settings.mobileBreakpoint && (n(t).addClass("navigation-landscape").removeClass("navigation-portrait"), k(), g(), r.hideOffcanvas(), s !== a && r.callback("onLandscape")), (u = i), (d = i)) : (n(t).addClass("navigation-landscape"), k(), s !== a && r.callback("onLandscape"));
                });
                var b = function() {
                        n("html").on("click.body touchstart.body", function(i) {
                            0 === n(i.target).closest(".navigation").length && (n(t).find(".nav-submenu").fadeOut(), n(t).find(".focus").removeClass("focus"), n(t).find(".nav-search").find("form").fadeOut());
                        });
                    },
                    C = function() {
                        return (i.innerWidth || e.documentElement.clientWidth || e.body.clientWidth);
                    },
                    w = function() {
                        n(t).find(".nav-menu").find("li, a").off(l).off(f).off(c);
                    },
                    O = function() {
                        if (C() > r.settings.mobileBreakpoint) {
                            var i = n(t).outerWidth(!0);
                            n(t).find(".nav-menu").children("li").children(".nav-submenu").each(function() {
                                n(this).parent().position().left + n(this).outerWidth() > i ? n(this).css("right", 0) : n(this).css("right", "auto");
                            });
                        }
                    },
                    y = function() {
                        function i(i) {
                            var e = n(i).children(".megamenu-tabs-nav").children("li"),
                                a = n(i).children(".megamenu-tabs-pane");
                            n(e).on("click.tabs touchstart.tabs", function(i) {
                                i.stopPropagation(), i.preventDefault(), n(e).removeClass("active"), n(this).addClass("active"), n(a).hide(0).removeClass("active"), n(a[n(this).index()]).show(0).addClass("active");
                            });
                        }
                        if (n(t).find(".megamenu-tabs").length > 0)
                            for (var e = n(t).find(".megamenu-tabs"), a = 0; a < e.length; a++) i(e[a]);
                    },
                    k = function() {
                        w(), h(), navigator.userAgent.match(/Mobi/i) || navigator.maxTouchPoints > 0 || "click" == r.settings.submenuTrigger ? n(t).find(".nav-menu, .nav-dropdown").children("li").children("a").on(l, function(e) {
                            if ((r.hideSubmenu(n(this).parent("li").siblings("li"), r.settings.effect), n(this).closest(".nav-menu").siblings(".nav-menu").find(".nav-submenu").fadeOut(r.settings.hideDuration), n(this).siblings(".nav-submenu").length > 0)) {
                                if ((e.stopPropagation(), e.preventDefault(), "none" == n(this).siblings(".nav-submenu").css("display"))) return (r.showSubmenu(n(this).parent("li"), r.settings.effect), O(), !1);
                                if ((r.hideSubmenu(n(this).parent("li"), r.settings.effect), "_blank" === n(this).attr("target") || "blank" === n(this).attr("target"))) i.open(n(this).attr("href"));
                                else {
                                    if ("#" === n(this).attr("href") || "" === n(this).attr("href") || "javascript:void(0)" === n(this).attr("href")) return !1;
                                    i.location.href = n(this).attr("href");
                                }
                            }
                        }) : n(t).find(".nav-menu").find("li").on(f, function() {
                            r.showSubmenu(this, r.settings.effect), O();
                        }).on(c, function() {
                            r.hideSubmenu(this, r.settings.effect);
                        }), r.settings.hideSubWhenGoOut && b();
                    },
                    S = function() {
                        w(), h(), r.settings.visibleSubmenusOnMobile ? n(t).find(".nav-submenu").show(0) : (n(t).find(".submenu-indicator").removeClass("submenu-indicator-up"), r.settings.submenuIndicator && r.settings.submenuIndicatorTrigger ? n(t).find(".submenu-indicator").on(l, function(i) {
                            return (i.stopPropagation(), i.preventDefault(), r.hideSubmenu(n(this).parent("a").parent("li").siblings("li"), "slide"), r.hideSubmenu(n(this).closest(".nav-menu").siblings(".nav-menu").children("li"), "slide"), "none" == n(this).parent("a").siblings(".nav-submenu").css("display") ? (n(this).addClass("submenu-indicator-up"), n(this).parent("a").parent("li").siblings("li").find(".submenu-indicator").removeClass("submenu-indicator-up"), n(this).closest(".nav-menu").siblings(".nav-menu").find(".submenu-indicator").removeClass("submenu-indicator-up"), r.showSubmenu(n(this).parent("a").parent("li"), "slide"), !1) : (n(this).parent("a").parent("li").find(".submenu-indicator").removeClass("submenu-indicator-up"), void r.hideSubmenu(n(this).parent("a").parent("li"), "slide")));
                        }) : n(t).find(".nav-menu, .nav-dropdown").children("li").children("a").on(l, function(e) {
                            if ((e.stopPropagation(), e.preventDefault(), r.hideSubmenu(n(this).parent("li").siblings("li"), r.settings.effect), r.hideSubmenu(n(this).closest(".nav-menu").siblings(".nav-menu").children("li"), "slide"), "none" == n(this).siblings(".nav-submenu").css("display"))) return (n(this).children(".submenu-indicator").addClass("submenu-indicator-up"), n(this).parent("li").siblings("li").find(".submenu-indicator").removeClass("submenu-indicator-up"), n(this).closest(".nav-menu").siblings(".nav-menu").find(".submenu-indicator").removeClass("submenu-indicator-up"), r.showSubmenu(n(this).parent("li"), "slide"), !1);
                            if ((n(this).parent("li").find(".submenu-indicator").removeClass("submenu-indicator-up"), r.hideSubmenu(n(this).parent("li"), "slide"), "_blank" === n(this).attr("target") || "blank" === n(this).attr("target"))) i.open(n(this).attr("href"));
                            else {
                                if ("#" === n(this).attr("href") || "" === n(this).attr("href") || "javascript:void(0)" === n(this).attr("href")) return !1;
                                i.location.href = n(this).attr("href");
                            }
                        }));
                    };
                (r.callback = function(n) {
                    s[n] !== a && s[n].call(t);
                }), r.init();
            }), (n.fn.navigation = function(i) {
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
                url: "{{route('getlocation')}}",
                data: {
                    "_token": "{{csrf_token()}}",
                    mode: mode
                },
                success: function(data) {
                    if (data.status) {
                        jQuery.each(data.locations, function(index, item) {
                            $options = $options.add($('<option>').attr('value', item.id).html(item.name));
                        });
                        $(".location").html($options);
                    }
                }
            });
        }
    </script>
    <script>
        var header = $('header.header');
        var shrinkIt = header.height();
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= shrinkIt) {
                header.addClass('shrunk');
            } else {
                header.removeClass('shrunk');
            }
        });
        $(".tabbed-forms li").click(function() {
            var elmnt = document.getElementById("elementtoScrollToID");
            elmnt.scrollIntoView();
        });
    </script> @yield('js_after')
    <x:notify-messages/> @notifyJs</body>