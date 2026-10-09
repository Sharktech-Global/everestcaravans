{{--
    Everest Caravans — Factory feature cards (diamond icon tile + label)
    Reusable on every page:

    @include('partials.ev-factory-features')

    Every prop is optional:

    @include('partials.ev-factory-features', [
        'features' => [                                                     // one card per item
            ['label' => 'Australian Made', 'icon' => 'assets/abreco/images/logo/kangaroo.svg'],
            ['label' => 'Built to Last',   'icon' => 'assets/abreco/images/logo/caravan.svg'],
        ],
        'columns' => 3,                                                     // cards per row on desktop
        'class'   => 'mt-5',                                                // extra classes on the <ul>
        'style'   => '--ff-ink: #0E1330; --ff-brand: #283895;',             // see the CSS for every var
    ])

    Icons are dark line art (SVG or PNG) in public/; the CSS flips them
    white on the tile. A missing file falls back to the label's first
    letter, so a card is never empty or broken.

    On a dark section, pass lighter colours:
    'style' => '--ff-ink: rgba(255,255,255,.12); --ff-brand: #D9AE55; --ff-label: #F4F2EE;'

    CSS: public/css/ev-factory-features.css (loaded below)
--}}

{{-- CSS, loaded once per page --}}
@once
    @php $ffCss = 'css/ev-factory-features.css'; @endphp
    {{-- Space Grotesk comes from the layout head --}}
    @if (file_exists(public_path($ffCss)))
        <link rel="stylesheet" href="{{ asset($ffCss) }}?v={{ filemtime(public_path($ffCss)) }}">
    @else
        <!-- EVEREST: public/{{ $ffCss }} not found -->
    @endif
@endonce

@php
    // Icons are SVG files in public/assets/abreco/images/logo/
    $ffFeatures = $features ?? [
        ['label' => 'Australian Made',             'icon' => 'assets/abreco/images/logo/kangaroo.svg'],
        ['label' => 'Built to Last',               'icon' => 'assets/abreco/images/logo/caravan.svg'],
        ['label' => '10 Year Structural Warranty', 'icon' => 'assets/abreco/images/logo/warranty.svg'],
    ];

    // Missing keys are filled in, so a label-only row works
    $ffFeatures = collect($ffFeatures)->map(fn ($f) => $f + ['label' => '', 'icon' => null]);

    $ffStyle = trim('--ff-cols: ' . (int) ($columns ?? 3) . '; ' . ($style ?? ''));
@endphp

<ul class="{{ trim('ev-factory__features ' . ($class ?? '')) }}" style="{{ $ffStyle }}">
    @foreach ($ffFeatures as $f)
        @php $ffIcon = $f['icon'] && file_exists(public_path($f['icon'])) ? asset($f['icon']) : null; @endphp
        <li class="ev-factory__feature">
            {{-- Tile is rotated 45deg; the inner span counter-rotates
                 so the icon itself stays upright --}}
            <span class="ev-factory__icon" aria-hidden="true">
                <span class="ev-factory__icon-in">
                    @if ($ffIcon)
                        <img src="{{ $ffIcon }}" alt="" loading="lazy" decoding="async">
                    @else
                        {{-- No artwork yet: show the first letter so the tile is never empty --}}
                        <span class="ev-factory__initial">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($f['label'], 0, 1)) }}</span>
                    @endif
                </span>
            </span>
            <span class="ev-factory__label">{{ $f['label'] }}</span>
        </li>
    @endforeach
</ul>
