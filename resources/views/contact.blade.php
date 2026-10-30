@extends('layouts.front')
@section('content')
    <!--====== contact Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Contact Us',
        'subtitle'    => 'Have a question or ready to start your adventure? Our friendly team is here to help you find the perfect caravan for your journey.',
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
            
                ['label' => 'Address',  'value' => '51 Glenbarry Road, Campbellfield VIC 3061', 'url' => '#', 'icon' => 'location'],
                ['label' => 'Call us',  'value' => '(03) 9357 9440', 'url' => 'tel:0393579440', 'icon' => 'phone'],
                ['label' => 'Email us', 'value' => 'info@everestcaravans.com.au', 'url' => 'mailto:info@everestcaravans.com.au', 'icon' => 'mail'],
                ['label' => 'Email us', 'value' => 'sales@everestcaravans.com.au', 'url' => 'mailto:sales@everestcaravans.com.au', 'icon' => 'mail'],
            ],
        ];
        // =====================================================
        $ecIcons = [
            'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
            'mail'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
            'location' => '<path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/>',
        ];
        $ecImg = file_exists(public_path($ec['image'])) ? asset($ec['image']) : null;
    @endphp
    <section class="ev-contact-forms" aria-labelledby="evContactTitle">
        <div class="ev-contact-forms__inner">

            {{-- Row 1: heading --}}
            <header class="ev-contact-forms__head">
                <p class="ev-contact__eyebrow">{{ $ec['eyebrow'] }}</p>
                <h2 class="ev-contact__title" id="evContactTitle">{{ $ec['title'] }}</h2>
                <p class="ev-contact__text">{{ $ec['text'] }}</p>
            </header>

            {{-- Row 2: form on the left, photo on the right --}}
            <div class="ev-contact-forms__body">

                <div class="ev-contact__form">
                    @include('forms.contactus_form')
                </div>

                @if ($ecImg)
                    <div class="ev-contact-forms__media">
                        <img src="{{ $ecImg }}"
                             alt="An Everest caravan set up at a campsite"
                             loading="lazy" decoding="async">
                    </div>
                @endif

            </div>
        </div>
    </section>
    <section class="ev-contact" aria-labelledby="evContactTitle">
        <div class="ev-contact__inner">
            {{-- LEFT: photo + contact details --}}
            <div class="ev-contact__info">
                <!-- @if ($ecImg)
                    <div class="ev-contact__media">
                        <img src="{{ $ecImg }}" alt="An Everest Avalanche set up on a beach with bikes on the rack" loading="lazy" decoding="async">
                    </div>
                @endif -->
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.277893552489!2d144.9573551!3d-37.663966599999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad6501ee8bc573d%3A0x2ba81ecf18c41b94!2s51%20Glenbarry%20Rd%2C%20Campbellfield%20VIC%203061%2C%20Australia!5e1!3m2!1sen!2sin!4v1791870850951!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
        </div>
    </section>
    @endsection