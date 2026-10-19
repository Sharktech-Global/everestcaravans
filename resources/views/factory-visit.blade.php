@extends('layouts.front')
@section('content')
    <!--====== Factory Visit Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Factory Visit',
        'subtitle'    => 'See where the adventure begins. Visit our factory and discover the craftsmanship, care and quality behind every Everest caravan.',
        'image'       => 'assets/abreco/images/newonce/contactheader.jpg',
        'breadcrumbs' => [['label' => 'Factory Visit']],
    ])

    <!--====== FACTORY VISIT PART START ======-->
    {{-- Everest Caravans — Factory Visit (enquiry form | warranty badges)
         The form's own styling lives in contact.css under .ev-contact-form,
         so both sheets load here; factory-visit.css only places the columns.
         Fonts are the site pair (Space Grotesk + Poppins), already loaded above. --}}
    @php
        $fvCss   = 'css/factory-visit.css';
        $fvForm  = 'css/contact.css';
    @endphp
    @foreach ([$fvForm, $fvCss] as $fvSheet)
        @if (file_exists(public_path($fvSheet)))
            <link rel="stylesheet" href="{{ asset($fvSheet) }}?v={{ filemtime(public_path($fvSheet)) }}">
        @else
            <!-- EVEREST: public/{{ $fvSheet }} not found -->
        @endif
    @endforeach

    @php
        // ===================== EDIT HERE =====================
        $fv = [
            'eyebrow' => 'Book a visit',
            'title'   => 'Come and see your van being built',
            'text'    => 'Fill in the enquiry form below and we will get back to you as soon as possible.',

            // Warranty badges shown beside the form
            'badges'  => [
                ['image' => 'assets/abreco/images/newonce/warranty1-01.png', 'alt' => '5 year structural warranty'],
                ['image' => 'assets/abreco/images/newonce/warranty2-01.png', 'alt' => '1 year general warranty'],
            ],
            'note'    => 'Every Everest caravan is covered from the day you collect it.',
        ];
        // =====================================================

        // Drop any badge whose file is not there, so the panel never breaks
        $fvBadges = collect($fv['badges'])->filter(fn ($b) => is_file(public_path($b['image'])))->values();
    @endphp

    <section class="ev-visit" aria-labelledby="evVisitTitle">
        {{-- Contour marks behind the content, same motif as the home page --}}
        <span class="ev-visit__topo ev-visit__topo--top" aria-hidden="true"></span>
        <span class="ev-visit__topo ev-visit__topo--bottom" aria-hidden="true"></span>

        <div class="ev-visit__inner">

            {{-- LEFT: intro + enquiry form --}}
            <div class="ev-visit__main">
                <p class="ev-visit__eyebrow">{{ $fv['eyebrow'] }}</p>
                <h2 class="ev-visit__title" id="evVisitTitle">{{ $fv['title'] }}</h2>
                <p class="ev-visit__text">{{ $fv['text'] }}</p>

                <div class="ev-visit__form">
                    @include('forms.factory_visit_form')
                </div>
            </div>

            {{-- RIGHT: warranty badges --}}
            @if ($fvBadges->isNotEmpty())
                <aside class="ev-visit__aside" aria-label="Our warranties">
                    @foreach ($fvBadges as $badge)
                        <img class="ev-visit__badge" src="{{ asset($badge['image']) }}"
                             alt="{{ $badge['alt'] }}" width="507" height="488"
                             loading="lazy" decoding="async">
                    @endforeach

                    @if ($fv['note'])
                        <p class="ev-visit__aside-note">{{ $fv['note'] }}</p>
                    @endif
                </aside>
            @endif

        </div>
    </section>
@endsection
