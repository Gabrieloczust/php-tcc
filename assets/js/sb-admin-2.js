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

  // Mascara para o celular
  $(window).ready(function () {
    $('.input-number').keyup(function () {
      $(this).val(this.value.replace(/\D/g, ''));
      $(this).mask('(##) #####-####');
    });
  });

  // Toggle password
  $(".input-olho").mousedown(function () {
    $(".input-senha").attr("type", "text");
  });

  $(".input-olho").mouseup(function () {
    $(".input-senha").attr("type", "password");
  });

  //Autofocus no titulo do Modal novo projeto
  $('#projectModal').on('shown.bs.modal', function () {
    $('#ng-titulo').trigger('focus')
  })

  //Autofocus no titulo do Modal editar projeto
  $('#editaTituloModal').on('shown.bs.modal', function () {
    $('#et-titulo').trigger('focus')
  })

  //Autofocus no email do Modal convidar aluno
  $('#alunoModal').on('shown.bs.modal', function () {
    $('#ca-aluno').trigger('focus')
  })

  //Autofocus no nome do Modal nova turma
  $('#turmaModal').on('shown.bs.modal', function () {
    $('#nt-nome').trigger('focus')
  })

  //Autofocus no nome do Modal editar nome turma
  $('#editaNomeModal').on('shown.bs.modal', function () {
    $('#en-nome').trigger('focus')
  })

  //Autofocus no nome do Modal editar nome turma
  $('#avaliadorModal').on('shown.bs.modal', function () {
    $('#ca-email').trigger('focus')
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

  // Modal editar nome turma
  $('.btn-editar-nome').click(function () {
    var id = $(this).attr('rel')
    var nome = $(this).attr('data-nome').toUpperCase()
    $('#editaNomeModal').find('.en-id').val(id)
    $('#editaNomeModal').find('.nome-turma').text(nome)
    $('#editaNomeModal').find('.en-nome-aviso').val(nome)
    $('#editaNomeModal').find('#en-nome').attr("placeholder", nome)
    $('#editaNomeModal').modal('show')
  })

  // Modal apagar turma
  $('.btn-apagar-turma').click(function () {
    var id9 = $(this).attr('rel')
    var nomeTurma = $(this).attr('data-nome')
    $('#apagarTurmaModal').find('.nome-turma').text(nomeTurma)
    $('#apagarTurmaModal').find('.at-id').val(id9)
    $('#apagarTurmaModal').modal('show')
  })

  // Adiciona novo input para convidar aluno
  $(document).ready(function () {
    var max_fields = 10;
    var wrapper_aluno = $("#novos-alunos");
    var add_aluno = $(".add-novo-aluno");
    var x = 1;

    $(add_aluno).click(function (e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
        $(wrapper_aluno).append('<div class="input-group my-3"><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control input-lowercase" placeholder="E-mail do Aluno ' + x + '" name="ca-aluno[]" required/><div class="input-group-append"><a class="remove_field input-group-text text-white bg-danger border-0" title="Remover">x</a></div></div>');
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