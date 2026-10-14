/* Hero slider — starts Owl on .vb-slider. Load after jQuery and owl.carousel.js. */
(function () {
    'use strict';
    if (!window.jQuery) { console.error('[hero-slider] Load jQuery before hero-slider.js'); return; }
    var $ = window.jQuery;

    $(function () {
        var $hero = $('.vb-hero');
        if (!$hero.length) return;
        if (!$.fn.owlCarousel) { console.error('[hero-slider] Load owl.carousel.js before hero-slider.js'); return; }

        var $slider = $hero.find('.vb-slider');
        var total   = $slider.children('.vb-slide').length;
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // On phones the slide grows to fit its content, so slides differ in
        // height; autoHeight keeps the stage on the one being shown instead of
        // holding the tallest. Desktop slides are a fixed height, so it is off
        // there — otherwise Owl would animate a height that never changes.
        var mqMobile = window.matchMedia('(max-width: 767.98px)');

        function startSlider() {
            // If anything else already started Owl here, reset it first
            if ($slider.data('owl.carousel')) $slider.trigger('destroy.owl.carousel');

            $slider.owlCarousel({
                items: 1,
                loop: total > 1,
                nav: false,
                dots: false,
                // Keeps advancing under prefers-reduced-motion: the slider has no
                // dots or arrows, so switching autoplay off left it a dead single
                // image. The motion itself is what gets dropped below — the change
                // is instant and the pause between slides is longer.
                autoplay: total > 1,
                autoplayTimeout: reduceMotion ? 9000 : 6000,
                autoplayHoverPause: true,
                smartSpeed: reduceMotion ? 0 : 900,
                autoHeight: mqMobile.matches,
                animateOut: reduceMotion ? false : 'vb-fade-out',
                mouseDrag: total > 1,
                touchDrag: total > 1
            });
        }

        startSlider();

        // Rebuild when the breakpoint is crossed so autoHeight matches the layout
        if (mqMobile.addEventListener) mqMobile.addEventListener('change', startSlider);
        else if (mqMobile.addListener) mqMobile.addListener(startSlider);


        $hero.on('keydown', function (e) {
            if (e.key === 'ArrowLeft')  $slider.trigger('prev.owl.carousel');
            if (e.key === 'ArrowRight') $slider.trigger('next.owl.carousel');
        });
    });
})();
