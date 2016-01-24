/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {

          needOverlay = function(element) {
              return(element.offsetHeight < element.scrollHeight);
          };

          $.fn.extend({
              toggleable: function(options) {
                  return this.each(function() {
                      $this = $(this);

                      var blurOverlay = $('<div/>', {
                          class: 'blur-overlay'
                      });

                      if(needOverlay(this)) {
                          $this.addClass('has-overlay');
                          $this.append(blurOverlay);
                      }

                      $this.filter('.has-overlay').hover(
                          function() {
                              blurOverlay.removeClass('blur-overlay');
                              $(this).addClass('service-open');
                          },
                          function() {
                              blurOverlay.addClass('blur-overlay');
                              $(this).removeClass('service-open');
                          }
                      );
                  });
              }
          });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    },
    'oferta': {
        init: function() {
            var getUri = function(href) {
                var l = document.createElement("a");
                l.href = href;
                return l;
            };
            var l = getUri(window.location.href);
            var regex = new RegExp('|oferta\/usluga\/\d+|');
            var hasServiceId = regex.test(l.path);


        },
        finalize: function() {
            $('.panel.offer-item > a').click(function() {
                var panel = $(this).children('.panel-heading');
                var icon = $(this).find('i');
                if( panel.css('min-height') === '100px'){
                    panel.css('min-height', '1px');
                } else {
                    panel.css('min-height', '100px');
                }
            });
        }
    },
    'kontakt' : {
        init: function() {
            function initialize() {
                var mapOptions = {
                    center: { lat: 53.155487, lng: 23.158595},
                    zoom: 15
                };
                var map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);

                var marker = new google.maps.Marker({
                    position: { lat: 53.155487, lng: 23.158595},
                    map: map,
                    title: 'CPKG Radcowie Prawni'
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);


            $('[data-toggle="tooltip"]').tooltip();


        }
    },
    'przedsiebiorcy': {
        finalize: function() {
            $(document).ready(function() {
                $('.panel-default.toggleable').toggleable();
            });
        }
    },
      'konsumenci': {
          finalize: function() {
              $(document).ready(function() {
                  $('.panel-default.toggleable').toggleable();
              });
          }
      },
      'spolki': {
          finalize: function() {
              $(document).ready(function() {
                  $('.panel-default.toggleable').toggleable();
              });
          }
      }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
