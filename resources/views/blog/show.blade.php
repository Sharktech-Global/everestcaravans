@extends('layouts.front')
@section('css_after')
  
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Blogs',
        'subtitle'    => 'BUILT FOR YOUR LIFESTYLE!',
        'image'       => 'assets/abreco/images/29.jpg',
        'breadcrumbs' => [['label' => 'Blogs']],
    ])
 <!--====== About Breadcrumb Part ======-->
 <!-- <section class="abreco-inner-banner blogs-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="assets/images/shapes/banner-head.png" alt="">
                        </div>
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!--====== abreco BLOG PART START ======--> 
    <section class="abreco-blog-area pt-90 pb-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="abreco-section-title">
                        <h3 class="abreco-title">Our Lastest Blogs</h3>
                        <p>We have jot together our stories and knowledge  to keep you updated. Give it a quick drift....</p>
                    </div>  
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-lg-6 col-md-12">
                        <div class="abreco-blog-item mt-30">
                            <div class="thumb">
                               <a href="{{route('blog.details',$blog->slug)}}">
                               <img src="{{ asset('storage/'.@$blog->feature_image) }}" alt="">
                               </a>
                            </div>
                            <div class="content">
                                <h3 class="title"><a href="{{route('blog.details',$blog->slug)}}">{{@$blog->title}}</a></h3>
                                <p>{!!  substr(strip_tags($blog->details), 0, 100) !!}</p>
                                <a href="{{route('blog.details',$blog->slug)}}"><span>Read More</span> <i class="fal fa-chevron-right"></i><i class="fal fa-chevron-right"></i>
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
<script>

</script>
@endsection
