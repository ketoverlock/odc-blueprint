jQuery(function($) {
    
    function trapFocus(element) {
      var focusableEls = element.querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
      var firstFocusableEl = focusableEls[0];  
      var lastFocusableEl = focusableEls[focusableEls.length - 1];
      var KEYCODE_TAB = 9;
    
      element.addEventListener('keydown', function(e) {
        var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);
    
        if (!isTabPressed) { 
          return; 
        }
    
        if ( e.shiftKey ) /* shift + tab */ {
          if (document.activeElement === firstFocusableEl) {
            lastFocusableEl.focus();
              e.preventDefault();
            }
          } else /* tab */ {
          if (document.activeElement === lastFocusableEl) {
            firstFocusableEl.focus();
              e.preventDefault();
            }
          }
      });
    }
    
    var element = $('.site-header').next();
    var defaultPadding = parseInt(element.css('padding-top').replace(/\D/g,''));
    
    function stickyHeader() {
        
        var scrollHeight = $('.top-bar').outerHeight();
        var headerHeight = $('.site-header').outerHeight();
        var newPadding = defaultPadding + headerHeight;
        
        if (scrollHeight == null) {
            scrollHeight = 0;
        }

        if ($(window).scrollTop() > scrollHeight) {
            $('.site-header').addClass('site-header--sticky');
            element.css("padding-top", newPadding);
        } else {
            $('.site-header').removeClass('site-header--sticky');
            element.css("padding-top", defaultPadding);
        }
        
    }
    
    function mobileToggle() {
    
        var navContainer = document.querySelector('.mobile-nav');
        
       $('.nav-primary').clone().appendTo('.mobile-nav');
       $('.mobile-nav .genesis-nav-menu').removeClass('js-superfish sf-js-enabled sf-arrows');
       $('.mobile-nav .sub-menu').hide();
    
       $('.menu-toggle').click(function() {
           var scrollPos = $(window).scrollTop();
           
           $('.site-container').addClass('fixed');
           if (scrollPos > 0) {
               $('.site-container').addClass('fixed--scroll');
           }
           $('.site-container').attr('aria-hidden', 'true');
           $('.site-container').css('margin-top', -scrollPos);
           $('.mobile-nav').addClass('mobile-nav--visible');
           $('.mobile-nav').attr({
               'aria-hidden': 'false',
               'open': 'true',
               'tabindex': 0
           });
           $('.menu-close').focus();
           trapFocus(navContainer);
           $('.mobile-nav .genesis-nav-menu .menu-item-has-children').append('<button class="submenu-toggle"><i class="fas fa-angle-down" aria-hidden="true"></i></button>');
       });
    
       $('.menu-close').click(function() {
           var scrollPos = $('.site-container').css('margin-top');
           scrollPos = -parseInt(scrollPos);
           
           $('.site-container').removeClass('fixed');
           if (scrollPos > 0) {
                $('.site-container').removeClass('fixed--scroll');
           }
           $('.site-container').attr('aria-hidden', 'false');
           $('.site-container').css('margin-top', '0');
           $('.mobile-nav').attr('aria-hidden', 'true');
           $('.mobile-nav').removeAttr('open tabindex');
           $('.menu-toggle').focus();
           $(window).scrollTop(scrollPos);
           $('.mobile-nav').removeClass('mobile-nav--visible');
           $('.submenu-toggle').remove();
       });
    
       $(document).on('click', '.submenu-toggle', function() {
           $(this).siblings('.sub-menu').slideToggle();
           $(this).toggleClass('rotated');
           $(this).siblings('.sub-menu').find('li:first-of-type > a').focus();
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
        stickyHeader();
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