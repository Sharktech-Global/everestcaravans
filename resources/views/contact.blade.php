@extends('layouts.front')

@section('content')
    <!--====== contact Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Contact Us',
        'subtitle'    => 'Get in touch with us today and make your dream a reality!',
        'image'       => 'assets/abreco/images/newonce/contactheader.jpg',
        'breadcrumbs' => [['label' => 'Contact Us']],
    ])

    <!--====== Showroom contact Part ======-->
    <!-- <section class="show-contact pt-120 pb-100 p-relative" id="showrooms">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="show-cont-head">
                        <h1>Our showroom address & Contacts</h1>
                    </div>
                </div>
                @foreach ($locations_footer as $key => $locs)
                    <div class="col-lg-3">
                        <div class="cont-bx cont-box-1">
                            <div class="icon-box">
                                <img src="{{ asset('storage/'.@$locs->icon2) }}" alt="">
                            </div>
                            <h3>{{ @$locs->name }}</h3>
                            <p>{!!@$locs->address !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> -->


    <!--====== Contact PART START ======-->
    {{-- Everest Caravans — Contact page section (image + details | form)
         Fonts are the site pair (Space Grotesk + Poppins); both already load
         above, so this section requests none. --}}
    @php $ecCss = 'css/contact.css'; @endphp
    @if (file_exists(public_path($ecCss)))
        <link rel="stylesheet" href="{{ asset($ecCss) }}?v={{ filemtime(public_path($ecCss)) }}">
    @else
        <!-- EVEREST: public/{{ $ecCss }} not found -->
    @endif

    @php
        // ===================== EDIT HERE =====================
        $ec = [
            'image'   => 'assets/abreco/images/newonce/contact21.jpg',    // roughly square, 1084x1078
            'eyebrow' => 'Contact us',
            'title'   => 'Get in touch with us',
            'text'    => 'Planning a custom build, booking a factory visit or need help with your van? Send us a message and our team will get back to you.',

            // TODO: replace phone and email with the real details.
            // Not taken from $settings — those still hold the old Abreco
            // values (+91 6282019115 / agm.cvpass@abrecomotors.com).
            'details' => [
                ['label' => 'Call us',  'value' => '+61 400 000 000',              'url' => 'tel:+61400000000',                    'icon' => 'phone'],
                ['label' => 'Email us', 'value' => 'sales@everestcaravans.com.au', 'url' => 'mailto:sales@everestcaravans.com.au', 'icon' => 'mail'],
            ],
        ];
        // =====================================================

        $ecIcons = [
            'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
            'mail'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        ];
        $ecImg = file_exists(public_path($ec['image'])) ? asset($ec['image']) : null;
    @endphp

    <section class="ev-contact" aria-labelledby="evContactTitle">
        <div class="ev-contact__inner">

            {{-- LEFT: photo + contact details --}}
            <div class="ev-contact__info">
                @if ($ecImg)
                    <div class="ev-contact__media">
                        <img src="{{ $ecImg }}" alt="An Everest Avalanche set up on a beach with bikes on the rack" loading="lazy" decoding="async">
                    </div>
                @endif

                <h3 class="ev-contact__subhead">Contact information</h3>

                <ul class="ev-contact__details">
                    @foreach ($ec['details'] as $d)
                        <li>
                            <span class="ev-contact__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="20" height="20">{!! $ecIcons[$d['icon']] !!}</svg>
                            </span>
                            <span class="ev-contact__detail">
                                <small>{{ $d['label'] }}</small>
                                <a href="{{ $d['url'] }}">{{ $d['value'] }}</a>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- RIGHT: form card --}}
            <div class="ev-contact__card">
                <p class="ev-contact__eyebrow">{{ $ec['eyebrow'] }}</p>
                <h2 class="ev-contact__title" id="evContactTitle">{{ $ec['title'] }}</h2>
                <p class="ev-contact__text">{{ $ec['text'] }}</p>

                <div class="ev-contact__form">
                    @include('forms.contactus_form')
                </div>
            </div>

        </div>
    </section>

    
    @endsection
