@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <section class="abreco-inner-banner news-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="assets/images/shapes/banner-head.png" alt="">
                        </div>
                        <h1>The Evolution Of Tata Motors</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco BLOG PART START ======-->
    <section class="abreco-blog-area pt-90 pb-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 custom-offset-right">
                    <div class="date-section">
                        <ul>
                            <li><span><i class="fa fa-calendar mr-2"></i></span> Jun 20,2023</li>
                            <li><span><i class="fa fa-map-marker mr-2"></i></span> Kozhikode</li>
                        </ul>
                    </div>
                    <div class="abreco-section-title">
                        <h3 class="abreco-title">The Introduction</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur vero obcaecati at molestias
                            iure vitae eligendi quia nobis voluptatem vel est fuga quidem voluptas reiciendis, animi
                            blanditiis eius maiores modi amet dolor voluptates hic sed. Officia aliquid, fugiat, adipisci ut
                            expedita aperiam ab at ducimus suscipit deserunt ipsa dolorum magnam.</p>
                    </div>
                    <div class="row">
                        {{--  <div class="col-lg-6 col-md-12">
                            <div class="abreco-blog-item mt-30">
                                <div class="thumb">
                                    <img src="assets/images/blog/1.jpg" alt="">
                                </div>
                            </div>
                        </div>  --}}
                        <div class="col-lg-12 col-md-12">
                            <div class="abreco-blog-item mt-30">
                                <div class="thumb">
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-50 pb-50 news-blokquote">
                            <blockquote class="text-center">
                                <q>{{ @$news->title }}</q>
                                <a href="#">– Joshua J. Marine</a>
                            </blockquote>
                            <p class="pt-60">{{ @$news->content }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidemenu-news">
                        <div class="head">
                            <h3>Other Newsrooms</h3>
                        </div>
                        <ul class="side-lists">
                            @if (@$relatedPosts)
                                @foreach (@$relatedPosts as $post)
                                    <li>
                                        <figure>
                                            <a href={{ route('news.show',$post->slug) }}><img src="{{ asset('storage/'.$post->image) }}"
                                                    alt=""></a>
                                        </figure>
                                        <div class="post-text">
                                            <h6><a href={{ route('news.show',$post->slug) }}>{{ substr($post->title, 0, 30) }}</a>
                                            </h6>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_after')
    <script></script>
@endsection
