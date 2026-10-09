@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Finance Partner',
        'subtitle'    => 'BUILT FOR YOUR LIFESTYLE!',
        'image'       => 'assets/abreco/images/29.jpg',
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
                <p>Credit One, the specialists in Caravan, Camper Trailer, RV and Motorhome Finance</p>
                <p>Want to embark on a trip around Australia or take your children camping for the weekend? Credit One has low rate finance solutions for all types of recreational vehicles.</p>
                <p>We specialise in loans for RVs, campervans, camper trailers and motorhomes. What’s more, our dedicated finance consultants will have you on the road sooner with better rates than the banks!</p>
                <p>Discover why Credit One really is the quicker, smarter and friendlier way to finance. Contact us on 1300 CREDIT (1300 273 348) or apply online for an obligation-free caravan finance pre-approval.</p>
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script></script>
@endsection
