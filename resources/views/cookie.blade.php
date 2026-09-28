@extends('layouts.app_front')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner"
        style="background: url('{{ @$page->banner_image ? asset('storage/' . @$page->banner_image) : asset('assets/images/background/default.png') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">COOKIE POLICY</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" href="{{ route('home') }}">Home</a></span> <i
                        class="mx-2 fa fa-angle-right" aria-hidden="true"></i> <span>COOKIE POLICY</span></p>
            </div>
        </div>
    </section>
    <!-- END BANNER -->
    <section class="section page-content"
        style="background: url('{{ asset('assets/front/images/pattern3.svg') }}') no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {!! @$page->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection