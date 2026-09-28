@extends('layouts.app_front')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner"
        style="background: url('{{ asset('assets/front/banner/leadership.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">LEADERSHIP TEAM</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-white"> <span><a class="text-white" 
                            href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                        aria-hidden="true"></i> <span>LEADERSHIP TEAM</span></p>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="bg-black">

            <!-- LEADERSHIP TEAM -->
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-12">
                     <h3 class="text-center text-dark mt5 mb5">COMING SOON...</h3>
                    </div>
                </div>
            </div>
            <!-- END LEADERSHIP TEAM -->

        </section>
    </main>
@endsection
