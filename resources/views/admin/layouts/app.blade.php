<!doctype html>
<html lang="en" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('favicons/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('storage/' . @$settings->favicon) }}"
        type="image/x-icon" />
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="author" content="Saran Sivaprasad">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">


    <!-- Stylesheets -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


    <link rel="stylesheet" id="css-main" href="{{ mix('css/theme.css') }}">

    <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('css/themes/flat.css') }}"> -->
    <style>
        /* FONT AWESOME GENERIC BEAT */
        .fa-beat {
            animation: fa-beat 1.5s ease infinite;
        }

        <blade keyframes|%20fa-beat%20%7B%0D>0% {
            transform: scale(1);
        }

        5% {
            transform: scale(1.25);
        }

        20% {
            transform: scale(1);
        }

        30% {
            transform: scale(1);
        }

        35% {
            transform: scale(1.25);
        }

        50% {
            transform: scale(1);
        }

        55% {
            transform: scale(1.25);
        }

        70% {
            transform: scale(1);
        }
        }

    </style>
    @yield('css_after')
    <!-- END Stylesheets -->
</head>

<body>

    <!-- Page Container -->

    <div id="page-container"
        class="sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed main-content-narrow">
        <!-- Sidebar -->

        <nav id="sidebar">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->

                <!-- END Side Header -->

                <!-- Side User -->

                <!-- END Side User -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full" style="background: rgb(11,37,99);
                background: radial-gradient(circle, rgba(11,37,99,1) 0%, rgba(43,78,120,1) 100%);">
                    <div class="sidebar-mini-visible-b align-v animated fadeIn">
                        <img class="img-avatar img-avatar32"
                            src="{{ asset('assets/images/logo/logo.png') }}" alt="Everest">
                    </div>
                    <!-- END Visible only in mini mode -->

                    <!-- Visible only in normal mode -->
                    <div class="text-center sidebar-mini-hidden-b">
                        <a class="img-link" href="{{ route('admin.profile') }}">
                            <img class="img-avatar"
                                src="{{ asset('assets/images/logo/logo.png') }}" alt="Everest">
                        </a>
                        <ul class="mt-10 list-inline">
                            <li class="list-inline-item">
                                <a class="link-effect font-w700" href="{{ route('admin.home') }}">
                                    <span class="font-size-xl text-dual-primary-dark"
                                        style="font-size: 15px !important;">{{ config('app.name') }}</span>
                                </a>
                            </li>

                        </ul>


                    </div>

                    <ul class="nav-main">
                        {{-- new user --}}

                        {{-- new user end --}}
                        <li>
                            <a class="{{ request()->is('admin/home') ? 'active' : '' }}"
                                href="{{ route('admin.home') }}"><i
                                    class="fas fa-tachometer-alt"></i><span
                                    class="sidebar-mini-hide">Dashboard</span></a>
                        </li>
                        {{-- <li class="{{ (request()->is('admin/roles*')) ? 'open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-user-tag"></i><span
                                class="sidebar-mini-hide">Roles</span></a>
                        <ul>
                            <li>
                                <a class="{{ (request()->is('admin/roles/create')) ? 'active' : '' }}"
                                    href="{{ route('admin.roles.create') }}">Add</a>
                            </li>
                            <li>
                                <a class="{{ (request()->is('admin/roles')) ? 'active' : '' }}"
                                    href="{{ route('admin.roles.index') }}">View</a>
                            </li>
                        </ul>
                        </li>
                        <li>
                            <a class="{{ (request()->is('admin/permissions*')) ? 'active' : '' }}"
                                href="{{ route('admin.permissions.index') }}"><i
                                    class="fas fa-lock"></i><span class="sidebar-mini-hide">Permissions</span></a>
                        </li> --}}
                        <!-- <li
                            class="{{ request()->is('admin/sections*') ? 'open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-window-restore"
                                    aria-hidden="true"></i>
                                <span class="sidebar-mini-hide">Sections</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/sections/create') ? 'active' : '' }}"
                                        href="{{ route('admin.sections.create') }}">Add</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/sections') ? 'active' : '' }}"
                                        href="{{ route('admin.sections.index') }}">View</a>
                                </li>
                            </ul>
                        </li> -->
                        <li
                            class="{{ request()->is('admin/vehicles*') ? 'open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-car"></i><span
                                    class="sidebar-mini-hide">Vehicles</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/vehicles/create') ? 'active' : '' }}"
                                        href="{{ route('admin.vehicles.create') }}">Add New</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/vehicles') ? 'active' : '' }}"
                                        href="{{ route('admin.vehicles.index') }}">View List</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li
                            class="{{ request()->is('admin/locations*') ? 'open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i
                                    class="fas fa-location-arrow"></i><span
                                    class="sidebar-mini-hide">Locations</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/locations/create') ? 'active' : '' }}"
                                        href="{{ route('admin.locations.create') }}">Add</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/locations') ? 'active' : '' }}"
                                        href="{{ route('admin.locations.index') }}">View</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i
                                    class="fas fa-location-arrow"></i><span
                                    class="sidebar-mini-hide">Counters</span></a>
                            <ul>
                                <li>
                                    <a class=""
                                        href="{{ route('admin.counter-settings.index') }}">Settings</a>
                                </li>
                                <li>
                                    <a class=""
                                        href="{{ route('admin.counter-settings-list.index') }}">List</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li class="{{ request()->is('admin/area*') ? 'open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i
                                    class="fas fa-location-arrow"></i><span class="sidebar-mini-hide">Areas</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/area/create') ? 'active' : '' }}"
                                        href="{{ route('admin.area.create') }}">Add</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/area') ? 'active' : '' }}"
                                        href="{{ route('admin.area.index') }}">View</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li
                            class="{{ request()->is('admin/careers*') ? 'open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i
                                    class="fas fa-briefcase"></i><span class="sidebar-mini-hide">Careers</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/careers/create') ? 'active' : '' }}"
                                        href="{{ route('admin.careers.create') }}">Add</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/careers') ? 'active' : '' }}"
                                        href="{{ route('admin.careers.index') }}">View</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li class="{{ request()->is('admin/careers*') ? 'open' : '' }}"> -->
                        <!-- <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i
                                    class="fas fa-briefcase"></i><span class="sidebar-mini-hide">Finance</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/careers/create') ? 'active' : '' }}"
                                        href="{{ route('finance.create') }}">Add</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/careers') ? 'active' : '' }}"
                                        href="{{ route('finance.index') }}">View</a>
                                </li>
                            </ul>
                        </li> -->

                        <l/li>
                        <li
                            class="{{ request()->is('admin/home-slider*') ? 'open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-home"></i><span
                                    class="sidebar-mini-hide">Home Page
                                    Slider</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/home-slider/create') ? 'active' : '' }}"
                                        href="{{ route('admin.home-slider.create') }}">Add</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/home-slider') ? 'active' : '' }}"
                                        href="{{ route('admin.home-slider.index') }}">View</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="{{ request()->is('admin/vehicle-slider*') ? 'open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i
                                    class="fas fa-home"></i><span class="sidebar-mini-hide">Home Vehicle
                                    Slider</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/vehicle-slider/create') ? 'active' : '' }}"
                                        href="{{ route('admin.vehicle-slider.create') }}">Add</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/vehicle-slider') ? 'active' : '' }}"
                                        href="{{ route('admin.vehicle-slider.index') }}">View</a>
                                </li>
                            </ul>
                        </li> -->
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-home"></i><span
                                    class="sidebar-mini-hide">About Us</span></a>
                            <ul>
                                <li>
                                    <a href="{{ route('admin.about-group.index') }}">Details</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.about-page.index') }}">Mission And
                                        Vision</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.faq.index') }}">FAQs</a>
                                </li>
                                <!-- <li>
                                    <a href="{{ route('admin.about-motors.index') }}">Abreco
                                        Motors</a>
                                </li> -->
                                <!-- <li>
                                    <a
                                        href="{{ route('admin.about-group-leaders.index') }}">Leadership</a>
                                </li> -->
                                <!-- <li>
                                    <a href="{{ route('admin.about-location.index') }}">About
                                        Location</a>
                                </li> -->
                            </ul>
                        </li>
                    <li>
                        <a class="{{ request()->is('admin/blogs*') ? 'active' : '' }}"
                            href="{{ route('admin.blogs.index') }}"><i class="fa fa-gift"></i><span
                                class="sidebar-mini-hide">Blogs</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/testimonials*') ? 'active' : '' }}"
                            href="{{ route('admin.testimonials.index') }}"><i
                                class="fa fa-quote-left"></i><span class="sidebar-mini-hide">Google Reviews</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/news-events-list*') ? 'active' : '' }}"
                            href="{{ route('admin.news-events-list.index') }}"><i
                                class="fa fa-quote-left"></i><span class="sidebar-mini-hide">GO RV Reviews</span></a>
                    </li>
                        <!-- <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-home"></i><span
                                    class="sidebar-mini-hide">GO RV Reviews</span></a>
                            <ul>
                                <li>
                                    <a href="{{ route('admin.news-events.index') }}">Add New</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.news-events-list.index') }}">View List</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-home"></i><span
                                    class="sidebar-mini-hide">Policies</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('admin/privacy*') ? 'active' : '' }}"
                                        href="{{ route('admin.privacy.index') }}">Privacy Policy</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/terms*') ? 'active' : '' }}"
                                        href="{{ route('admin.terms.index') }}">Terms of Use</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/cookies*') ? 'active' : '' }}"
                                        href="{{ route('admin.cookies.index') }}">Cookie Policy</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/refund-policy-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.refund-policy-page.index') }}">Refund
                                        Policy</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li>
                            <a class="{{ request()->is('admin/insurance-page/faqs') ? 'active' : '' }}"
                                href="{{ route('admin.insurance-page.index', 'faqs') }}"><i
                                    class="fas fa-lock"></i>FAQs</a>
                        </li> -->
                        
                        <!-- <li>
                            <a class="{{ request()->is('admin/enquiry-page*') ? 'active' : '' }}"
                                href="{{ route('admin.faq.index') }}"><i
                            class="fas fa-lock"></i>FAQs</a>
                        </li> -->
                        <!-- <li>
                            <a class="nav-submenu {{ request()->is('admin/contact-page') ? 'active' : '' }}
                                {{ request()->is('admin/home-settings') ? 'active' : '' }}
                                {{-- {{ request()->is('admin/about-page') ? 'active' : '' }} --}}
                                {{ request()->is('admin/book-online') ? 'active' : '' }}
                                {{ request()->is('admin/buy-new-car') ? 'active' : '' }}
                                {{ request()->is('admin/career-page') ? 'active' : '' }}
                                {{-- {{ request()->is('admin/cng-model-page') ? 'active' : '' }} --}}
                                {{ request()->is('admin/enquiry-page') ? 'active' : '' }}
                                {{-- {{ request()->is('admin/insure-my-car-page') ? 'active' : '' }} --}}
                                {{ request()->is('admin/exchange-page') ? 'active' : '' }}
                                {{-- {{ request()->is('admin/buy-used-car-page') ? 'active' : '' }} --}}
                                {{ request()->is('admin/terms') ? 'active' : '' }}
                                {{ request()->is('admin/privacy') ? 'active' : '' }}
                                {{ request()->is('admin/brochures') ? 'active' : '' }}
                                {{ request()->is('admin/book-a-service*') ? 'active' : '' }}
                                {{ request()->is('admin/contact-page*') ? 'active' : '' }}
                                {{ request()->is('admin/offers*') ? 'active' : '' }}
                                {{ request()->is('admin/service_product_content*') ? 'active' : '' }}
                                {{ request()->is('admin/test-drive') ? 'active' : '' }}"
                                data-toggle="nav-submenu" href="#"><i class="fas fa-wrench"></i><span
                                    class="sidebar-mini-hide">Pages
                                </span></a> -->
                            <!-- <ul> -->
                                <!-- <li>
                                    <a class="{{ request()->is('admin/about-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.about-page.index') }}"> Page</a>
                                </li> -->

                                <!-- <li>
                                    <a class="{{ request()->is('admin/brochures') ? 'active' : '' }}"
                                        href="{{ route('admin.brochures.index') }}">Brochure Page</a>
                                </li> -->

                                <!-- <li>
                                    <a class="{{ request()->is('admin/book-a-service*') ? 'active' : '' }}"
                                        href="{{ route('admin.book-a-service.index') }}">Book Service Online Page</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('admin/book-online*') ? 'active' : '' }}"
                                        href="{{ route('admin.book-online.index') }}">Book Online</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('admin/buy-new-car*') ? 'active' : '' }}"
                                        href="{{ route('admin.buy-new-car.index') }}">Buy New Car</a>
                                </li> -->

                                <!-- <li>
                                    <a class="{{ request()->is('admin/career-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.career-page.index') }}">Career Page</a>
                                </li> -->

                                <!-- <li>
                                    <a class="{{ request()->is('admin/cng-model-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.cng-model-page.index') }}">CNG Model Page</a>
                                </li>  -->

                                <!-- <li>
                                    <a class="{{ request()->is('admin/enquiry-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.enquiry-page.index') }}">Enquiry Page</a>
                                </li> -->
                                <!-- <li>
                                    <a class="{{ request()->is('admin/enquiry-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.faq.index') }}">Faq</a>
                                </li> -->


                                <!-- <li>
                                    <a class="{{ request()->is('admin/insure-my-car-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.insure-my-car-page.index') }}">Insure My Car Page</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('admin/exchange-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.exchange-page.index') }}">Exchange Page</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('admin/buy-used-car-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.buy-used-car-page.index') }}">Buy Used Car Page</a>
                                </li> -->

                                <!-- <li>
                                    <a class="{{ request()->is('admin/contact-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.contact-page.index') }}">Contact Page</a>
                                </li> -->

                                <!-- <li>
                                    <a class="{{ request()->is('admin/home-settings*') ? 'active' : '' }}"
                                        href="{{ route('admin.settings.home') }}">Home Settings</a>
                                </li>


                                 <li>
                                    <a class="{{ request()->is('admin/contact-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.location_content.index') }}">Location Content</a>
                                </li> 

                                <li>
                                    <a class="{{ request()->is('admin/offers*') ? 'active' : '' }}"
                                        href="{{ route('admin.offers.index') }}">Offer Page</a>
                                </li>



                                <li>
                                    <a class="{{ request()->is('admin/service_product_content*') ? 'active' : '' }}"
                                        href="{{ route('admin.service_product_content.index') }}">Service Product
                                        Page</a>
                                </li> -->


                                <!-- <li>
                                    <a class="{{ request()->is('admin/test-drive*') ? 'active' : '' }}"
                                        href="{{ route('admin.test-drive.index') }}">Test Drive</a>
                                </li> 
                                <li>
                                    <a class="{{ request()->is('admin/board-committees*') ? 'active' : '' }}"
                                        href="{{ route('admin.board-committees.index') }}">Board Committee</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/vigil-mechanism*') ? 'active' : '' }}"
                                        href="{{ route('admin.vigil-mechanism.index') }}">Vigil Mechanism</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/general-meeting-notice*') ? 'active' : '' }}"
                                        href="{{ route('admin.general-meeting-notice.index') }}">General Meeting
                                        Notice</a>
                                </li>  -->
                                <!-- <li>
                                    <a class="{{ request()->is('admin/testimonial-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.testimonial-page.index') }}">Testimonial</a>
                                </li> -->
                                {{-- <li>
                                    <a class="{{ request()->is('admin/network*') ? 'active' : '' }}"
                                href="{{ route('admin.network.index') }}">Network</a>
                        </li> --}}
                        {{-- <li>
                                    <a class="{{ request()->is('admin/shareholder-grievance-redressal*') ? 'active' : '' }}"
                        href="{{ route('admin.shareholder-grievance-redressal.index') }}">Shareholder
                        Grievance Redressal</a>
                        </li> --}}
                        {{-- <li>
                                    <a class="{{ request()->is('admin/dealership-page*') ? 'active' : '' }}"
                        href="{{ route('admin.dealership-page.index') }}">Dealership Page</a>
                        </li> --}}

                        <!-- <li>
                            <a class="{{ request()->is('admin/location-map-page*') ? 'active' : '' }}"
                                href="{{ route('admin.location-map-page.index') }}">Location Maps
                                Page</a>
                        </li> -->

                        <!-- <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><span
                                            class="sidebar-mini-hide">Insurance Pages</span></a>
                                    <ul>
                                        <li>
                                            <a class="{{ request()->is('admin/insurance-page/insurance-features') ? 'active' : '' }}"
                                                href="{{ route('admin.insurance-page.index', 'insurance-features') }}">Insurance
                                                Features
                                                Page</a>
                                        </li>
                                        <li>
                                            <a class="{{ request()->is('admin/insurance-page/why-buy-maruti-insurance') ? 'active' : '' }}"
                                                href="{{ route('admin.insurance-page.index', 'why-buy-maruti-insurance') }}">Why
                                                Buy Maruti
                                                Insurance
                                                Page</a>
                                        </li>
                                        <li>
                                            <a class="{{ request()->is('admin/insurance-page/advantages-of-popular') ? 'active' : '' }}"
                                                href="{{ route('admin.insurance-page.index', 'advantages-of-popular') }}">Advantages
                                                of Popular</a>
                                        </li>
                                        <li>
                                            <a class="{{ request()->is('admin/insurance-page/add-ons') ? 'active' : '' }}"
                                                href="{{ route('admin.insurance-page.index', 'add-ons') }}">Add
                                                ons</a>
                                        </li>
                                        <li>
                                            <a class="{{ request()->is('admin/insurance-page/value-added-services') ? 'active' : '' }}"
                                                href="{{ route('admin.insurance-page.index', 'value-added-services') }}">Value
                                                Added Services</a>
                                        </li>

                                    </ul>
                                </li> -->
                        <!-- <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><span
                                            class="sidebar-mini-hide">Network Page</span></a>
                                    <ul>
                                        <li>

                                            <a class="{{ request()->is('admin/network-main') ? 'active' : '' }}"
                                                href="{{ route('admin.network_main.index') }}">Main Network</a>

                                        </li>
                                        <li>
                                            <a class="{{ request()->is('admin/network-sub') ? 'active' : '' }}"
                                                href="{{ route('admin.network_sub.index') }}">Sub
                                                Network</a>
                                        </li>
                                        <li>
                                            <a class="{{ request()->is('admin/network-branch') ? 'active' : '' }}"
                                                href="{{ route('admin.network_branch.index', 'advantages-of-popular') }}">Branches</a>
                                        </li>
                                        <li>
                                            <a class="{{ request()->is('admin/brands') ? 'active' : '' }}"
                                                href="{{ route('admin.brands.index') }}">Brands</a>
                                        </li>

                                    </ul>
                                </li> -->
                        <!-- <li>
                                    <a class="{{ request()->is('admin/services-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.services-page.index') }}">Our Services Page</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('admin/subscribe-page*') ? 'active' : '' }}"
                                        href="{{ route('admin.subscribe-page.index') }}">Subscribe Page</a>
                                </li> -->
                    <!-- </ul>
                    </li> -->
                    {{-- <li class="{{ request()->is('admin/marketing*') ? 'open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-search"></i><span
                            class="sidebar-mini-hide">Marketing
                            Page</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('admin/marketing/create') ? 'active' : '' }}"
                                href="{{ route('admin.marketing.create') }}">Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('admin/marketing') ? 'active' : '' }}"
                                href="{{ route('admin.marketing.index') }}">View</a>
                        </li>
                    </ul>
                    </li> --}}
                    <!-- <li
                        class="{{ request()->is('admin/services*') ? 'open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-plus"></i><span
                                class="sidebar-mini-hide">Services</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('admin/services/create') ? 'active' : '' }}"
                                    href="{{ route('admin.services.create') }}">Add</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('admin/services') ? 'active' : '' }}"
                                    href="{{ route('admin.services.index') }}">View</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li
                        class="{{ request()->is('admin/services_content*') ? 'open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fas fa-plus"></i><span
                                class="sidebar-mini-hide">Service Content</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('admin/services/create') ? 'active' : '' }}"
                                    href="{{ route('service_content.create') }}">Add</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('admin/services') ? 'active' : '' }}"
                                    href="{{ route('service_content.index') }}">View</a>
                            </li>
                        </ul>
                    </li> -->
                    {{-- <li>
                            <a class="{{ request()->is('admin/announcements*') ? 'active' : '' }}"
                    href="{{ route('admin.announcements.index') }}"><i
                        class="fas fa-bullhorn"></i><span class="sidebar-mini-hide">Announcements</span></a>
                    </li> --}}
                    <!-- <li>
                            <a class="{{ request()->is('admin/exchanges*') ? 'active' : '' }}"
                                href="{{ route('admin.exchanges.index') }}"><i class="fa fa-exchange"></i><span
                                    class="sidebar-mini-hide">Exchanges</span></a>
                        </li> -->
                    <!-- <li>
                            <a class="{{ request()->is('admin/offer_details*') ? 'active' : '' }}"
                                href="{{ route('admin.offer_details.index') }}"><i class="fa fa-gift"></i><span
                                    class="sidebar-mini-hide">Offers</span></a>
                        </li> -->

                    <!-- <li>
                            <a class="{{ request()->is('admin/form_export*') ? 'active' : '' }}"
                                href="{{ route('admin.form_export.index') }}"><i class="fa fa-gift"></i><span
                                    class="sidebar-mini-hide">Form Submissions</span></a>
                        </li> -->
                    <!-- <li>
                        <a class="{{ request()->is('admin/gallery*') ? 'active' : '' }}"
                            href="{{ route('admin.gallery.create') }}"><i class="fa fa-gift"></i><span
                                class="sidebar-mini-hide">Gallery</span></a>
                    </li> -->
                    <li class="nav-main-heading"><span class="sidebar-mini-visible">General</span><span
                            class="sidebar-mini-hidden">General</span></li>
                    <!-- <li>
                        <a class="{{ (request()->is('admin/features*')) ? 'active' : '' }}"
                            href="{{ route('admin.features.index') }}"><i
                                class="fas fa-list"></i><span class="sidebar-mini-hide">Features</span></a>
                    </li>
                    <li>
                        <a class="{{ (request()->is('admin/specifications*')) ? 'active' : '' }}"
                            href="{{ route('admin.specifications.index') }}"><i
                                class="fas fa-list"></i><span class="sidebar-mini-hide">Specifications</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/category-types*') ? 'active' : '' }}"
                            href="{{ route('admin.category_type.index') }}"><i
                                class="fas fa-book"></i><span class="sidebar-mini-hide">Category</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/fuels*') ? 'active' : '' }}"
                            href="{{ route('admin.fuels.index') }}"><i
                                class="fas fa-gas-pump"></i><span class="sidebar-mini-hide">Fuels</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/emissions*') ? 'active' : '' }}"
                            href="{{ route('admin.emissions.index') }}"><i
                                class="fas fa-list"></i><span class="sidebar-mini-hide">Emissions</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/conditions*') ? 'active' : '' }}"
                            href="{{ route('admin.conditions.index') }}"><i
                                class="fas fa-list"></i><span class="sidebar-mini-hide">Conditions</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/transmissions*') ? 'active' : '' }}"
                            href="{{ route('admin.transmissions.index') }}"><i
                                class="fas fa-cog"></i><span class="sidebar-mini-hide">Transmissions</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/location_types*') ? 'active' : '' }}"
                            href="{{ route('admin.location_types.index') }}"><i
                                class="fa fa-map"></i><span class="sidebar-mini-hide">Location
                                Types</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/location_types*') ? 'active' : '' }}"
                            href="{{ route('image_category.index') }}"><i class="fa fa-map"></i><span
                                class="sidebar-mini-hide">Image Category</span></a>
                    </li> -->

                    <!-- <li>
                        <a class="{{ request()->is('admin/service_types*') ? 'active' : '' }}"
                            href="{{ route('admin.service_types.index') }}"><i
                                class="fas fa-wrench"></i><span class="sidebar-mini-hide">Service Types</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/service_products*') ? 'active' : '' }}"
                            href="{{ route('admin.service_products.index') }}"><i
                                class="fas fa-wrench"></i><span class="sidebar-mini-hide">Service
                                Products</span></a>
                    </li> -->
                    {{-- <li>
                            <a class="{{ request()->is('admin/contact-settings*') ? 'active' : '' }}"
                    href="{{ route('admin.contact.index') }}"><i class="fas fa-phone"></i><span
                        class="sidebar-mini-hide">Contact Settings</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/address-settings*') ? 'active' : '' }}"
                    href="{{ route('admin.address.index') }}"><i class="fas fa-address-card"></i><span
                        class="sidebar-mini-hide">Address Settings</span></a>
                    </li> --}}
                    <li>
                        <a class="{{ request()->is('admin/general-settings*') ? 'active' : '' }}"
                            href="{{ route('admin.settings.general') }}"><i
                                class="fas fa-wrench"></i><span class="sidebar-mini-hide">Settings</span></a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/vehicle-types*') ? 'active' : '' }}"
                            href="{{ route('admin.vehicle-types.index') }}"><i
                                class="fa fa-tags"></i><span class="sidebar-mini-hide">Vehicle Types</span></a>
                    </li>
                     <!-- <li>
                        <a class="{{ request()->is('admin/vehicle-categories*') ? 'active' : '' }}"
                            href="{{ route('admin.vehicleCategories.index') }}"><i
                                class="fa fa-tags"></i><span class="sidebar-mini-hide">Vehicle Category</span></a>
                    </li> -->
                    <li>
                        <a class="{{ request()->is('admin/vehicle-application*') ? 'active' : '' }}"
                            href="{{ route('admin.vehicle-application.index') }}"><i
                                class="fa fa-tags"></i><span class="sidebar-mini-hide">Vehicle Application</span></a>
                    </li>
                    <!-- <li>
                        <a class="{{ request()->is('admin/documents*') ? 'active' : '' }}"
                            href="{{ route('admin.documents.index') }}"><i
                                class="fa fa-tags"></i><span class="sidebar-mini-hide">Documents</span></a>
                    </li> -->
                    <li>
                        <a class="{{ request()->is('admin/seo*') ? 'active' : '' }}"
                            href="{{ route('seo.index') }}"><i class="fas fa-search"></i><span
                                class="sidebar-mini-hide">SEO</span></a>
                    </li>
                    <!-- <li class="nav-main-heading"><span class="sidebar-mini-visible">Enquiries</span><span
                        class="sidebar-mini-hidden">Reports</span></li> -->
                {{-- @if(Auth::guard('admin')->user()->email == 'shyam.krishnan@popularv.com' || Auth::guard('admin')->user()->email == 'developer@netventure.in') --}}
                {{-- <li>
                    <a class="{{ request()->is('admin/all-enquiries*') ? 'active' : '' }}"
                href="{{ route('admin.home-enquiries.all') }}"><i class="fa fa-wpforms"></i><span
                    class="sidebar-mini-hide">Enquiries</span></a>
                </li> --}}
                {{-- @else --}}
                <!-- <li>
                    <a class="{{ request()->is('admin/contact-enquiries*') ? 'active' : '' }}"
                        href="{{ route('admin.payment-enquiries.index') }}"><i
                            class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Booking Reports</span></a>
                </li> -->

                    <li class="nav-main-heading"><span class="sidebar-mini-visible">Enquiries</span><span
                            class="sidebar-mini-hidden">Enquiries</span></li>
                    {{-- @if(Auth::guard('admin')->user()->email == 'shyam.krishnan@popularv.com' || Auth::guard('admin')->user()->email == 'developer@netventure.in') --}}
                    {{-- <li>
                        <a class="{{ request()->is('admin/all-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.home-enquiries.all') }}"><i class="fa fa-wpforms"></i><span
                        class="sidebar-mini-hide">Enquiries</span></a>
                    </li> --}}
                    {{-- @else --}}
                   
                    <li>
                        <a class="{{ request()->is('admin/booking-enquiries*') ? 'active' : '' }}" 
                        href="{{ route('admin.booking-enquiries.index') }}"><i
                                class="fa fa-wpforms"></i>
                            <span>Booking Enquiries</span>
                        </a>
                    </li>

                    <li>
                        <a class="{{ request()->is('admin/warrior-enquiries*') ? 'active' : '' }}"
                        href="{{ route('admin.warrior-enquiries.index') }}">
                            <i class="fa fa-wpforms"></i>
                            <span class="sidebar-mini-hide">Warrior Enquiries</span>
                        </a>
                    </li>

                    <li>
                        <a class="{{ request()->is('admin/contact-enquiries*') ? 'active' : '' }}"
                            href="{{ route('admin.home-enquiries.contact') }}"><i
                                class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Contact Enquiries</span></a>
                    </li>
                    <li>
                        <a  class="{{ request()->is('admin/factory-visit-enquiries*') ? 'active' : '' }}" 
                            href="{{ route('admin.factory-visits.index') }}">
                            <i class="fa fa-calendar"></i>
                            <span>Factory Visit Enquiries</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a class="{{ request()->is('admin/career-enquiries*') ? 'active' : '' }}"
                            href="{{ route('admin.career-enquiries.index') }}"><i
                                class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Career
                                Enquiries</span></a>
                    </li> -->
                    {{-- <li>
                            <a class="{{ request()->is('admin/offer-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.offer-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Offer
                        Enquiries</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/quick-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.quick-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Quick
                        Enquiries</span></a>
                    </li> --}}
                    <!-- <li>
                        <a class="{{ request()->is('admin/service-enquiries*') ? 'active' : '' }}"
                            href="{{ route('admin.service-enquiries.index') }}"><i
                                class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Service
                                Enquiries</span></a>
                    </li> -->
                    <!-- <li>
                        <a class="{{ request()->is('admin/test-drive-enquiries*') ? 'active' : '' }}"
                            href="{{ route('admin.test-drive-enquiries.index') }}"><i
                                class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Test Drive
                                Enquiries</span></a>
                    </li> -->
                    <!-- <li>
                        <a class="{{ request()->is('admin/vehicle-enquiries*') ? 'active' : '' }}"
                            href="{{ route('admin.vehicle-enquiries.index') }}"><i
                                class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Vehicle
                                Enquiries</span></a>
                    </li> -->
                    {{-- <li>
                            <a class="{{ request()->is('admin/service-product-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.service-product-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Service Product
                        Enquiries</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/exit-popup-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.exit-popup-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Exit Popup
                        Enquiries</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/insurance-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.insurance-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Insurance
                        Enquiries</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/exchange-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.exchange-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Exchange
                        Enquiries</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/usedcar-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.usedcar-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Used Car
                        Enquiries</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/locate-us-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.locate-us-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Locate Us
                        Enquiries</span></a>
                    </li> --}}
                    {{-- <li>
                            <a class="{{ request()->is('admin/subscription-enquiries*') ? 'active' : '' }}"
                    href="{{ route('admin.subscription-enquiries.index') }}"><i
                        class="fa fa-wpforms"></i><span class="sidebar-mini-hide">Subscription
                        Enquiries</span></a>
                    </li> --}}

                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- Sidebar Content -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="content-header-section">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <!-- END Toggle Sidebar -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="content-header-section">
                    <!-- User Dropdown -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                            <i class="ml-5 fa fa-angle-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-200"
                            aria-labelledby="page-header-user-dropdown">
                            <h5 class="py-10 mb-5 text-center border-b h6 text-uppercase">Admin</h5>
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                <i class="mr-5 si si-user"></i> Profile
                            </a>
                            @can('settings.index')
                                <div class="dropdown-divider"></div>
                                <!-- Toggle Side Overlay -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" href="{{ route('admin.settings.index') }}"
                                    data-toggle="layout" data-action="side_overlay_toggle">
                                    <i class="mr-5 si si-wrench"></i> Settings
                                </a>
                                <!-- END Side Overlay -->
                            @endcan
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mr-5 si si-logout"></i> Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form action="be_pages_generic_search.html" method="post">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- Close Search Section -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <button type="button" class="btn btn-secondary" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fa fa-times"></i>
                                </button>
                                <!-- END Close Search Section -->
                            </div>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="text-center content-header content-header-fullrow">
                    <div class="content-header-item">
                        <i class="text-white fa fa-sun-o fa-spin"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">

            <!-- Page Content -->
            @yield('content')
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="opacity-0">
            <div class="clearfix py-20 content font-size-xs">
                {{-- <div class="float-right">
                    Crafted with <i class="fa fa-heart text-pulse fa-beat"></i> by <a class="font-w600"
                        href="https://www.netventure.in/" target="_blank">netventure</a>
                </div> --}}
                <div class="float-left">
                    <a class="font-w600" href="{{ config('app.url') }}"
                        target="_blank">{{ config('app.name') }}</a>
                    &copy; <span class="js-year-copy"></span>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <script src="{{ mix('js/theme.app.js') }}"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script>
        $.validator.addMethod("regex", function (value, element, param) {
            return (
                this.optional(element) ||
                value.match(typeof param == "string" ? new RegExp(param) : param)
            );
        });

    </script>
    @yield('js_after')

</body>

</html>
