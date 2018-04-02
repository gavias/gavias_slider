/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work?
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function ($) {
  var $event = $.event,
    $special, resizeTimeout;
    $special = $event.special.debouncedresize = {
      setup: function () {
              $(this).on("resize", $special.handler);
      },
      teardown: function () {
              $(this).off("resize", $special.handler);
      },
      handler: function (event, execAsap) {
              // Save the context
              var context = this,
                      args = arguments,
                      dispatch = function () {
                              // set correct event type
                              event.type = "debouncedresize";
                              $event.dispatch.apply(context, args);
                      };

              if (resizeTimeout) {
                      clearTimeout(resizeTimeout);
              }

              execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
      },
    threshold: 150
  };
})(jQuery);


(function($) {
   'use strict';
    function init_gavias_slider() { 
      $('.gavias-slider').each(function() {
       var $slider_wrapper = $(this),
         $pause_on_hover = $slider_wrapper.data('pause'),
         $speed = $slider_wrapper.data('speed'),
         $height = $slider_wrapper.attr('data-height'),
         $fullHeight = $slider_wrapper.attr('data-fullheight'),
         $dots = $slider_wrapper.data('dots'),
         $arrows = $slider_wrapper.data('arrows'),
         $autoplay = $slider_wrapper.data('autoplay'),
         $autoplay_speed = $slider_wrapper.data('autoplayspeed'),
         $fade = $slider_wrapper.data('fade'),
         $header_height = 0,
         gavias_height = 0,
         adminbar = 0;
         if(!$fade) $fade = false; 
          var swiper_main = $slider_wrapper.find('.swiper-wrapper').slick({
            fade: $fade,
            dots: $dots,
            infinite: true,
            arrows: $arrows,
            prevArrow: '<a class="slick-prev"><i class="fa fa-angle-left"></i></a>',
            nextArrow: '<a class="slick-next"><i class="fa fa-angle-right"></i></a>',
            cssEase: 'ease',
            easing: 'easeOutQuint',
            edgeFriction: 0.35,
            pauseOnHover: $pause_on_hover,
            speed: $speed,
            autoplay: $autoplay,
            autoplaySpeed: $autoplay_speed,
          });  

  

      var animationDimensions = function() {
         gavias_slider_resposnive($slider_wrapper);
         gavias_slider_opacity($height);
        if ($fullHeight === 'true') {
            gavias_height = $(window).height() - $header_height - adminbar;
        } else {
            gavias_height = $height;
        }
       }

       $(window).load(animationDimensions());
        $(window).on("debouncedresize", function(event) {
           setTimeout(function() {
               animationDimensions();
           }, 50);
        });

        gavias_slider_opacity($height);
         $(window).scroll(function(){
          gavias_slider_opacity($height);
        });
    })   
   }

   function gavias_slider_opacity(height){
     $('.gavias-opacity').each(function () {
        var divs = $(this); 
        var $scrollTop = $(window).scrollTop();
        var percent = $scrollTop / (height - 100);
        divs.css({
          'opacity': 1 - percent,
          'z-index': 999
        });
        divs.parents('.gavias-slider-image').css({
          'opacity': 1 - (0.5 * percent),
          'z-index': 999
        });
      });
   }

   function gavias_slider_resposnive(el) {
     "use strict";
       var $this = el,
         $items = $this.find('.swiper-slide .gavias-slider-image'),
         $height = $this.attr('data-height'),
         $fullHeight = $this.attr('data-fullheight'),
         $skip_header_fix = 0,
         $header_height = 0;

       var $window_height = $(window).outerHeight();

       if ($(window).width() < 780) {

         $window_height = 500;

       } else if ($fullHeight == 'true') {

         $window_height = $window_height - $header_height;

       } else {

         $window_height = $height;

       }

       $items.each(function(){
          $(this).css('height', $window_height);
       });

       $this.find('.swiper-slide').each(function() {
         var $this = $(this),
           $content = $this.find('.gva-caption');

         if ($this.hasClass('left_center') || $this.hasClass('center_center') || $this.hasClass('right_center')) {
           var $this_height_half = $content.outerHeight() / 2;
           if ($content.outerHeight() < $window_height) {
             var $window_half = $window_height / 2;
             $content.css('marginTop', ($window_half - $this_height_half));
           }
         }

         if ($this.hasClass('left_bottom') || $this.hasClass('center_bottom') || $this.hasClass('right_bottom')) {
           if ($content.outerHeight() < $window_height) {
             var $distance_from_top = $window_height - $content.outerHeight() - 90;
             $content.css('marginTop', ($distance_from_top));
           }
         }
       });
       
       $this.find('.edge-slider-loading').fadeOut();
   }

  $(document).ready(function(){
      init_gavias_slider();
       $(window).load(function() {
        if (!jQuery.browser.mobile){
          $(".youtube-bg").mb_YTPlayer();
        }
      });  
  });

})(jQuery);
