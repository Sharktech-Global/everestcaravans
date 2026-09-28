@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ asset('assets/images/background/tv.jpg') }}">
        <div class="container">
            <div class="text-center row">
                <h1 class="text-center text-white col-md-12">Life At Popular</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>Life At Popular</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->
    <main id="content">
        <section>
            <!-- ABOUT GALLERY -->
            <div class="container pb-5 pt-5">
                <div class="row">
                    <div class="text-center col-md-10 offset-md-1">
                        <div class="about-gallery">
                            <div class="container">
                                <div class="image-gallery">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image px-2">
                                            <div class="img-wrapper">
                                                <a href="{{ asset('assets/images/slider/about-gallery-1.jpg') }}"><img alt="Abreco" src="{{ asset('assets/images/slider/about-gallery-1.jpg') }}" class="img-responsive"></a>
                                                <div class="img-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image px-2">
                                            <div class="img-wrapper">
                                                <a href="{{ asset('assets/images/slider/about-gallery-2.jpg') }}"><img alt="Abreco" src="{{ asset('assets/images/slider/about-gallery-2.jpg') }}" class="img-responsive"></a>
                                                <div class="img-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image px-2">
                                            <div class="img-wrapper">
                                                <a href="{{ asset('assets/images/slider/about-gallery-3.jpg') }}"><img alt="Abreco" src="{{ asset('assets/images/slider/about-gallery-3.jpg') }}" class="img-responsive"></a>
                                                <div class="img-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image px-2">
                                            <div class="img-wrapper">
                                                <a href="{{ asset('assets/images/slider/about-gallery-4.jpg') }}"><img alt="Abreco" src="{{ asset('assets/images/slider/about-gallery-4.jpg') }}" class="img-responsive"></a>
                                                <div class="img-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image px-2">
                                            <div class="img-wrapper">
                                                <a href="{{ asset('assets/images/slider/about-gallery-5.jpg') }}"><img alt="Abreco" src="{{ asset('assets/images/slider/about-gallery-5.jpg') }}" class="img-responsive"></a>
                                                <div class="img-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image px-2">
                                            <div class="img-wrapper">
                                                <a href="{{ asset('assets/images/slider/about-gallery-6.jpg') }}"><img alt="Abreco" src="{{ asset('assets/images/slider/about-gallery-6.jpg') }}" class="img-responsive"></a>
                                                <div class="img-overlay"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    {{-- <div class="px-3 w-100">
                    @if (@$page->content_image_one)
                    <div class="float-left p-0 col-lg-8 col-md-12 col-sm-12 col-xs-12 h-100">
                        <img class="w-100 h-100" alt="Abreco" title="Maruti" src="{{ asset('storage/'.@$page->content_image_one) }}">
                    </div>
                    @endif
                    @if (@$page->content_image_two || @$page->content_image_three)
                    <div class="float-left p-0 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <img class="w-100" alt="Abreco" title="Maruti" src="{{ asset('storage/'.@$page->content_image_two) }}">
                        <img class="w-100" alt="Abreco" title="Maruti" src="{{ asset('storage/'.@$page->content_image_three) }}">
                    </div>
                    @endif
                </div> --}}

                </div>
            </div>
            <!-- END ABOUT GALLERY -->
        </section>

    </main>
@endsection

@section('js_after')
    <script>
        /*function lightbox(idx) {
            var ninjaSldr = document.getElementById("ninja-slider");
            ninjaSldr.parentNode.style.display = "block";
            nslider.init(idx);
            var fsBtn = document.getElementById("fsBtn");
            fsBtn.click();
        }

        function fsIconClick(isFullscreen, ninjaSldr) {
            if (isFullscreen) {
                ninjaSldr.parentNode.style.display = "none";
            }
        }*/

    </script>
@endsection
