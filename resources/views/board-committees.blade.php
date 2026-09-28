@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Board & Committees</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Board & Committees</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-0 bg-black">
            <div class="container pt-5">
                
            </div>
        </section>
    </main>
@endsection
@section('js_after')

@endsection
