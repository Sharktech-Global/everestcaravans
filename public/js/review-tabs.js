/* Review tabs — deep linking
   =========================================================================
   The Customer Reviews block on the vehicle page is a set of Bootstrap tabs:

       <a data-toggle="tab" href="#everest-revieww">   ->   <div class="tab-pane" id="everest-revieww">

   Bootstrap wires those up for CLICKS only. It never looks at the address
   bar, so arriving at

       /vehicle/summitt-22-8f#everest-revieww

   left "Google Reviews" selected. The browser could not fall back to simply
   scrolling to the element either: an inactive .tab-pane is display:none, so
   there was nothing on the page to scroll to. The link looked dead.

   This file closes both halves of that loop — it opens the tab named in the
   hash on arrival, and it writes the hash back when a tab is clicked, so the
   address bar always holds a link that works when pasted somewhere else.
   ========================================================================= */
(function ($) {
    'use strict';

    if (!$ || !$.fn || !$.fn.tab) return;        // Bootstrap's tab plugin is required

    var STRIP = '#reviewTabs';

    /* The tab link whose href is this hash, or null. */
    function triggerFor(hash) {
        if (!hash || hash.length < 2) return null;
        try {
            return document.querySelector(STRIP + ' a[href="' + hash + '"]');
        } catch (e) {
            return null;                          // hash isn't a usable selector
        }
    }

    /* The header only gains .sticky once the page has been scrolled, which
       has not happened yet when we measure — but it certainly will have by
       the time we land. So reserve the height of any header that CAN go
       sticky, not just one that currently is, or the section heading ends
       up underneath it. */
    function headerOffset() {
        var h = document.querySelector('.abreco-sticky, .header-sticky');
        return h ? h.offsetHeight + 20 : 20;
    }

    function scrollToReviews(smooth) {
        var section = document.querySelector('.vehicle-reviews');
        if (!section) return;
        var top = section.getBoundingClientRect().top + window.pageYOffset - headerOffset();
        try {
            window.scrollTo({ top: top, behavior: smooth ? 'smooth' : 'auto' });
        } catch (e) {
            window.scrollTo(0, top);              // older browsers take two numbers
        }
    }

    function openFromHash(scroll) {
        var el = triggerFor(window.location.hash);
        if (!el) return false;
        $(el).tab('show');
        if (scroll) scrollToReviews(true);
        return true;
    }

    $(function () {
        /* Everything above the reviews — hero slider, gallery, the video
           embeds inside the pane itself — is still settling at this point,
           so the first measurement lands short. Correct it as the page
           finishes rather than trusting one reading. */
        if (openFromHash(false)) {
            setTimeout(function () { scrollToReviews(false); }, 60);
            $(window).on('load', function () {
                setTimeout(function () { scrollToReviews(false); }, 120);
            });
        }

        /* Keep the address bar in step. replaceState rather than assigning
           location.hash, which would make the browser jump to the pane and
           fight the smooth scroll. */
        $(document).on('shown.bs.tab', STRIP + ' a[data-toggle="tab"]', function (e) {
            var href = e.target.getAttribute('href');
            if (href && window.history && window.history.replaceState) {
                window.history.replaceState(null, '', href);
            }
        });

        /* A hash pasted into the bar of an already-open page. */
        $(window).on('hashchange', function () { openFromHash(true); });
    });
})(window.jQuery);
