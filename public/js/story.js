/* Everest About — image slider. Plain JavaScript, no libraries. */
(function () {
    'use strict';

    function init(root) {
        var slides = Array.prototype.slice.call(root.querySelectorAll('.ev-story__slide'));
        var dots   = Array.prototype.slice.call(root.querySelectorAll('[data-ev-goto]'));
        if (slides.length < 2) return;

        var delay   = parseInt(root.getAttribute('data-autoplay'), 10) || 0;
        var reduce  = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var current = 0, timer = null, paused = false;

        function go(index) {
            index = (index + slides.length) % slides.length;
            if (index === current) return;
            slides[current].classList.remove('is-active');
            slides[current].setAttribute('aria-hidden', 'true');
            slides[index].classList.add('is-active');
            slides[index].removeAttribute('aria-hidden');
            dots.forEach(function (d, i) {
                d.classList.toggle('is-active', i === index);
                if (i === index) d.setAttribute('aria-current', 'true'); else d.removeAttribute('aria-current');
            });
            current = index;
            schedule();
        }

        function schedule() {
            clearTimeout(timer);
            if (!delay || reduce || paused) return;
            timer = setTimeout(function () { go(current + 1); }, delay);
        }

        root.querySelector('[data-ev-prev]').addEventListener('click', function () { go(current - 1); });
        root.querySelector('[data-ev-next]').addEventListener('click', function () { go(current + 1); });
        dots.forEach(function (d) {
            d.addEventListener('click', function () { go(parseInt(d.getAttribute('data-ev-goto'), 10)); });
        });

        // Pause while the visitor is looking or using the controls
        root.addEventListener('mouseenter', function () { paused = true;  clearTimeout(timer); });
        root.addEventListener('mouseleave', function () { paused = false; schedule(); });
        root.addEventListener('focusin',    function () { paused = true;  clearTimeout(timer); });
        root.addEventListener('focusout',   function (e) { if (!root.contains(e.relatedTarget)) { paused = false; schedule(); } });
        document.addEventListener('visibilitychange', function () { if (document.hidden) clearTimeout(timer); else schedule(); });

        // Keyboard
        root.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft')  go(current - 1);
            if (e.key === 'ArrowRight') go(current + 1);
        });

        // Swipe
        var startX = null;
        root.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
        root.addEventListener('touchend', function (e) {
            if (startX === null) return;
            var dx = e.changedTouches[0].clientX - startX;
            if (Math.abs(dx) > 45) go(dx < 0 ? current + 1 : current - 1);
            startX = null;
        });

        schedule();
    }

    function boot() { document.querySelectorAll('[data-ev-slider]').forEach(init); }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot); else boot();
})();
