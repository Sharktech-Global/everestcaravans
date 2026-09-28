(function ($) {

    "use strict";
// test preloader
// window.onload = function(){
//     document.getElementById("preloader-wrap").style.display = "none";
//     document.getElementById("preloading").style.display = "block";
// }

$(window).load(function(){
    $('#loading').fadeOut();
    $('#loading-img').delay(150).fadeOut('slow');
}),4000;


    //===== Preloader
    function handlePreloader() {
        if($('.loader-wrap').length){
            $('.loader-wrap').delay(1000).fadeOut(500);
        }
        TweenMax.to($(".loader-wrap .overlay"), 1.2, {
            force3D: true,
            left: "100%",
            ease: Expo.easeInOut,
        });
    }


    if ($(".preloader-close").length) {
        $(".preloader-close").on("click", function(){
            $('.loader-wrap').delay(200).fadeOut(500);
        })
    }

    $(window).on('load', function() {
        handlePreloader();
    }); 


    jQuery(document).on('ready', function () {


        //===== Sticky Header Menus

        // jQuery(window).on('scroll', function (event) {
        //     var scroll = jQuery(window).scrollTop();
        //     if (scroll < 150) {
        //         jQuery(".abreco-sticky").removeClass("sticky");
        //     } else {
        //         jQuery(".abreco-sticky").addClass("sticky");
        //     }
        // });

        jQuery(window).on('scroll',function(){
            if($(window).scrollTop() > 100){
                $('.abreco-sticky').addClass('sticky');
            } else{
                $('.abreco-sticky').removeClass('sticky');
            }
        });

        var zero =0;

        jQuery(window).on('scroll',function(){
            $('.sticky').toggleClass('hide',$(window).scrollTop()>zero);
            zero = $(window).scrollTop();
        });


        // :: 0.0 testi SLIDER ACTIVE CODE
        $('.testi-slider.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            smartSpeed: 2000,
            autoplay: false,
            autoplayTimeout: 4000,
            // animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            stagePadding:30,
            smartSpeed:450, 
            // navText: [
            //     "<img src='assets/img/left-side.png'> Prev",
            //     "Next <img src='assets/img/left-side.png'>"
            // ],
            responsive: {
                0: {
                    items: 1,
                    margin: 0,
                    stagePadding: 0
                },
                576: {
                    items: 1,
                    margin: 0,
                    stagePadding: 0
                },
                768: {
                    items: 1
                },
                992: {
                    items: 1
                },
                1140: {
                    items: 1
                }
            }
        });

        // :: 0.0 SErvice SLIDER ACTIVE CODE
        $('.service-slider.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            smartSpeed: 2000,
            autoplay: true,
            autoplayTimeout: 4000,
            navText: [
                "<img src='assets/img/left-side.png' class='d-none'>",
                "<img src='" + rightImageUrl + "'>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1
                },
                768: {
                    items: 3
                },
                992: {
                    items: 3
                },
                1140: {
                    items: 4.5
                }
            }
        });

        // :: 0.0 SErvice SLIDER ACTIVE CODE
        $('.truck-slider.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            smartSpeed: 2000,
            autoplay: false,
            autoplayTimeout: 4000,
            navText: [
                "<img src='assets/images/shapes/left.svg' >",
                "<img src='" + rightImageUrl + "'>"
            ],
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1
                },
                768: {
                    items: 1
                },
                992: {
                    items: 1
                },
                1140: {
                    items: 1
                }
            }
        });



        // wow js
        if ($('.wow').length) {
            var wow = new WOW({
                boxClass: 'wow', // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 250, // distance to the element when triggering the animation (default is 0)
                mobile: true, // trigger animations on mobile devices (default is true)
                live: true // act on asynchronously loaded content (default is true)
            });
            wow.init();
        }

        // faq accrodion

        if ($('.accrodion-grp').length) {
            var accrodionGrp = $('.accrodion-grp');
            accrodionGrp.each(function () {
                var accrodionName = $(this).data('grp-name');
                var Self = $(this);
                var accordion = Self.find('.accrodion');
                Self.addClass(accrodionName);
                Self.find('.accrodion .accrodion-content').hide();
                Self.find('.accrodion.active').find('.accrodion-content').show();
                accordion.each(function () {
                    $(this).find('.accrodion-title').on('click', function () {
                        if ($(this).parent().parent().hasClass('active') === false) {
                            $('.accrodion-grp.' + accrodionName).find('.accrodion').removeClass('active');
                            $('.accrodion-grp.' + accrodionName).find('.accrodion').find('.accrodion-content').slideUp();
                            $(this).parent().parent().addClass('active');
                            $(this).parent().parent().find('.accrodion-content').slideDown();
                        };

                    });
                });
            });
        };



        /*===============================  
             counter up
        ================================*/

        $('.counter-item').counterUp({
            delay: 10,
            time: 2000
        });

        //====== Magnific Popup

        jQuery('.abreco-video-popup').magnificPopup({
            type: 'iframe'
            // other options
        });


        //===== Magnific Popup

        jQuery('.abreco-image-popup').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        //===== Sticky Footer Icons (Phone View)
        jQuery(window).on('scroll', function (event) {
            if (jQuery(this).scrollTop() > 400) {
                jQuery('.float-icon-bottom').fadeIn(200)
            } else {
                jQuery('.float-icon-bottom').fadeOut(200)
            }
        });


        //===== Back to top

        // Show or hide the sticky footer button
        jQuery(window).on('scroll', function (event) {
            if (jQuery(this).scrollTop() > 600) {
                jQuery('.back-to-top').fadeIn(200)
            } else {
                jQuery('.back-to-top').fadeOut(200)
            }
        });


        //Animate the scroll to yop
        jQuery('.back-to-top').on('click', function (event) {
            event.preventDefault();
             
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;

        // jQuery('*').animate({
        //     scrollTop: 0,
        // }, 1500);

       
        });



        /*---canvas menu activation---*/
        $('.canvas_open').on('click', function(){
            $('.offcanvas_menu_wrapper,.off_canvars_overlay').addClass('active')
        });
        
        $('.canvas_close,.off_canvars_overlay').on('click', function(){
            $('.offcanvas_menu_wrapper,.off_canvars_overlay').removeClass('active')
        });

        /*---Off Canvas Menu---*/
        var $offcanvasNav = $('.offcanvas_main_menu'),
            $offcanvasNavSubMenu = $offcanvasNav.find('.sub-menu');
        $offcanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="fa fa-angle-down"></i></span>');
        
        $offcanvasNavSubMenu.slideUp();
        
        $offcanvasNav.on('click', 'li a, li .menu-expand', function(e) {
            var $this = $(this);
            if ( ($this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/)) && ($this.attr('href') === '#' || $this.hasClass('menu-expand')) ) {
                e.preventDefault();
                if ($this.siblings('ul:visible').length){
                    $this.siblings('ul').slideUp('slow');
                }else {
                    $this.closest('li').siblings('li').find('ul:visible').slideUp('slow');
                    $this.siblings('ul').slideDown('slow');
                }
            }
            if( $this.is('a') || $this.is('span') || $this.attr('clas').match(/\b(menu-expand)\b/) ){
                $this.parent().toggleClass('menu-open');
            }else if( $this.is('li') && $this.attr('class').match(/\b('menu-item-has-children')\b/) ){
                $this.toggleClass('menu-open');
            }
        });

        


    });

    // vehicles listing on Mobile view
    $("#mobile-select").change(function () {      
        const selectedValue = $(this).val();
        $(".nav-link").removeClass("active");
        $(`#${selectedValue}-tab`).addClass("active");
        $('.tab-pane').removeClass('show active');
        $(`#${selectedValue}`).addClass('show active');
    });

    

    // Services listing on Mobile view
    

    //index Load More........
    // var $content = $('#content .box'); 
    // var itemsToShow = 12; 
    // var itemsLoaded = itemsToShow;

        
    // $content.slice(0, itemsToShow).removeClass('hidden');

  
    // $('#load-more').click(function(e) {
    //     e.preventDefault();
    //         var itemsToLoad = 8; 

    //         $content.slice(itemsLoaded, itemsLoaded + itemsToLoad).removeClass('hidden');
    //         itemsLoaded += itemsToLoad;
    //         if (itemsLoaded >= $content.length) {
    //             $('#load-more').hide();
    //         }
    //         else{
    //             $('#load-more').show();
    //         }
    // });

    //career Load More........
    var $content = $('#career-content .box'); 
    var itemsToShow = 6; 
    var itemsLoaded = itemsToShow;

        
    $content.slice(0, itemsToShow).removeClass('hidden');


    $('#load-more2').click(function(e) {
        alert("hia")
        e.preventDefault();
            var itemsToLoad = 3; 

            $content.slice(itemsLoaded, itemsLoaded + itemsToLoad).removeClass('hidden');
            itemsLoaded += itemsToLoad;
            if (itemsLoaded >= $content.length) {
                $('#load-more2').hide();
            }
    });

    //Banner Slider 
    var owl = $('.header .owl-carousel');
    
    // Slider owlCarousel - (Inner Page Slider)
    $('.slider .owl-carousel').owlCarousel({
        items: 1,
        loop: false,
        dots: true,
        margin: 0,
        autoplay: false,
        autoplayTimeout: 5000,
        nav: false,
        navText: ['<i class="ti-angle-left" aria-hidden="true"></i>', '<i class="ti-angle-right" aria-hidden="true"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                dots: true
            },
            600: {
                dots: true
            },
            1000: {
                dots: true
            }
        }
    });

    // Slider owlCarousel (Homepage Slider)
    $('.slider-fade .owl-carousel').owlCarousel({
        items: 1,
        loop: false,
        dots: true,
        margin: 0,
        autoplay: false,
        autoplayTimeout: 7000,
        animateOut: 'fadeOut',
        nav: false,
        responsiveClass: true,
        onChanged: updateCounter,
        responsive: {
            0: {
                autoplay: true,
                autoplayTimeout: 5000,
                loop: true
            }
        }
    });

    //Counter Number updated
    function updateCounter(event) {
      var currentItem = event.page.index + 1; 
      var totalItems = event.page.count; 
      $(".slide-counter").text(currentItem + "/" + totalItems); 
    }

    updateCounter({ page: { index: 0, count: owl.find(".owl-item").length } });

    $(".owl-dot").click(function() {
      var dotIndex = $(this).index(); 
      owl.trigger("to.owl.carousel", dotIndex); 
    });

    // Animation on slider
        function handleAnimations(item) {
            $('h3').removeClass('animated fadeInUp');
            $('h1').removeClass('animated fadeInUp');
            $('p').removeClass('animated fadeInUp');
            $('.butn-light').removeClass('animated fadeInUp');

            item.find('h3').addClass('animated fadeInUp');
            item.find('h1').addClass('animated fadeInUp');
            item.find('p').addClass('animated fadeInUp');
            item.find('.butn-light').addClass('animated fadeInUp');
        }

        
        handleAnimations($('.owl-item').not('.cloned').eq(0));

       
        owl.on('click', '.owl-dot', function () {
            var dotIndex = $(this).index();
            var item = $('.owl-item').not('.cloned').eq(dotIndex);
            handleAnimations(item);
        });

        //team slider
        $('.team-slider .owl-carousel').owlCarousel({
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            loop: true,
            margin: 30,
            responsiveClass: true,
            nav: false,
            loop: true,
            stagePadding: 100,
            responsive: {
                0: {
                  items: 1, // Number of items to show on phones
                },
                768: {
                  items: 3, // Number of items to show on tablets
                },
                992: {
                  items: 5, // Number of items to show on desktop
                },
              },
        });
        




})(jQuery);
