@extends('layouts.front')
@section('css_after')
  
@endsection
@section('content')
    <!--====== Blog Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Blogs',
        'subtitle'    => 'BUILT FOR YOUR LIFESTYLE!',
        'image'       => 'assets/abreco/images/newonce/blog-banner.jpg',
        'breadcrumbs' => [['label' => 'Blogs']],
    ])

    <!--====== abreco BLOG PART START ======--> 
    @if($blog)
        <section class="abreco-blog-area pt-90 pb-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 custom-offset-right">
                        <div class="date-section d-none">
                            <!-- <ul>
                                <li><span><i class="fa fa-calendar mr-2"></i></span> Jun 20,2023</li>
                                <li><span><i class="fa fa-map-marker mr-2"></i></span> Kozhikode</li>
                            </ul> -->
                        </div>
                        <!-- <div class="abreco-section-title">
                            <h3 class="abreco-title">The Introduction</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur vero obcaecati at molestias iure vitae eligendi quia nobis voluptatem vel est fuga quidem voluptas reiciendis, animi blanditiis eius maiores modi amet dolor voluptates hic sed. Officia aliquid, fugiat, adipisci ut expedita aperiam ab at ducimus suscipit deserunt ipsa dolorum magnam.</p>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="abreco-blog-item mt-30">
                                    <div class="thumb">
                                        <img src="{{asset('storage/'.$blog->feature_image)}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-12 pt-50 pb-50 news-blokquote">
                                <blockquote class="text-center">
                                    <q>{{@$blog->title}}</q>
                                </blockquote>
                                <p class="pt-60 blog-paragraph">{!!$blog->details!!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidemenu-news">
                            <div class="head">
                                <h3>Other Newsrooms</h3>
                            </div>
                            <ul class="side-lists">
                                @foreach($blogs as $blog_data)
                                    <li>
                                        <figure>
                                            <a href="{{route('blog.details',$blog_data->slug)}}"><img src="{{asset('storage/'.$blog_data->feature_image)}}" alt=""></a>
                                        </figure>
                                        <div class="post-text">
                                            <h6><a href="{{route('blog.details',$blog_data->slug)}}">{{@$blog_data->title}}</a></h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif



@endsection
@section('js_after')
<script>

</script>
@endsection
