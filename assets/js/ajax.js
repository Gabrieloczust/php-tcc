// Toggle tema dark
$('#muda-tema').on('click', function () {
    var home = $(this).attr('data-url')
    var checked = $(this).is(':checked');
    var tema = $('#page-top')
    if (checked == true) {
        tema.removeClass('temadark-off')
        tema.addClass('temadark-on')
    } else {
        tema.removeClass('temadark-on')
        tema.addClass('temadark-off')
    }
    $(this).load(home + "ajax/mudatema")
});

// Muda as notificacoes de nao lidas para lidas
$('#notificacoes').on('click', function () {
    var home = $(this).attr('data-url')
    $('#qtd-notificacoes').hide()
    $('#qtd-notificacoes').load(home + "ajax/notificacoesLidas")
})


// Atualiza convites e notifacoes a cada 5s
reloadNotifications();
var timeout = setInterval(reloadNotifications, 3000);

function reloadNotifications() {
    var home = $('#notificacoes').attr('data-url');
    var open = $('.stop-ajax').hasClass('show')
    if (open == false) {
        $('#notificacoes').load(home + "ajax/notificacoes");
        $('#convites').load(home + "ajax/convites");
        $('#convitesProfessor').load(home + "ajax/convitesProfessor");
    }
}