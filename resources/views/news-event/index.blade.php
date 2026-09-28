@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    <section class="abreco-inner-banner news-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="assets/images/shapes/banner-head.png" alt="">
                        </div>
                        <h1>Latest Updates</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco BLOG PART START ======-->
    <section class="abreco-blog-area pt-90 pb-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="abreco-section-title">
                        <h3 class="abreco-title">Our Lastest Updates</h3>
                        <p>We have jot together our stories and knowledge to keep you updated. Give it a quick drift....</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($news as $data)
                    <div class="col-lg-6 col-md-12">
                        <div class="abreco-blog-item mt-30">
                            <div class="thumb">
                             
                                <img src="{{ asset('storage/'.$data->image) }}" alt="">
                            </div>
                            <div class="content">
                                <h3 class="title"><a href="{{ route('news.show',$data->slug) }}">{{ @$data->title }}</a></h3>
                                <p>{{ @$data->content }}</p>
                                <a href="{{ route('news.show',$data->slug) }}"><span>Read More</span> <i class="fal fa-chevron-right"></i><i
                                        class="fal fa-chevron-right"></i>
                                    <i class="fal fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js_after')
    <script></script>
@endsection
