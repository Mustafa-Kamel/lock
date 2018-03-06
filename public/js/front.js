/*global $, document, Chart, LINECHART, data, options, window, setTimeout*/
$(document).ready(function () {

    'use strict';


    // ------------------------------------------------------- //
    // Equalixe height
    // ------------------------------------------------------ //
    function equalizeHeight(x, y) {
        var textHeight = $(x).height();
        $(y).css('min-height', textHeight);
    }
    equalizeHeight('.featured-posts .text', '.featured-posts .image');

    $(window).resize(function () {
        equalizeHeight('.featured-posts .text', '.featured-posts .image');
    });


    // ---------------------------------------------- //
    // Preventing URL update on navigation link click
    // ---------------------------------------------- //
    $('.link-scroll').bind('click', function (e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top + 2
        }, 700);
        e.preventDefault();
    });


    // ---------------------------------------------- //
    // FancyBox
    // ---------------------------------------------- //
    $("[data-fancybox]").fancybox();


    // ---------------------------------------------- //
    // Search Bar
    // ---------------------------------------------- //
    $('.search-btn').on('click', function (e) {
        e.preventDefault();
        $('.search-area').fadeIn();
    });
    $('.search-area .close-btn').on('click', function () {
        $('.search-area').fadeOut();
    });



    // ---------------------------------------------- //
    // Navbar Toggle Button
    // ---------------------------------------------- //
    $('.navbar-toggler').on('click', function () {
        $('.navbar-toggler').toggleClass('active');
    });


    // ---------------------------------------------- //
    // Divider Section Parallax Background
    // ---------------------------------------------- //
    $(window).on('scroll', function () {

        var scroll = $(this).scrollTop();

        if ($(window).width() > 1250) {
            $('section.divider').css({
                'background-position': 'left -' + scroll / 8 + 'px'
            });
        } else {
            $('section.divider').css({
                'background-position': 'center bottom'
            });
        }


    // ---------------------------------------------- //
    // Back To Top Button
    // ---------------------------------------------- //
        if ($(this).scrollTop() > 200) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    });

    $(window).scroll(function(){ 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    });
});

(function($) {
  "use strict"; // Start of use strict

  // Show the navbar when the page is scrolled up
  var MQL = 992;

  //primary navigation slide-in effect
  if ($(window).width() > MQL) {
    var headerHeight = $('#mainNav').height();
    $(window).on('scroll', {previousTop: 0}, function() {
        var currentTop = $(window).scrollTop();
        //check if user is scrolling up
        if (currentTop < this.previousTop) {
          //if scrolling up...
          if (currentTop > 0 && $('#mainNav').hasClass('is-fixed')) {
            $('#mainNav').addClass('is-visible');
          } else {
            $('#mainNav').removeClass('is-visible is-fixed');
          }
        } else if (currentTop > this.previousTop) {
			//if scrolling down...
			$('#mainNav').removeClass('is-visible');
          if (currentTop > headerHeight && !$('#mainNav').hasClass('is-fixed'))
			$('#mainNav').addClass('is-fixed');
        }
        this.previousTop = currentTop;
      });
  }

})(jQuery); // End of use strict