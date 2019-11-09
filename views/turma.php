<div class="d-sm-flex flex-column mb-4">
    <?php if (!empty($turma)) : ?>
        <h1 class="h3 mb-2 text-gray-800">
            <a class="text-success" href="<?= HOME ?>turmas">Turmas</a> - Turma <?= @$turma[0]['nome'] ?>
        </h1>
        <a data-toggle="modal" data-target="#solicitarEntregaModal" class="btn btn-success shadow-sm btn-new text-white pointer">
            <i class="fas fa-file-medical fa-sm pr-1"></i> Nova Entrega
        </a>
    <?php else : ?>
        <a href="<?= HOME ?>turmas" class="btn btn-new btn-warning" title="Voltar">Voltar</a>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col">
        <?php
        foreach ($successes as $s) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $s . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
        }
        foreach ($warnings as $w) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $w . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
        }
        foreach ($errors as $e) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $e . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
        }
        ?>
    </div>
</div>

<div class="row mb-4">

    <div class="col-lg-8">
        <div class="card border-left-success shadow py-2 mb-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ENTREGAS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $qtdEntregas ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($entregas as $entrega) { ?>
            <div class="card border-left-info shadow py-2 mb-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2 mb-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $entrega['titulo'] ?>
                            </div>
                            <div class="text-xs font-weight-bold text-info text-uppercase">DATA DE ENTREGA: <?= date("d/m/y", strtotime($entrega['data_entrega'])) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="col-lg-4">
        <div class="card border-left-dark shadow py-2 mb-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">PROJETOS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $qtdProjetos ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paste fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($turma as $projeto) : ?>
            <div class="card shadow mb-2">
                <div class="card-header pt-0 pb-0 pr-0 d-flex flex-row align-items-center justify-content-between">
                    <a href="<?= HOME . 'turmas/projeto/' . $projeto['slug'] ?>" class="m-0 py-2 font-weight-bold text-dark"><?= $projeto['titulo'] ?></a>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle p-3 text-dark" href="#" role="button" id="dropdownMenuLink<?= $projeto['idProjeto'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink<?= $projeto['idProjeto'] ?>">
                            <div class="dropdown-header">Ações:</div>
                            <?php if ($qtdTurmas > 1 && $qtdEntregas < 1) : ?>
                                <a class="dropdown-item btn-alterar-turma" href="#" rel="<?= $projeto['idProjeto'] ?>" data-turma="<?= $projeto['nome'] ?>" data-projeto="<?= $projeto['titulo'] ?>">Alterar Turma</a>
                                <div class="dropdown-divider"></div>
                            <?php endif; ?>
                            <a class="dropdown-item btn-remover-projeto" href="#" rel="<?= $projeto['idProjeto'] ?>" data-turma="<?= $projeto['nome'] ?>" data-projeto="<?= $projeto['titulo'] ?>">Remover Projeto</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- Modal Alterar Turma -->
<div class="modal fade" id="alterarTurmaModal" tabindex="-1" role="dialog" aria-labelledby="alterarTurmaModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="alterar_turma" value="alterar_turma" />
        <input type="hidden" name="at-id" class="at-id" />
        <input type="hidden" name="nome-projeto" class="nome-projeto" />
        <input type="hidden" name="nome-turma" class="nome-turma" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alterarTurmaModalLabel">
                    Turma <span class="nome-turma"></span> - Projeto <span class="nome-projeto"></span>
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="at-turma" class="text-success">Selecione a nova turma: </label>
                    <div class="form-group mb-2">
                        <select id="at-turma" class="form-control form-control-sm" name="at-turma" required>
                            <option selected disabled value="">Selecione..</option>
                            <?php foreach ($turmas as $t) { ?>
                                <option <?php if ($turma[0]['idTurma'] == $t['idTurma']) : echo "class='d-none' disabled";
                                            else : echo 'value="' . $t['idTurma'] . '"';
                                            endif; ?>>
                                    <?= $t['nome'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal remover projeto -->
<div class="modal fade" id="removerProjetoModal" tabindex="-1" role="dialog" aria-labelledby="removerProjetoModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="remover_projeto" value="remover_projeto" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removerProjetoModalLabel">Tem certeza?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span>
                    Ao remover você não terá mais acesso ao projeto <b class="nome-projeto"></b>.
                </span>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-center">
                <input type="hidden" class="rp-id" name="rp-id">
                <input type="hidden" name="nome-projeto" class="nome-projeto" />
                <input type="hidden" name="nome-turma" class="nome-turma" />
                <a class="btn btn-danger mr-2" href="#" data-dismiss="modal">Cancelar</a>
                <input type="submit" class="btn btn-success" value="Apagar">
            </div>
        </div>
    </form>
</div>

<!-- Modal Solciitar Entrega -->
<div class="modal fade" id="solicitarEntregaModal" tabindex="-1" role="dialog" aria-labelledby="solicitarEntregaModalLabel" aria-hidden="true">
    <form class="modal-dialog modal-lg" role="document" method="POST" id="form-entrega">
        <input type="hidden" name="solicitar_entrega" value="solicitar_entrega" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solicitarEntregaModalLabel">Nova Entrega</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="se-titulo">Titulo:</label>
                    <input type="text" name="se-titulo" id="se-titulo" class="form-control text-uppercase" required>
                </div>
                <div class="form-group">
                    <label for="se-descricao">Descrição:</label>
                    <textarea name="se-descricao" id="se-descricao" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="se-data">Data de Entrega:</label>
                    <input type="date" name="se-data" id="se-data" class="form-control" required>
                </div>
                <div class="row">
                    <span class="col-lg-12 mb-2 text-dark text-center">
                        Arraste para a lista <span class="text-danger">Não Receber</span> se deseja que algum projeto não receba esta entrega!
                    </span>
                    <div class="col-lg-6">
                        <span class="d-block text-center text-success my-2 dark-off">Receber</span>
                        <ul class="list-group list-group-sortable list-group-sortable-success" id="demo1">
                            <?php foreach ($turma as $projeto) : ?>
                                <li class="list-group-item" rel="<?= $projeto['idProjeto'] ?>">
                                    <?= $projeto['titulo'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <span class="d-block text-center text-danger my-2">Não Receber</span>
                        <ul class="list-group list-group-sortable list-group-sortable-danger" id="demo2"></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="se-projetos" name="se-projetos">
                <input type="submit" class="btn btn-success" value="Solicitar">
            </div>
        </div>
    </form>
</div>