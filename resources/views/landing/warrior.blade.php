@extends('layouts.landing')

@section('title', 'New Everest Warrior Caravans | 19.5 ft & 21.5 ft | Everest Caravans')
@section('meta_description', 'Two newly built Everest Warrior caravans, 19.5 ft and 21.5 ft. Compare specifications, view genuine photographs and request pricing from the Campbellfield factory.')

@section('content')

@php
    // ===================== EDIT HERE =====================
    // Drop the real photographs into public/assets/abreco/images/warrior/
    // under these names and they appear automatically. The extension does
    // not matter — webp, jpg, jpeg and png are all picked up, newest format
    // first. Until a file exists the cards show a placeholder.
    $wlDir = 'assets/abreco/images/warrior/';

    $wlPic = function ($name, $fallback = null) use ($wlDir) {
        foreach (['webp', 'jpg', 'jpeg', 'png'] as $ext) {
            $path = $wlDir . $name . '.' . $ext;
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }
        return ($fallback && file_exists(public_path($fallback))) ? asset($fallback) : null;
    };

    $wlHero   = $wlPic('hero', 'assets/abreco/images/newonce/home-ban21.jpg');
    $wlIntro  = $wlPic('intro');
    $wl195    = $wlPic('warrior-19-5');
    $wl215    = $wlPic('warrior-21-5');
    $wlGallery = collect(range(1, 6))
        ->map(fn ($n) => ['src' => $wlPic("gallery-{$n}"), 'n' => $n]);
    // =====================================================

    $wl195Specs = [
        ['icon' => 'solar',   'text' => '630W solar panel system (3 &times; 210W)'],
        ['icon' => 'battery', 'text' => '300Ah lithium battery system (2 &times; 150Ah)'],
        ['icon' => 'fridge',  'text' => '188L Dometic compressor refrigerator'],
        ['icon' => 'washer',  'text' => '3.5kg top-load washing machine'],
        ['icon' => 'tv',      'text' => '24-inch Google TV'],
        ['icon' => 'weight',  'text' => '3500kg ATM'],
        ['icon' => 'chassis', 'text' => '6-inch chassis'],
    ];

    $wl215Specs = [
        ['icon' => 'solar',   'text' => '840W solar panel system (4 &times; 210W)'],
        ['icon' => 'battery', 'text' => '400Ah lithium battery system (2 &times; 200Ah)'],
        ['icon' => 'bunk',    'text' => 'Warrior with Bunk package'],
        ['icon' => 'fridge',  'text' => '188L Dometic compressor refrigerator'],
        ['icon' => 'washer',  'text' => '3kg front-load washing machine'],
        ['icon' => 'heater',  'text' => 'Diesel heater'],
        ['icon' => 'tv',      'text' => '24-inch Google Smart TV'],
        ['icon' => 'weight',  'text' => '3500kg ATM'],
        ['icon' => 'chassis', 'text' => '6-inch chassis'],
    ];

    $wlIcons = [
        'solar'   => '<rect x="3" y="4" width="18" height="11" rx="1"/><path d="M3 9h18M9 4v11M15 4v11M12 15v5M8 20h8"/>',
        'battery' => '<rect x="2" y="7" width="17" height="10" rx="2"/><path d="M22 10v4M9 10l-2 4h4l-2 4"/>',
        'fridge'  => '<rect x="5" y="2" width="14" height="20" rx="2"/><path d="M5 10h14M8 6v2M8 13v3"/>',
        'washer'  => '<rect x="4" y="2" width="16" height="20" rx="2"/><circle cx="12" cy="14" r="4.5"/><path d="M8 6h2"/>',
        'tv'      => '<rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8M12 17v4"/>',
        'weight'  => '<path d="M6 7h12l2 13H4L6 7Z"/><path d="M9 7a3 3 0 0 1 6 0"/>',
        'chassis' => '<path d="M3 12h18M6 12v4M18 12v4"/><circle cx="8" cy="18" r="2"/><circle cx="16" cy="18" r="2"/><path d="M3 8h13l3 4"/>',
        'bunk'    => '<path d="M3 5v14M21 10v9M3 10h18M3 19h18M7 8h4"/><path d="M3 14h18"/>',
        'heater'  => '<path d="M12 3s4 4 4 7a4 4 0 0 1-8 0c0-3 4-7 4-7Z"/><path d="M5 20h14"/>',
        'lounge'  => '<path d="M4 11V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3"/><path d="M3 11h18v6H3z"/><path d="M6 17v2M18 17v2M8 11V9h8v2"/>',
    ];
@endphp

{{-- ==========================================================
     HERO
     ========================================================== --}}
<section class="wl-hero"@if ($wlHero) style="--wl-hero-img:url('{{ $wlHero }}')"@endif>
    <div class="wl-hero__inner">
        <p class="wl-hero__eyebrow">Introducing the new Warrior builds</p>

        <h1 class="wl-hero__title">Two New Warriors.<br>One Big Adventure.</h1>

        <p class="wl-hero__lead">
            Discover two newly built Everest Warrior caravans, with different layouts
            and equipment configurations to explore.
        </p>
        <p class="wl-hero__lead">
            Whether you're planning your next Australian road trip or comparing caravans
            before making a purchase, take a closer look at the Warrior 19.5 ft and
            Warrior 21.5 ft.
        </p>

        <div class="wl-hero__actions">
            <a class="wl-btn" href="#enquire">
                Request Pricing &amp; Details
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>
            <a class="wl-btn wl-btn--ghost" href="#compare">
                Compare Both Models
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>
        </div>

        <p class="wl-hero__meta">Everest Caravans &nbsp;|&nbsp; Campbellfield, Victoria</p>
    </div>

    <span class="wl-hero__scroll" aria-hidden="true"></span>
</section>

{{-- ==========================================================
     INTRO
     ========================================================== --}}
<section class="wl-intro">
    <span class="wl-deco wl-deco--dots wl-deco--dots-left" aria-hidden="true"></span>
    <div class="wl-intro__inner">

        {{-- Heading on one side, the copy on the other: centred text alone
             left the section reading as empty space. --}}
        <div class="wl-intro__top">
            <div class="wl-intro__head">
                <p class="wl-eyebrow">Meet the new Everest Warriors</p>
                <h2 class="wl-intro__title">Your Next Adventure Deserves a Caravan That Suits Your Plans.</h2>
            </div>

            <div class="wl-intro__copy">
                <p>Explore the latest Warrior builds from Everest Caravans, an
                   Australian-owned, family-run caravan manufacturer with over
                   15 years of industry experience.</p>
                <p>Compare real specifications, explore genuine photographs and
                   speak directly with our team about the caravan that interests you.</p>
            </div>
        </div>

        {{-- Row 2: a full-width band separating the introduction from the
             specifications the two builds share. --}}
        @if ($wlIntro)
            <figure class="wl-intro__band">
                <img src="{{ $wlIntro }}" width="1920" height="640"
                     alt="The roof of an Everest Warrior caravan, showing the solar panel array, roof hatches and air conditioning unit"
                     loading="lazy" decoding="async">
            </figure>
        @endif

        {{-- What the two builds have in common. Stated here so the model
             sections below can concentrate on what separates them. --}}
        <div class="wl-intro__shared">
            <p class="wl-intro__shared-label">Shared across both builds</p>
            <ul class="wl-intro__specs">
                @foreach ([
                    ['icon' => 'lounge',  'text' => 'L-Lounge configuration'],
                    ['icon' => 'fridge',  'text' => '188L Dometic refrigerator'],
                    ['icon' => 'weight',  'text' => '3500kg ATM'],
                    ['icon' => 'chassis', 'text' => '6-inch chassis'],
                ] as $shared)
                    <li>
                        <span class="wl-intro__specs-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">{!! $wlIcons[$shared['icon']] !!}</svg>
                        </span>
                        <span>{{ $shared['text'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</section>

{{-- ==========================================================
     MODEL — WARRIOR 19.5 FT
     ========================================================== --}}
<section class="wl-model" id="warrior-195">
    <div class="wl-model__inner">

        {{-- Row 1: the introduction runs the full width, so the title is not
             squeezed into a column beside the photograph. --}}
        <header class="wl-model__head">
            <p class="wl-eyebrow">Everest Warrior 19.5 ft</p>
            <h2 class="wl-model__title">Your Next Chapter Starts Here.</h2>
            <p class="wl-model__lead">Explore the newly built Everest Warrior 19.5 ft, featuring an L-Lounge configuration and a range of listed touring equipment.</p>
        </header>

        {{-- Row 2: photograph on one side, specifications on the other --}}
        <div class="wl-model__body">

            <div class="wl-model__media">
                <div class="wl-model__frame">
                    @if ($wl195)
                        <img src="{{ $wl195 }}" alt="The Everest Warrior 19.5 ft caravan" loading="lazy" decoding="async">
                    @else
                        <div class="wl-model__placeholder" role="img" aria-label="Warrior 19.5 ft photography coming soon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 16V7a1 1 0 0 1 1-1h12l4 5v5"/><path d="M3 16h18"/><circle cx="7.5" cy="18" r="2"/><circle cx="16.5" cy="18" r="2"/></svg>
                            <span>Warrior 19.5 ft photography coming soon</span>
                        </div>
                    @endif
                    <span class="wl-model__badge" aria-hidden="true"><strong>19.5</strong><span>ft</span></span>
                </div>
            </div>

            <div class="wl-model__content">
                <h3 class="wl-model__subhead">Key Specifications</h3>
                <ul class="wl-specs">
                    @foreach ($wl195Specs as $spec)
                        <li class="wl-specs__item">
                            <span class="wl-specs__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">{!! $wlIcons[$spec['icon']] !!}</svg>
                            </span>
                            <span>{!! $spec['text'] !!}</span>
                        </li>
                    @endforeach
                </ul>

                <p class="wl-model__text">Explore the actual caravan photographs and contact Everest for complete specifications, current pricing and available viewing arrangements.</p>

                <a class="wl-btn" href="#enquire">
                    Request Warrior 19.5 ft Pricing
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                </a>
            </div>

        </div>

    </div>
</section>

{{-- ==========================================================
     MODEL — WARRIOR 21.5 FT (media on the right)
     ========================================================== --}}
<section class="wl-model wl-model--alt" id="warrior-215">
    <div class="wl-model__inner">

        {{-- Row 1: the introduction runs the full width, so the title is not
             squeezed into a column beside the photograph. --}}
        <header class="wl-model__head">
            <p class="wl-eyebrow">Everest Warrior 21.5 ft</p>
            <h2 class="wl-model__title">Make the Journey Yours.</h2>
            <p class="wl-model__lead">Discover the Warrior 21.5 ft, specified with the Warrior with Bunk package, L-Lounge configuration and a different electrical and equipment setup.</p>
        </header>

        {{-- Row 2: photograph on one side, specifications on the other --}}
        <div class="wl-model__body">

            <div class="wl-model__media">
                <div class="wl-model__frame">
                    @if ($wl215)
                        <img src="{{ $wl215 }}" alt="The Everest Warrior 21.5 ft caravan" loading="lazy" decoding="async">
                    @else
                        <div class="wl-model__placeholder" role="img" aria-label="Warrior 21.5 ft photography coming soon">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 16V7a1 1 0 0 1 1-1h12l4 5v5"/><path d="M3 16h18"/><circle cx="7.5" cy="18" r="2"/><circle cx="16.5" cy="18" r="2"/></svg>
                            <span>Warrior 21.5 ft photography coming soon</span>
                        </div>
                    @endif
                    <span class="wl-model__badge" aria-hidden="true"><strong>21.5</strong><span>ft</span></span>
                </div>
            </div>

            <div class="wl-model__content">
                <h3 class="wl-model__subhead">Key Specifications</h3>
                <ul class="wl-specs">
                    @foreach ($wl215Specs as $spec)
                        <li class="wl-specs__item">
                            <span class="wl-specs__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">{!! $wlIcons[$spec['icon']] !!}</svg>
                            </span>
                            <span>{!! $spec['text'] !!}</span>
                        </li>
                    @endforeach
                </ul>

                <p class="wl-model__text">Request the full build specifications and discuss whether this caravan suits your travel requirements.</p>

                <a class="wl-btn" href="#enquire">
                    Request Warrior 21.5 ft Pricing
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                </a>
            </div>

        </div>

    </div>
</section>

{{-- ==========================================================
     COMPARISON
     ========================================================== --}}
<section class="wl-compare" id="compare">
    <span class="wl-deco wl-deco--topo wl-deco--topo-a" aria-hidden="true"></span>
    <div class="wl-compare__inner">

        <header class="wl-section-head">
            <p class="wl-eyebrow wl-eyebrow--light">Warrior 19.5 ft vs Warrior 21.5 ft</p>
            <h2 class="wl-section-title">Compare the Builds. Find Your Warrior.</h2>
            <p class="wl-section-text">
                Both Everest Warrior models offer different configurations, giving buyers
                the opportunity to compare their features before enquiring.
            </p>
        </header>

        <div class="wl-table-wrap">
            <table class="wl-table">
                <caption class="wl-visually-hidden">
                    Specification comparison between the Warrior 19.5 ft and the Warrior 21.5 ft
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Feature</th>
                        <th scope="col">Warrior 19.5 ft</th>
                        <th scope="col">Warrior 21.5 ft</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Package</th>
                        <td>Warrior</td>
                        <td>Warrior with Bunk</td>
                    </tr>
                    <tr>
                        <th scope="row">Solar panels</th>
                        <td>630W</td>
                        <td>840W</td>
                    </tr>
                    <tr>
                        <th scope="row">Lithium battery</th>
                        <td>300Ah</td>
                        <td>400Ah</td>
                    </tr>
                    <tr>
                        <th scope="row">Washing machine</th>
                        <td>3.5kg top-load</td>
                        <td>3kg front-load</td>
                    </tr>
                    <tr>
                        <th scope="row">Refrigerator</th>
                        <td>188L Dometic</td>
                        <td>188L Dometic</td>
                    </tr>
                    <tr>
                        <th scope="row">ATM</th>
                        <td>3500kg</td>
                        <td>3500kg</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="wl-compare__foot">
            <div>
                <p class="wl-compare__q">Need help deciding?</p>
                <p class="wl-compare__a">
                    Speak with the Everest team about the actual layouts, equipment
                    inclusions and pricing for each build.
                </p>
            </div>
            <a class="wl-btn wl-btn--gold" href="#enquire">
                Help Me Choose My Warrior
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>
        </div>

    </div>
</section>

{{-- ==========================================================
     GALLERY
     ========================================================== --}}
<section class="wl-gallery">
    <span class="wl-deco wl-deco--topo wl-deco--topo-b" aria-hidden="true"></span>
    <div class="wl-gallery__inner">

        <header class="wl-section-head">
            <p class="wl-eyebrow">See the real details</p>
            <h2 class="wl-section-title">Explore Genuine Everest Warrior Photographs</h2>
            <p class="wl-section-text">
                Take a closer look at both caravans through genuine exterior and interior
                photographs. Explore the exterior styling, windows, doors, storage
                compartments and layout details before requesting more information.
            </p>
        </header>

        <div class="wl-gallery__grid">
            @foreach ($wlGallery as $shot)
                <figure class="wl-gallery__item{{ $shot['n'] === 1 ? ' wl-gallery__item--lead' : '' }}{{ $shot['src'] ? '' : ' wl-gallery__item--empty' }}">
                    @if ($shot['src'])
                        <img src="{{ $shot['src'] }}"
                             alt="Everest Warrior caravan, photograph {{ $shot['n'] }}"
                             loading="lazy" decoding="async">
                    @else
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="8.5" cy="10" r="1.5"/><path d="m21 16-5-5-9 8"/></svg>
                    @endif
                </figure>
            @endforeach
        </div>

        <div class="wl-gallery__cta">
            <a class="wl-btn" href="#enquire">
                Enquire About a Factory Inspection
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>
        </div>

    </div>
</section>

{{-- ==========================================================
     WHY EVEREST
     ========================================================== --}}
<section class="wl-why">
    <span class="wl-deco wl-deco--dots wl-deco--dots-right" aria-hidden="true"></span>
    <div class="wl-why__inner">

        <div class="wl-why__copy">
            <p class="wl-eyebrow wl-eyebrow--light">Why choose Everest Caravans?</p>
            <h2 class="wl-section-title">Built in Victoria, Around How You Travel.</h2>
            <p class="wl-section-text">
                Everest Caravans is a family-owned Australian business with over 15 years
                of experience in the caravan industry.
            </p>
            <p class="wl-section-text">
                Based in Campbellfield, Victoria, Everest manufactures caravans designed
                around customers' touring requirements.
            </p>
            <p class="wl-section-text">
                Explore our Warrior range and speak with the team about the build that
                suits your plans.
            </p>
        </div>

        <ul class="wl-why__points">
            <li>
                <span class="wl-why__value">15+</span>
                <span class="wl-why__label">Years in the caravan industry</span>
            </li>
            <li>
                <span class="wl-why__value">100%</span>
                <span class="wl-why__label">Australian owned and family run</span>
            </li>
            <li>
                <span class="wl-why__value">VIC</span>
                <span class="wl-why__label">Built at our Campbellfield factory</span>
            </li>
        </ul>

    </div>
</section>

{{-- ==========================================================
     ENQUIRY FORM
     ========================================================== --}}
<section class="wl-form" id="enquire">
    <div class="wl-form__inner">

        <div class="wl-form__intro">
            <p class="wl-eyebrow">Request pricing &amp; specifications</p>
            <h2 class="wl-section-title">Let's Find Your Everest Warrior.</h2>
            <p class="wl-section-text">Interested in the Warrior 19.5 ft or 21.5 ft?</p>
            <p class="wl-section-text">
                Share your details and our sales team can contact you to discuss pricing,
                specifications and next steps.
            </p>

            <ul class="wl-form__assure">
                <li>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 13 4 4L19 7"/></svg>
                    Spoken to by the team that builds the vans
                </li>
                <li>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 13 4 4L19 7"/></svg>
                    Real specifications, not a generic brochure
                </li>
                <li>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m5 13 4 4L19 7"/></svg>
                    Your details are never passed to a third party
                </li>
            </ul>
        </div>

        <div class="wl-form__card">

            @if (session('warrior_success'))
                <div class="wl-alert wl-alert--ok" role="status">
                    <strong>Thanks &mdash; we have your enquiry.</strong>
                    A member of the Everest sales team will be in touch to discuss pricing
                    and specifications.
                </div>
            @endif

            @if ($errors->any())
                <div class="wl-alert wl-alert--bad" role="alert">
                    <strong>Please check the form.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('warrior-landing.store') }}" method="POST" novalidate>
                @csrf

                <div class="wl-field">
                    <label for="wl-name">Full name <span aria-hidden="true">*</span></label>
                    <input type="text" id="wl-name" name="name" value="{{ old('name') }}"
                           placeholder="Your full name" autocomplete="name" required>
                </div>

                <div class="wl-field-row">
                    <div class="wl-field">
                        <label for="wl-phone">Australian phone number <span aria-hidden="true">*</span></label>
                        <input type="tel" id="wl-phone" name="phone" value="{{ old('phone') }}"
                               placeholder="0412 345 678" autocomplete="tel" required>
                    </div>
                    <div class="wl-field">
                        <label for="wl-email">Email address <span aria-hidden="true">*</span></label>
                        <input type="email" id="wl-email" name="email" value="{{ old('email') }}"
                               placeholder="you@example.com" autocomplete="email" required>
                    </div>
                </div>

                <div class="wl-field-row">
                    <div class="wl-field">
                        <label for="wl-postcode">Postcode <span aria-hidden="true">*</span></label>
                        <input type="text" id="wl-postcode" name="postcode" value="{{ old('postcode') }}"
                               placeholder="3061" inputmode="numeric" maxlength="4"
                               autocomplete="postal-code" required>
                    </div>
                    <div class="wl-field">
                        <label for="wl-model">Preferred model <span aria-hidden="true">*</span></label>
                        <select id="wl-model" name="preferred_model" required>
                            <option value="">Select a model</option>
                            @foreach (['19.5' => 'Warrior 19.5 ft', '21.5' => 'Warrior 21.5 ft', 'both' => 'Both models'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('preferred_model') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="wl-field-row">
                    <div class="wl-field">
                        <label for="wl-timeframe">Purchase timeframe <span aria-hidden="true">*</span></label>
                        <select id="wl-timeframe" name="purchase_timeframe" required>
                            <option value="">Select a timeframe</option>
                            @foreach (['Within 3 months', '3 to 6 months', '6 to 12 months', 'Just researching'] as $opt)
                                <option value="{{ $opt }}" @selected(old('purchase_timeframe') === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="wl-field">
                        <label for="wl-type">Enquiry type <span aria-hidden="true">*</span></label>
                        <select id="wl-type" name="enquiry_type" required>
                            <option value="">Select an enquiry type</option>
                            @foreach (['Pricing', 'Specifications', 'Factory inspection'] as $opt)
                                <option value="{{ $opt }}" @selected(old('enquiry_type') === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="wl-field wl-field--captcha">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                </div>

                <button type="submit" class="wl-btn wl-btn--block">
                    Get Pricing &amp; Details
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                </button>
            </form>

        </div>

    </div>
</section>

{{-- ==========================================================
     FAQ
     ========================================================== --}}
<section class="wl-faq">
    <div class="wl-faq__inner">

        <header class="wl-section-head">
            <p class="wl-eyebrow">Frequently asked questions</p>
            <h2 class="wl-section-title">The Questions Buyers Ask Us First.</h2>
        </header>

        @php
            $wlFaqs = [
                [
                    'q' => "What's the difference between the Warrior 19.5 ft and 21.5 ft?",
                    'a' => 'The two builds have different package and equipment configurations. The 19.5 ft model lists 630W solar panels and 300Ah lithium battery capacity. The 21.5 ft model lists 840W solar panels, 400Ah lithium battery capacity and the Warrior with Bunk package.',
                ],
                [
                    'q' => 'How much do the new Everest Warrior caravans cost?',
                    'a' => 'Contact the Everest Caravans sales team to request the current price and included specifications for your preferred model.',
                ],
                [
                    'q' => 'Can I arrange a factory inspection?',
                    'a' => 'Submit an inspection enquiry or contact the Everest team to discuss available viewing arrangements.',
                ],
                [
                    'q' => 'How can I find out more about towing requirements?',
                    'a' => 'Ask the team for the complete weight specifications and towing information for the individual caravan. Confirm compatibility with your tow vehicle before purchasing.',
                ],
            ];
        @endphp

        <div class="wl-faq__list">
            @foreach ($wlFaqs as $i => $faq)
                {{-- <details> gives a working accordion with no JavaScript --}}
                <details class="wl-faq__item"@if ($i === 0) open @endif>
                    <summary>
                        {{ $faq['q'] }}
                        <span class="wl-faq__mark" aria-hidden="true"></span>
                    </summary>
                    <div class="wl-faq__answer"><p>{{ $faq['a'] }}</p></div>
                </details>
            @endforeach
        </div>

    </div>
</section>

{{-- ==========================================================
     CLOSING CALL TO ACTION
     ========================================================== --}}
<section class="wl-final">
    <div class="wl-final__inner">
        <h2 class="wl-final__title">Your Next Adventure Starts Here.</h2>
        <p class="wl-final__text">
            Explore the two new Everest Warrior caravans and find the right next step
            for your touring plans.
        </p>
        <a class="wl-btn wl-btn--gold" href="#enquire">
            Request Pricing Today
            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
        </a>
    </div>
</section>

{{-- FAQPage structured data, so the questions can surface in search --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => collect($wlFaqs)->map(fn ($f) => [
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ])->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@endsection
