<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="<?= CSS ?>bootstrap.min.css">

    <?= $this->loadCssInTemplate($viewName); ?>

    <title><?= $viewName ?></title>
</head>

<body>

    <main class="conteudo-central">

        <?= $this->loadViewInTemplate($viewName, $viewData); ?>

    </main>

    <script src="<?= JS ?>jquery.min.js"></script>
    <script src="<?= JS ?>bootstrap.min.js"></script>
    <script src="<?= JS ?>validator.min.js"></script>

    <?= $this->loadJsInTemplate($viewName); ?>

</body>

</html>