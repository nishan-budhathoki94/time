jQuery(document).ready(function() {
    jQuery('.home-slider .bxslider').bxSlider({
        auto: true,
        mode: 'vertical',
        caption: true,
        pagerCustom: '#bx-pager',
        controls: true,
        nextText: '<i class="fa fa-angle-right"></i>',
        prevText: '<i class="fa fa-angle-left"></i>'
    });

    // toggle js
    jQuery('.main-navigation .menu-toggle').click(function() {
        jQuery('.main-navigation .menu').slideToggle('slow');
    });
    jQuery('.main-navigation .menu-item-has-children').append('<span class="menu-item"> <i class="fa fa-angle-down"></i> </span>');

    jQuery('.main-navigation .menu-item').click(function() {
        jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        jQuery(this).children('.fa-angle-down').first().toggleClass('fa-angle-down');
    });


    jQuery('.client-slider').bxSlider({
        slideWidth: 380,
        minSlides: 1,
        maxSlides: 3,
        auto: true,
        pagerCustom: '#bx-pager',
        controls: true,
        nextText: '<i class="fa fa-circle-o"></i>',
        prevText: '<i class="fa fa-circle-o"></i>'
    });
    jQuery('#nav').onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 750
    })
    jQuery('#features').parallax("50%", 0.1);
    jQuery('#blog').parallax("50%", 0.1);


});
