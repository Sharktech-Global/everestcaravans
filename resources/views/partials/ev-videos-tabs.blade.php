{{--
    Everest Caravans — Videos with a channel switcher.

    One section, two logo tabs across the top: click Everest and our own
    videos show, click GoRV and the reviews show. Each panel is the
    matching channel component rendered with 'as' => 'panel', so the video
    lists stay where they are edited:

        resources/views/partials/ev-videos-everest.blade.php
        resources/views/partials/ev-videos-gorv.blade.php

    Use it on a page with:

        @include('partials.ev-videos-tabs')

    Or override the heading:

        @include('partials.ev-videos-tabs', [
            'title' => 'Videos',
            'text'  => 'Walk-arounds and independent reviews.',
        ])

    To show a single channel instead, include that component on its own —
    it renders a standalone section with its own heading.

    The count on each tab is filled in by public/js/videos.js from the
    cards in its panel, so it can never disagree with what is listed.
--}}

@php
    // ===================== EDIT HERE =====================
    $evTabHead = [
        'title' => $title ?? 'Videos',
        'text'  => $text  ?? 'Walk-arounds, internal tours and independent reviews of our custom builds.',
    ];

    // One entry per tab. 'include' is the component rendered in its panel.
    $evTabs = [
        [
            'key'     => 'everest',
            'name'    => 'Everest Caravans',
            'logo'    => @$settings->logo ? 'storage/' . $settings->logo : null,
            'include' => 'partials.ev-videos-everest',
        ],
        [
            'key'     => 'gorv',
            'name'    => 'GoRV',
            'logo'    => 'assets/abreco/images/newonce/gorv_v.png',
            'include' => 'partials.ev-videos-gorv',
        ],
    ];
    // =====================================================

    // Uploaded logo names carry spaces and brackets, so encode each segment
    foreach ($evTabs as $i => $t) {
        $evTabs[$i]['logoUrl'] = $t['logo'] && is_file(public_path($t['logo']))
            ? asset(implode('/', array_map('rawurlencode', explode('/', $t['logo']))))
            : null;
    }
@endphp

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
                        <span class="ev-videos__count" aria-hidden="true"></span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Panels: the channel components, each without its own section --}}
        @foreach ($evTabs as $i => $t)
            @include($t['include'], ['as' => 'panel', 'hidden' => $i > 0])
        @endforeach

    </div>
</section>
