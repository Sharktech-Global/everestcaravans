{{--
    Everest Caravans — Awards "Journey" (black & gold)
    Reusable on every page:

    @include('partials.ev-journey')

    Every prop is optional:

    @include('partials.ev-journey', [
        'awards'   => [                                                 // one row per award
            ['rank' => 1,    'van' => 'Nitro Extreme', 'title' => 'Best Off-Road Van in Australia',  'year' => 2022],
            ['rank' => null, 'van' => null,            'title' => 'Custom Manufacturer of the Year', 'year' => 2022],
        ],
        'title'    => 'Top 5 Vans in Australia',                        // main heading line
        'subtitle' => 'Our Journey for the Past 4 Years',               // top line; built from the years when omitted
        'image'    => 'assets/abreco/images/newonce/home-ban21.jpg',    // background photo
        'sort'     => true,                                             // newest first, ranked awards before trophies
    ])

    'rank' => null shows a trophy instead of a number, and the award text
    then takes the empty van-name column as well.

    CSS:    public/css/ev-journey.css (loaded below)
    Images: dark, wide shots work best — the photo sits under a navy gradient
    Reveal (optional): add <script src="{{ asset('assets/js/reveal.js') }}"></script>
                       before </body> to fade the heading and rows in on scroll
--}}

{{-- Font + CSS, loaded once per page --}}
@once
    @php $ejCss = 'css/ev-journey.css'; @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Space Grotesk comes from the layout head; this adds the condensed face --}}
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">
    @if (file_exists(public_path($ejCss)))
        <link rel="stylesheet" href="{{ asset($ejCss) }}?v={{ filemtime(public_path($ejCss)) }}">
    @else
        <!-- EVEREST: public/{{ $ejCss }} not found -->
    @endif
@endonce

@php
    // Add one line per award. 'rank' => null shows a trophy.
    $evAwards = $awards ?? [
        ['rank' => 1,    'van' => 'Nitro Extreme',      'title' => 'Best Off-Road Van in Australia',  'year' => 2022],
        ['rank' => null, 'van' => null,                 'title' => 'Custom Manufacturer of the Year', 'year' => 2022],
        ['rank' => 3,    'van' => 'Kombat Performance', 'title' => 'Best Off-Road Van in Australia',  'year' => 2021],
        ['rank' => 2,    'van' => 'Camo',               'title' => 'Best Off-Road Van in Australia',  'year' => 2020],
        ['rank' => 5,    'van' => 'Kombat E1',          'title' => 'Best Off-Road Van in Australia',  'year' => 2019],
    ];

    // Missing keys are filled in, so a short row like ['title' => '…', 'year' => 2024] works
    $evRows = collect($evAwards)
        ->map(fn ($a) => $a + ['rank' => null, 'van' => null, 'title' => '', 'year' => null]);

    // Newest first; ranked awards before trophies in the same year
    $evRows = ($sort ?? true)
        ? $evRows->sortBy([['year', 'desc'], [fn ($a) => $a['rank'] === null ? 1 : 0, 'asc']])->values()
        : $evRows->values();

    $evYears = $evRows->max('year') - $evRows->min('year') + 1;

    $evTitle = $title ?? 'Top 5 Vans in Australia';
    $evSub   = $subtitle ?? 'Everest&rsquo;s Journey for the Past ' . $evYears . ' Years';

    // Background photo (sits under a dark-blue gradient)
    $evJourneyBg = asset($image ?? 'assets/abreco/images/newonce/home-ban21.jpg');

    // Unique heading id, so the section can appear more than once on a page
    $evId = 'evJourneyTitle' . \Illuminate\Support\Str::random(6);
@endphp

<section class="ev-journey" aria-labelledby="{{ $evId }}" style="--ej-photo: url('{{ $evJourneyBg }}');">

    {{-- Shared gold gradient + laurel artwork, used by every icon below --}}
    @once
        <svg class="ev-journey__defs" width="0" height="0" aria-hidden="true" focusable="false">
            <defs>
                <linearGradient id="evJGold" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0"   stop-color="#F8E3A3"/>
                    <stop offset=".45" stop-color="#D9AE55"/>
                    <stop offset=".65" stop-color="#B8862F"/>
                    <stop offset="1"   stop-color="#F1D58C"/>
                </linearGradient>
                <symbol id="evJLaurel" viewBox="0 0 120 120"><path d="M47 102 A42 42 0 0 1 24 36" fill="none" stroke="url(#evJGold)" stroke-width="1.6" stroke-linecap="round"/><path d="M73 102 A42 42 0 0 0 96 36" fill="none" stroke="url(#evJGold)" stroke-width="1.6" stroke-linecap="round"/><g fill="url(#evJGold)"><ellipse cx="42.0" cy="104.5" rx="3.2" ry="7.5" transform="rotate(-286.0 42.0 104.5)"/><ellipse cx="46.5" cy="93.4" rx="3.2" ry="7.5" transform="rotate(-210.0 46.5 93.4)"/><ellipse cx="29.1" cy="96.8" rx="3.2" ry="7.5" transform="rotate(-268.0 29.1 96.8)"/><ellipse cx="36.9" cy="87.6" rx="3.2" ry="7.5" transform="rotate(-192.0 36.9 87.6)"/><ellipse cx="19.3" cy="85.4" rx="3.2" ry="7.5" transform="rotate(-250.0 19.3 85.4)"/><ellipse cx="29.5" cy="79.1" rx="3.2" ry="7.5" transform="rotate(-174.0 29.5 79.1)"/><ellipse cx="13.4" cy="71.6" rx="3.2" ry="7.5" transform="rotate(-232.0 13.4 71.6)"/><ellipse cx="25.1" cy="68.7" rx="3.2" ry="7.5" transform="rotate(-156.0 25.1 68.7)"/><ellipse cx="12.1" cy="56.7" rx="3.2" ry="7.5" transform="rotate(-214.0 12.1 56.7)"/><ellipse cx="24.1" cy="57.5" rx="3.2" ry="7.5" transform="rotate(-138.0 24.1 57.5)"/><ellipse cx="15.5" cy="42.0" rx="3.2" ry="7.5" transform="rotate(-196.0 15.5 42.0)"/><ellipse cx="26.6" cy="46.5" rx="3.2" ry="7.5" transform="rotate(-120.0 26.6 46.5)"/><ellipse cx="23.2" cy="29.1" rx="3.2" ry="7.5" transform="rotate(-178.0 23.2 29.1)"/><ellipse cx="32.4" cy="36.9" rx="3.2" ry="7.5" transform="rotate(-102.0 32.4 36.9)"/><ellipse cx="78.0" cy="104.5" rx="3.2" ry="7.5" transform="rotate(106.0 78.0 104.5)"/><ellipse cx="73.5" cy="93.4" rx="3.2" ry="7.5" transform="rotate(30.0 73.5 93.4)"/><ellipse cx="90.9" cy="96.8" rx="3.2" ry="7.5" transform="rotate(88.0 90.9 96.8)"/><ellipse cx="83.1" cy="87.6" rx="3.2" ry="7.5" transform="rotate(12.0 83.1 87.6)"/><ellipse cx="100.7" cy="85.4" rx="3.2" ry="7.5" transform="rotate(70.0 100.7 85.4)"/><ellipse cx="90.5" cy="79.1" rx="3.2" ry="7.5" transform="rotate(-6.0 90.5 79.1)"/><ellipse cx="106.6" cy="71.6" rx="3.2" ry="7.5" transform="rotate(52.0 106.6 71.6)"/><ellipse cx="94.9" cy="68.7" rx="3.2" ry="7.5" transform="rotate(-24.0 94.9 68.7)"/><ellipse cx="107.9" cy="56.7" rx="3.2" ry="7.5" transform="rotate(34.0 107.9 56.7)"/><ellipse cx="95.9" cy="57.5" rx="3.2" ry="7.5" transform="rotate(-42.0 95.9 57.5)"/><ellipse cx="104.5" cy="42.0" rx="3.2" ry="7.5" transform="rotate(16.0 104.5 42.0)"/><ellipse cx="93.4" cy="46.5" rx="3.2" ry="7.5" transform="rotate(-60.0 93.4 46.5)"/><ellipse cx="96.8" cy="29.1" rx="3.2" ry="7.5" transform="rotate(-2.0 96.8 29.1)"/><ellipse cx="87.6" cy="36.9" rx="3.2" ry="7.5" transform="rotate(-78.0 87.6 36.9)"/></g></symbol>
                <symbol id="evJBranch" viewBox="12 24 44 86"><path d="M47 102 A42 42 0 0 1 24 36" fill="none" stroke="url(#evJGold)" stroke-width="1.6" stroke-linecap="round"/><g fill="url(#evJGold)"><ellipse cx="42.0" cy="104.5" rx="3.2" ry="7.5" transform="rotate(-286.0 42.0 104.5)"/><ellipse cx="46.5" cy="93.4" rx="3.2" ry="7.5" transform="rotate(-210.0 46.5 93.4)"/><ellipse cx="29.1" cy="96.8" rx="3.2" ry="7.5" transform="rotate(-268.0 29.1 96.8)"/><ellipse cx="36.9" cy="87.6" rx="3.2" ry="7.5" transform="rotate(-192.0 36.9 87.6)"/><ellipse cx="19.3" cy="85.4" rx="3.2" ry="7.5" transform="rotate(-250.0 19.3 85.4)"/><ellipse cx="29.5" cy="79.1" rx="3.2" ry="7.5" transform="rotate(-174.0 29.5 79.1)"/><ellipse cx="13.4" cy="71.6" rx="3.2" ry="7.5" transform="rotate(-232.0 13.4 71.6)"/><ellipse cx="25.1" cy="68.7" rx="3.2" ry="7.5" transform="rotate(-156.0 25.1 68.7)"/><ellipse cx="12.1" cy="56.7" rx="3.2" ry="7.5" transform="rotate(-214.0 12.1 56.7)"/><ellipse cx="24.1" cy="57.5" rx="3.2" ry="7.5" transform="rotate(-138.0 24.1 57.5)"/><ellipse cx="15.5" cy="42.0" rx="3.2" ry="7.5" transform="rotate(-196.0 15.5 42.0)"/><ellipse cx="26.6" cy="46.5" rx="3.2" ry="7.5" transform="rotate(-120.0 26.6 46.5)"/><ellipse cx="23.2" cy="29.1" rx="3.2" ry="7.5" transform="rotate(-178.0 23.2 29.1)"/><ellipse cx="32.4" cy="36.9" rx="3.2" ry="7.5" transform="rotate(-102.0 32.4 36.9)"/></g></symbol>
                <symbol id="evJStar" viewBox="0 0 24 24"><path fill="url(#evJGold)" d="m12 1.5 3.1 6.6 7.2.9-5.3 5 1.4 7.1L12 17.6l-6.4 3.5L7 14l-5.3-5 7.2-.9z"/></symbol>
            </defs>
        </svg>
    @endonce

    <div class="ev-journey__inner">

        {{-- Heading: stars above, laurels either side --}}
        <header class="ev-journey__head">
            <div class="ev-journey__stars" aria-hidden="true">
                <svg><use href="#evJStar"/></svg>
                <svg><use href="#evJStar"/></svg>
                <svg><use href="#evJStar"/></svg>
            </div>

            <div class="ev-journey__titlebar">
                <svg class="ev-journey__branch" aria-hidden="true"><use href="#evJBranch"/></svg>
                <h2 class="ev-journey__title" id="{{ $evId }}">
                    <span class="ev-journey__title-top">{!! $evSub !!}</span>
                    <span class="ev-journey__title-main">{{ $evTitle }}</span>
                </h2>
                <svg class="ev-journey__branch ev-journey__branch--right" aria-hidden="true"><use href="#evJBranch"/></svg>
            </div>
        </header>

        {{-- Award rows --}}
        <ol class="ev-journey__list">
            @foreach ($evRows as $a)
                <li class="ev-journey__row">
                    <span class="ev-journey__medal" aria-hidden="true">
                        <svg class="ev-journey__wreath"><use href="#evJLaurel"/></svg>
                        <span class="ev-journey__mini-stars">
                            <svg><use href="#evJStar"/></svg><svg><use href="#evJStar"/></svg><svg><use href="#evJStar"/></svg>
                        </span>
                        @if ($a['rank'])
                            <span class="ev-journey__num">{{ $a['rank'] }}</span>
                        @else
                            <svg class="ev-journey__cup" viewBox="0 0 24 24"><path d="M7 4h10v5a5 5 0 0 1-10 0z"/><path d="M7 6H4v2a3 3 0 0 0 3 3M17 6h3v2a3 3 0 0 1-3 3M12 14v4M8 21h8M9 18h6"/></svg>
                        @endif
                    </span>

                    @if ($a['van'])
                        <p class="ev-journey__text ev-journey__name">
                            <span class="ev-journey__van">{{ $a['van'] }}</span>
                        </p>
                    @endif

                    {{-- With no van name, the award text takes the empty name column too --}}
                    <p class="ev-journey__text ev-journey__what @unless ($a['van']) ev-journey__what--wide @endunless">
                        @if ($a['rank'])Rated Number {{ $a['rank'] }} {{ $a['title'] }}@else<span class="ev-journey__gold">{{ $a['title'] }}</span>@endif
                    </p>

                    <span class="ev-journey__year">{{ $a['year'] }}</span>
                </li>
            @endforeach
        </ol>

    </div>
</section>
