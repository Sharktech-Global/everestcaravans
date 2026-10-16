/* Everest — entry animations on scroll.

   Tags the elements listed in GROUPS, then animates each one the first time
   it reaches the viewport. Every group names a motion variant, so a heading,
   a photo and a grid of cards do not all arrive the same way:

     up    small lift          headings, body copy, list rows
     rise  longer lift + settle section intros
     left  slides in from the left   photo columns, left halves
     right slides in from the right  right halves
     pop   scales up                 cards, logos, feature tiles
     zoom  settles down from larger   photos
     mask  wipes upward               NOT for a lazy-loaded <img> — see below

   The hidden start state lives behind the .rv-js class on <html>, which only
   this file adds — so with JavaScript off, with no IntersectionObserver, or
   under prefers-reduced-motion, nothing is ever hidden and the page renders
   normally.

   The About section has its own reveal (about-reveal.js + the .ev-js rules),
   so it is deliberately not listed here. */
(function () {
    'use strict';

    if (!('IntersectionObserver' in window)) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    /* selector : variant — order matters only in that the first match wins */
    var GROUPS = [
        // Awards journey
        ['.ev-journey__head > *',      'rise'],
        ['.ev-journey__row',           'up'],

        // Lux Decor
        ['.ev-decor__main > *',        'rise'],
        ['.ev-decor__side > *',        'pop'],

        // Workshop / who we are
        ['.ws-about__media',           'left'],
        ['.ws-about__content > *',     'up'],

        // Partners: deliberately not listed — the section shows as-is, with
        // no entry animation on the heading or the logo tiles.

        // Tribe: reviews, then the factory block under it
        ['.ev-tribe__head > *',        'rise'],
        ['.ev-tribe__reviews > li',    'pop'],
        ['.ev-factory > *',            'up'],
        ['.ev-factory__feature',       'pop'],

        // Call-to-action band — the two halves meet in the middle
        ['.ev-ctaband__half--dark',    'left'],
        ['.ev-ctaband__half--light',   'right'],
        ['.ev-ctaband__half',          'up'],

        // Talk to the experts. The photo uses zoom rather than mask: a
        // clip-path that hides the element also stops Chrome fetching a
        // loading="lazy" image, so it never loaded and never revealed.
        ['.ev-experts__img',           'zoom'],
        ['.ev-experts__content > *',   'up']
    ];

    var items = [];

    /* Child selectors like `.ev-factory > *` also catch the <link> tags the
       section partials emit inline. Those never render, so they would sit
       tagged and unobservable forever. */
    var SKIP = /^(LINK|SCRIPT|STYLE|META|TEMPLATE|NOSCRIPT|BR)$/;

    GROUPS.forEach(function (group) {
        var sel = group[0], variant = group[1];
        Array.prototype.forEach.call(document.querySelectorAll(sel), function (el) {
            if (items.indexOf(el) !== -1) return;   // first group to claim it wins
            if (SKIP.test(el.tagName)) return;
            el.setAttribute('data-rv', variant);
            items.push(el);
        });
    });

    if (!items.length) return;

    document.documentElement.classList.add('rv-js');

    items.forEach(function (el) {
        // Stagger by position among siblings, capped so long lists don't crawl
        var i = Array.prototype.indexOf.call(el.parentNode.children, el);
        el.style.setProperty('--rv-i', Math.min(i, 6));
    });

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-in');
            io.unobserve(entry.target);          // once only
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    items.forEach(function (el) { io.observe(el); });
}());
