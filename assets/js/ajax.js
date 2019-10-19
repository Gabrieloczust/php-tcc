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