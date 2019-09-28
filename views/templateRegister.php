<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="shortcut icon" href="<?= IMG ?>favicon.png" />

    <link href="<?= CSS ?>sb-admin-2.min.css" rel="stylesheet">

    <?= $this->loadCssInTemplate($viewName); ?>

    <title><?= ucwords($viewName) ?></title>
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

    <?= $this->loadJsInTemplate($viewName); ?>

</body>

</html>