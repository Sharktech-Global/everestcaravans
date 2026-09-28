@extends('admin.layouts.app')

@section('content')
<!-- BANNER -->


    <div class="container">
        <div class="row text-center">
            <h1 class="text-white text-center col-md-12">{{ $Service->name }}</h1>
            <div class="breadcrumbs col-md-12 text-center">
                <p class="text-white"><a href="{{ route('admin.home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                        aria-hidden="true"></i>
                    <span>{{ $Service->name }}</span>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- END BANNER -->
<main id="content">
    <section class="bg-black">

        <!-- ABOUT -->
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-white">
                        {!! $Service->content !!}
                    </p>
                </div>
            </div>
        </div>
        <!-- END ABOUT -->

        <!-- ABOUT GALLERY -->
        {{-- <div class="container pb-5">
            <div class="row">
                <div class="w-100 px-3">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 p-0 float-left h-100">
                        <img class="w-100 h-100" alt="abreco" title="Maruti"
                            src="{{ asset('storage/'.$Service->image) }}">
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- END ABOUT GALLERY -->

    </section>
</main>
@endsection
