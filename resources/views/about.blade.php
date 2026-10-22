@extends('layouts.front')
@section('css_after')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap">
    {{-- ?v=mtime so an edit is never served from the browser cache --}}
    <link rel="stylesheet" href="{{ asset('assets/css/about2.css') }}?v={{ filemtime(public_path('assets/css/about2.css')) }}">
    {{-- .ws-about ("Who we are") is shared with the home page and its rules live here --}}
    <link rel="stylesheet" href="{{ asset('assets/css/home2.css') }}?v={{ filemtime(public_path('assets/css/home2.css')) }}">
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'About Us',
        'subtitle'    => 'Family owned and Australian built. Every Everest caravan leaves our yard ready for the roads most vans never see',
        'image'       => 'assets/abreco/images/newonce/about-main.jpg',
        'breadcrumbs' => [['label' => 'About Us']],
    ])

    <!--====== abreco About Group START ======-->
    {{-- Everest Caravans — About page, first section (story + mission / vision / values) --}}

    {{-- Font + CSS, loaded here so nothing else needs linking --}}
    @php
        $esCss = 'css/story.css';
        $esJs  = 'js/story.js';
    @endphp
    @if (file_exists(public_path($esCss)))
        <link rel="stylesheet" href="{{ asset($esCss) }}?v={{ filemtime(public_path($esCss)) }}">
    @else
        <!-- EVEREST: public/{{ $esCss }} not found -->
    @endif

    @php
        // ===================== EDIT HERE =====================
        $es = [
            'accent' => 'A reputation',             // coloured part of the title
            'title'  => '15+ years in the making',
            'paragraphs' => [
                'Everest Caravans is a family owned business with over 15 years experience in the caravan industry, and the business continues to grow.',
                'We pride ourselves on premium quality, custom built caravans. We use the highest quality materials, and our manufacturing process ensures every van is built to the highest standard and meets regulations. Our team hits the road often, so we know exactly what a van needs to handle the Gibb River, Oodnadatta and the Nullarbor.',
            ],

            // Button under the text
            'button' => ['label' => 'Book a Factory Visit', 'url' => route('factory-visit.show')],

            // Slider on the left. Add as many slides as you like. 'caption' is optional.
            'slides' => [
                ['image' => 'assets/abreco/images/newonce/home-ban21.jpg',    'alt' => 'A family camped beside their Everest caravan in the outback',       'caption' => 'Built for the toughest tracks'],
                ['image' => 'assets/abreco/images/vehicles/build-van-17.jpeg', 'alt' => 'An Everest caravan shell being built on the factory floor',          'caption' => 'Made in Campbellfield, VIC'],
                ['image' => 'assets/images/about/who-we1.jpg',                 'alt' => 'A finished Everest Alpine Quattro in the factory yard',              'caption' => 'Finished to your spec'],
                ['image' => 'assets/images/about/who-we2.jpg',                 'alt' => 'The A-frame of a finished Everest van, with gas bottles and stone guard', 'caption' => 'Quality checked before delivery'],
            ],
            'autoplay' => 5000,   // ms per slide; 0 = no autoplay
        ];

        $esColumns = [
            [
                'title' => 'Mission statement',
                'icon'  => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.2"/><path d="M12 3V1M21 12h2"/>',
                'text'  => 'To build premium, custom off-road caravans that are engineered for the toughest Australian terrain, finished to feel like home, and backed by our team for the life of the van.',
            ],
            [
                'title' => 'Our vision',
                'icon'  => '<path d="M2 19 9 8l4 6 3-4 6 9z"/><path d="m9 8 1.6 2.4L12 9"/>',
                'text'  => 'To be Australia’s most trusted name in off-road caravans, known for quality you can see, a build process you can follow and a team that stands behind every van we deliver.',
            ],
        ];

        // Third column is a photo rather than text, filling the whole column
        $esColImage    = 'assets/abreco/images/newonce/about121.jpg';
        $esColImageAlt = 'A finished Everest Pinnacle caravan outside the factory, side door open';
        // =====================================================

        $esImg = fn ($p) => ($p && file_exists(public_path($p))) ? asset($p) : null;
    @endphp

    <section class="ev-story" aria-labelledby="evStoryTitle">
        <div class="ev-story__inner">

            {{-- ================= TOP: photos + story ================= --}}
            <div class="ev-story__top">

                {{-- Image slider --}}
                @php $esCount = count($es['slides']); @endphp
                <div class="ev-story__slider" data-ev-slider data-autoplay="{{ $es['autoplay'] }}"
                     role="region" aria-roledescription="carousel" aria-label="Everest Caravans photos">
                    <div class="ev-story__slides">
                        @foreach ($es['slides'] as $i => $slide)
                            <figure class="ev-story__slide {{ $i === 0 ? 'is-active' : '' }}"
                                    role="group" aria-roledescription="slide" aria-label="{{ $i + 1 }} of {{ $esCount }}"
                                    @if ($i !== 0) aria-hidden="true" @endif>
                                @if ($esImg($slide['image']))
                                    <img src="{{ $esImg($slide['image']) }}" alt="{{ $slide['alt'] }}"
                                         decoding="async" @if ($i === 0) fetchpriority="high" @else loading="lazy" @endif>
                                @endif
                                @if (!empty($slide['caption']))
                                    <figcaption>{{ $slide['caption'] }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>

                    @if ($esCount > 1)
                        <div class="ev-story__controls">
                            <div class="ev-story__dots">
                                @foreach ($es['slides'] as $i => $slide)
                                    <button type="button" class="ev-story__dot {{ $i === 0 ? 'is-active' : '' }}"
                                            data-ev-goto="{{ $i }}" aria-label="Show photo {{ $i + 1 }}"
                                            @if ($i === 0) aria-current="true" @endif></button>
                                @endforeach
                            </div>
                            <div class="ev-story__arrows">
                                <button type="button" class="ev-story__arrow" data-ev-prev aria-label="Previous photo">
                                    <svg viewBox="0 0 20 20" width="18" height="18" aria-hidden="true"><path d="M16 10H5m4-4-4 4 4 4"/></svg>
                                </button>
                                <button type="button" class="ev-story__arrow" data-ev-next aria-label="Next photo">
                                    <svg viewBox="0 0 20 20" width="18" height="18" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="ev-story__copy">
                    <h2 class="ev-story__title" id="evStoryTitle">
                        <span>{{ @$group->title }}</span> {{ @$group->sub_title }}
                    </h2>
                    <span class="ev-story__rule" aria-hidden="true"><i></i><i></i></span>

                    <div class="ev-story__text">{!! @$group->content !!}</div>

                    <a class="ev-story__btn" href="{{ $es['button']['url'] }}">
                        {{ $es['button']['label'] }}
                        <svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                    </a>
                </div>
            </div>

            {{-- ================= BOTTOM: mission / vision / values ================= --}}
            <div class="ev-story__cols">
                @if($pages->count() > 0)
                    @foreach ($pages as $page)
                        <article class="ev-story__col">
                            <div class="ev-story__col-head">
                                <span class="ev-story__icon" aria-hidden="true">
                                    <img src="{{ asset('storage/'.$page->banner_image) }}" alt="">
                                </span>
                                <span class="ev-story__num" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span>
                            </div>
                            <h3>{{@$page->title}}</h3>
                            <p>{!!@$page->content!!}</p>
                        </article>
                    @endforeach
                @endif
                {{-- Third column is the photo: no head, no heading, edge to edge --}}
                @if ($esImg($esColImage))
                    <article class="ev-story__col ev-story__col--media">
                        <img src="{{ $esImg($esColImage) }}" alt="{{ $esColImageAlt }}"
                             loading="lazy" decoding="async">
                    </article>
                @endif
            </div>

        </div>
    </section>

    @if (file_exists(public_path($esJs)))
        <script src="{{ asset($esJs) }}?v={{ filemtime(public_path($esJs)) }}" defer></script>
    @endif

    <!--====== Who are us ======-->
    {{-- Everest — "Who we are" with service tabs (tabs switch the quote + image)
         Same section as the home page; its CSS lives in assets/css/home2.css,
         which this page links in css_after. --}}
    @php
        $wsJs = 'js/about-services.js';

        // ================= EDIT CONTENT HERE =================
        $wsAbout = [
            'eyebrow' => 'Who We Are',
            'title'   => 'Premium Custom Caravans, Built to the Highest Standard',
            'text'    => 'Everest Caravans is a family owned business with over 15 years experience in the caravan industry. We use the highest quality materials, and our manufacturing process ensures every van is built to the highest standard and meets regulations.',
            // Home sends this to /about; we are already on /about, so it points at contact instead
            'button'  => ['label' => 'Talk to Us', 'url' => url('/contact')],
            'bg'      => null,                                  // stats panel background; null = reuse the main photo
            'photo'   => 'assets/images/about/who-we1.jpg',        // large photo, top left
            'photo2'  => 'assets/images/about/who-we2.jpg',        // smaller photo, overlapping bottom right
        ];

        // One entry per tab. Clicking a tab swaps the quote text and image.
        $wsServices = [
             [
            'label' => 'OFF-GRID',
            'icon'  => '<path d="M2 20 8 10l4 6 3-4 7 8z"/><circle cx="17" cy="6" r="2"/>',
            'title' => 'Engineered for off-road',
            'text'  => 'Why stop where the power ends? With solar, lithium batteries and big water tanks on board, our vans let you camp for days in the places caravan parks can’t reach. No power point, no problem.',
            'image' => 'assets/abreco/images/newonce/off-grid.webp',
        ],
        [
            'label' => 'Lux Decor',
            'icon'  => '<path d="M5 11V8a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"/><path d="M3 18v-5a2 2 0 0 1 4 0v2h10v-2a2 2 0 0 1 4 0v5z"/><path d="M5 18v2M19 18v2"/>',
            'title' => 'Customised from the inside out',
            'text'  => 'Every Everest is built on a hot-dipped galvanised chassis and wrapped in checker-plate armour. It’s why we back our vans with a 5-year structural warranty. We build them to last for decades of big laps, not just one.',
            'image' => 'assets/abreco/images/newonce/lux.jpg',
        ],
        [
            'label' => 'Custom Build',
            'icon'  => '<path d="M12 3 20 6v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>',
            'title' => 'Strict quality control',
            'text'  => 'No two adventures are the same, so no two Everests need to be. Choose your layout, finishes and features, and we’ll build a van around the way your family actually travels.',
            'image' => 'assets/images/services/quality.jpeg',
        ],
        ];
        // =====================================================

        $wsImg = fn ($path) => ($path && file_exists(public_path($path))) ? asset($path) : null;
        $wsPanelBg = $wsImg($wsAbout['bg']) ?? $wsImg($wsAbout['photo']);
    @endphp

    <section class="ws-about" aria-labelledby="wsAboutTitle">
        <div class="ws-about__inner">

            {{-- Heading lives outside the copy column so the photos can sit
                 between it and the body text when the grid stacks --}}
            <div class="ws-about__head">
                <p class="ws-about__eyebrow">{{ $wsAbout['eyebrow'] }}</p>
                <h2 class="ws-about__title" id="wsAboutTitle">{{ $wsAbout['title'] }}</h2>
            </div>

            {{-- Photos --}}
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

            {{-- Copy, button, service tabs --}}
            <div class="ws-about__content">
                <p class="ws-about__text">{{ $wsAbout['text'] }}</p>

                <div class="ws-about__cta">
                    <a class="ws-about__btn" href="{{ $wsAbout['button']['url'] }}">{{ $wsAbout['button']['label'] }} <svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg></a>
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

    <!--====== Built in Melbourne, tested across Australia ======-->
    {{-- Everest Caravans — "Built in Melbourne, tested across Australia" (About page)
         Fonts are the site pair (Space Grotesk + Poppins), both already loaded
         in the layout head / this page's css_after, so none is requested here. --}}
    @php $eaCss = 'css/australia.css'; @endphp
    @if (file_exists(public_path($eaCss)))
        <link rel="stylesheet" href="{{ asset($eaCss) }}?v={{ filemtime(public_path($eaCss)) }}">
    @else
        <!-- EVEREST: public/{{ $eaCss }} not found -->
    @endif

    @php
        // ===================== EDIT HERE =====================
        $ea = [
            'eyebrow' => 'Across Australia',
            'title'   => 'Built in Melbourne, tested across Australia',
            'text'    => 'Built at our Campbellfield factory and proven on Australia’s toughest tracks, so your van is ready for wherever you head next.',
            'map'     => 'assets/abreco/images/newonce/australia-map-light.svg',   // use australia-map-dark.svg on a light background
            'bg'      => 'assets/abreco/images/newonce/austever.jpg',             // background photo (dark gradient goes on top)
        ];

        // Pins on the map. x / y = position on the map in %.
        $eaPins = [
            ['name' => 'Campbellfield, VIC',  'tag' => 'Factory & showroom', 'x' => 76.7, 'y' => 80.5, 'main' => true],
            ['name' => 'Gibb River Road, WA', 'tag' => 'Tested here',         'x' => 33.5, 'y' => 20.3, 'main' => false],
            ['name' => 'Oodnadatta Track, SA','tag' => 'Tested here',         'x' => 54.5, 'y' => 51.6, 'main' => false],
            ['name' => 'Nullarbor Plain',     'tag' => 'Tested here',         'x' => 41.9, 'y' => 62.6, 'main' => false],
        ];
        // =====================================================

        $eaMap = file_exists(public_path($ea['map'])) ? asset($ea['map']) : null;
        $eaBg  = file_exists(public_path($ea['bg']))  ? asset($ea['bg'])  : null;
    @endphp

    <section class="ev-aus" aria-labelledby="evAusTitle">
        @if ($eaBg)
            <img class="ev-aus__bg" src="{{ $eaBg }}" alt="" loading="lazy" decoding="async">
        @endif
        <span class="ev-aus__shade" aria-hidden="true"></span>

        <div class="ev-aus__inner">

            {{-- LEFT: dotted map with pins --}}
            <div class="ev-aus__map">
                @if ($eaMap)
                    <img src="{{ $eaMap }}" alt="Map of Australia showing the Everest factory and test tracks" loading="lazy" decoding="async">
                @endif
                @foreach ($eaPins as $p)
                    <span class="ev-aus__pin {{ $p['main'] ? 'is-main' : '' }}"
                          style="left: {{ $p['x'] }}%; top: {{ $p['y'] }}%;" aria-hidden="true">
                        <span class="ev-aus__dot"></span>
                        <span class="ev-aus__label">{{ $p['name'] }}</span>
                    </span>
                @endforeach
            </div>

            {{-- RIGHT: content --}}
            <div class="ev-aus__content">
                <p class="ev-aus__eyebrow">{{ $ea['eyebrow'] }}</p>
                <h2 class="ev-aus__title" id="evAusTitle">{{ $ea['title'] }}</h2>
                <p class="ev-aus__text">{{ $ea['text'] }}</p>

                <ul class="ev-aus__places">
                    @foreach ($eaPins as $p)
                        <li class="{{ $p['main'] ? 'is-main' : '' }}">
                            <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><path d="M20 10c0 6.5-8 12-8 12s-8-5.5-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>
                                <strong>{{ $p['name'] }}</strong>
                                <small>{{ $p['tag'] }}</small>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
    <!--====== FAQ ======-->
    {{-- Everest Caravans — FAQ (image + accordion)
         Fonts are the site pair (Space Grotesk + Poppins), both already loaded
         in the layout head / this page's css_after, so none is requested here. --}}
    @php $efqCss = 'css/faq.css'; @endphp
    @if (file_exists(public_path($efqCss)))
        <link rel="stylesheet" href="{{ asset($efqCss) }}?v={{ filemtime(public_path($efqCss)) }}">
    @else
        <!-- EVEREST: public/{{ $efqCss }} not found -->
    @endif

    @php
        // ===================== EDIT HERE =====================
        $efq = [
            'eyebrow' => 'FAQ',
            'title'   => 'Get answers to your questions',
            'button'  => ['label' => 'Ask a Question', 'url' => url('/contact')],
            'image'   => 'assets/abreco/images/newonce/faq.jpg',          // landscape, ~1200×800
        ];

        // First item opens by default
        $efqItems = [
            ['q' => 'Can I customise my caravan?',
             'a' => 'Yes. Every Everest van is custom built. You can choose the layout, features and interior finishes, then come into our showroom to select your one-of-a-kind interior.'],
            ['q' => 'Are Everest caravans built for off-road travel?',
             'a' => 'They are engineered for purpose. Our team hits the road often, and our vans handle tough terrain such as the Gibb River Road, the Oodnadatta Track and the Nullarbor.'],
            ['q' => 'Can I visit your factory?',
             'a' => 'Of course. Our display and manufacturing facility is at 51 Glenbarry Road, Campbellfield VIC 3061, only 20 minutes from Melbourne Airport.'],
            ['q' => 'What warranty do you offer?',
             'a' => 'Every Everest caravan comes with a 5 year structural warranty.'],
            ['q' => 'Do you provide after-sales service?',
             'a' => 'Yes. We are the manufacturer and the dealer, so you deal with us from the point of sale through delivery, handover and after-care, for the life of your caravan.'],
            ['q' => 'Do your caravans meet Australian regulations?',
             'a' => 'Yes. We use the highest quality materials, and every van goes through our strict quality control process before it is delivered.'],
        ];
        // =====================================================

        $efqImg = file_exists(public_path($efq['image'])) ? asset($efq['image']) : null;
    @endphp

    <section class="ev-faq" aria-labelledby="evFaqTitle">
        <div class="ev-faq__inner">

            {{-- LEFT: heading, link, image --}}
            <div class="ev-faq__intro">
                <p class="ev-faq__eyebrow">{{ $efq['eyebrow'] }}</p>
                <h2 class="ev-faq__title" id="evFaqTitle">{{ $efq['title'] }}</h2>

                <a class="ev-faq__link" href="{{ $efq['button']['url'] }}">
                    {{ $efq['button']['label'] }}
                    <svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M5 15 15 5M7 5h8v8"/></svg>
                </a>

                @if ($efqImg)
                    <div class="ev-faq__media">
                        <img src="{{ $efqImg }}" alt="An Everest Warrior caravan and tow vehicle at the Nullarbor Plain sign" loading="lazy" decoding="async">
                    </div>
                @endif
            </div>

            {{-- RIGHT: accordion (native <details>, only one open at a time) --}}
            <div class="ev-faq__list">
                @foreach ($faqs as $data)
                    <details class="ev-faq__item" name="ev-faq" @if ($loop->first) open @endif>
                        <summary>
                            <span class="ev-faq__num">{{ sprintf('%02d', $loop->iteration) }}</span>
                            <span class="ev-faq__q">{{ @$data->title }}</span>
                            <span class="ev-faq__icon" aria-hidden="true"></span>
                        </summary>
                        <div class="ev-faq__a"><p>{!! @$data->description !!}</p></div>
                    </details>
                @endforeach
            </div>

        </div>
    </section>
@endsection

@section('js_after')
    <script></script>
@endsection
