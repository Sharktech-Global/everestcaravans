@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . @$page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">{{ @$page->title }}</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>{{ @$page->title }}</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-0 bg-black">
            <div class="container pt-5">
                <div class="mt-0 mb-5 bg-white col-lg-12 tabbed-single-form" id='contact'>
                    <div class="bg-white hero__form carBooking">
                        {{-- <h3><span class="text-primary text-uppercase">{{ $page->title }}</span></h3> --}}
                        <ul class="mb-4">
                            {!! @$page->content !!}

                        </ul>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')

@endsection
