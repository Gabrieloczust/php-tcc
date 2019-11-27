<div class="d-sm-flex flex-column mb-3">
    <h1 class="h3 mb-2 text-gray-800">
        <a class="text-success" href="<?= HOME ?>turmas">TURMAS</a> - ENCERRAR TURMA <?= $turma->getNome() ?>
    </h1>
</div>

<div class="row">
    <?php foreach ($projetoNotas as $projeto) : ?>
        <div class="col-12 mb-3">
            <div class="card border-left-success shadow py-2 mb-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="h5 mb-0 font-weight-bold text-uppercase text-success dark-off">
                                PROJETO <?= $projeto[0]['tituloProjeto'] ?>
                            </div>
                            <?php
                                $media = 0;
                                $qtdNotas = 0;
                                foreach ($projeto as $item) : ?>
                                <div class="text-xs font-weight-bold text-gray-800">
                                    <?= $item['tituloEntrega'] ?> - <?= $item['nota'] ?: '0.00' ?>
                                </div>
                            <?php
                                    $media +=  $item['nota'];
                                    $qtdNotas++;
                                endforeach;
                                $media = round($media / $qtdNotas, 2);
                                if ($media >= 7)
                                    $class = 'primary';
                                else
                                    $class = 'danger';
                                ?>
                        </div>
                        <div class="col-auto">
                            <div class="text-md font-weight-bold text-<?= $class ?>">
                                MÉDIA: <?= $media ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="row my-3">
    <div class="col">
        <a class="btn btn-danger" href="<?= HOME ?>turmas/encerrando/<?= $turma->getSlug() ?>">ENCERRAR</a>
    </div>
</div>