/* Everest Caravans — Videos section.

   Three jobs, all scoped to .ev-videos so nothing here touches the rest
   of the page:

   1. Tabs   — one panel visible at a time, with the arrow-key handling a
               role="tablist" is expected to have.
   2. Play   — each card ships a thumbnail and a button, not an iframe.
               YouTube is only loaded for the card that is clicked, so a
               page of twenty videos still costs one player.
   3. More   — cards past 'perPage' are rendered with [hidden][data-more];
               the button reveals them and then removes itself.

   The markup works without this file: every card still links out to
   YouTube, and the first tab's panel is the one left visible. */
(function () {
    'use strict';

    var sections = document.querySelectorAll('.ev-videos');
    if (!sections.length) return;

    Array.prototype.forEach.call(sections, function (root) {
        setupTabs(root);
        setupPlay(root);
        setupMore(root);
    });

    /* ---------- 1. Tabs ---------- */
    function setupTabs(root) {
        var tabs = Array.prototype.slice.call(root.querySelectorAll('.ev-videos__tab'));
        if (tabs.length < 2) return;

        function panelFor(tab) {
            var id = tab.getAttribute('aria-controls');
            return id ? root.querySelector('#' + CSS_escape(id)) : null;
        }

        function select(tab, moveFocus) {
            tabs.forEach(function (t) {
                var on = t === tab;
                t.setAttribute('aria-selected', on ? 'true' : 'false');
                t.setAttribute('tabindex', on ? '0' : '-1');

                var panel = panelFor(t);
                if (panel) {
                    if (on) panel.removeAttribute('hidden');
                    else panel.setAttribute('hidden', '');
                }
            });
            if (moveFocus) tab.focus();
        }

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () { select(tab, false); });

            tab.addEventListener('keydown', function (e) {
                var i = tabs.indexOf(tab);
                var next = null;

                if (e.key === 'ArrowRight' || e.key === 'ArrowDown') next = tabs[(i + 1) % tabs.length];
                else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') next = tabs[(i - 1 + tabs.length) % tabs.length];
                else if (e.key === 'Home') next = tabs[0];
                else if (e.key === 'End') next = tabs[tabs.length - 1];

                if (next) {
                    e.preventDefault();
                    select(next, true);
                }
            });
        });
    }

    /* ---------- 2. Click to play ---------- */
    function setupPlay(root) {
        root.addEventListener('click', function (e) {
            var btn = e.target.closest ? e.target.closest('.ev-videos__play') : null;
            if (!btn || !root.contains(btn)) return;

            var id = btn.getAttribute('data-yt');
            var media = btn.parentNode;
            if (!id || !media) return;

            var frame = document.createElement('iframe');
            frame.src = 'https://www.youtube.com/embed/' + encodeURIComponent(id) +
                        '?autoplay=1&rel=0&modestbranding=1';
            frame.title = btn.getAttribute('data-title') || 'Everest Caravans video';
            frame.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            frame.setAttribute('allowfullscreen', '');
            frame.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');

            media.replaceChild(frame, btn);
        });
    }

    /* ---------- 3. Show more ---------- */
    function setupMore(root) {
        var buttons = root.querySelectorAll('.ev-videos__more-btn');

        Array.prototype.forEach.call(buttons, function (btn) {
            btn.addEventListener('click', function () {
                // The button lives in .ev-videos__more, a sibling of the grid
                var panel = btn.closest ? btn.closest('.ev-videos__panel') : null;
                if (!panel) return;

                var hiddenCards = panel.querySelectorAll('.ev-videos__card[data-more][hidden]');
                Array.prototype.forEach.call(hiddenCards, function (card) {
                    card.removeAttribute('hidden');
                });

                var wrap = btn.parentNode;
                if (wrap && wrap.parentNode) wrap.parentNode.removeChild(wrap);
            });
        });
    }

    /* The tab ids are ours (evVidPanel-<key>), but CSS.escape is not in
       every browser this theme supports, so fall back to escaping by hand. */
    function CSS_escape(value) {
        if (window.CSS && typeof window.CSS.escape === 'function') return window.CSS.escape(value);
        return String(value).replace(/([^a-zA-Z0-9_-])/g, '\\$1');
    }
}());
