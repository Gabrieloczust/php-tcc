(function ($) {
  "use strict"; // Start of use strict
  
  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

  // Add input no model novo projeto
  $(document).ready(function () {
    var max_fields = 10;
    var wrapper_colega = $(".form-group-colega");
    var wrapper_avaliador = $(".form-group-avaliador");
    var add_colega = $(".input-add-colega");
    var add_avaliador = $(".input-add-avaliador");
    var x = 1;

    $(add_colega).click(function (e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
        $(wrapper_colega).append('<div class="input-group my-3"><input type="text" class="form-control" placeholder="E-mail do Colega ' + x + '" name="emailColega[]" /><div class="input-group-append"><a class="remove_field input-group-text text-white bg-danger border-0" title="Remover">x</a></div></div>');
      }
    });

    $(add_avaliador).click(function (e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
        $(wrapper_avaliador).append('<div class="input-group my-3"><input type="text" class="form-control" placeholder="E-mail do Avaliador ' + x + '" name="emailAvaliador[]" /><div class="input-group-append"><a class="remove_field input-group-text text-white bg-danger border-0" title="Remover">x</a></div></div>');
      }
    });

    $(wrapper_colega).add(wrapper_avaliador).on("click", ".remove_field", function (e) {
      e.preventDefault();
      $(this).parent('div').parent('.input-group').remove();
      x--;
    })
  });

})(jQuery); // End of use strict