(function($) {
    //  'use strict';
    $('.lightbox_gallery_carousel').each(function() {
        var $carousel = $(this);
        var lightbakso_numberofitems = parseInt($carousel.data("lightbakso_numberofitems"));
        var lightbakso_numberofitems_tablet = parseInt($carousel.data("lightbakso_numberofitems_tablet"));
        var lightbakso_numberofitems_mobile = parseInt($carousel.data("lightbakso_numberofitems_mobile"));
        var lightbakso_margin = parseInt($carousel.data("lightbakso_margin"));
        var lightbakso_loop = $carousel.data("lightbakso_loop");
        var lightbakso_centeritems = $carousel.data("lightbakso_centeritems");
        var lightbakso_navigation = $carousel.data("lightbakso_navigation");
        var lightbakso_rewindtheslide = $carousel.data("lightbakso_rewindtheslide");
        var lightbakso_dotnavigation = $carousel.data("lightbakso_dotnavigation");
        var lightbakso_dotsforeachitem = $carousel.data("lightbakso_dotsforeachitem");
        var lightbakso_autoplay = $carousel.data("lightbakso_autoplay");
        var lightbakso_autopalyspeed = parseInt($carousel.data("lightbakso_autopalyspeed"));
        $carousel.owlCarousel({
            items: lightbakso_numberofitems,
            margin: lightbakso_margin,
            loop: lightbakso_loop,
            center: lightbakso_centeritems,
            nav: lightbakso_navigation,
            rewind: lightbakso_rewindtheslide,
            dots: lightbakso_dotnavigation,
            dotsEach: lightbakso_dotsforeachitem,
            autoplay: lightbakso_autoplay,
            autoplaySpeed: lightbakso_autopalyspeed,
            navText: ['<span class="dashicons dashicons-arrow-left-alt2"></span>', '<span class="dashicons dashicons-arrow-right-alt2"></span>'],
            responsive: {
                0: {
                    items: lightbakso_numberofitems_mobile
                },
                640: {
                    items: lightbakso_numberofitems_tablet
                },
                1000: {
                    items: lightbakso_numberofitems
                }
            }
        });
    });
})(jQuery)