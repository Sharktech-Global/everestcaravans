@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
    <style>
        @keyframes float {
            0% {
                transform: translatey(0px);
            }

            50% {
                transform: translatey(-20px);
            }

            100% {
                transform: translatey(0px);
            }
        }
        .avatar {
            transform: translatey(0px);
            animation: float 6s ease-in-out infinite;
            width: 320px;
        }
    </style>
@endsection
@section('content')
<section class="section page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <img src="{{ asset('assets/images/cars/roundcarnotfound.gif') }}" alt="404" style="margin: 0 auto; width: 300px;"> --}}
                <h1 class="text-dark text-center title">Whoops!</h1>
                <h4 class="text-dark text-center sub-title">Looks like you're lost</h4>
                <div class="not-found-img text-center mt-5">
                    <img class="avatar" src="{{ asset('assets/images/cars/404_page.webp') }}" alt="Abreco" usemap="#Map" style="margin: 0 auto;" />
                    {{-- <map name="Map">
                        <area shape="rect" coords="695,221,777,250" href="{{ route('home') }}"> <!-- back button -->
                        <area shape="rect" coords="705,260,786,292" href="{{ route('home') }}"> <!-- home button -->
                    </map> --}}
                </div>

            </div>
        </div>
    </div>
</section>
@endsection