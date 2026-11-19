@extends('layouts.landing')

@section('title', 'Thank You | Everest Warrior Enquiry Received | Everest Caravans')
@section('meta_description', 'Thank you for your Everest Warrior enquiry. Our Campbellfield sales team will be in touch with pricing and specifications within one business day.')

{{-- A confirmation page has no business in search results, and no business
     passing link equity around either. --}}
@section('head_after')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('css_after')
    @php $wtCss = 'css/warrior-thank-you.css'; @endphp
    @if (file_exists(public_path($wtCss)))
        <link rel="stylesheet" href="{{ asset($wtCss) }}?v={{ filemtime(public_path($wtCss)) }}">
    @else
        <!-- EVEREST: public/{{ $wtCss }} not found -->
    @endif
@endsection

{{-- Resolved above @section('content') so the preload below can reach it.
     Same reasoning as the landing page: the hero is the LCP element and
     loads as a CSS background, which the preload scanner cannot see. --}}
@php
    // ===================== EDIT HERE =====================
    // Same picture-finder the landing page uses, so a photograph dropped into
    // public/assets/abreco/images/warrior/ appears here too, whatever the
    // extension. Until a file exists the page falls back to the brand wash.
    $wtDir = 'assets/abreco/images/warrior/';

    $wtPic = function ($name, $fallback = null) use ($wtDir) {
        foreach (['webp', 'jpg', 'jpeg', 'png'] as $ext) {
            $path = $wtDir . $name . '.' . $ext;
            if (file_exists(public_path($path))) {
                return asset($path) . '?v=' . filemtime(public_path($path));
            }
        }
        return ($fallback && file_exists(public_path($fallback)))
            ? asset($fallback) . '?v=' . filemtime(public_path($fallback))
            : null;
    };

    // Hero banner. Deliberately a different shot from the landing hero so the
    // page reads as a new step rather than a reload of the one before it.
    $wtHero = $wtPic('thank-you', 'assets/images/about/19.5Connected2.webp');
@endphp

@section('head_preload')
    @if ($wtHero)
        <link rel="preload" as="image" href="{{ $wtHero }}" fetchpriority="high">
    @endif
@endsection

@section('content')

@php
    // The small photograph beside the "while you wait" links.
    $wtAside = $wtPic('thank-you-aside', 'assets/images/about/about21-tile.webp');

    $wtPhone     = '(03) 9357 9440';
    $wtPhoneHref = 'tel:0393579440';
    $wtEmail     = 'sales@everestcaravans.com.au';
    $wtAddress   = '51 Glenbarry Road, Campbellfield VIC 3061';
    $wtMapHref   = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($wtAddress);

    // The landing page the enquiry came from, for every link back.
    $wtLanding = route('warrior-landing.show');
    // =====================================================

    $wtSteps = [
        [
            'n'    => '01',
            'head' => 'Your enquiry reaches the sales team',
            'text' => 'It lands with the Everest Caravans sales team at the Campbellfield factory, together with the model and the next step you selected.',
            'meta' => 'Immediately',
        ],
        [
            'n'    => '02',
            'head' => 'We call or email you back',
            'text' => 'A member of the team gets in touch on the number or email address you gave us, with pricing and the full specification list for the Warrior you asked about.',
            'meta' => 'Within one business day',
        ],
        [
            'n'    => '03',
            'head' => 'You decide the next step',
            'text' => 'Book a factory inspection, talk through towing weights and tow vehicle compatibility, or ask about a custom build. No obligation either way.',
            'meta' => 'At your pace',
        ],
    ];

    $wtLinks = [
        [
            'head' => 'The Warrior 19.6 ft',
            'text' => '630W solar, 300Ah lithium and a 188L Dometic fridge.',
            'href' => $wtLanding . '#warrior-195',
        ],
        [
            'head' => 'The Warrior 21.6 ft',
            'text' => '840W solar, 400Ah lithium and the Warrior with Bunk package.',
            'href' => $wtLanding . '#warrior-215',
        ],
        [
            'head' => 'Compare the two builds',
            'text' => 'Both specification lists side by side, line for line.',
            'href' => $wtLanding . '#compare',
        ],
        [
            'head' => 'Frequently asked questions',
            'text' => 'Pricing, inspections and towing requirements, answered.',
            'href' => $wtLanding . '#faq',
        ],
    ];
@endphp

{{-- ==========================================================
     CONFIRMATION HERO
     ========================================================== --}}
<section class="wt-hero"@if ($wtHero) style="--wt-hero-img:url('{{ $wtHero }}')"@endif>
    <span class="wl-deco wl-deco--topo wl-deco--topo-a" aria-hidden="true"></span>

    <div class="wt-hero__inner">

        {{-- The tick is drawn, not an image file, so it is crisp at any size
             and costs no extra request. --}}
        <span class="wt-tick" aria-hidden="true">
            <svg viewBox="0 0 48 48"><path d="M14 25l7 7 14-14"/></svg>
        </span>

        <p class="wl-hero__eyebrow">Enquiry received</p>

        <h1 class="wt-hero__title">Thank You.<br>We&rsquo;ve Got Your Enquiry.</h1>

        <p class="wt-hero__lead">
            Your Everest Warrior enquiry is with our sales team at the Campbellfield
            factory. Someone will be in touch with pricing and the full specification
            list for the model you asked about.
        </p>

        <p class="wt-hero__promise">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>
            We reply within one business day
        </p>

        <div class="wt-hero__actions">
            <a class="wl-btn wl-btn--gold" href="{{ $wtPhoneHref }}">
                Call {{ $wtPhone }}
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>
            <a class="wl-btn wl-btn--ghost" href="{{ $wtLanding }}">
                Back to the Warriors
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>
        </div>

        <p class="wt-hero__note">
            In a hurry? Call the factory on
            <a href="{{ $wtPhoneHref }}">{{ $wtPhone }}</a> during business hours and
            quote your name &mdash; we can pull your enquiry up on the spot.
        </p>

    </div>
</section>

{{-- ==========================================================
     WHAT HAPPENS NEXT
     ========================================================== --}}
<section class="wt-next">
    <span class="wl-deco wl-deco--dots wl-deco--dots-right" aria-hidden="true"></span>

    <div class="wt-next__inner">

        <header class="wl-section-head">
            <p class="wl-eyebrow">What happens next</p>
            <h2 class="wl-section-title">Three Steps, And None Of Them Are Yours.</h2>
            <p class="wl-section-text">
                No chasing, no forms to fill in twice. Here is exactly how your enquiry
                moves from here.
            </p>
        </header>

        <ol class="wt-steps">
            @foreach ($wtSteps as $step)
                <li class="wt-step">
                    <span class="wt-step__n" aria-hidden="true">{{ $step['n'] }}</span>
                    <h3 class="wt-step__head">{{ $step['head'] }}</h3>
                    <p class="wt-step__text">{{ $step['text'] }}</p>
                    <p class="wt-step__meta">{{ $step['meta'] }}</p>
                </li>
            @endforeach
        </ol>

    </div>
</section>

{{-- ==========================================================
     WHILE YOU WAIT
     ========================================================== --}}
<section class="wt-wait">
    <div class="wt-wait__inner">

        <div class="wt-wait__copy">
            <p class="wl-eyebrow">While you wait</p>
            <h2 class="wl-section-title">Have Another Look Around.</h2>
            <p class="wl-section-text">
                Most buyers compare the two builds a second time before they speak to us.
                Everything on the Warrior page is still there, and your enquiry is already
                in &mdash; nothing below will ask you for your details again.
            </p>

            <ul class="wt-wait__links">
                @foreach ($wtLinks as $link)
                    <li>
                        <a href="{{ $link['href'] }}">
                            <span class="wt-wait__head">{{ $link['head'] }}</span>
                            <span class="wt-wait__text">{{ $link['text'] }}</span>
                            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="wt-wait__media">
            @if ($wtAside)
                <img src="{{ $wtAside }}"
                     alt="The leather dinette and lounge inside an Everest Warrior caravan"
                     width="720" height="900" loading="lazy" decoding="async">
            @else
                <span class="wt-wait__placeholder" aria-hidden="true"></span>
            @endif
        </div>

    </div>
</section>

{{-- ==========================================================
     CONTACT — the same details as the footer, but reachable
     without scrolling past it.
     ========================================================== --}}
<section class="wt-contact">
    <div class="wt-contact__inner">

        <header class="wl-section-head">
            <p class="wl-eyebrow wl-eyebrow--light">Reach us directly</p>
            <h2 class="wl-section-title">Rather Not Wait?</h2>
            <p class="wl-section-text">
                The factory is open to visitors and the sales team answers the phone.
                Come and stand next to one.
            </p>
        </header>

        <ul class="wt-contact__grid">
            <li class="wt-contact__card">
                <span class="wt-contact__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M6 3h3l2 5-2.5 1.5a11 11 0 0 0 5 5L15 12l5 2v3a2 2 0 0 1-2.2 2A15.5 15.5 0 0 1 4 5.2 2 2 0 0 1 6 3Z"/></svg>
                </span>
                <h3 class="wt-contact__head">Call the factory</h3>
                <a class="wt-contact__value" href="{{ $wtPhoneHref }}">{{ $wtPhone }}</a>
                <p class="wt-contact__meta">Monday to Friday, business hours</p>
            </li>

            <li class="wt-contact__card">
                <span class="wt-contact__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                </span>
                <h3 class="wt-contact__head">Email the team</h3>
                <a class="wt-contact__value" href="mailto:{{ $wtEmail }}">{{ $wtEmail }}</a>
                <p class="wt-contact__meta">Attach your tow vehicle details and we will check the weights</p>
            </li>

            <li class="wt-contact__card">
                <span class="wt-contact__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 21s7-5.6 7-11a7 7 0 1 0-14 0c0 5.4 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                </span>
                <h3 class="wt-contact__head">Visit the factory</h3>
                <a class="wt-contact__value wt-contact__value--sm"
                   href="{{ $wtMapHref }}" target="_blank" rel="noopener">{{ $wtAddress }}</a>
                <p class="wt-contact__meta">Where every Everest Warrior is built</p>
            </li>
        </ul>

    </div>
</section>

{{-- ==========================================================
     CLOSING
     ========================================================== --}}
<section class="wl-final">
    <div class="wl-final__inner">
        <h2 class="wl-final__title">Your Next Adventure Starts Here.</h2>
        <p class="wl-final__text">
            Thank you again for considering Everest. We will talk soon &mdash; and in the
            meantime, the Warrior page is right where you left it.
        </p>
        <a class="wl-btn wl-btn--gold" href="{{ $wtLanding }}">
            Back to the Warriors
            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
        </a>
    </div>
</section>

@endsection

@section('js_after')
    {{--
        Break out of the enquiry iframe.

        The form on /warrior is a GoHighLevel embed. When GoHighLevel's
        "On submit -> Redirect to URL" points here, it navigates ITS OWN
        iframe, so without this the whole confirmation page renders inside
        an 805px-tall box on the landing page, header and footer and all.

        Once that redirect has happened this document is same-origin with
        the page framing it, so reading and setting window.top.location is
        allowed outright — no postMessage handshake, and nothing to go
        stale if LeadConnector changes its message format.
    --}}
    <script>
        (function () {
            if (window.top === window.self) {
                return;
            }

            try {
                window.top.location.replace(window.self.location.href);
            } catch (e) {
                // Framed by something we are not same-origin with. Nothing
                // further is permitted, and the page still reads correctly
                // on its own, so this is left alone rather than retried.
            }
        })();
    </script>
@endsection
