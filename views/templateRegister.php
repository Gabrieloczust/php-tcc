<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="<?= IMG ?>favicon.png" />

    <link href="<?= CSS ?>sb-admin-2.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?= VENDOR ?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <?= $this->loadCssInTemplate($viewName); ?>

    <title>MyTCC - <?= ucwords($viewName) ?></title>
</head>

<body>

    <main class="conteudo-central">

        <?= $this->loadViewInTemplate($viewName, $viewData); ?>

    </main>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= VENDOR ?>jquery/jquery.min.js"></script>
    <script src="<?= VENDOR ?>bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Validor Form FrontEnd -->
    <script src="<?= JS ?>validator.min.js"></script>
    <script src="<?= JS ?>jquery.mask.min.js"></script>

    <script>
        $('.change-form').change(function() {
            if ($(this).val() == 'aluno') {
                $("#professor").hide()
                $("#aluno").show()
                $(".conteudo-central").removeClass("background-professor")
                $(".conteudo-central").addClass("background-aluno")
            } else {
                $("#aluno").hide()
                $("#professor").show()
                $(".conteudo-central").removeClass("background-aluno")
                $(".conteudo-central").addClass("background-professor")
            }
        });

        // Toggle password
        $(".input-olho").on('click', function() {
            var senha = $(".input-senha")
            if (senha.attr('type') == 'password') {
                senha.attr("type", "text");
            } else {
                senha.attr("type", "password");
            }
        });

        $(window).ready(function() {
            $('.input-number').keyup(function() {
                $(this).val(this.value.replace(/\D/g, ''));
                $(this).mask('(##) #####-####');
            });
        });
    </script>

</body>

</html>