/* Everest About — one reveal when the section scrolls into view. Optional. */
(function () {
    'use strict';
    var section = document.querySelector('[data-ev-reveal]');
    if (!section) return;

    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce || !('IntersectionObserver' in window)) return;   // content just shows

    document.documentElement.classList.add('ev-js');               // enables the hidden start state

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-in');
            io.unobserve(entry.target);
        });
    }, { threshold: 0.2 });

    io.observe(section);
})();
