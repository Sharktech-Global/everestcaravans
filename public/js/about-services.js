/* Everest — "Who we are" service tabs.
   Drives [data-ws-tabs]: click / arrow-key switching plus autoplay.
   The progress line is CSS; this only toggles .is-running / .is-paused and
   restarts the animation by replaying the class. No dependencies. */
(function () {
    'use strict';

    var groups = document.querySelectorAll('[data-ws-tabs]');
    if (!groups.length) return;

    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    Array.prototype.forEach.call(groups, function (root) {
        var tabs   = Array.prototype.slice.call(root.querySelectorAll('[role="tab"]'));
        var panels = Array.prototype.slice.call(root.querySelectorAll('[role="tabpanel"]'));
        if (tabs.length < 2) return;

        var delay = parseInt(root.getAttribute('data-autoplay'), 10);
        var autoplay = !reduce && delay > 0;
        var timer = null;
        var current = Math.max(0, tabs.findIndex ? tabs.findIndex(isActive) : 0);

        function isActive(t) { return t.getAttribute('aria-selected') === 'true'; }

        // Hand the duration to the CSS progress line so the two stay in step
        if (autoplay) root.style.setProperty('--ws-autoplay', delay + 'ms');

        function show(i, focus) {
            current = (i + tabs.length) % tabs.length;

            tabs.forEach(function (tab, n) {
                var on = n === current;
                tab.classList.toggle('is-active', on);
                tab.setAttribute('aria-selected', on ? 'true' : 'false');
                tab.setAttribute('tabindex', on ? '0' : '-1');
            });
            panels.forEach(function (panel, n) {
                var on = n === current;
                panel.classList.toggle('is-active', on);
                if (on) { panel.removeAttribute('hidden'); } else { panel.setAttribute('hidden', ''); }
            });

            if (focus) tabs[current].focus();
            restart();
        }

        // Removing and re-adding the class forces the progress animation to replay
        function restart() {
            if (!autoplay) return;
            root.classList.remove('is-running');
            void root.offsetWidth;
            root.classList.add('is-running');

            clearTimeout(timer);
            timer = setTimeout(function () { show(current + 1); }, delay);
        }

        tabs.forEach(function (tab, n) {
            tab.addEventListener('click', function () { show(n); });
        });

        root.addEventListener('keydown', function (e) {
            if (tabs.indexOf(e.target) === -1) return;
            var k = e.key;
            if (k === 'ArrowRight' || k === 'ArrowDown')     { e.preventDefault(); show(current + 1, true); }
            else if (k === 'ArrowLeft' || k === 'ArrowUp')   { e.preventDefault(); show(current - 1, true); }
            else if (k === 'Home')                           { e.preventDefault(); show(0, true); }
            else if (k === 'End')                            { e.preventDefault(); show(tabs.length - 1, true); }
        });

        // Hold while the reader is on the section, and while the page is hidden
        if (autoplay) {
            ['mouseenter', 'focusin'].forEach(function (ev) {
                root.addEventListener(ev, function () {
                    clearTimeout(timer);
                    root.classList.add('is-paused');
                });
            });
            ['mouseleave', 'focusout'].forEach(function (ev) {
                root.addEventListener(ev, function () {
                    root.classList.remove('is-paused');
                    restart();
                });
            });
            document.addEventListener('visibilitychange', function () {
                if (document.hidden) { clearTimeout(timer); } else { restart(); }
            });
            restart();
        }
    });
})();
