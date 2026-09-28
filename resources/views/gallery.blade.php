@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <!--====== Gallery Breadcrumb Part ======-->
    <section class="abreco-inner-banner gallery-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt="">
                        </div>
                        <h1>Gallery</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Gallery Part ======-->
    <section class="gallery-home gallery-home2 pt-100 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="abreco-section-title">
                        <h3 class="abreco-title">Let’s Roll Across the Snaps </h3>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
            @if ($galleries->count() > 0)
                <div class="row" id="content">
                    @foreach ($galleries as $key => $gallery)
                        <div class="col-md-3 col-6 box gall-box-padding @if ($key >= 12) hidden @endif">
                            <div class="card home-galery">
                                <div class="card-image">
                                    <a href="{{ asset('storage/' . $gallery->images) }}" data-fancybox="gallery" class="plus">
                                        <img src="{{ asset('storage/' . $gallery->images) }}">
                                        </a>
                                        <!-- <div class="overlay-box">
                                            <div class="overlay-content">
                                                <a href="{{ asset('storage/' . $gallery->images) }}" data-fancybox="gallery" class="plus">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-12 text-center">
                    <div class="feature-mobile-btn mt-60 mb-40">
                        <!-- <button id="load-more">Load More</button> -->
                        <div class="primary-btn-main">
                            <a href="" class=" new-btn-style" id="load-more">
                                <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                    viewBox="0 0 21 14" fill="none">
                                    <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <img src="{{asset('assets/abreco/images/shapes/right-white.png')}}" class="d-none white" alt="">
                                Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






@endsection
@section('js_after')
    <script>
        var $content = $('#content .box');
        var itemsToShow = 12;
        var itemsLoaded = itemsToShow;


        $content.slice(0, itemsToShow).removeClass('hidden');


        $('#load-more').click(function(e) {
            e.preventDefault();
            var itemsToLoad = 8;

            $content.slice(itemsLoaded, itemsLoaded + itemsToLoad).removeClass('hidden');
            itemsLoaded += itemsToLoad;
            if (itemsLoaded >= $content.length) {
                $('#load-more').hide();
            }
            else{
                $('#load-more').show();
            }
        });
    </script>
@endsection
