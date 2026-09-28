@extends('layouts.app')

@section('content')
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Location Map</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Location Map</span></p>
                </div>
            </div>
        </div>
    </section>
    <main id="content">
        <section class="bg-black pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                            <iframe src="https://www.google.com/maps/d/embed?mid=1Th_WQBxs5iQLUW0vVuKI0kov820&hl=en" width="100%" height="480"></iframe>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection