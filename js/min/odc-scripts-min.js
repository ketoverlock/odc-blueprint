jQuery((function($){$(document).ready((function(){$(".nav-primary").clone().appendTo(".mobile-nav"),$(".mobile-nav .genesis-nav-menu").removeClass("js-superfish sf-js-enabled sf-arrows"),$(".menu-toggle").click((function(){$(".site-container").addClass("fixed"),$(".mobile-nav").addClass("mobile-nav--visible"),$(".mobile-nav .genesis-nav-menu .menu-item-has-children").append('<button class="submenu-toggle"><i class="fas fa-angle-down" aria-hidden="true"></i></button>')})),$(".menu-close").click((function(){$(".site-container").removeClass("fixed"),$(".mobile-nav").removeClass("mobile-nav--visible"),$(".submenu-toggle").remove()})),$(document).on("click",".submenu-toggle",(function(){$(this).siblings(".sub-menu").slideToggle(),$(this).toggleClass("rotated")}))})),$(window).resize((function(){$(window).width()<1024&&$(".mobile-nav").hasClass("mobile-nav--visible")?$(".site-container").addClass("fixed"):$(".site-container").removeClass("fixed")})),$(window).scroll((function(){var e;e=$(".top-bar").outerHeight(),$(window).scrollTop()>e&&$(window).width()>1024?$(".site-header").addClass("site-header--sticky"):$(".site-header").removeClass("site-header--sticky"),$(".fade-in").each((function(){var e=$(this).offset().top+150;$(window).scrollTop()+$(window).height()>e&&$(this).addClass("fade-in--visible")}))}))}));