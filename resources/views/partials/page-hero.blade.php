{{--
    Everest Caravans — Inner page top banner (title + breadcrumb)
    Reusable on every inner page:

    @include('partials.page-hero', [
        'title'       => 'About Us',
        'subtitle'    => 'Family owned, custom built off-road caravans.', // optional
        'image'       => 'assets/images/page-hero/about.jpg',      // optional
        'breadcrumbs' => [['label' => 'About Us']],                  // optional; "Home" is added automatically
    ])
--}}

{{-- Font + CSS, loaded once per page --}}
@once
    @php $phCss = 'css/page-hero.css'; @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600&display=swap" rel="stylesheet">
    @if (file_exists(public_path($phCss)))
        <link rel="stylesheet" href="{{ asset($phCss) }}?v={{ filemtime(public_path($phCss)) }}">
    @else
        <!-- EVEREST: public/{{ $phCss }} not found -->
    @endif
@endonce

@php
    $phTitle  = $title ?? 'Page';
    $phSub    = $subtitle ?? null;
    $phImage  = $image ?? 'assets/images/page-hero/default.jpg';
    $phImgUrl = file_exists(public_path($phImage)) ? asset($phImage) : null;

    // Home is always first; if no breadcrumbs are passed, the title is used.
    $phCrumbs = array_merge(
        [['label' => 'Home', 'url' => url('/')]],
        $breadcrumbs ?? [['label' => $phTitle]]
    );
@endphp

<section class="ev-pagehero" aria-labelledby="evPageHeroTitle">
    @if ($phImgUrl)
        <img class="ev-pagehero__img" src="{{ $phImgUrl }}" alt="" fetchpriority="high" decoding="async">
    @endif
    <span class="ev-pagehero__shade" aria-hidden="true"></span>

    <div class="ev-pagehero__inner">
        <nav class="ev-pagehero__crumbs" aria-label="Breadcrumb">
            <ol>
                @foreach ($phCrumbs as $crumb)
                    <li>
                        @if (!$loop->last && !empty($crumb['url']))
                            <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                            <span class="ev-pagehero__sep" aria-hidden="true">/</span>
                        @else
                            <span aria-current="page">{{ $crumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        <div class="ev-pagehero__row">
            <h1 class="ev-pagehero__title" id="evPageHeroTitle">{{ $phTitle }}</h1>
            @if ($phSub)
                <p class="ev-pagehero__sub">{{ $phSub }}</p>
            @endif
        </div>
    </div>
</section>
