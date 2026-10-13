{{--
    Everest Caravans — videos from our own channel.
    Reusable on every page:

        @include('partials.ev-videos-everest')

    Any prop can be overridden per page, e.g. to show a shorter set:

        @include('partials.ev-videos-everest', ['title' => 'Van tours', 'perPage' => 6])

    The list below is the content; the markup, CSS and click-to-play
    behaviour all live in [partials.ev-videos].
--}}

@php
    // ===================== EDIT HERE =====================
    // 'youtube' takes the full link (watch, youtu.be, shorts, embed) or
    // just the 11-character ID. Rows with an empty one are skipped.
    $evEverestVideos = [
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
    ];
    // =====================================================
@endphp

@include('partials.ev-videos', [
    'key'     => 'everest',
    'videos'  => $videos  ?? $evEverestVideos,
    'title'   => $title   ?? 'Our videos',
    'text'    => $text    ?? 'Walk-arounds and internal tours of our custom builds, filmed in the yard.',
    'label'   => $label   ?? 'Everest Caravans',
    'logo'    => $logo    ?? (@$settings->logo ? 'storage/' . $settings->logo : null),
    'perPage' => $perPage ?? 9,
    // Passed straight through, so a tab strip can render this as a panel
    'as'      => $as     ?? 'section',
    'hidden'  => $hidden ?? false,
])
