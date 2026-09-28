@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
    <style>
        @keyframes float {
            0% {
                box-shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);
                transform: translatey(0px);
            }

            50% {
                box-shadow: 0 25px 15px 0px rgba(0, 0, 0, 0.2);
                transform: translatey(-20px);
            }

            100% {
                box-shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);
                transform: translatey(0px);
            }
        }
        .avatar {
            width: 150px;
            height: 150px;
            box-sizing: border-box;
            border: 5px white solid;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 5px 15px 0px rgba(0, 0, 0, 0.6);
            transform: translatey(0px);
            animation: float 6s ease-in-out infinite;
            img {
                width: 100%;
                height: auto;
            }
        }

        .border_data {
            background: #fff;
            border: 1px solid transparent;
            box-shadow: 0px 20px 20px -10px #ccc;
            border-radius: 10px;
        }
        .checked {
            color: #ffae19;
            font-size: 14px;
            line-height: 14px;
        }
        .bgLightOrange {
            margin-bottom: 130px;
            padding: 50px 15px;
            margin: 0 15px 130px 15px;
        }
        .testi-img {
            margin-top: -100px;
            margin-bottom: 20px
        }
    </style>
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner"
        style="background: url('{{ asset('assets/images/background/testimonials-banner.webp') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">TESTIMONIALS</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" href="{{ route('home') }}">Home</a></span> <i
                        class="mx-2 fa fa-angle-right" aria-hidden="true"></i> <span>TESTIMONIALS</span></p>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <section class="section page-content"
        style="background: url('{{ asset('assets/front/images/pattern3.svg') }}') no-repeat center center;background-size: cover;">
            <div class="container pt-5">
                <div class="row">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-md-12 bgLightOrange border_data">
                            <p class="text-center testi-img">
                                @if ($testimonial->photo)
                                    <img class="rounded-circle testimonialimg avatar" src="{{ asset('storage/' . $testimonial->photo) }}"
                                        alt="{{ $testimonial->name }}" width="100" height="100">
                                @else
                                    <img class="rounded-circle testimonialimg avatar" src="{{ asset('assets/images/avatar.png') }}"
                                        alt="{{ $testimonial->name }}" width="100" height="100">
                                @endif
                            </p>
                            <h4 class="mt-2 text-center primaryColor">{{ $testimonial->name }}</h4>
                            @if ($testimonial->designation)
                                <p class="text-center text-muted">{{ $testimonial->designation }}</p>
                            @endif
                             @if ($testimonial->rating)
                            <p class="text-center text-muted" style="line-height: 15px;">
                                @php $review = (object)['rate' => 3];
                                for ($i = 0; $i < 5; ++$i) {
                                    echo '<span class="fa fa-star' , ($testimonial->rating <= $i ? ' ' : ' checked') , '" "></span>';
                                } @endphp
                               
                            </p>
                            @endif
                            @if ($testimonial->message)
                                <p class="mb-0 text-center">{{ $testimonial->message }}</p>
                            @endif
                            @if ($testimonial->url)
                                <p class="mb-0 text-center videoTestimonial">
                                    <iframe width="100%" height="400" src="{{ $testimonial->url }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="testimonials-pagination">
                    {!! $testimonials->links() !!}
                </div>
            </div>
        </section>
@endsection
@section('js_after')
@endsection