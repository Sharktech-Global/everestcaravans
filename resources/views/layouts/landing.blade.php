<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Everest Caravans')</title>
    <meta name="description" content="@yield('meta_description', '')">

    @php
        // Campaign pages are standalone: no site header, footer or menus, and
        // none of the theme CSS behind them. Everything the page needs is the
        // font pair plus its own stylesheet.
        // $settings is the GeneralSetting record, shared with every view by
        // GeneralSettingsComposer — the same source the site header uses.
        $lpSettings = $settings ?? null;

        // The header sits on white, so it takes the dark mark; the footer is
        // dark, so it takes the light one, falling back the way the site does.
        $lpLogo = @$lpSettings->logo ? asset('storage/' . $lpSettings->logo) : null;

        $lpLogoLight = (@$lpSettings->logo_secondary ?: @$lpSettings->logo)
            ? asset('storage/' . ($lpSettings->logo_secondary ?: $lpSettings->logo))
            : null;

        $lpFavicon = @$lpSettings->favicon ? asset('storage/' . $lpSettings->favicon) : null;
    @endphp

    @if ($lpFavicon)
        <link rel="icon" href="{{ $lpFavicon }}" type="image/x-icon">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap">

    @php $lpCss = 'css/warrior-landing.css'; @endphp
    @if (file_exists(public_path($lpCss)))
        <link rel="stylesheet" href="{{ asset($lpCss) }}?v={{ filemtime(public_path($lpCss)) }}">
    @else
        <!-- EVEREST: public/{{ $lpCss }} not found -->
    @endif

    @yield('css_after')

    {{-- The site-wide GTM container, so campaign traffic lands in the same
         property as the rest of the site. --}}
    @php $lpGtm = \App\Gtm::first(); @endphp
    @if ($lpGtm && filled($lpGtm->head))
        {!! $lpGtm->head !!}
    @endif





    <style>

.warrior-enquiry-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.warrior-enquiry-form h3 {
    font-size: 28px;
    line-height: 1.25;
    font-weight: 700;
    margin: 0 0 8px;
}

.warrior-enquiry-form h4 {
    font-size: 20px;
    font-weight: 600;
    margin: 12px 0 0;
}

.warrior-form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.warrior-form-group label {
    font-size: 14px;
    font-weight: 600;
}

.warrior-form-group input,
.warrior-form-group select {
    width: 100%;
    min-height: 50px;
    padding: 12px 15px;
    border: 1px solid #d5d9df;
    border-radius: 8px;
    background: #fff;
    color: #222;
    font-size: 15px;
    font-family: inherit;
    box-sizing: border-box;
}

.warrior-form-group input:focus,
.warrior-form-group select:focus {
    outline: none;
    border-color: #a71c24;
    box-shadow: 0 0 0 3px rgba(167, 28, 36, 0.1);
}

.warrior-form-note {
    font-size: 13px;
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.warrior-error {
    color: #c62828;
    font-size: 12px;
}

.warrior-submit-btn {
    width: 100%;
    padding: 16px 24px;
    border: none;
    border-radius: 8px;
    background: #a71c24;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s ease;
}

.warrior-submit-btn:hover {
    background: #80151b;
}

@media (max-width: 767px) {
    .warrior-enquiry-form h3 {
        font-size: 23px;
    }
}
</style>
</head>

<body class="wl-page">

    @if ($lpGtm && filled($lpGtm->body))
        {!! $lpGtm->body !!}
    @endif

    {{-- ============================================================
         HEADER — logo and one call to action, nothing else. A campaign
         page has a single job, so there is no menu to wander off into.
         ============================================================ --}}
    <header class="wl-header" id="top">
        <div class="wl-header__inner">
            <a class="wl-header__logo" href="{{ route('home') }}" aria-label="Everest Caravans home">
                @if ($lpLogo)
                    <img src="{{ $lpLogo }}" alt="Everest Caravans" width="170" height="48">
                @else
                    <span class="wl-wordmark">Everest<em>Caravans</em></span>
                @endif
            </a>

            <a class="wl-btn wl-btn--sm" href="#enquire">
                Enquire Now
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
            </a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- ============================================================
         FOOTER — written for this page only. It repeats the contact
         details and the call to action rather than linking out to the
         rest of the site.
         ============================================================ --}}
    <footer class="wl-footer">
        <div class="wl-footer__inner">

            <div class="wl-footer__brand">
                @if ($lpLogoLight)
                    <img class="wl-footer__logo" src="{{ $lpLogoLight }}" alt="Everest Caravans"
                         width="180" height="52" loading="lazy" decoding="async">
                @else
                    <span class="wl-wordmark wl-wordmark--light">Everest<em>Caravans</em></span>
                @endif
                <p class="wl-footer__about">
                    An Australian-owned, family-run caravan manufacturer with over 15 years
                    in the industry, building caravans around how our customers actually travel.
                </p>

                @if (@$lpSettings->facebook || @$lpSettings->instagram || @$lpSettings->youtube)
                    <ul class="wl-footer__social">
                        @if (@$lpSettings->facebook)
                            <li><a href="{{ $lpSettings->facebook }}" target="_blank" rel="noopener" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H9v3h2v7h3v-7h2.5l.5-3H14V9.5c0-.3.2-.5.5-.5H14Z"/></svg>
                            </a></li>
                        @endif
                        @if (@$lpSettings->instagram)
                            <li><a href="{{ $lpSettings->instagram }}" target="_blank" rel="noopener" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 8.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm5-1.2a.9.9 0 1 1-1.8 0 .9.9 0 0 1 1.8 0ZM7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4Z"/></svg>
                            </a></li>
                        @endif
                        @if (@$lpSettings->youtube)
                            <li><a href="{{ $lpSettings->youtube }}" target="_blank" rel="noopener" aria-label="YouTube">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.6 7.2A2.5 2.5 0 0 0 19.8 5.4C18.2 5 12 5 12 5s-6.2 0-7.8.4A2.5 2.5 0 0 0 2.4 7.2 26 26 0 0 0 2 12a26 26 0 0 0 .4 4.8 2.5 2.5 0 0 0 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.4a2.5 2.5 0 0 0 1.8-1.8A26 26 0 0 0 22 12a26 26 0 0 0-.4-4.8ZM10 15V9l5 3-5 3Z"/></svg>
                            </a></li>
                        @endif
                    </ul>
                @endif
            </div>

            <div class="wl-footer__contact">
                <h3 class="wl-footer__title">Everest Caravans</h3>
                <ul class="wl-footer__list">
                    <li>
                        <span class="wl-footer__label">Address</span>
                        <span>51 Glenbarry Road, Campbellfield VIC 3061</span>
                    </li>
                    <li>
                        <span class="wl-footer__label">Phone</span>
                        <a href="tel:0393579440">(03) 9357 9440</a>
                    </li>
                    <li>
                        <span class="wl-footer__label">Email</span>
                        <a href="mailto:info@everestcaravans.com.au">info@everestcaravans.com.au</a>
                    </li>
                    <li>
                        <span class="wl-footer__label">Email</span>
                        <a href="mailto:sales@everestcaravans.com.au">sales@everestcaravans.com.au</a>
                    </li>
                </ul>
            </div>

            <div class="wl-footer__cta">
                <p class="wl-footer__cta-title">Ready to talk Warriors?</p>
                <p class="wl-footer__cta-text">
                    Request pricing, full specifications or a factory inspection.
                </p>
                <a class="wl-btn wl-btn--gold" href="#enquire">
                    Request Pricing
                    <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10h11m-4-4 4 4-4 4"/></svg>
                </a>
            </div>

        </div>

        <div class="wl-footer__bar">
            <p>Copyright &copy; {{ date('Y') }} Everest Caravans. Digitally Empowered By
                <a href="https://www.vcpility.com.au/" target="_blank" rel="noopener">Sharktech VCPility</a>
            </p>
            <ul class="wl-footer__legal">
                <li><a href="{{ route('privacy.show') }}">Privacy Policy</a></li>
                <li><a href="{{ route('terms.show') }}">Terms of Use</a></li>
            </ul>
        </div>
    </footer>

    @yield('js_after')

    {{--
        No chat widget on the landing pages.

        The campaign already has the GoHighLevel enquiry form in the page, so a
        second LeadConnector entry point only competes with it. The widget also
        injected Roboto into the document through the deprecated css?family= API
        (three requests) plus two jsdelivr woff2 files, none of which set
        font-display - they showed up in the Lighthouse font-display audit.

        The rest of the site still loads it from layouts/front.blade.php.
    --}}
</body>

</html>
