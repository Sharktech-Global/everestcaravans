@extends('layouts.front')
@section('content')
    <!--====== contact Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Factory Visit',
        'subtitle'    => 'Request a visit to our factory and see our caravans in person!',
        'image'       => 'assets/abreco/images/newonce/contactheader.jpg',
        'breadcrumbs' => [['label' => 'Factory Visit']],
    ])
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
            
                ['label' => 'Call us',  'value' => '51 Glenbarry Road, Campbellfield VIC 3061', 'url' => '#', 'icon' => 'location'],
                ['label' => 'Call us',  'value' => '(03) 9357 9440', 'url' => 'tel:0393579440', 'icon' => 'phone'],
                ['label' => 'Email us', 'value' => 'info@everestcaravans.com.au', 'url' => 'mailto:info@everestcaravans.com.au', 'icon' => 'mail'],
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
        <div class="container">

            {{-- RIGHT: form card --}}
            <div class="ev-contact__cards">
                <p class="ev-contact__eyebrow">{{ $ec['eyebrow'] }}</p>
                <h2 class="ev-contact__title" id="evContactTitle">{{ $ec['title'] }}</h2>
                <p class="ev-contact__text">{{ $ec['text'] }}</p>

                <div class="ev-contact__form">
                    @include('forms.factory_visit_form')
                </div>
            </div>
        </div>
    </section>
    @endsection