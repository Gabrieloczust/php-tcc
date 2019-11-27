<div class="d-sm-flex flex-column mb-3">
    <h1 class="h3 mb-2 text-gray-800">
        <a class="text-primary" href="<?= HOME ?>projetos">PROJETOS</a> - PROJETO <?= $projeto['titulo'] ?> FINALIZADO
    </h1>
</div>

<div class="row">
    <div class="col-12 mb-2">
        <div class="card border-left-<?= $class ?> shadow py-2 mb-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-<?= $class ?> text-uppercase mb-1">PROJETO: <?= $projeto['titulo'] ?></div>
                        <div class="text-xs font-weight-bold text-uppercase">ORIENTADOR: <b><?= $projeto['nome'] ?></b></div>
                        <div class="text-xs font-weight-bold text-uppercase">ALUNO(S): <b><?= $projeto['alunosParticipantes'] ?></b></div>
                        <div class="text-xs font-weight-bold text-uppercase">INÍCIO: <b><?= date("d/m/y", strtotime($projeto['data_criacao'])) ?></b></div>
                        <div class="text-xs font-weight-bold text-uppercase">ENCERRADO: <b><?= date("d/m/y", strtotime($projeto['data_encerrado'])) ?></b></div>
                    </div>
                    <div class="col-auto">
                        <b class="text-<?= $class ?>">NOTA <?= $nota ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php foreach ($avaliados as $avaliado) : ?>
        <div class="col-12">
            <a class="card card-entrega border-left-primary dark-off shadow py-2 mb-3" download href="<?= HOME ?>assets/uploads/<?= $avaliado['idProjetoEntrega'] . '/' . $avaliado['documento'] ?>" title="Baixa Documento">
                <div class=" card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col d-flex align-items-center">
                            <i class="fas fa-check-circle fa-2x text-primary mr-3 dark-off"></i>
                            <div>
                                <div class="h5 mb-0 font-weight-bold text-uppercase text-primary dark-off">
                                    <?= $avaliado['titulo'] ?>
                                </div>
                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                                    ENTREGUE POR <b><?= $avaliado['nome'] ?></b> NO DIA <b><?= date("d/m/y", strtotime($avaliado['data'])) ?></b>
                                </div>
                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                                    <?= $avaliado['notaStatus'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-center text-primary">
                            <i class="fas fa-download fa-2x"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>