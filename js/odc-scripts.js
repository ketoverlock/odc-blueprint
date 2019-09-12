jQuery(function($) {
    
    function stickyHeader() {
        
        var scrollHeight = $('.top-bar').outerHeight();

        if ($(window).scrollTop() > scrollHeight && $(window).width() > 1024) {
            $('.site-header').addClass('site-header--sticky');
        } else {
            $('.site-header').removeClass('site-header--sticky');
        }
        
    }
    
    function mobileToggle() {
        
        $('.nav-primary').clone().appendTo('.mobile-nav');
        $('.mobile-nav .genesis-nav-menu').removeClass('js-superfish sf-js-enabled sf-arrows');
        
        $('.menu-toggle').click(function() {
            $('.site-container').addClass('fixed');
            $('.mobile-nav').addClass('mobile-nav--visible');
            $('.mobile-nav .genesis-nav-menu .menu-item-has-children').append('<button class="submenu-toggle"><i class="fas fa-angle-down" aria-hidden="true"></i></button>');
        });
        
        $('.menu-close').click(function() {
            $('.site-container').removeClass('fixed');
            $('.mobile-nav').removeClass('mobile-nav--visible');
            $('.submenu-toggle').remove();
        });
        
        $(document).on('click', '.submenu-toggle', function() {
            $(this).siblings('.sub-menu').slideToggle();
            $(this).toggleClass('rotated');
        });
        
    }
    
    function windowFix() {

        if ($(window).width() < 1024 && $('.mobile-nav').hasClass('mobile-nav--visible')) {
            $('.site-container').addClass('fixed');
        } else {
            $('.site-container').removeClass('fixed');
        }
        
    }
    
    function contentFade() {
        
        $('.fade-in').each( function(){

            var top_of_object = $(this).offset().top + 150;
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            if( bottom_of_window > top_of_object ){

                $(this).addClass('fade-in--visible');

            }

        }); 
        
    }
    $(document).ready(function() {
        mobileToggle();
    });
    
    $(window).resize(function() {
        windowFix();
    });
    
    $(window).scroll(function() {
        stickyHeader();
        contentFade();
    });
    
});