@extends('layouts.front')

@section('css_after')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap">
    {{-- ?v=mtime so an edit is never served from the browser cache --}}
    <link rel="stylesheet" href="{{ asset('assets/css/home2.css') }}?v={{ filemtime(public_path('assets/css/home2.css')) }}">
@endsection

@section('content')
    {{-- @dd($settings); --}}
    <!--====== Banner Part START ======-->


<section id="web-banner" class="vb-hero" aria-roledescription="carousel" aria-label="Featured vehicles">
    <div class="vb-slider owl-carousel">
        @foreach ($sliders as $data)
            @php
                $title = preg_replace('/\[(.+?)\]/', '<span>$1</span>', e($data->title));
                $tag   = $loop->first ? 'h1' : 'h2';
            @endphp

            <div class="vb-slide" style="background-image: url('{{ asset('storage/' . $data->image) }}');">
                <div class="vb-overlay">
                    <div class="vb-wrap">

                        <div class="vb-main">
                            @if ($data->vehicle)
                                <p class="vb-eyebrow">{{ $data->vehicle->name }}</p>
                            @endif

                            <{{ $tag }} class="vb-title">{!! $title !!}@if ($data->sub_title) <span>{{ $data->sub_title }}</span>@endif</{{ $tag }}>

                            @if ($data->vehicle)
                                <a class="vb-btn" href="{{ route('vehicles.show', $data->vehicle->slug) }}#enquiry">Enquire Now</a>
                            @endif
                        </div>

                        @if ($data->description)
                            <div class="vb-desc">
                                {!! strip_tags($data->description, '<p><br><strong><em><b><i>') !!}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</section>


    <!--====== Mobile Banner START ======-->
    <section id="mobile-banner" class="abreco-hero-area header slider-fade d-none">
        <div class="owl-carousel owl-theme">
            @if ($sliders->count())
                @foreach ($sliders as $data)
                    <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
                    <div class="item bg-img bg-img-1"
                        style="background-image: url({{ asset('storage/' . $data->image) }});">
                        <div class="overlay"></div>
                        <div class="caption">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="banner-inner">
                                            <div class="baner-bg-head">
                                                <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}"
                                                    alt="">
                                            </div>
                                            <h1 class="">{{ @$data->title }}<br><span>{{ @$data->sub_title }}</span>
                                            <div class="butn-light mt-30 mb-30">
                                                <a href="{{ route('vehicles.show', $data->vehicle->slug) }}">Enquire Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->vehicle)
                                    <div class="truck-name">
                                        <h3>{{ $data->vehicle->name }}</h3>
                                        <p class="">{{ $data->description }}</p>
                                    </div>
                                @endif
                                <div class="scroll-baner">
                                    <a href="#Features">Scroll</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Counter Number -->
        <div class="slide-counter">01/03</div>
        <!-- Booking Search -->
        <div class="booking-wrapper">
            <form action="{{ route('vehicle_search') }}" method="POST">

                @csrf
                <div class="form-control">
                    <select name="type" id="vehicle_type_mobile" required>
                        <option value="">Select Type</option>
                        @foreach ($vehicle_types_data as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control d-none" id="vehicleAppMobile">
                    <select name="vehicleApplications" id="vehicleApplicationsmobile">
                        <option value="">Select Application</option>
                    </select>
                </div>
                <div class="form-control form-control-submit">
                    {{-- <button type="submit" name="submit">Search</button> --}}
                    <input type="submit" value="Search">
                </div>
            </form>
        </div>
    </section>



    <!--====== abreco about Us ======-->
{{--
    Everest Caravans — "Who are we?" section + awards strip
    CSS: public/css/about.css   JS: public/js/about.js (optional reveal)
    Background texture: public/assets/images/about/topo.svg
    Font (in <head>):
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet">
--}}
@php
    // One place to edit the feature list. Icon = SVG path(s), 24×24 grid.
    $evFeatures = [
        // Off-road tyre: hub, rim, and a ring of tread blocks
        ['label' => 'Engineered for Off-Road', 'icon' => '<circle cx="12" cy="12" r="9.25"/><circle cx="12" cy="12" r="6.25"/><circle cx="12" cy="12" r="2.75"/><path d="M18.25 12h3M12 18.25v3M5.75 12H2.75M12 5.75V2.75"/><path d="m16.42 16.42 2.12 2.12M7.58 16.42l-2.12 2.12M7.58 7.58 5.46 5.46M16.42 7.58l2.12-2.12"/>'],
        // Brilliant-cut diamond, with a glow off the crown
        ['label' => 'Lux Interior Decor',      'icon' => '<path d="M8 6.5h8l3 4.5-7 9.5-7-9.5z"/><path d="M5 11h14"/><path d="M8 6.5 12 20.5M16 6.5 12 20.5"/><path d="M12 2v2.5M4.5 4l1.6 1.6M19.5 4l-1.6 1.6"/>'],
        // Dial gauge: measured, not eyeballed
        ['label' => 'Strict Quality Control',  'icon' => '<path d="M3.5 17.5a8.5 8.5 0 1 1 17 0"/><path d="M3.5 17.5h17"/><path d="M12 9v2M6.5 11.2l1.4 1.4M17.5 11.2l-1.4 1.4"/><path d="m12 17.5 4.2-4.2"/><circle cx="12" cy="17.5" r="1.4"/>'],
        // Scales: measured against the standard
        ['label' => 'Built to Regulations',    'icon' => '<path d="M12 4.5v16M7.5 20.5h9M4 8h16"/><circle cx="12" cy="6.2" r="1.6"/><path d="M4 8 1.5 13.5h5z"/><path d="M20 8l-2.5 5.5h5z"/>'],
        // Top-grade stock: boards under a star
        ['label' => 'Premium Materials',       'icon' => '<path d="M12 2.2l1.3 2.7 3 .4-2.2 2.1.5 3-2.6-1.4-2.6 1.4.5-3-2.2-2.1 3-.4z"/><rect x="2.5" y="11.5" width="19" height="4" rx="1.5"/><rect x="2.5" y="17.5" width="19" height="4" rx="1.5"/>'],
        // Ruler: built to your dimensions
        ['label' => 'Custom Built to Order',   'icon' => '<rect x="2" y="7.5" width="20" height="9" rx="2.5"/><path d="M6 7.5v3.2M10 7.5v4.6M14 7.5v3.2M18 7.5v4.6"/>'],
    ];

@endphp






<section class="ev-about" id="about" aria-labelledby="evAboutTitle" data-ev-reveal>
    <div class="ev-about__inner">

        {{-- Photo + years badge --}}
        <div class="ev-about__media">
            <div class="ev-about__frame">
                <img src="{{ asset('assets/abreco/images/about1.jpg') }}"
                     alt="Caravan parked on a desert road below a red rock bluff at sunset"
                     width="520" height="578" loading="lazy" decoding="async">
                <div class="ev-about__badge">
                    <strong>15+</strong>
                    <span>Years</span>
                </div>
            </div>
        </div>

        {{-- Copy --}}
        <div class="ev-about__content">
            <p class="ev-about__eyebrow">
                Who Are We?
                <svg viewBox="0 0 26 16" aria-hidden="true"><path d="M2 12V4.5A2.5 2.5 0 0 1 4.5 2H16a5 5 0 0 1 5 5v5z"/><path d="M1 12h23"/><circle cx="8" cy="13" r="2"/><path d="M5 5.5h5v3H5zM13 5.5h3"/></svg>
            </p>

            <h2 class="ev-about__title" id="evAboutTitle">Premium Custom&#8209;Built Caravans</h2>

            <p class="ev-about__lead">
                Everest Caravans is a family-owned business with over 15 years in the caravan industry.
                Every van is built from the highest quality materials and passes a strict quality-control
                stage before it is delivered to you.
            </p>

            <ul class="ev-about__features">
                @foreach ($evFeatures as $f)
                    <li>
                        <span class="ev-about__chip"><svg viewBox="0 0 24 24" aria-hidden="true">{!! $f['icon'] !!}</svg></span>
                        <span>{{ $f['label'] }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="ev-about__actions">
                <a class="ev-about__btn" href="{{ url('/caravans') }}">View Our Vans</a>
                <a class="ev-about__link" href="{{ url('/contact') }}">Contact Us</a>
            </div>
        </div>

        {{-- Decoration (right column) --}}
        <div class="ev-about__deco" aria-hidden="true">
            <span class="ev-about__vertical">Off-Road</span>
            <svg class="ev-about__topview" viewBox="0 0 120 320" fill="none"
                 stroke-linejoin="round" stroke-linecap="round">
                <!-- A-frame: members + cross brace -->
                <path d="M60 13 27 62M60 13 93 62M38 46h44" stroke="#0E1330" stroke-width="4.5"/>
                <!-- Off-road coupling -->
                <rect x="53" y="2" width="14" height="13" rx="4" fill="#0E1330"/>
                <circle cx="60" cy="7" r="2.6" fill="#E4E7F8" opacity=".55"/>
                <!-- Twin gas bottles -->
                <circle cx="46" cy="34" r="6.5" fill="#1D2A72"/>
                <circle cx="74" cy="34" r="6.5" fill="#1D2A72"/>
                <circle cx="46" cy="34" r="2.6" fill="#E4E7F8" opacity=".4"/>
                <circle cx="74" cy="34" r="2.6" fill="#E4E7F8" opacity=".4"/>
                <!-- Jerry cans -->
                <rect x="21" y="48" width="12" height="16" rx="3" fill="#1D2A72"/>
                <rect x="87" y="48" width="12" height="16" rx="3" fill="#1D2A72"/>
                <!-- Mesh stone guard -->
                <rect x="36" y="50" width="48" height="14" rx="4" fill="#0E1330"/>
                <g stroke="#3446B0" stroke-width="1" opacity=".6">
                    <path d="M44 52v10M52 52v10M60 52v10M68 52v10M76 52v10"/>
                </g>

                <!-- Tandem off-road axles -->
                <g fill="#0E1330">
                    <rect x="2"   y="170" width="16" height="40" rx="5"/>
                    <rect x="2"   y="216" width="16" height="40" rx="5"/>
                    <rect x="102" y="170" width="16" height="40" rx="5"/>
                    <rect x="102" y="216" width="16" height="40" rx="5"/>
                </g>
                <g stroke="#3446B0" stroke-width="1.5" opacity=".55">
                    <path d="M4 180h12M4 190h12M4 200h12M4 226h12M4 236h12M4 246h12"/>
                    <path d="M104 180h12M104 190h12M104 200h12M104 226h12M104 236h12M104 246h12"/>
                </g>
                <!-- Mudguards -->
                <g stroke="#3446B0" stroke-width="1.5" opacity=".55">
                    <rect x="4" y="165" width="12" height="96" rx="6"/>
                    <rect x="104" y="165" width="12" height="96" rx="6"/>
                </g>

                <!-- Awning box (kerb side) and entry door -->
                <rect x="8" y="92" width="6" height="72" rx="3" fill="#0E1330" opacity=".65"/>
                <rect x="104" y="100" width="6" height="32" rx="3" fill="#E4E7F8" opacity=".5"/>

                <!-- Body + roof deck -->
                <rect x="13" y="68" width="94" height="234" rx="18" fill="#283895"/>
                <rect x="19" y="74" width="82" height="222" rx="13" fill="#3446B0"/>
                <!-- Roof rails -->
                <g fill="#283895" opacity=".8">
                    <rect x="21" y="80" width="3" height="208" rx="1.5"/>
                    <rect x="96" y="80" width="3" height="208" rx="1.5"/>
                </g>

                <!-- Solar array -->
                <g fill="#E4E7F8">
                    <rect x="29" y="86"  width="62" height="46" rx="3"/>
                    <rect x="29" y="138" width="62" height="46" rx="3"/>
                </g>
                <g stroke="#9AA6E6" stroke-width="1">
                    <path d="M50 86v46M70 86v46M29 101h62M29 117h62"/>
                    <path d="M50 138v46M70 138v46M29 153h62M29 169h62"/>
                </g>

                <!-- Satellite dome -->
                <circle cx="60" cy="198" r="9" fill="#0E1330"/>
                <circle cx="60" cy="198" r="4.5" fill="#E4E7F8" opacity=".3"/>
                <!-- Air-conditioner -->
                <rect x="37" y="216" width="46" height="32" rx="8" fill="#0E1330"/>
                <rect x="44" y="222" width="32" height="20" rx="4" fill="#E4E7F8" opacity=".28"/>
                <g stroke="#0E1330" stroke-width="1" opacity=".5">
                    <path d="M48 228h24M48 232h24M48 236h24"/>
                </g>
                <!-- Roof hatch -->
                <rect x="46" y="258" width="28" height="22" rx="6" fill="#1D2A72"/>
                <rect x="50" y="262" width="20" height="14" rx="3" fill="#E4E7F8" opacity=".3"/>
                <!-- Vent -->
                <circle cx="60" cy="290" r="6" fill="#1D2A72"/>

                <!-- Rear bar: spare wheel between two jerry holders -->
                <rect x="24" y="299" width="72" height="12" rx="5" fill="#0E1330"/>
                <rect x="48" y="302" width="24" height="16" rx="5" fill="#1D2A72"/>
                <g fill="#1D2A72" opacity=".8">
                    <rect x="28" y="303" width="12" height="10" rx="3"/>
                    <rect x="80" y="303" width="12" height="10" rx="3"/>
                </g>
            </svg>
        </div>

    </div>
</section>




    <!--====== abreco feature ======-->
{{--
    Everest Caravans — Awards "Journey" (black & gold)
    CSS:    public/assets/css/home2.css
    Images: public/assets/images/awards/awardsection.jpg
    Fonts (in <head>):
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Oswald:wght@400;500&display=swap" rel="stylesheet">
--}}
@php
    // Add one line per award. 'rank' => null shows a trophy.
    $evAwards = [
        ['rank' => 1,    'van' => 'Nitro Extreme',      'title' => 'Best Off-Road Van in Australia',  'year' => 2022],
        ['rank' => null, 'van' => null,                 'title' => 'Custom Manufacturer of the Year', 'year' => 2022],
        ['rank' => 3,    'van' => 'Kombat Performance', 'title' => 'Best Off-Road Van in Australia',  'year' => 2021],
        ['rank' => 2,    'van' => 'Camo',               'title' => 'Best Off-Road Van in Australia',  'year' => 2020],
        ['rank' => 5,    'van' => 'Kombat E1',          'title' => 'Best Off-Road Van in Australia',  'year' => 2019],
    ];

    // Newest first; ranked awards before trophies in the same year
    $evRows  = collect($evAwards)->sortBy([['year', 'desc'], [fn ($a) => $a['rank'] === null ? 1 : 0, 'asc']])->values();
    $evYears = $evRows->max('year') - $evRows->min('year') + 1;

    // Background photo (sits under a dark-blue gradient). Dark, wide shots work best.
    $evJourneyBg = asset('assets/images/awards/awardsection.jpg');
@endphp

<section class="ev-journey" aria-labelledby="evJourneyTitle" style="--ej-photo: url('{{ $evJourneyBg }}');">

    {{-- Shared gold gradient + laurel artwork, used by every icon below --}}
    <svg class="ev-journey__defs" width="0" height="0" aria-hidden="true" focusable="false">
        <defs>
            <linearGradient id="evJGold" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0"   stop-color="#F8E3A3"/>
                <stop offset=".45" stop-color="#D9AE55"/>
                <stop offset=".65" stop-color="#B8862F"/>
                <stop offset="1"   stop-color="#F1D58C"/>
            </linearGradient>
            <symbol id="evJLaurel" viewBox="0 0 120 120"><path d="M47 102 A42 42 0 0 1 24 36" fill="none" stroke="url(#evJGold)" stroke-width="1.6" stroke-linecap="round"/><path d="M73 102 A42 42 0 0 0 96 36" fill="none" stroke="url(#evJGold)" stroke-width="1.6" stroke-linecap="round"/><g fill="url(#evJGold)"><ellipse cx="42.0" cy="104.5" rx="3.2" ry="7.5" transform="rotate(-286.0 42.0 104.5)"/><ellipse cx="46.5" cy="93.4" rx="3.2" ry="7.5" transform="rotate(-210.0 46.5 93.4)"/><ellipse cx="29.1" cy="96.8" rx="3.2" ry="7.5" transform="rotate(-268.0 29.1 96.8)"/><ellipse cx="36.9" cy="87.6" rx="3.2" ry="7.5" transform="rotate(-192.0 36.9 87.6)"/><ellipse cx="19.3" cy="85.4" rx="3.2" ry="7.5" transform="rotate(-250.0 19.3 85.4)"/><ellipse cx="29.5" cy="79.1" rx="3.2" ry="7.5" transform="rotate(-174.0 29.5 79.1)"/><ellipse cx="13.4" cy="71.6" rx="3.2" ry="7.5" transform="rotate(-232.0 13.4 71.6)"/><ellipse cx="25.1" cy="68.7" rx="3.2" ry="7.5" transform="rotate(-156.0 25.1 68.7)"/><ellipse cx="12.1" cy="56.7" rx="3.2" ry="7.5" transform="rotate(-214.0 12.1 56.7)"/><ellipse cx="24.1" cy="57.5" rx="3.2" ry="7.5" transform="rotate(-138.0 24.1 57.5)"/><ellipse cx="15.5" cy="42.0" rx="3.2" ry="7.5" transform="rotate(-196.0 15.5 42.0)"/><ellipse cx="26.6" cy="46.5" rx="3.2" ry="7.5" transform="rotate(-120.0 26.6 46.5)"/><ellipse cx="23.2" cy="29.1" rx="3.2" ry="7.5" transform="rotate(-178.0 23.2 29.1)"/><ellipse cx="32.4" cy="36.9" rx="3.2" ry="7.5" transform="rotate(-102.0 32.4 36.9)"/><ellipse cx="78.0" cy="104.5" rx="3.2" ry="7.5" transform="rotate(106.0 78.0 104.5)"/><ellipse cx="73.5" cy="93.4" rx="3.2" ry="7.5" transform="rotate(30.0 73.5 93.4)"/><ellipse cx="90.9" cy="96.8" rx="3.2" ry="7.5" transform="rotate(88.0 90.9 96.8)"/><ellipse cx="83.1" cy="87.6" rx="3.2" ry="7.5" transform="rotate(12.0 83.1 87.6)"/><ellipse cx="100.7" cy="85.4" rx="3.2" ry="7.5" transform="rotate(70.0 100.7 85.4)"/><ellipse cx="90.5" cy="79.1" rx="3.2" ry="7.5" transform="rotate(-6.0 90.5 79.1)"/><ellipse cx="106.6" cy="71.6" rx="3.2" ry="7.5" transform="rotate(52.0 106.6 71.6)"/><ellipse cx="94.9" cy="68.7" rx="3.2" ry="7.5" transform="rotate(-24.0 94.9 68.7)"/><ellipse cx="107.9" cy="56.7" rx="3.2" ry="7.5" transform="rotate(34.0 107.9 56.7)"/><ellipse cx="95.9" cy="57.5" rx="3.2" ry="7.5" transform="rotate(-42.0 95.9 57.5)"/><ellipse cx="104.5" cy="42.0" rx="3.2" ry="7.5" transform="rotate(16.0 104.5 42.0)"/><ellipse cx="93.4" cy="46.5" rx="3.2" ry="7.5" transform="rotate(-60.0 93.4 46.5)"/><ellipse cx="96.8" cy="29.1" rx="3.2" ry="7.5" transform="rotate(-2.0 96.8 29.1)"/><ellipse cx="87.6" cy="36.9" rx="3.2" ry="7.5" transform="rotate(-78.0 87.6 36.9)"/></g></symbol>
            <symbol id="evJBranch" viewBox="12 24 44 86"><path d="M47 102 A42 42 0 0 1 24 36" fill="none" stroke="url(#evJGold)" stroke-width="1.6" stroke-linecap="round"/><g fill="url(#evJGold)"><ellipse cx="42.0" cy="104.5" rx="3.2" ry="7.5" transform="rotate(-286.0 42.0 104.5)"/><ellipse cx="46.5" cy="93.4" rx="3.2" ry="7.5" transform="rotate(-210.0 46.5 93.4)"/><ellipse cx="29.1" cy="96.8" rx="3.2" ry="7.5" transform="rotate(-268.0 29.1 96.8)"/><ellipse cx="36.9" cy="87.6" rx="3.2" ry="7.5" transform="rotate(-192.0 36.9 87.6)"/><ellipse cx="19.3" cy="85.4" rx="3.2" ry="7.5" transform="rotate(-250.0 19.3 85.4)"/><ellipse cx="29.5" cy="79.1" rx="3.2" ry="7.5" transform="rotate(-174.0 29.5 79.1)"/><ellipse cx="13.4" cy="71.6" rx="3.2" ry="7.5" transform="rotate(-232.0 13.4 71.6)"/><ellipse cx="25.1" cy="68.7" rx="3.2" ry="7.5" transform="rotate(-156.0 25.1 68.7)"/><ellipse cx="12.1" cy="56.7" rx="3.2" ry="7.5" transform="rotate(-214.0 12.1 56.7)"/><ellipse cx="24.1" cy="57.5" rx="3.2" ry="7.5" transform="rotate(-138.0 24.1 57.5)"/><ellipse cx="15.5" cy="42.0" rx="3.2" ry="7.5" transform="rotate(-196.0 15.5 42.0)"/><ellipse cx="26.6" cy="46.5" rx="3.2" ry="7.5" transform="rotate(-120.0 26.6 46.5)"/><ellipse cx="23.2" cy="29.1" rx="3.2" ry="7.5" transform="rotate(-178.0 23.2 29.1)"/><ellipse cx="32.4" cy="36.9" rx="3.2" ry="7.5" transform="rotate(-102.0 32.4 36.9)"/></g></symbol>
            <symbol id="evJStar" viewBox="0 0 24 24"><path fill="url(#evJGold)" d="m12 1.5 3.1 6.6 7.2.9-5.3 5 1.4 7.1L12 17.6l-6.4 3.5L7 14l-5.3-5 7.2-.9z"/></symbol>
        </defs>
    </svg>

    <div class="ev-journey__inner">

        {{-- Heading: stars above, laurels either side --}}
        <header class="ev-journey__head">
            <div class="ev-journey__stars" aria-hidden="true">
                <svg><use href="#evJStar"/></svg>
                <svg><use href="#evJStar"/></svg>
                <svg><use href="#evJStar"/></svg>
            </div>

            <div class="ev-journey__titlebar">
                <svg class="ev-journey__branch" aria-hidden="true"><use href="#evJBranch"/></svg>
                <h2 class="ev-journey__title" id="evJourneyTitle">
                    <span class="ev-journey__title-top">Everest&rsquo;s Journey for the Past {{ $evYears }} Years</span>
                    <span class="ev-journey__title-main">Top 5 Vans in Australia</span>
                </h2>
                <svg class="ev-journey__branch ev-journey__branch--right" aria-hidden="true"><use href="#evJBranch"/></svg>
            </div>
        </header>

        {{-- Award rows --}}
        <ol class="ev-journey__list">
            @foreach ($evRows as $a)
                <li class="ev-journey__row">
                    <span class="ev-journey__medal" aria-hidden="true">
                        <svg class="ev-journey__wreath"><use href="#evJLaurel"/></svg>
                        <span class="ev-journey__mini-stars">
                            <svg><use href="#evJStar"/></svg><svg><use href="#evJStar"/></svg><svg><use href="#evJStar"/></svg>
                        </span>
                        @if ($a['rank'])
                            <span class="ev-journey__num">{{ $a['rank'] }}</span>
                        @else
                            <svg class="ev-journey__cup" viewBox="0 0 24 24"><path d="M7 4h10v5a5 5 0 0 1-10 0z"/><path d="M7 6H4v2a3 3 0 0 0 3 3M17 6h3v2a3 3 0 0 1-3 3M12 14v4M8 21h8M9 18h6"/></svg>
                        @endif
                    </span>

                    @if ($a['van'])
                        <p class="ev-journey__text ev-journey__name">
                            <span class="ev-journey__van">{{ $a['van'] }}</span>
                        </p>
                    @endif

                    {{-- With no van name, the award text takes the empty name column too --}}
                    <p class="ev-journey__text ev-journey__what @unless ($a['van']) ev-journey__what--wide @endunless">
                        @if ($a['rank'])Rated Number {{ $a['rank'] }} {{ $a['title'] }}@else<span class="ev-journey__gold">{{ $a['title'] }}</span>@endif
                    </p>

                    <span class="ev-journey__year">{{ $a['year'] }}</span>
                </li>
            @endforeach
        </ol>

    </div>
</section>



    <!--====== [reer] ======-->

{{-- Everest Caravans — "Lux Decor" (about-style section with video) --}}

{{-- Styles live in assets/css/home2.css; fonts load once in the layout head --}}
@php
    $evDecorJs = 'js/decor.js';
@endphp

@php
    // ---- Edit content here ----
    $evDecor = [
        'eyebrow' => 'Lux Decor',
        'title'   => 'Customised inside and out, styled to feel like home.',
        'text'    => 'Everest vans are customisable from the inside out. We love giving our owners the chance to style their interior with whatever makes them feel right at home.',
        'button'  => ['label' => 'Visit Our Showroom', 'url' => url('/contact')],

        // YouTube embed link, e.g. https://www.youtube.com/embed/VIDEO_ID  (null = no play button)
        'video'   => null,

        'cover'    => 'assets/images/decor/video-cover.jpg',       // landscape ~1400x780
        // Portrait slider — add or remove entries, the slideshow adapts
        'portraits' => [
            'assets/abreco/images/vehicles/build-van-17.jpeg',
            'assets/abreco/images/vehicles/build-van-18.jpeg',
        ],
    ];

    $evDecorFeatures = [
        ['label' => 'Interior styled your way',       'icon' => '<path d="M4 20V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="m10 8 3.5-3.5a1 1 0 0 1 1.4 0l2.6 2.6a1 1 0 0 1 0 1.4L10 16"/><path d="M8 22h12a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3"/><circle cx="7" cy="18" r=".6"/>'],
        ['label' => 'One-of-a-kind layouts',          'icon' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 10h18M10 10v11"/>'],
        ['label' => 'Highest quality materials',      'icon' => '<path d="M6 3h12l4 6-10 12L2 9z"/><path d="M2 9h20M9.5 3 12 21l2.5-18"/>'],
        ['label' => 'Quality checked before delivery','icon' => '<path d="M12 3 20 6v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>'],
    ];

    $evCover    = file_exists(public_path($evDecor['cover']))    ? asset($evDecor['cover'])    : null;
    $evPortraits = collect($evDecor['portraits'])
        ->filter(fn ($i) => file_exists(public_path($i)))
        ->map(fn ($i) => asset($i))
        ->values();
@endphp

<section class="ev-decor" aria-labelledby="evDecorTitle">
    <div class="ev-decor__inner">

        {{-- LEFT: heading, video, features --}}
        <div class="ev-decor__main">
            <p class="ev-decor__eyebrow">{{ $evDecor['eyebrow'] }}</p>
            <h2 class="ev-decor__title" id="evDecorTitle">{{ $evDecor['title'] }}</h2>

            <div class="ev-decor__media">
                @if ($evCover)
                    <img class="ev-decor__img" src="{{ $evCover }}" alt="Inside an Everest caravan"
                         width="1400" height="780" loading="lazy" decoding="async">
                @endif

                @if ($evDecor['video'])
                    <button type="button" class="ev-decor__play" data-ev-video="{{ $evDecor['video'] }}"
                            aria-label="Play video">
                        <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><path d="M8 5.5v13l11-6.5z"/></svg>
                    </button>
                @endif
            </div>

            <ul class="ev-decor__features">
                @foreach ($evDecorFeatures as $f)
                    <li class="ev-decor__feature">
                        <span class="ev-decor__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="16" height="16">{!! $f['icon'] !!}</svg>
                        </span>
                        <span class="ev-decor__label">{{ $f['label'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- RIGHT: text, button, tall photo --}}
        <div class="ev-decor__side">
            <p class="ev-decor__text">{{ $evDecor['text'] }}</p>

            <a class="ev-decor__btn" href="{{ $evDecor['button']['url'] }}">
                <span>{{ $evDecor['button']['label'] }}</span>
                <svg viewBox="0 0 20 20" width="18" height="18" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>

            {{-- Crossfades through the images; one image = a plain photo --}}
            <div class="ev-decor__portrait" data-ev-slides="{{ $evPortraits->count() }}">
                @foreach ($evPortraits as $src)
                    {{-- Only the first carries the alt text; the rest are decorative --}}
                    <img src="{{ $src }}"
                         alt="{{ $loop->first ? 'An Everest caravan under construction' : '' }}"
                         width="800" height="1000" loading="lazy" decoding="async">
                @endforeach
            </div>
        </div>

    </div>

    @if ($evDecor['video'])
        {{-- Video popup (native <dialog>; the video only loads when opened) --}}
        <dialog class="ev-decor__dialog" id="evDecorDialog" aria-label="Everest video">
            <button type="button" class="ev-decor__close" aria-label="Close video">
                <svg viewBox="0 0 20 20" width="18" height="18" aria-hidden="true"><path d="M5 5l10 10M15 5 5 15"/></svg>
            </button>
            <div class="ev-decor__frame">
                <iframe title="Everest Caravans video" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
            </div>
        </dialog>

        @if (file_exists(public_path($evDecorJs)))
            <script src="{{ asset($evDecorJs) }}?v={{ filemtime(public_path($evDecorJs)) }}" defer></script>
        @endif
    @endif
</section>


    <!--====== Who are us ======-->



{{-- Everest — "Who we are" with service tabs (tabs switch the quote + image) --}}

{{-- Styles live in assets/css/home2.css; fonts load once in the layout head --}}
@php
    $wsJs = 'js/about-services.js';

    // ================= EDIT CONTENT HERE =================
    $wsAbout = [
        'eyebrow' => 'Who We Are',
        'title'   => 'Premium Custom Caravans, Built to the Highest Standard',
        'text'    => 'Everest Caravans is a family owned business with over 15 years experience in the caravan industry. We use the highest quality materials, and our manufacturing process ensures every van is built to the highest standard and meets regulations.',
        'button'  => ['label' => 'About Everest', 'url' => url('/about')],
        'bg'      => null,                                  // stats panel background; null = reuse the main photo
        'photo'   => 'assets/images/about/who-we1.jpg',        // large photo, top left
        'photo2'  => 'assets/images/about/who-we2.jpg',        // smaller photo, overlapping bottom right
    ];

    // One entry per tab. Clicking a tab swaps the quote text and image.
    $wsServices = [
        [
            'label' => 'Off-Road',
            'icon'  => '<path d="M2 20 8 10l4 6 3-4 7 8z"/><circle cx="17" cy="6" r="2"/>',
            'title' => 'Engineered for off-road',
            'text'  => 'Our vans are engineered for purpose. The Everest team hits the road often, so we know exactly what a van needs to handle the Gibb River, Oodnadatta and the Nullarbor.',
            'image' => 'assets/images/services/off-road.png',
        ],
        [
            'label' => 'Lux Decor',
            'icon'  => '<path d="M5 11V8a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"/><path d="M3 18v-5a2 2 0 0 1 4 0v2h10v-2a2 2 0 0 1 4 0v5z"/><path d="M5 18v2M19 18v2"/>',
            'title' => 'Customised from the inside out',
            'text'  => 'Style your interior with whatever makes you feel right at home. Come into our showroom and select your one-of-a-kind interior.',
            'image' => 'assets/images/services/lux-decor.png',
        ],
        [
            'label' => 'Quality',
            'icon'  => '<path d="M12 3 20 6v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>',
            'title' => 'Strict quality control',
            'text'  => 'Every caravan goes through our strict quality control process and must pass our QC stage before it is delivered to you.',
            'image' => 'assets/images/services/quality.jpeg',
        ],
    ];
    // =====================================================

    $wsImg = fn ($path) => ($path && file_exists(public_path($path))) ? asset($path) : null;
    $wsPanelBg = $wsImg($wsAbout['bg']) ?? $wsImg($wsAbout['photo']);
@endphp

<section class="ws-about" aria-labelledby="wsAboutTitle">
    <div class="ws-about__inner">

        {{-- LEFT: dark stats panel + overlapping photo --}}
        <div class="ws-about__media">
            <div class="ws-about__photo ws-about__photo--main">
                @if ($wsImg($wsAbout['photo']))
                    <img src="{{ $wsImg($wsAbout['photo']) }}" alt="Everest Alpine Quattro off-road caravan" loading="lazy" decoding="async">
                @endif
            </div>

            <div class="ws-about__photo ws-about__photo--sub">
                @if ($wsImg($wsAbout['photo2']))
                    <img src="{{ $wsImg($wsAbout['photo2']) }}" alt="Front of an Everest caravan with its stone guard and gas bottles" loading="lazy" decoding="async">
                @endif
            </div>
        </div>

        {{-- RIGHT: copy, button, service tabs --}}
        <div class="ws-about__content">
            <p class="ws-about__eyebrow">{{ $wsAbout['eyebrow'] }}</p>
            <h2 class="ws-about__title" id="wsAboutTitle">{{ $wsAbout['title'] }}</h2>
            <p class="ws-about__text">{{ $wsAbout['text'] }}</p>

            <div class="ws-about__cta">
                <a class="ws-about__btn" href="{{ $wsAbout['button']['url'] }}">{{ $wsAbout['button']['label'] }}</a>
            </div>

            {{-- Service tabs + slider --}}
            <div class="ws-tabs" data-ws-tabs data-autoplay="6000">
                <div class="ws-tabs__list" role="tablist" aria-label="What makes an Everest">
                    @foreach ($wsServices as $i => $svc)
                        <button type="button" class="ws-tabs__tab {{ $i === 0 ? 'is-active' : '' }}"
                                role="tab" id="wsTab{{ $i }}" aria-controls="wsPanel{{ $i }}"
                                aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                                tabindex="{{ $i === 0 ? '0' : '-1' }}">
                            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">{!! $svc['icon'] !!}</svg>
                            <span>{{ $svc['label'] }}</span>
                        </button>
                    @endforeach
                </div>

                <div class="ws-tabs__panels">
                    @foreach ($wsServices as $i => $svc)
                        <div class="ws-tabs__panel {{ $i === 0 ? 'is-active' : '' }}"
                             role="tabpanel" id="wsPanel{{ $i }}" aria-labelledby="wsTab{{ $i }}"
                             {{ $i === 0 ? '' : 'hidden' }}>
                            <figure class="ws-quote">
                                <svg class="ws-quote__mark" viewBox="0 0 32 24" width="32" height="24" aria-hidden="true">
                                    <path d="M0 24V13.6C0 5.9 4.3 1.3 12.9 0l1.3 3.6C9.6 4.9 7.3 7.4 7 11h6.5v13zm17.8 0V13.6C17.8 5.9 22.1 1.3 30.7 0L32 3.6c-4.6 1.3-6.9 3.8-7.2 7.4h6.5v13z"/>
                                </svg>
                                <blockquote class="ws-quote__text">{{ $svc['text'] }}</blockquote>
                                <figcaption class="ws-quote__by">
                                    <strong>Everest Caravans</strong>
                                    <span>Family owned</span>
                                </figcaption>
                            </figure>

                            <div class="ws-tabs__img">
                                @if ($wsImg($svc['image']))
                                    <img src="{{ $wsImg($svc['image']) }}" alt="{{ $svc['title'] }}" loading="lazy" decoding="async">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

@if (file_exists(public_path($wsJs)))
    <script src="{{ asset($wsJs) }}?v={{ filemtime(public_path($wsJs)) }}" defer></script>
@endif

{{-- Everest Caravans — "Our Partners" logo wall --}}

{{-- Styles live in assets/css/home2.css; fonts load once in the layout head --}}
@php
    // ================= EDIT HERE =================
    // Logos are already black & white. PNG/SVG with a transparent background works best.
    // 'url' is optional — leave it null for a logo that isn't a link.
    $epPartners = [
        ['name' => 'Burst',                 'logo' => 'assets/images/partners/burst.png',            'url' => null],
        ['name' => 'Vinyl Media',           'logo' => 'assets/images/partners/vinyl-media.jpg',      'url' => null],
        ['name' => 'Plenty River Plumbing', 'logo' => 'assets/images/partners/plenty-river.jpg',     'url' => null],
        ['name' => 'Road Runner Chassis',   'logo' => 'assets/images/partners/road-runner.jpg',      'url' => null],
        ['name' => 'Swift Appliance Group', 'logo' => 'assets/images/partners/swift.jpg',            'url' => null],
        ['name' => 'MPC Mags and Tyres',    'logo' => 'assets/images/partners/mpc.jpg',              'url' => null],
        ['name' => 'Coast to Coast',        'logo' => 'assets/images/partners/coast-to-coast.jpg',   'url' => null],
        ['name' => 'NCE',                   'logo' => 'assets/images/partners/nce.jpg',              'url' => null],
        ['name' => 'Aussie Traveller',      'logo' => 'assets/images/partners/aussie-traveller.jpg', 'url' => null],
        ['name' => 'Camec',                 'logo' => 'assets/images/partners/camec.jpg',            'url' => null],
        ['name' => 'Thetford',              'logo' => 'assets/images/partners/thetford.jpg',         'url' => null],
        ['name' => 'Adelaide Bank',         'logo' => 'assets/images/partners/adelaide-bank.webp',   'url' => null],
    ];
    // =============================================
@endphp

<section class="ev-partners" aria-labelledby="evPartnersTitle">
    {{-- Background elements --}}
    <span class="ev-partners__topo ev-partners__topo--a" aria-hidden="true"></span>
    <span class="ev-partners__topo ev-partners__topo--b" aria-hidden="true"></span>
    <span class="ev-partners__dots" aria-hidden="true"></span>

    <div class="ev-partners__inner">

        <header class="ev-partners__head">
            <p class="ev-partners__eyebrow">Our Partners</p>
            <h2 class="ev-partners__title" id="evPartnersTitle">Built with Australia&rsquo;s best caravan brands.</h2>
            <p class="ev-partners__text">We work with trusted suppliers so every Everest van is fitted with parts that last on the road.</p>
        </header>

        <ul class="ev-partners__grid">
            @foreach ($epPartners as $p)
                @php
                    $epLogo = file_exists(public_path($p['logo'])) ? asset($p['logo']) : null;
                    $epTag  = $p['url'] ? 'a' : 'div';
                @endphp
                <li class="ev-partners__item">
                    <{{ $epTag }} class="ev-partners__cell"
                        @if ($p['url']) href="{{ $p['url'] }}" target="_blank" rel="noopener" aria-label="{{ $p['name'] }} (opens in a new tab)" @endif>
                        @if ($epLogo)
                            <img src="{{ $epLogo }}" alt="{{ $p['name'] }}" loading="lazy" decoding="async">
                        @else
                            {{-- No image yet: show the name so the grid never has an empty or broken cell --}}
                            <span class="ev-partners__name">{{ $p['name'] }}</span>
                        @endif
                    </{{ $epTag }}>
                </li>
            @endforeach
        </ul>

    </div>
</section>



    <!--====== [reer] ======-->






    </section>


@endsection

@section('js_after')
    <script src="{{ asset('assets/js/hero-slider.js') }}"></script>
    <script src="{{ asset('assets/js/about-reveal.js') }}"></script>
    <script src="{{ asset('assets/js/reveal.js') }}"></script>
    <script>
        var rightImageUrl = "{{ asset('assets/abreco/images/shapes/right.svg') }}";
    </script>
    <!-- Frist truck slider -->
    <script>
        //  $('#form-Popup-veh').submit(function(event) {

        //         var response = grecaptcha.getResponse();
        //         alert(response);
        //             if (response.length === 0) {
        //                 alert("Please complete the reCAPTCHA before submitting the form.");
        //                 event.preventDefault(); // Prevent form submission
        //             }
        //     });


        (function($) {
            $.fn.stack_slider = function(options) {
                // Sldier core functions
                $(".slider-next").click(function() {
                    var total = $(".intro-slide").length;
                    $("#intro-slider .intro-slide:first-child")
                        .hide()
                        .appendTo("#intro-slider")
                        .fadeIn();
                    $.each($(".intro-slide"), function(index, dp_item) {
                        $(dp_item).attr("data-position", index + 1);
                    });
                });
                $("body").on(
                    "click",
                    "#intro-slider .intro-slide:not(:first-child)",
                    function() {
                        var get_slide = $(this).attr("data-class");
                        console.log(get_slide);
                        $("#intro-slider .intro-slide[data-class=" + get_slide + "]")
                            .hide()
                            .prependTo("#intro-slider")
                            .fadeIn();
                        $.each($(".intro-slide"), function(index, dp_item) {
                            $(dp_item).attr("data-position", index + 1);
                        });
                    }
                );
                // Drag
                $.fn.swipe = function(callback) {
                    var touchDown = false,
                        originalPosition = null,
                        $el = jQuery(this);

                    function swipeInfo(event) {
                        var x = event.originalEvent.pageX,
                            y = event.originalEvent.pageY,
                            dx;

                        dx = x > originalPosition.x ? "right" : "left";

                        return {
                            direction: {
                                x: dx
                            },
                            offset: {
                                x: x - originalPosition.x
                            }
                        };
                    }

                    $el.on("touchstart mousedown", function(event) {
                        touchDown = true;
                        originalPosition = {
                            x: event.originalEvent.pageX,
                            y: event.originalEvent.pageY
                        };
                    });

                    $el.on("touchend mouseup", function() {
                        touchDown = false;
                        originalPosition = null;
                        flag = true;
                    });

                    $el.on("touchmove mousemove", function(event) {
                        if (!touchDown) {
                            return;
                        }
                        var info = swipeInfo(event);
                        callback(info.direction, info.offset);
                    });

                    return true;
                };
                // disabel image drag
                $("#slider img").on("dragstart", function(event) {
                    event.preventDefault();
                });
                // Slider Methods
                // This is the easiest way to have default options.
                var settings = $.extend({
                        // These are the defaults.
                        color: "transparent",
                        background: "transparent",
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        dots: true,
                        arrows: true,
                        drag: true,
                        direction: "horizontal"
                    },
                    options
                );

                // dots
                if (settings.dots !== true) {
                    $("#dp-dots").hide();
                }
                // drag
                if (settings.drag == true) {
                    // trigger next prev on drag
                    var flag = true;
                    jQuery(".intro-slide").swipe(function(direction, offset) {
                        if (offset.x > 30 && flag) {
                            flag = false;
                            $(".slider-next").click();
                        }
                        if (offset.x < -30 && flag) {
                            flag = false;
                            $(".slider-prev").click();
                        }
                    });
                }
                // arrows
                if (settings.arrows !== true) {
                    $(".slider-next, .slider-prev").hide();
                }
                // slider autoplay
                if (settings.autoPlay == true) {
                    setInterval(function() {
                        $(".slider-next").click();
                    }, settings.autoPlaySpeed);
                }

                //slider direction
                if (settings.direction == "vertical") {
                    $(".slider-wrap").addClass("vertical");
                }

                // stack_slider the collection based on the settings variable.
                return this.css({
                    color: settings.color,
                    background: settings.background
                });
            };
        })(jQuery);

        $("#slider").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: true,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });
    </script>

    <!-- Second Truck Slider -->
    <script>
        (function($) {
            $.fn.stack_slider = function(options) {
                // Sldier core functions
                $(".slider-next2").click(function() {
                    var total = $(".intro-slide2").length;
                    $("#intro-slider2 .intro-slide2:first-child")
                        .hide()
                        .appendTo("#intro-slider2")
                        .fadeIn();
                    $.each($(".intro-slide2"), function(index, dp_item) {
                        $(dp_item).attr("data-position", index + 1);
                    });
                });
                $("body").on(
                    "click",
                    "#intro-slider2 .intro-slide2:not(:first-child)",
                    function() {
                        var get_slide = $(this).attr("data-class");
                        console.log(get_slide);
                        $("#intro-slider2 .intro-slide2[data-class=" + get_slide + "]")
                            .hide()
                            .prependTo("#intro-slider2")
                            .fadeIn();
                        $.each($(".intro-slide2"), function(index, dp_item) {
                            $(dp_item).attr("data-position", index + 1);
                        });
                    }
                );
                // Drag
                $.fn.swipe = function(callback) {
                    var touchDown = false,
                        originalPosition = null,
                        $el = jQuery(this);

                    function swipeInfo(event) {
                        var x = event.originalEvent.pageX,
                            y = event.originalEvent.pageY,
                            dx;

                        dx = x > originalPosition.x ? "right" : "left";

                        return {
                            direction: {
                                x: dx
                            },
                            offset: {
                                x: x - originalPosition.x
                            }
                        };
                    }

                    $el.on("touchstart mousedown", function(event) {
                        touchDown = true;
                        originalPosition = {
                            x: event.originalEvent.pageX,
                            y: event.originalEvent.pageY
                        };
                    });

                    $el.on("touchend mouseup", function() {
                        touchDown = false;
                        originalPosition = null;
                        flag = true;
                    });

                    $el.on("touchmove mousemove", function(event) {
                        if (!touchDown) {
                            return;
                        }
                        var info = swipeInfo(event);
                        callback(info.direction, info.offset);
                    });

                    return true;
                };
                // disabel image drag
                $("#slider img").on("dragstart", function(event) {
                    event.preventDefault();
                });
                // Slider Methods
                // This is the easiest way to have default options.
                var settings = $.extend({
                        // These are the defaults.
                        color: "transparent",
                        background: "transparent",
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        dots: true,
                        arrows: true,
                        drag: true,
                        direction: "horizontal"
                    },
                    options
                );

                // dots
                if (settings.dots !== true) {
                    $("#dp-dots").hide();
                }
                // drag
                if (settings.drag == true) {
                    // trigger next prev on drag
                    var flag = true;
                    jQuery(".intro-slide2").swipe(function(direction, offset) {
                        if (offset.x > 30 && flag) {
                            flag = false;
                            $(".slider-next2").click();
                        }
                        if (offset.x < -30 && flag) {
                            flag = false;
                            $(".slider-prev").click();
                        }
                    });
                }
                // arrows
                if (settings.arrows !== true) {
                    $(".slider-next2, .slider-prev").hide();
                }
                // slider autoplay
                if (settings.autoPlay == true) {
                    setInterval(function() {
                        $(".slider-next2").click();
                    }, settings.autoPlaySpeed);
                }

                //slider direction
                if (settings.direction == "vertical") {
                    $(".slider-wrap").addClass("vertical");
                }

                // stack_slider the collection based on the settings variable.
                return this.css({
                    color: settings.color,
                    background: settings.background
                });
            };
        })(jQuery);

        $("#slider2").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: true,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });
    </script>

    <!-- Third Truck Slider -->
    <!-- <script>
        (function($) {
            $.fn.stack_slider = function(options) {
                $(".slider-next3").click(function() {
                    var total = $(".intro-slide3").length;
                    $("#intro-slider3 .intro-slide3:first-child")
                        .hide()
                        .appendTo("#intro-slider3")
                        .fadeIn();
                    $.each($(".intro-slide3"), function(index, dp_item) {
                        $(dp_item).attr("data-position", index + 1);
                    });
                });
                $("body").on(
                    "click",
                    "#intro-slider3 .intro-slide3:not(:first-child)",
                    function() {
                        var get_slide = $(this).attr("data-class");
                        console.log(get_slide);
                        $("#intro-slider3 .intro-slide3[data-class=" + get_slide + "]")
                            .hide()
                            .prependTo("#intro-slider3")
                            .fadeIn();
                        $.each($(".intro-slide3"), function(index, dp_item) {
                            $(dp_item).attr("data-position", index + 1);
                        });
                    }
                );
                $.fn.swipe = function(callback) {
                    var touchDown = false,
                        originalPosition = null,
                        $el = jQuery(this);

                    function swipeInfo(event) {
                        var x = event.originalEvent.pageX,
                            y = event.originalEvent.pageY,
                            dx;

                        dx = x > originalPosition.x ? "right" : "left";

                        return {
                            direction: {
                                x: dx
                            },
                            offset: {
                                x: x - originalPosition.x
                            }
                        };
                    }

                    $el.on("touchstart mousedown", function(event) {
                        touchDown = true;
                        originalPosition = {
                            x: event.originalEvent.pageX,
                            y: event.originalEvent.pageY
                        };
                    });

                    $el.on("touchend mouseup", function() {
                        touchDown = false;
                        originalPosition = null;
                        flag = true;
                    });

                    $el.on("touchmove mousemove", function(event) {
                        if (!touchDown) {
                            return;
                        }
                        var info = swipeInfo(event);
                        callback(info.direction, info.offset);
                    });

                    return true;
                };
                $("#slider img").on("dragstart", function(event) {
                    event.preventDefault();
                });
                var settings = $.extend({
                        color: "transparent",
                        background: "transparent",
                        autoPlay: false,
                        autoPlaySpeed: 3000,
                        dots: true,
                        arrows: true,
                        drag: true,
                        direction: "horizontal"
                    },
                    options
                );

                if (settings.dots !== true) {
                    $("#dp-dots").hide();
                }
                if (settings.drag == true) {
                    var flag = true;
                    jQuery(".intro-slide3").swipe(function(direction, offset) {
                        if (offset.x > 30 && flag) {
                            flag = false;
                            $(".slider-next3").click();
                        }
                        if (offset.x < -30 && flag) {
                            flag = false;
                            $(".slider-prev").click();
                        }
                    });
                }
                if (settings.arrows !== true) {
                    $(".slider-next3, .slider-prev").hide();
                }
                if (settings.autoPlay == false) {
                    setInterval(function() {
                        $(".slider-next3").click();
                    }, settings.autoPlaySpeed);
                }
                if (settings.direction == "vertical") {
                    $(".slider-wrap").addClass("vertical");
                }
                return this.css({
                    color: settings.color,
                    background: settings.background
                });
            };
        })(jQuery);

        $("#slider3").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: false,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });
    </script> -->
    <script>
        (function ($) {
            $.fn.stack_slider = function (options) {
            // Sldier core functions
            $(".slider-next3").click(function () {
                var total = $(".intro-slide3").length;
                $("#intro-slider3 .intro-slide3:first-child")
                .hide()
                .appendTo("#intro-slider3")
                .fadeIn();
                $.each($(".intro-slide3"), function (index, dp_item) {
                $(dp_item).attr("data-position", index + 1);
                });
            });
            $("body").on(
                "click",
                "#intro-slider3 .intro-slide3:not(:first-child)",
                function () {
                var get_slide = $(this).attr("data-class");
                console.log(get_slide);
                $("#intro-slider3 .intro-slide3[data-class=" + get_slide + "]")
                    .hide()
                    .prependTo("#intro-slider3")
                    .fadeIn();
                $.each($(".intro-slide3"), function (index, dp_item) {
                    $(dp_item).attr("data-position", index + 1);
                });
                }
            );
            // Drag
            $.fn.swipe = function (callback) {
                var touchDown = false,
                originalPosition = null,
                $el = jQuery(this);

                function swipeInfo(event) {
                var x = event.originalEvent.pageX,
                    y = event.originalEvent.pageY,
                    dx;

                dx = x > originalPosition.x ? "right" : "left";

                return {
                    direction: {
                    x: dx
                    },
                    offset: {
                    x: x - originalPosition.x
                    }
                };
                }

                $el.on("touchstart mousedown", function (event) {
                touchDown = true;
                originalPosition = {
                    x: event.originalEvent.pageX,
                    y: event.originalEvent.pageY
                };
                });

                $el.on("touchend mouseup", function () {
                touchDown = false;
                originalPosition = null;
                flag = true;
                });

                $el.on("touchmove mousemove", function (event) {
                if (!touchDown) {
                    return;
                }
                var info = swipeInfo(event);
                callback(info.direction, info.offset);
                });

                return true;
            };
            // disabel image drag
            $("#slider img").on("dragstart", function (event) {
                event.preventDefault();
            });
            // Slider Methods
            // This is the easiest way to have default options.
            var settings = $.extend(
                {
                // These are the defaults.
                color: "transparent",
                background: "transparent",
                autoPlay: true,
                autoPlaySpeed: 3000,
                dots: true,
                arrows: true,
                drag: true,
                direction: "horizontal"
                },
                options
            );

            // dots
            if (settings.dots !== true) {
                $("#dp-dots").hide();
            }
            // drag
            if (settings.drag == true) {
                // trigger next prev on drag
                var flag = true;
                jQuery(".intro-slide3").swipe(function (direction, offset) {
                if (offset.x > 30 && flag) {
                    flag = false;
                    $(".slider-next3").click();
                }
                if (offset.x < -30 && flag) {
                    flag = false;
                    $(".slider-prev").click();
                }
                });
            }
            // arrows
            if (settings.arrows !== true) {
                $(".slider-next3, .slider-prev").hide();
            }
            // slider autoplay
            if (settings.autoPlay == true) {
                setInterval(function () {
                $(".slider-next3").click();
                }, settings.autoPlaySpeed);
            }

            //slider direction
            if (settings.direction == "vertical") {
                $(".slider-wrap").addClass("vertical");
            }

            // stack_slider the collection based on the settings variable.
            return this.css({
                color: settings.color,
                background: settings.background
            });
            };
        })(jQuery);

        $("#slider3").stack_slider({
            autoPlaySpeed: 6000,
            autoPlay: false,
            dots: true,
            arrows: true,
            drag: true,
            direction: "vertical"
        });

    </script>
    <script type="text/javascript">
        jQuery('#home-slider-carousel').carousel({
            interval: 3000,
            autoplay: true
        });

        // FIXED HEADER
        $(document).ready(function() {

            var header = $(".header_area");
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= 1) {
                    header.addClass("cbp-af-header-shrink");
                } else {
                    header.removeClass("cbp-af-header-shrink");
                }
            });

            var header1 = $(".menu-section");
            $(window).scroll(function() {
                var scroll1 = $(window).scrollTop();
                if (scroll1 >= 1) {
                    header1.addClass("cbp-af-header-shrink");
                } else {
                    header1.removeClass("cbp-af-header-shrink");
                }
            });

        });
    </script>
    <script>
       $(document).ready(function() {
            // alert(1);
            // Listen for change event on the first select element

            $('#vehicle_type').on('change', function() {
                $('#vehicleApp').removeClass('d-none');
                var selectedType = $(this).val();

                // alert(selectedType);
                // Make an Ajax request to fetch vehicles based on the selected type
                if(selectedType){
                        $.ajax({
                         url: '{{ route('get-vehicle-application', ':type') }}'.replace(':type',
                        selectedType),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Clear the current options in the second select element
                            $('#vehicleApplications').removeClass('d-none');
                            $('#vehicleApplications').empty();
                            $('#vehicleApplications').append(
                                '<option value="">Select Application</option>');

                            // Populate the second select element with retrieved vehicles
                            $.each(data, function(index, vehicle) {
                                $('#vehicleApplications').append('<option value="' + vehicle
                                    .id + '">' + vehicle.name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Error loading vehicle application.');
                        }
                    });
                }

            });

            $('#vehicle_type_mobile').on('change', function() {
                $('#vehicleAppMobile').removeClass('d-none');
                var selectedType = $(this).val();
                // alert(selectedType);
                // Make an Ajax request to fetch vehicles based on the selected type
                if(selectedType){
                    $.ajax({
                        url: '{{ route('get-vehicle-application', ':type') }}'.replace(':type',
                            selectedType),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Clear the current options in the second select element
                            $('#vehicleApplicationsmobile').empty();
                            $('#vehicleApplicationsmobile').append(
                                '<option value="">Select Application</option>');
                            // Populate the second select element with retrieved vehicles
                            $.each(data, function(index, vehicle) {
                                $('#vehicleApplicationsmobile').append('<option value="' +
                                    vehicle.id + '">' + vehicle.name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Error loading vehicle application.');
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('.type-cliker').click(function() {
                // Get the value of the clicker-value attribute
                var customValue = $(this).attr('clicker');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('createslugfromvalue') }}', // Replace with the actual route to retrieve the new URL
                    data: {
                        customValue: customValue
                    },
                    success: function(newUrl) {

                        // Update the href attribute of the anchor element
                        $("#viewMore").attr("href", newUrl);
                    },
                    error: function() {
                        // Handle errors here
                    }
                });
            });
        });
    </script>
@endsection
