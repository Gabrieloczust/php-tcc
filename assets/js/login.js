$('#check').change(function () {
    var selecionado = $(this).val();
    if(selecionado == 'professor'){
        $('.conteudo-central').addClass('background-professor');
    } else{
        $('.conteudo-central').removeClass('background-professor');
    }
});