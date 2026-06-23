'use strict';
(function ($) {
    // Block Trigger
    $(".draw").hide();
    $(".trigger").click(function () {
        let $this = $(this);
        $this.parent('.accordion-block').toggleClass('active');
        $this.next().slideToggle( "fast","linear", function() {
            // Animation complete.
        });
    });

    // Add functionality to have a mobile only displayed accordion
    function mobileAccordionAdjust() {
        if(window.matchMedia('(max-width:680px)').matches) {
            $('.accordion-block:not(.active) .mobiledraw').hide()
            $(".mobiletrigger").show();
        } else {
            $(".mobiletrigger").hide();
            $('.mobiledraw').show()
        }
    }

    $(window).on('resize', throttle(function() {
        mobileAccordionAdjust();
    }));
    mobileAccordionAdjust();

    // Channel Trigger
    // $(".cat-content").hide();
    // $(".channel-trigger").click(function () {
    //     let $this = $(this);
    //     let $catContent = $this.parent('.grid').next('.cat-content');
    //     $this.toggleClass('active');
    //     $catContent.toggleClass('active');
    //     $catContent.slideToggle( "medium","linear", function() {
    //         // Animation complete.
    //     });
    // });

})(jQuery); // Fully reference jQuery after this point.
