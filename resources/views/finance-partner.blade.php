@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Finance Partner',
        'subtitle'    => 'BUILT FOR YOUR LIFESTYLE!',
        'image'       => 'assets/abreco/images/newonce/video-banner.jpg',
        'breadcrumbs' => [['label' => 'Finance Partner']],
    ])

    <!--====== About Breadcrumb Part ======-->
    <!-- <section class="abreco-inner-banner ken-burn">
        <div class="about-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <h1>Our Range</h1>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="abreco-features-area pt-90 pb-90" id="Features">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12">
                    <img class="img-fluid mb-30" src="{{ asset('assets/abreco/images/newonce/credit-one.png') }}"
                         alt="Credit One — Smarter Finance and Insurance"
                         width="300" height="93" loading="lazy" decoding="async">
                </div>
                <p>Credit One, the specialists in Caravan, Camper Trailer, RV and Motorhome Finance</p>
                <p>Want to embark on a trip around Australia or take your children camping for the weekend? Credit One has low rate finance solutions for all types of recreational vehicles.</p>
                <p>We specialise in loans for RVs, campervans, camper trailers and motorhomes. What’s more, our dedicated finance consultants will have you on the road sooner with better rates than the banks!</p>
                <p>Discover why Credit One really is the quicker, smarter and friendlier way to finance. Contact us on 1300 CREDIT (1300 273 348) or apply online for an <a class="ev-inline-link" href="https://www.creditone.com.au/form" target="_blank" rel="noopener">obligation-free caravan finance pre-approval</a>.</p>
                <div class="col-12">
                    <img class="img-fluid mt-30" src="{{ asset('assets/abreco/images/newonce/dealer-banner.png') }}"
                         alt="Choose Smarter Finance, Choose Credit One — apply online in less than 30 seconds"
                         width="728" height="90" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script></script>
@endsection
