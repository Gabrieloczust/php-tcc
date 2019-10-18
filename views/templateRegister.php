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
        $(".input-olho").mousedown(function() {
            $(".input-senha").attr("type", "text");
        });

        $(".input-olho").mouseup(function() {
            $(".input-senha").attr("type", "password");
        });
    </script>

    <script>
        $(window).ready(function() {
            $('.input-number').keyup(function() {
                $(this).val(this.value.replace(/\D/g, ''));
                $(this).mask('(##) #####-####');
            });
        });
    </script>

    <?= $this->loadJsInTemplate($viewName); ?>

</body>

</html>