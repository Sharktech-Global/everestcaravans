@extends('layouts.front')

@section('content')
    <!--====== Videos Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Videos',
        'subtitle'    => 'BUILT FOR YOUR LIFESTYLE!',
        'image'       => 'assets/abreco/images/newonce/blog-banner.jpg',
        'breadcrumbs' => [['label' => 'Videos']],
    ])

{{-- Everest Caravans — Videos section (tabs: Everest Caravans | GoRV, YouTube cards)
     Files: public/css/videos.css, public/js/videos.js
     Logos:  public/assets/images/videos/everest-logo.png, gorv-logo.png
     A video only loads YouTube when it's clicked (thumbnail first = fast page). --}}

@php
    $evVidCss = 'css/videos.css';
    $evVidJs  = 'js/videos.js';
@endphp
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600&display=swap" rel="stylesheet">
@if (file_exists(public_path($evVidCss)))
    <link rel="stylesheet" href="{{ asset($evVidCss) }}?v={{ filemtime(public_path($evVidCss)) }}">
@else
    <!-- EVEREST: public/{{ $evVidCss }} not found -->
@endif

@php
    // ===================== EDIT HERE =====================
    // 'youtube' takes the full link (watch, youtu.be, shorts, embed) or just the 11-character ID.
    // Videos with an empty 'youtube' are skipped; a tab with no videos is hidden.
    $evVideos = [
        'title'   => 'Videos',
        'text'    => 'Walk-arounds, internal tours and independent reviews of our custom builds.',
        'perPage' => 9,   // cards shown before "Show more videos"

        'tabs' => [
            [
                'key'   => 'everest',
                'name'  => 'Everest Caravans',
                // The dark mark from admin → Settings, so the tab follows the site logo
                'logo'  => 'storage/' . (@$settings->logo ?: ''),
                'label' => 'Everest Caravans',
                'videos' => [
                    ['title' => 'Custom 19.7ft Kombat Semi Off-Road Family Bunk Van Walk Around',      'youtube' => 'https://www.youtube.com/watch?v=av3hDPyywcg'],
                    ['title' => 'Custom 19.7ft Kombat Family Bunk Van - Internal Walk Through',        'youtube' => 'https://www.youtube.com/watch?v=CCX5yVERtrU'],
                    ['title' => 'Everest 21ft Vantage Family Bunk Caravan',                            'youtube' => 'https://www.youtube.com/watch?v=d-SH8ftHGp0'],
                    ['title' => 'Everest 21ft Vantage Family Bunk Caravans - Internal Walk Through',   'youtube' => 'https://www.youtube.com/watch?v=8gAuudCMWBk'],
                    ['title' => 'Everest 18ft Camo Off Road Family Caravan - Internal Tour',           'youtube' => 'https://www.youtube.com/watch?v=qgv6bENgY5k'],
                    ['title' => 'Everest 18ft Camo Family Bunk Van External Walk Around',              'youtube' => 'https://www.youtube.com/watch?v=-8KULhUHX7Y'],
                    ['title' => 'Everest 18.6FT Alpine - External Walk Through',                       'youtube' => 'https://www.youtube.com/watch?v=OhNC69-XOF4'],
                    ['title' => 'Everest 22.2FT Storm - Internal Walk Through',                        'youtube' => 'https://www.youtube.com/watch?v=2UKzrAUR0Eg'],
                    ['title' => 'Everest 22.2ft Storm - External Walk Around',                         'youtube' => 'https://www.youtube.com/watch?v=p24KKlXCUPQ'],
                    ['title' => 'Everest 19.7ft Kombat - Inside Walk Through',                         'youtube' => 'https://www.youtube.com/watch?v=64kRb1UmqWQ'],
                    ['title' => 'Everest 18.6FT Alpine - Compact Family Bunk Off Road Caravan',        'youtube' => 'https://www.youtube.com/watch?v=fOJj_RIyMR0'],
                    ['title' => '18.6FT Alpine Off Road Family Bunk Caravan',                          'youtube' => 'https://www.youtube.com/watch?v=lxRNKs-HswA'],
                    ['title' => 'Everest Caravans - Blizzard 21.6ft',                                  'youtube' => 'https://www.youtube.com/watch?v=j78_tTfrRlE'],
                    ['title' => '21ft Everest Vantage - Family Bunk Van Walk Through',                 'youtube' => 'https://www.youtube.com/watch?v=YOUgdaYhMhA'],
                    ['title' => '22.8ft Everest Glider Caravan Inside Walk Through',                   'youtube' => 'https://www.youtube.com/watch?v=V1aug7k14qc'],
                    ['title' => '22.8ft Everest Ice Glider Family Bunk Off Road Caravan',              'youtube' => 'https://www.youtube.com/watch?v=6xE_KZD00XE'],
                    ['title' => 'Everest 22ft Ice Glider Full Off Road Family Bunk Van',               'youtube' => 'https://www.youtube.com/watch?v=1wTUkUAymcA'],
                    ['title' => 'Small 18FT Family Off Road Caravan',                                  'youtube' => 'https://www.youtube.com/watch?v=iIBNxz9FTzU'],
                    ['title' => 'Van reading lights with mood lighting and USB charging ports',        'youtube' => 'https://www.youtube.com/watch?v=6Cr7k1ZlUfI'],
                ],
            ],
            [
                'key'   => 'gorv',
                'name'  => 'GoRV',
                'logo'  => 'assets/abreco/images/newonce/gorv_v.png',
                'label' => 'GoRV review',
                'videos' => [
                    ['title' => 'Caravan Review: Everest Caravans Kombat Performance', 'youtube' => 'https://www.youtube.com/watch?v=Y2EVh8aNbqM'],
                    ['title' => 'Review: Everest Caravans Kombat Performance',         'youtube' => 'https://www.youtube.com/watch?v=vbOK0TpUwrI'],
                    ['title' => 'Review: Everest Caravans Kombat 19ft 7in Family Van', 'youtube' => 'https://www.youtube.com/watch?v=1Mc0mpkVJSE'],
                    ['title' => 'Review: Everest Caravans Camo',                       'youtube' => 'https://www.youtube.com/watch?v=AsvJGeDIR6o'],
                    ['title' => 'Review: Everest Ice Glider Offroader',                'youtube' => 'https://www.youtube.com/watch?v=6z_q4gugREA'],
                ],
            ],
        ],
    ];
    // =====================================================

    // Pull the 11-character video ID out of any YouTube link
    $evYtId = function ($s) {
        $s = trim((string) $s);
        if (preg_match('~(?:youtu\.be/|[?&]v=|/embed/|/shorts/|/live/)([A-Za-z0-9_-]{11})~', $s, $m)) return $m[1];
        return preg_match('~^[A-Za-z0-9_-]{11}$~', $s) ? $s : null;
    };

    $evTabs = [];
    foreach ($evVideos['tabs'] as $t) {
        $list = [];
        foreach ($t['videos'] as $v) {
            if ($id = $evYtId($v['youtube'] ?? '')) $list[] = ['id' => $id, 'title' => $v['title']];
        }
        if ($list) {
            $t['list'] = $list;
            // Uploaded logo names carry spaces and brackets, so encode each segment
            $t['logoUrl'] = $t['logo'] && is_file(public_path($t['logo']))
                ? asset(implode('/', array_map('rawurlencode', explode('/', $t['logo']))))
                : null;
            $evTabs[] = $t;
        }
    }
    $evPer = (int) $evVideos['perPage'];
@endphp

@if (count($evTabs))
<section class="ev-videos" aria-labelledby="evVideosTitle">
    <div class="ev-videos__inner">

      

        {{-- Tabs --}}
        <div class="ev-videos__tabs-wrap">
            <div class="ev-videos__tabs" role="tablist" aria-label="Video channels">
                @foreach ($evTabs as $i => $t)
                    <button type="button" class="ev-videos__tab" role="tab"
                            id="evVidTab-{{ $t['key'] }}" aria-controls="evVidPanel-{{ $t['key'] }}"
                            aria-label="{{ $t['name'] }}"
                            aria-selected="{{ $i === 0 ? 'true' : 'false' }}" tabindex="{{ $i === 0 ? '0' : '-1' }}">
                        {{-- Logo only; the name is on the button's aria-label. The text
                             fallback is kept so a missing file can't leave a blank tab. --}}
                        @if ($t['logoUrl'])
                            <img src="{{ $t['logoUrl'] }}" alt="" decoding="async">
                        @else
                            <span class="ev-videos__tab-name">{{ $t['name'] }}</span>
                        @endif
                        <span class="ev-videos__count" aria-label="{{ count($t['list']) }} videos">{{ count($t['list']) }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Panels --}}
        @foreach ($evTabs as $i => $t)
            <div class="ev-videos__panel" role="tabpanel" id="evVidPanel-{{ $t['key'] }}"
                 aria-labelledby="evVidTab-{{ $t['key'] }}" tabindex="0" @if ($i > 0) hidden @endif>

                <ul class="ev-videos__grid">
                    @foreach ($t['list'] as $j => $v)
                        <li class="ev-videos__card" @if ($j >= $evPer) hidden data-more @endif>
                            <div class="ev-videos__media">
                                <button type="button" class="ev-videos__play" data-yt="{{ $v['id'] }}" data-title="{{ $v['title'] }}" aria-label="Play video: {{ $v['title'] }}">
                                    <img src="https://i.ytimg.com/vi/{{ $v['id'] }}/hqdefault.jpg" alt="" width="480" height="360" loading="lazy" decoding="async" onerror="this.remove()">
                                    <span class="ev-videos__btn" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" width="20" height="20"><path d="M8 5.5v13l10.5-6.5z"/></svg>
                                        <span class="ev-videos__btn-text">Play video</span>
                                    </span>
                                </button>
                            </div>
                            <div class="ev-videos__body">
                                <p class="ev-videos__label">
                                    <span>{{ sprintf('%02d', $j + 1) }}</span>
                                    {{ $t['label'] }}
                                </p>
                                <h3 class="ev-videos__title">{{ $v['title'] }}</h3>
                            </div>
                            <a class="ev-videos__yt" href="https://www.youtube.com/watch?v={{ $v['id'] }}" target="_blank" rel="noopener noreferrer">
                                Watch on YouTube
                                <svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8"/></svg>
                            </a>
                        </li>
                    @endforeach
                </ul>

                @if (count($t['list']) > $evPer)
                    <div class="ev-videos__more">
                        <button type="button" class="ev-videos__more-btn">Show more videos</button>
                    </div>
                @endif
            </div>
        @endforeach

    </div>
</section>

@if (file_exists(public_path($evVidJs)))
    <script src="{{ asset($evVidJs) }}?v={{ filemtime(public_path($evVidJs)) }}" defer></script>
@else
    <!-- EVEREST: public/{{ $evVidJs }} not found -->
@endif
@endif
@endsection
