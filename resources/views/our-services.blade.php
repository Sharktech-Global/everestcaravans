@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection

@section('content')
    <!-- BANNER -->
    <section class="page-banner"  style="background: url('{{asset('assets/images/background/book-a-service.webp')}}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title" href="{{route('our-services.show')}}" style="">SERVICES</span>
            <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"> <span><a class="text-white"  href="{{route('home')}}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Services</span></p>
                </div>
        </div>
    </section>
    <!-- END BANNER -->

    <section id="ourServices" class="section" style="background-image: url('{{asset('assets/front/images/pattern3.svg')}}');">
        <div class="container">
            <div class="row">
                {{-- assets/front/images/Abreco-logo.webp --}}
                @foreach ($add_pages as $add_page)
                <div class="col-md-3 text-center">
                    <a class="serviceboxwrapper" href="{{ route('addPage.view',$add_page->slug) }}">
                        <img src="{{ asset('storage/'.$add_page->image) }}" alt="Everest" />
                        <span>{{$add_page->title}}</span>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </section>

@endsection
@section('js_after')

@endsection