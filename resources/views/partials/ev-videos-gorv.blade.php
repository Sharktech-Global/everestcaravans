{{--
    GoRV — independent reviews of Everest caravans.
    Reusable on every page:

        @include('partials.ev-videos-gorv')

    Any prop can be overridden per page, e.g. to show a shorter set:

        @include('partials.ev-videos-gorv', ['title' => 'Reviews', 'perPage' => 3])

    The list below is the content; the markup, CSS and click-to-play
    behaviour all live in [partials.ev-videos].
--}}

@php
    // ===================== EDIT HERE =====================
    // 'youtube' takes the full link (watch, youtu.be, shorts, embed) or
    // just the 11-character ID. Rows with an empty one are skipped.
    $evGorvVideos = [
        ['title' => 'Caravan Review: Everest Caravans Kombat Performance', 'youtube' => 'https://www.youtube.com/watch?v=Y2EVh8aNbqM'],
        ['title' => 'Review: Everest Caravans Kombat Performance',         'youtube' => 'https://www.youtube.com/watch?v=vbOK0TpUwrI'],
        ['title' => 'Review: Everest Caravans Kombat 19ft 7in Family Van', 'youtube' => 'https://www.youtube.com/watch?v=1Mc0mpkVJSE'],
        ['title' => 'Review: Everest Caravans Camo',                       'youtube' => 'https://www.youtube.com/watch?v=AsvJGeDIR6o'],
        ['title' => 'Review: Everest Ice Glider Offroader',                'youtube' => 'https://www.youtube.com/watch?v=6z_q4gugREA'],
    ];
    // =====================================================
@endphp

@include('partials.ev-videos', [
    'key'     => 'gorv',
    'videos'  => $videos  ?? $evGorvVideos,
    'title'   => $title   ?? '',
    'text'    => $text    ?? '',
    'label'   => $label   ?? 'GoRV review',
    'logo'    => $logo    ?? 'assets/abreco/images/newonce/gorv_v.png',
    'perPage' => $perPage ?? 9,
    // Passed straight through, so a tab strip can render this as a panel
    'as'      => $as     ?? 'section',
    'hidden'  => $hidden ?? false,
])
