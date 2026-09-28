@extends('layouts.front')
@section('content')
    <!--====== About Breadcrumb Part ======-->
    <section class="abreco-inner-banner privacy-bg-banner"><!-- faq-bg-banner  -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="assets/images/shapes/banner-head.png" alt="">
                        </div>
                        <h1>Frequently Asked Questions</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== FAQ PART START ======-->
    <section class="faq-part section pt-100 pb-100">

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="accordion accordion-prime mt-30" id="accordionExample">
                        @foreach ($page as $data)
                            <div class="card card-accord card-accord-2">
                                <div class="card-header" id="heading{{ $loop->iteration }}">
                                    <h2 class="mb-0">
                                        <!-- <button class="btn btn-link btn-block text-left accordion-btn" type="button"
                                            data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true"
                                            aria-controls="collapse{{ $loop->iteration }}">
                                            {{ @$data->title }}
                                        </button> -->
                                        <button type="button" class="accordion-btn" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}"><i class="fa fa-plus"></i>{{ @$data->title }}</button>
                                    </h2>
                                </div>

                                <div id="collapse{{ $loop->iteration }}" class="{{ $loop->first ? 'collapse show' : 'collapse' }}" aria-labelledby="heading{{ $loop->iteration }}"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        {{--  {{ @$data->description }}  --}}
                                        {!! @$data->description !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </section>

    <!--====== Contact PART START ======-->
    <section class="contact-section section">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4 order-1-991">
                    <div class="contact-head">
                        <h2>Enquire now</h2>
                        <h5>Time to gear up
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="21" viewBox="0 0 28 21"
                                fill="none">
                                <path d="M15.4389 0H17.609L12.606 21H10.3047L15.4389 0Z" fill="white" />
                                <path d="M25.7436 0H27.9137L22.9107 21H20.6094L25.7436 0Z" fill="white" />
                                <path d="M5.13422 0H7.30435L2.30132 21H0L5.13422 0Z" fill="white" />
                            </svg>
                        </h5>
                        <p>Now let’s start this new venture together and experience the seamless services and rides of
                            Abreco with all its premium quality. Commence this journey to find your smooth ride.</p>
                    </div>
                </div>
                @include('forms.contactus_form')
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

    @section('js_after')
    <!-- Accordion -->
    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function() {
                $(this)
                    .prev(".card-header")
                    .find(".fa")
                    .addClass("fa-minus")
                    .removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse")
                .on("show.bs.collapse", function() {
                    $(this)
                        .prev(".card-header")
                        .find(".fa")
                        .removeClass("fa-plus")
                        .addClass("fa-minus");
                })
                .on("hide.bs.collapse", function() {
                    $(this)
                        .prev(".card-header")
                        .find(".fa")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                });
        });
    </script>
@endsection
