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

        // If anything else already started Owl here, reset it first
        if ($slider.data('owl.carousel')) $slider.trigger('destroy.owl.carousel');

        $slider.owlCarousel({
            items: 1,
            loop: total > 1,
            nav: false,
            dots: false,
            autoplay: total > 1 && !reduceMotion,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            smartSpeed: 900,
            animateOut: reduceMotion ? false : 'vb-fade-out',
            mouseDrag: total > 1,
            touchDrag: total > 1
        });


        $hero.on('keydown', function (e) {
            if (e.key === 'ArrowLeft')  $slider.trigger('prev.owl.carousel');
            if (e.key === 'ArrowRight') $slider.trigger('next.owl.carousel');
        });
    });
})();
