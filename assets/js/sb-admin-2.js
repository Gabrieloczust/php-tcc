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

  //Autofocus no titulo do Modal novo projeto
  $('#projectModal').on('shown.bs.modal', function () {
    $('#ng-titulo').trigger('focus')
  })

  //Autofocus no titulo do Modal editar projeto
  $('#editaTituloModal').on('shown.bs.modal', function () {
    $('#et-titulo').trigger('focus')
  })

  //Autofocus no emial do Modal convidar aluno
  $('#alunoModal').on('shown.bs.modal', function () {
    $('#ca-aluno').trigger('focus')
  })

  // Modal editar titulo
  $('.btn-editar-titulo').click(function () {
    var id = $(this).attr('rel')
    $('#editaTituloModal').find('.et-id').val(id)
    $('#editaTituloModal').modal('show')
  })

  // Modal sair projeto
  $('.btn-sair-projeto').click(function () {
    var id2 = $(this).attr('rel')
    $('#sairProjetoModal').find('.sp-id').val(id2)
    $('#sairProjetoModal').modal('show')
  })

  // Modal convidar aluno
  $('.btn-convidar-aluno').click(function () {
    var id3 = $(this).attr('rel')
    $('#alunoModal').find('.ca-id').val(id3)
    $('#alunoModal').modal('show')
  })

  // Adiciona nosso input para convidar aluno
  $(document).ready(function () {
    var max_fields = 10;
    var wrapper_aluno = $("#novos-alunos");
    var add_aluno = $(".add-novo-aluno");
    var x = 1;

    $(add_aluno).click(function (e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
        $(wrapper_aluno).append('<div class="input-group my-3"><input type="email" class="form-control" placeholder="E-mail do Aluno ' + x + '" name="ca-aluno[]" required/><div class="input-group-append"><a class="remove_field input-group-text text-white bg-danger border-0" title="Remover">x</a></div></div>');
      }
      if (x == max_fields) {
        $(add_aluno).toggle()
      }
    });

    $(wrapper_aluno).on("click", ".remove_field", function (e) {
      e.preventDefault();
      $(this).parent('div').parent('.input-group').remove();
      x--;

      if (x == (max_fields - 1)) {
        $(add_aluno).toggle()
      }
    })
  });

})(jQuery); // End of use strict