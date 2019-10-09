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

  // Add plus input for aluno
  $(document).ready(function () {
    var max_fields = 10;
    var wrapper_aluno = $(".form-group-aluno");
    var add_aluno = $(".input-add-aluno");
    var x = 1;

    $(add_aluno).click(function (e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
        $(wrapper_aluno).append('<div class="input-group my-3"><input type="email" class="form-control" placeholder="E-mail do Aluno ' + x + '" name="emailAluno[]" /><div class="input-group-append"><a class="remove_field input-group-text text-white bg-danger border-0" title="Remover">x</a></div></div>');
      }
    });

    $(wrapper_aluno).on("click", ".remove_field", function (e) {
      e.preventDefault();
      $(this).parent('div').parent('.input-group').remove();
      x--;
    })
  });

  //Autofocus no titulo do Modal novo projeto
  $('#projectModal').on('shown.bs.modal', function () {
    $('#ng-titulo').trigger('focus')
  })

})(jQuery); // End of use strict