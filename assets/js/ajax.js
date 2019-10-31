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

reloadNotifications();

// Muda as notificacoes de nao lidas para lidas
$('#notificacoes').on('click', function () {
    var home = $(this).attr('data-url')
    $('#qtd-notificacoes').hide()
    $('#qtd-notificacoes').load(home + "ajax/notificacoesLidas")
})

// Atualiza convites e notifacoes a cada 5s
var timeout = setInterval(reloadNotifications, 5000);

function reloadNotifications() {
    var home = $('#notificacoes').attr('data-url');
    $('#notificacoes').load(home + "ajax/notificacoes");
    $('#convites').load(home + "ajax/convites");
    $('#convitesProfessor').load(home + "ajax/convitesProfessor");
}

// Se abrir convites ou notificacoes para de atualizar
$('.stop-ajax').on('click', function () {
    clearInterval(timeout);
});