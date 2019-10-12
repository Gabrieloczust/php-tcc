<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="<?= IMG ?>favicon.png" />

    <link href="<?= CSS ?>sb-admin-2.css" rel="stylesheet">

    <?= $this->loadCssInTemplate($viewName); ?>

    <title>MyTCC - <?= ucwords($viewName) ?></title>
</head>

<body>

    <main class="conteudo-central">

        <?= $this->loadViewInTemplate($viewName, $viewData); ?>

    </main>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Validor Form FrontEnd -->
    <script src="<?= JS ?>validator.min.js"></script>
    <script src="<?= JS ?>jquery.mask.min.js"></script>

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