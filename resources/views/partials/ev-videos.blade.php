{{--
    Everest Caravans — Video grid (YouTube cards, click to play)

    The presentational half of the video components. It renders ONE
    channel's videos; the per-channel lists live in their own partials
    so a page can pull in just the set it wants:

        @include('partials.ev-videos-everest')
        @include('partials.ev-videos-gorv')

    Call this one directly when the videos come from somewhere else:

    @include('partials.ev-videos', [
        'videos'  => [                                               // required
            ['title' => 'Kombat walk around', 'youtube' => 'https://www.youtube.com/watch?v=VIDEO_ID'],
        ],
        'title'   => 'Videos',                                       // heading; null hides the header
        'text'    => 'Walk-arounds and independent reviews.',        // intro under the heading
        'label'   => 'Everest Caravans',                             // small label on each card
        'logo'    => 'assets/abreco/images/newonce/gorv_v.png',      // optional mark above the heading
        'perPage' => 9,                                              // cards before "Show more videos"
        'key'     => 'everest',                                      // unique per section on a page
    ])

    'youtube' takes any YouTube link (watch, youtu.be, shorts, embed) or
    the bare 11-character ID. Rows without a usable one are dropped, and
    the whole section renders nothing when none are left.

    A card only loads YouTube when it is clicked — the thumbnail comes
    from i.ytimg.com, so a page of twenty videos still costs one player.

    CSS: public/css/videos.css   JS: public/js/videos.js  (both loaded once)
--}}

{{-- Font + CSS + behaviour, loaded once per page however many sections --}}
@once
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
    @if (file_exists(public_path($evVidJs)))
        <script src="{{ asset($evVidJs) }}?v={{ filemtime(public_path($evVidJs)) }}" defer></script>
    @else
        <!-- EVEREST: public/{{ $evVidJs }} not found -->
    @endif
@endonce

@php
    // Pull the 11-character video ID out of any YouTube link
    $evYtId = function ($s) {
        $s = trim((string) $s);
        if (preg_match('~(?:youtu\.be/|[?&]v=|/embed/|/shorts/|/live/)([A-Za-z0-9_-]{11})~', $s, $m)) return $m[1];
        return preg_match('~^[A-Za-z0-9_-]{11}$~', $s) ? $s : null;
    };

    $evList = [];
    foreach ($videos ?? [] as $v) {
        if ($id = $evYtId($v['youtube'] ?? '')) {
            $evList[] = ['id' => $id, 'title' => $v['title'] ?? ''];
        }
    }

    $evKey   = $key ?? \Illuminate\Support\Str::random(6);
    $evLabel = $label ?? '';
    $evPer   = (int) ($perPage ?? 9);
    $evTitle = $title ?? null;
    $evText  = $text ?? null;

    // 'panel' drops the <section> and heading and emits just the grid, so a
    // tab strip can hold several channels in one section — see
    // partials/ev-videos-tabs.blade.php. Default is a standalone section.
    $evPanelOnly = ($as ?? 'section') === 'panel';
    $evHidden    = (bool) ($hidden ?? false);

    // Uploaded names carry spaces and brackets, so encode each segment
    $evLogo    = $logo ?? null;
    $evLogoUrl = $evLogo && is_file(public_path($evLogo))
        ? asset(implode('/', array_map('rawurlencode', explode('/', $evLogo))))
        : null;
@endphp

@if (count($evList))
@unless ($evPanelOnly)
<section class="ev-videos" @if ($evTitle) aria-labelledby="evVidTitle-{{ $evKey }}" @else aria-label="Videos" @endif>
    <div class="ev-videos__inner">

        @if ($evTitle || $evText || $evLogoUrl)
            <header class="ev-videos__head">
                @if ($evLogoUrl)
                    <img class="ev-videos__logo" src="{{ $evLogoUrl }}" alt="{{ $evLabel }}" decoding="async">
                @endif
                @if ($evTitle)
                    <h2 class="ev-videos__heading" id="evVidTitle-{{ $evKey }}">{{ $evTitle }}</h2>
                @endif
                @if ($evText)
                    <p class="ev-videos__intro">{{ $evText }}</p>
                @endif
            </header>
        @endif
@endunless

        {{-- Also the scope "Show more" reveals within --}}
        <div class="ev-videos__panel"
             @if ($evPanelOnly)
                 role="tabpanel" id="evVidPanel-{{ $evKey }}"
                 aria-labelledby="evVidTab-{{ $evKey }}" tabindex="0"
                 @if ($evHidden) hidden @endif
             @endif>
            <ul class="ev-videos__grid">
                @foreach ($evList as $j => $v)
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
                                {{ $evLabel }}
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

            @if (count($evList) > $evPer)
                <div class="ev-videos__more">
                    <button type="button" class="ev-videos__more-btn">Show more videos</button>
                </div>
            @endif
        </div>

@unless ($evPanelOnly)
    </div>
</section>
@endunless
@endif
