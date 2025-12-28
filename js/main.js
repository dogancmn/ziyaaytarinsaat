(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Date and time picker
    $('.date').datetimepicker({
        format: 'L'
    });
    $('.time').datetimepicker({
        format: 'LT'
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        dotsData: true,
    });


    // Testimonials carousel
    $('.testimonial-carousel').owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        dotsData: true,
    });

    
})(jQuery);


// Modern City Selector - Clean & Beautiful Design
$(document).ready(function() {
    const cityItems = $('.city-item');
    
    // Initialize first city as active
    const firstCity = cityItems.first();
    if (firstCity.length) {
        const firstTarget = firstCity.data('target');
        if (firstTarget) {
            $('[data-bs-target="' + firstTarget + '"]').tab('show');
        }
    }
    
    // City item click handler
    cityItems.on('click', function() {
        const clickedItem = $(this);
        const targetCity = clickedItem.data('target');
        
        // Remove active class from all items
        cityItems.removeClass('active');
        
        // Add active class to clicked item
        clickedItem.addClass('active');
        
        // Switch to corresponding tab
        if (targetCity) {
            $('[data-bs-target="' + targetCity + '"]').tab('show');
        }
        
        // Smooth scroll to projects when city is selected
        setTimeout(function() {
            const projectsSection = $('#cityTabsContent');
            if (projectsSection.length) {
                $('html, body').animate({
                    scrollTop: projectsSection.offset().top - 100
                }, 800);
            }
        }, 300);
    });
});
