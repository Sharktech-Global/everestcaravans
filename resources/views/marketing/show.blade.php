@extends('layouts.app')

@section('content')
<!-- BANNER -->
<section class="hero set-bg min-height-450 " data-setbg="{{ asset('assets/images/slider/about-banner.png') }}">
    <div class="container">
        <div class="row text-center">
            <h1 class="text-white text-center col-md-12">{{@$data->tag}}</h1>
            <div class="breadcrumbs col-md-12 text-center">
                <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right" aria-hidden="true"></i>
                    <span>{{@$data->tag}}</span>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- END BANNER -->
<main id="content">
    <section>

        <div class="container">
            <div class="row">
                @foreach(explode(',', @$data->values) as $val)
                <div class="col-md-4 p-3 text-center">
                    {{-- {{route('marketing.show',$val->tag)}} --}}
                    <a href="{{url(strtolower(preg_replace('/\s+/', '', @$data->tag)).'/'. strtolower(preg_replace('/\s+/', '', @$val)))}}" class="text-dark" target="_blank">
                        <div class="card" style="background-color: #3a3b3d; color:#fff;">
                            <div class="card-body">
                                {{ $val }}
                            </div>
                        </div>
                    </a>
                </div>

                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
