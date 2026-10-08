/* Everest — entry animations on scroll.
   Tags the elements listed in SELECTORS, then fades/slides each one in the
   first time it reaches the viewport. The hidden start state lives behind the
   .rv-js class on <html>, which only this file adds — so with JavaScript off,
   with no IntersectionObserver, or under prefers-reduced-motion, nothing is
   ever hidden and the page renders normally.

   The About section has its own reveal (about-reveal.js + the .ev-js rules),
   so it is deliberately not listed here. */
(function () {
    'use strict';

    if (!('IntersectionObserver' in window)) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var SELECTORS = [
        '.ev-journey__head > *',
        '.ev-journey__row',
        '.ev-decor__main > *',
        '.ev-decor__side > *',
        '.ws-about__media',
        '.ws-about__content > *'
    ];

    var items = [];
    SELECTORS.forEach(function (sel) {
        Array.prototype.forEach.call(document.querySelectorAll(sel), function (el) {
            if (items.indexOf(el) === -1) items.push(el);
        });
    });
    if (!items.length) return;

    document.documentElement.classList.add('rv-js');

    items.forEach(function (el) {
        // Stagger by position among siblings, capped so long lists don't crawl
        var i = Array.prototype.indexOf.call(el.parentNode.children, el);
        el.style.setProperty('--rv-i', Math.min(i, 6));
        el.setAttribute('data-rv', '');
    });

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-in');
            io.unobserve(entry.target);          // once only
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });

    items.forEach(function (el) { io.observe(el); });
})();
