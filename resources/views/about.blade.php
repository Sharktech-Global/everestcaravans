@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    <section class="abreco-inner-banner ken-burn"  style="background-image: url('{{ asset('storage/' . @$group->banner_image) }}');">
    <div class="about-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt="">
                            <!-- <div class="bg-lines bg-lines-1"><img src="{{ asset('assets/abreco/images/shapes/b-1.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-2"><img src="{{ asset('assets/abreco/images/shapes/b-2.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-3"><img src="{{ asset('assets/abreco/images/shapes/b-3.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-4"><img src="{{ asset('assets/abreco/images/shapes/b-4.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-5"><img src="{{ asset('assets/abreco/images/shapes/b-5.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-6"><img src="{{ asset('assets/abreco/images/shapes/b-6.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-7"><img src="{{ asset('assets/abreco/images/shapes/b-7.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-8"><img src="{{ asset('assets/abreco/images/shapes/b-8.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-9"><img src="{{ asset('assets/abreco/images/shapes/b-9.png') }}" alt=""></div>
                            <div class="bg-lines bg-lines-10"><img src="{{ asset('assets/abreco/images/shapes/b-10.png') }}" alt=""></div> -->
                        </div>
                        <h1>ABOUT ABRECO GROUP</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco About Group START ======-->
    <section class="abreco-service-area abreco-group-about pt-110 pb-90" id="abreco-Group">
        <div class="container">
            <div class="row mb-40">
                <!-- <div class="col-lg-4">
                    <div class="abt-logo abt-logo2 d-flex">
                        <div class="title title2">
                            <h2>
                            <div class="head-icon d-none d-inline-block-991">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="43" viewBox="0 0 38 43" fill="none">
                                <path d="M21.7307 0H26.1743L15.93 43H11.2178L21.7307 0Z" fill="black"/>
                                <path d="M32.9475 0H37.3911L27.1468 43H22.4346L32.9475 0Z" fill="black"/>
                                <path d="M10.5129 0H14.9565L4.71223 43H0L10.5129 0Z" fill="black"/>
                            </svg> 
                            </div>
                                {{ @$group->title }}</h2>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12 p-0-575">
                    <div class="abt-titlte abt-titlte2 abt-titlte20 p-15-575 pl-0">
                        <p>{!! @$group->content !!}</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <div class="abt-bg">
                        <img src="{{ asset('storage/' . @$group->content_image_one) }}" alt="" class="w-100">
                        <div class="abt-video">
                            <a href="{{ @$group->link }}" data-fancybox="images">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="48" viewBox="0 0 36 48"
                                    fill="none">
                                    <path
                                        d="M2 42.0457V5.95431C2 2.66657 5.74609 0.782778 8.3853 2.74334L32.6775 20.789C34.8305 22.3884 34.8305 25.6116 32.6775 27.211L8.3853 45.2566C5.74609 47.2172 2 45.3334 2 42.0457Z"
                                        fill="white" stroke="white" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco About Motors ======-->
    <section class="abreco-service-area pt-110 pb-90 d-none" id="abreco-Motors">
        <div class="container">
            <div class="row mb-40">
                <div class="col-lg-3">
                    <div class="abt-logo abt-logo2 d-flex">
                        <div class="title title2">
                            <h2>{{ @$motors->title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 p-0-575">
                    <div class="abt-titlte abt-titlte2 abt-titlte20 p-15-575">
                        <p>{!! @$motors->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
