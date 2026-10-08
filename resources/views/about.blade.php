@extends('layouts.front')
@section('css_after')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap">
    {{-- ?v=mtime so an edit is never served from the browser cache --}}
    <link rel="stylesheet" href="{{ asset('assets/css/about2.css') }}?v={{ filemtime(public_path('assets/css/about2.css')) }}">
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'About Us',
        'subtitle'    => 'Family owned and Australian built. Every Everest caravan leaves our yard ready for the roads most vans never see.',
        'image'       => 'assets/abreco/images/29.jpg',
        'breadcrumbs' => [['label' => 'About Us']],
    ])

    <!--====== abreco About Group START ======-->
    {{-- Everest Caravans — About page, first section (story + mission / vision / values) --}}

    {{-- Font + CSS, loaded here so nothing else needs linking --}}
    @php
        $esCss = 'css/story.css';
        $esJs  = 'js/story.js';
    @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600&display=swap" rel="stylesheet">
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
            'button' => ['label' => 'Book a Factory Visit', 'url' => url('/contact')],

            // Slider on the left. Add as many slides as you like. 'caption' is optional.
            'slides' => [
                ['image' => 'assets/abreco/images/newonce/home21.jpg',        'alt' => 'An Everest caravan and tow vehicle parked at a painted silo',        'caption' => 'Built for the toughest tracks'],
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
                        <span>{{ $es['accent'] }}</span> {{ $es['title'] }}
                    </h2>
                    <span class="ev-story__rule" aria-hidden="true"><i></i><i></i></span>

                    @foreach ($es['paragraphs'] as $p)
                        <p class="ev-story__text">{{ $p }}</p>
                    @endforeach

                    <a class="ev-story__btn" href="{{ $es['button']['url'] }}">
                        {{ $es['button']['label'] }}
                        <svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                    </a>
                </div>
            </div>

            {{-- ================= BOTTOM: mission / vision / values ================= --}}
            <div class="ev-story__cols">
                @foreach ($esColumns as $c)
                    <article class="ev-story__col">
                        <div class="ev-story__col-head">
                            <span class="ev-story__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="22" height="22">{!! $c['icon'] !!}</svg>
                            </span>
                            <span class="ev-story__num" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span>
                        </div>
                        <h3>{{ $c['title'] }}</h3>
                        <p>{{ $c['text'] }}</p>
                    </article>
                @endforeach

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

    <!--====== abreco About Motors ======-->
  

    <!--====== abreco Counter PART START ======-->
    @if($counters->count() > 0)
        <section class="counter-area counter-area2 counter-about-area pt-120 pb-80">
            <div class="container">
                <div class="row">
                    @foreach ($counters as $key => $data)
                        <div class="col-lg-3 col-md-6 col-12 p-0-991">
                            @php
                                $key = $key + 1;
                            @endphp
                            <div class="conter-box conter-box{{$key}} conter_box">
                                <div class="count d-flex mt-2">
                                @if ($data->counter < 10)
                                        <span class="zero">0</span>
                                    @endif
                                    <div class="counter-item">{{ @$data->counter }}
                                            
                                    </div>
                                    <span>{{ $data->plus }}</span>
                                </div>
                                <div class="title">
                                    <h4>{{ $data->title }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!--====== Mission | Vision | Values ======-->
    @if($pages->count() > 0)
        <section class="mision-area section pt-100 pb-80">
            <div class="container">
                <div class="row">
                    @foreach ($pages as $page)
                        <div class="col-lg-4 col-md-6">
                            <div class="mision-box h-100">
                                <div class="icon">
                                    <img src="{{ asset('storage/'.$page->banner_image) }}" alt="">
                                </div>
                                <h2>{{@$page->title}}</h2>
                                <p>{!!@$page->content!!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--====== Founder Area ======-->
    <section class="founder-area pb-100 pt-80">
        <div class="left-img">
            <img src="{{ asset('assets/abreco/images/trucks/left-img.png') }}" alt="">
        </div>
        <div class="founder-inner d-flex align-items-center justify-content-between">
            <div class="founder-img">
                <div class="img">
                    <img src="{{ asset('assets/abreco/images/about-page/chairman2.jpg') }}" alt="">
                </div>
            </div>
            <div class="founder-text">
                <div class="head">
                    <h2>Accelerating Beyond Boundaries: A Pursuit of Innovation and Excellence</h2>
                </div>
                <div class="para">
                    <p>{!!@$ceo->details!!} </p>
                    <span class="name"> <b>{{@$ceo->name}}</b> <span class="designation">{{@$ceo->position}}</span></span>
                </div>
            </div>
        </div>
    </section>

    <!--====== Abreco Team Details ======-->
    <section class="abreco-team section pt-50 pb-120" id="Abreco-team">
        <div class="container">
            <div class="row mb-40">
                <div class="col-lg-3">
                    <div class="abt-logo abt-logo-new2 d-flex">
                        <div class="title title2">
                            <h2>{{@$group->sub_title}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 p-0-575">
                    <div class="abt-titlte abt-titlte2 abt-titlte20 p-15-575">
                        <p>{!!@$group->sub_content!!}</p>
                    </div>
                </div>
            </div>
        </div>
        @if($leaders->count() > 0)
            <div class="team-slider">
                <div class="owl-carousel">
                    @foreach ($leaders as $leader)
                        <div class="item">
                            <div class="img">
                                <img src="{{ asset('storage/'.@$leader->image) }}" alt="">
                            </div>
                            <div class="name">
                                <h3>{{@$leader->name}}</h3>
                                <span>{{@$leader->position}}</span>
                            </div>
                        </div>
                
                    @endforeach
                  
                </div>
            </div>
        @endif
    </section>

    <!--====== Abreco Global Pit Stops ======-->
    <section class="global-area">
        <div class="glob-img d-none d-block-575">
            <img src="{{ asset('assets/abreco/images/shapes/globe.webp') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-md-12 col-lg-8">
                    <div class="global-inner">
                        <h2>{{@$group->location_title}}</h2>
                        <p>{!!@$group->location_content!!}</p>
                        @if($locations->count() > 0)
                            <div class="global-points d-flex align-items-center justify-content-between">
                                @foreach ($locations as $location)
                                    <div class="bo-glo d-flex">
                                        <div class="img"><img src="{{ asset('storage/'.@$location->icon) }}"
                                                alt=""></div>
                                        <h4>{{@$location->name}}</h4>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco BLOG PART START ======-->
    <section class="abreco-blog-area pt-90 pb-95">
        <div class="container">
            @if($blogs->count() > 0)
                <div class="row">
                    <div class="col-lg-9">
                        <div class="abreco-section-title">
                            <h3 class="abreco-title">Drift Across Our Blogs</h3>
                            <p>We have jot together our stories and knowledge to keep you updated. Give it a quick drift....</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-6 col-md-12">
                            <div class="abreco-blog-item mt-30">
                                <div class="thumb">
                                <a href="{{ route('blog.details', $blog->slug) }}">
                                    <img src="{{  asset('storage/'.$blog->feature_image) }}" alt="">
                                </a>
                                </div>
                                <div class="content">
                                    <h3 class="title"><a href="{{route('blog.details',$blog->slug)}}">{{@$blog->title}}</a></h3>
                                    <p>{!! \Illuminate\Support\Str::limit(@$blog->details, $limit = 150, $end = '...') !!}</p>
                                    <a href="{{route('blog.details',$blog->slug)}}" class="blog-btn-home"><span>Read More</span> <i class="fal fa-chevron-right"></i><i
                                            class="fal fa-chevron-right"></i>
                                        <i class="fal fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach              
                </div>
            @endif
        </div>
    </section>

    <!--====== Contact PART START ======-->
    
    
@endsection

@section('js_after')
    <script></script>
@endsection
