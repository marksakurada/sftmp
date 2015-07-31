/**
 * @file
 * Custom scripts for theme.
 */
(function ($) {

  Drupal.behaviors.header = {
    attach: function (context, settings) {
      $('.js-mobile-menu-trigger').click(function() {
        $('.top-nav').toggleClass('visible');
      });
    }
  };

  Drupal.behaviors.ent_fixedLargeHeader = {
    attach: function (context, settings) {
      var detectChange = _.throttle(function(){
        if ($('.site-header-top-large').attr('data-fixed') == 'false' && $(window).scrollTop() >= 114) {
          $('.site-header-top-large').attr('data-fixed','true').addClass('is-fixed');
          $('body').addClass('fixed-header');
          _move_header_components();
        }
        if ($('.site-header-top-large').attr('data-fixed') == 'true' && $(window).scrollTop() <=114) {
          $('.site-header-top-large').attr('data-fixed','false').removeClass('is-fixed');
          $('body').removeClass('fixed-header');
          _move_header_components_back();
        }
      }, 100);

      // Small screens should always have components moved.
      var showResize = _.debounce(function() {
        if ($(window).width() < 768) {
          _move_header_components();
        }
        else if ($('body').hasClass('fixed-header') === false) {
          _move_header_components_back();
        }
      }, 300);

      window.addEventListener('load', detectChange, true);
      window.addEventListener('scroll', detectChange, true);
      window.addEventListener('resize', detectChange, true);

      window.addEventListener('load', showResize, true);
      window.addEventListener('resize', showResize, true);

      function _move_header_components() {
        // Move the tunegenie widget.
        if ($(window).width() <= 670) {
          $('.block-ent-tunegenie-ent-tunegenie-button').prependTo('.mobile-tune-genie');
        }
        else if ($(window).width() > 670) {
          $('.block-ent-tunegenie-ent-tunegenie-button').prependTo('.region-navigation-right');
        }
        $('.top-listen-live').prependTo('.region-navigation-right');
      }
      function _move_header_components_back() {
        // Move the tunegenie button back only if page width 768px or wider.
        if ($(window).width() > 767 ) {
          $('.top-listen-live').prependTo('.region-branding-right');
          $('.block-ent-tunegenie-ent-tunegenie-button').prependTo('.region-branding-right');
        }
      }
    }
  };

  Drupal.behaviors.ent_imagegallery = {
    attach: function(context, settings) {

      var $topShow = $("#cycle2-slideshow .field-name-field-image-upload", context);
      var $topSlides = $("#cycle2-slideshow .field-name-field-image-upload .field-items .field-item img", context);

      var showButtons = $('<div class="cycle-button cycle-top-prev"><span></span></div><div class="cycle-button cycle-top-next"><span></span></div>');
      var carouselWrap = $('<div class="cycle-slideshow-wrap cycle-carousel-wrapper" id="#cycle2-slideshow-carousel"></div>');

      // Sets the correct number of carousel items to display
      if ($topSlides.length == 1) {
        $('.cycle-carousel-wrapper').remove();
        $topShow.children('.cycle-button').remove();
      }
      else if ($topSlides.length < 5) {
        $slideCount = $topSlides.length;
      }
      else {
        $slideCount = 5;
      }

      if ($topSlides.length != 1) {
        // When the top slideshow is initialized, only if we have more than one slide, we add the carousel
        $topShow.on('cycle-initialized', function (e, opts) {
          // We add our carousel wrapper to the DOM
          $('#cycle2-slideshow').after(carouselWrap);
          // If we have a carousel -- lets move the description below the carousel
          $('.cycle-carousel-wrapper').after($('.field-name-body'));
          $topSlides.each(function () {
            $(this).clone().appendTo('.cycle-carousel-wrapper');
          });
          // Initialize the  carousel
          $('.cycle-carousel-wrapper').cycle({
            'timeout': 0,
            'fx': 'carousel',
            'carouselVisible': $slideCount,
            'carouselFluid': true,
            'allowWrap': false,
            'log': false
          });
        });
      }

      // Initialize the top slideshow
      $topShow.cycle({
        'slides': '> .field-items .field-item',
        'timeout': 0,
        'swipe': true,
        'fx': 'fade',
        'log': false
      });

      // Places the prev/next arrows, if we have more than one slide to cycle through
      if ($topSlides.length != 1) {
        $topShow.children('.field-items').after(showButtons);
      }

      // Top show move to prev slide
      $('.cycle-top-prev', context).click(function() {
        $topShow.cycle('prev');
      });

      // Top show move to next slide
      $('.cycle-top-next', context).click(function() {
        $topShow.cycle('next');
      });

      // Set our prev/next triggers to move carousel forward
      $topShow.on('cycle-next cycle-prev', function(e, opts) {
        $('.cycle-carousel-wrapper').cycle('goto', opts.currSlide);
      });

      // When we click a slide -- lets go there
      $('.cycle-carousel-wrapper .cycle-slide', context).click(function() {
        var index = $('.cycle-carousel-wrapper').data('cycle.API').getSlideIndex(this);
        $('#cycle2-slideshow .field-name-field-image-upload, .cycle-carousel-wrapper').cycle('goto', index);
      });

      // We create a debounced function to reset carousel position (to correct bug in responsive behavior)
      var showResize = _.debounce(function() {
        $('#cycle2-slideshow .field-name-field-image-upload, .cycle-carousel-wrapper').cycle('goto', 0);
        // Since we've set all the proper defaults in CSS -- removing style at first position "resets" our layout manually
        $('.cycle-carousel-wrap').stop(true, true).removeAttr('style');
      }, 500);

      window.addEventListener('resize', showResize, true);

    }
  };

  Drupal.behaviors.footer = {
    attach: function(context, settings) {
      var $wrapper = $('.block-menu-menu-footer-menu > .content > .menu', context);
      var menuItems = $wrapper.children().length;
      $wrapper.attr('data-children', menuItems);
      $wrapper.tinyNav();
    }
  }

  // Modal resize on window resize.
  Drupal.behaviors.modalResize = {
    attach: function(context, settings) {

        var oldWidth = $(window).width();
        // Range to check resize against.
        var widthRange = 25;

        modalLoad = function() {
          var winWidth = $(window).width();
          var winHeight = $(window).height();

          $newWidth = winWidth * .9;
          $newHeight = winHeight * .9;
          if (winWidth < 775) {
            if (winHeight < 515) {
              $.colorbox.resize({width: $newWidth, height: $newHeight});
            } else {
              $.colorbox.resize({width: $newWidth, height: 515});
            }
          }
          else {
            if (winHeight < 515) {
              $.colorbox.resize({width: 775, height: $newHeight});
            }
          }
          // Call function to handle resizing.
          modalResize(oldWidth,widthRange);
        }

        modalResize = function(oldWidth, widthRange) {
          $(window).resize(_.debounce(function(){
            var winWidth = $(window).width();
            // Check if resize is larger than widthRange and resize modal.
            if (winWidth > (oldWidth + widthRange) || winWidth < (oldWidth - widthRange)) {
              var winHeight = $(window).height();

              $newWidth = winWidth * .90;
              $newHeight = winHeight * .9;
              if (winWidth < 775) {
                if (winHeight < 515) {
                  $.colorbox.resize({width: $newWidth, height: $newHeight});
                } else {
                  $.colorbox.resize({width: $newWidth, height: 515});
                }
              } else {
                if (winHeight < 515) {
                  $.colorbox.resize({width: 775, height: $newHeight});
                } else {
                  $.colorbox.resize({width: 775, height: 515});
                }
              }
            }
            oldWidth = winWidth;
          },300));
        }

        // Bind to colorbox complete.
        $(document).bind('cbox_complete', function(){
          modalLoad();
        });
    }
  }

})(jQuery);
