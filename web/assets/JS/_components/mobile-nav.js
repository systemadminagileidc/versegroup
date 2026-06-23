'use strict';
(function ($) {
    //MOBILE NAVIGATION
    let navItems = [];
    let sideNav = $("header nav:not(.socialLinks)");
    let socialNav = $("header nav .socialLinks");
    let menuButton = $("#menu-icon");
    let trigger = $(".sub-menu");

    // $('.nav-link').each(function () {
    //     navItems.push($(this).children());
    // })

    // Toggle of submenu on mobile screen
    if ($(window).width() < mobileBreakpoint) {
        // $(sideNav).html(navItems);
        trigger.on("click", function (e) {
            e.stopPropagation();
            $(this).toggleClass('active')
            // $(this).parent('.nav-link').siblings().children('.sub-nav').slideUp();
            $(this).next('.sub-nav').slideToggle("fast").animate({easing: 'linear'});
        });
    }

    // Handle main burger menu
    menuButton.on("click", function (e) {
        $(this).toggleClass('active');
        e.stopPropagation();
        $('#header').toggleClass(headerPosition + ' active');
        sideNav.slideToggle('fast', function () {
            if ($(this).is(':visible')) {
                $(this).css('display', 'flex');
            }
        }).animate({easing: 'linear'});
        $('html, body').animate({ scrollTop: 0 }, 'fast');

    });

    // Add scrolling classes
    $(window).scroll(function(){
        var scroll = $(window).scrollTop()
        if(scroll >= 300){
            $('#header').addClass('scrolled');
        }else{
            $('#header').removeClass('scrolled');
        }
    })

    // Make open burger menu not active when screen size changes
    $(window).on('resize', function(event){
        if ($(window).width() > mobileBreakpoint) {
            if (menuButton.hasClass('active')) {
                menuButton.removeClass('active');
                $('#header').removeClass('active');
                $('#header').addClass('default');
            }

            sideNav.css('display','flex');
            socialNav.css('display','flex');
        } else {
            if (!menuButton.hasClass('active')) {
                sideNav.css('display','none');
                socialNav.css('display','none');
            }
        }
    });
})(jQuery); // Fully reference jQuery after this point.
