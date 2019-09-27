$('#check').click(function () {
    $("#aluno").toggle(this.checked)
    $("#professor").toggle()
    $(".conteudo-central").toggleClass("background-professor")
});