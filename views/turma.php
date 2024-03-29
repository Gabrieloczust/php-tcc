<div class="d-sm-flex flex-column mb-3">
    <?php if (!empty($turma)) : ?>
        <h1 class="h3 mb-2 text-gray-800">
            <a class="text-success" href="<?= HOME ?>turmas">TURMAS</a> - TURMA <?= $turma[0]['nome'] ?>
        </h1>
        <div>
            <a data-toggle="modal" data-target="#solicitarEntregaModal" class="btn btn-success shadow-sm btn-new text-white pointer">
                <i class="fas fa-file-medical fa-sm pr-1"></i> Nova Entrega
            </a>
            <a href="<?= HOME ?>turmas/encerrar/<?= $turmas[0]['slug'] ?>" class="btn btn-danger shadow-sm btn-new">
                <i class="fas fa-door-closed fa-sm pr-1"></i> Encerrar Turma
            </a>
        </div>
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

<div class="accordion" id="accordionExample">
    <div class="row mb-2">
        <div class="col-lg-6 mb-2">
            <div class="accordion-menu accordion-menu-info" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                Entregas
                <span class="badge badge-info badge-pill"><?= $qtdEntregas ?></span>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <div class="accordion-menu accordion-menu-dark" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                Projetos
                <span class="badge badge-dark badge-pill"><?= $qtdProjetos ?></span>
            </div>
        </div>
    </div>
    <div id="collapse1" class="row collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <?php foreach ($entregas as $entrega) { ?>
            <div class="col-12">
                <div class="card border-left-info shadow py-2 mb-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <a href="<?= HOME ?>turmas/entrega/<?= $entrega['idEntrega'] ?>" title="Abrir Entrega" class="col hover-success">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $entrega['titulo'] ?>
                                </div>
                                <div class="text-xs font-weight-bold text-info text-uppercase">DATA DE ENTREGA: <?= date("d/m/y", strtotime($entrega['data_entrega'])) ?></div>
                            </a>
                            <div class="col-auto d-flex align-items-center">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle p-3" href="#" role="button" id="dropTurma<?= $entrega['idEntrega'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa fa-fw text-info"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropTurma<?= $entrega['idEntrega'] ?>">
                                        <div class="dropdown-header">Ações:</div>
                                        <a class="dropdown-item btn-editar-turma" href="#" rel="<?= $entrega['idEntrega'] ?>" data-titulo="<?= $entrega['titulo'] ?>" data-data="<?= date("Y-m-d", strtotime($entrega['data_entrega'])) ?>">Alterar a data de entrega</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn-apagar-entrega" href="#" rel="<?= $entrega['idEntrega'] ?>">Apagar entrega</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="collapse2" class="row collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
        <?php foreach ($turma as $projeto) : ?>
            <div class="col-lg-6">
                <div class="card shadow mb-2">
                    <div class="card-header pt-0 pb-0 pr-0 d-flex flex-row align-items-center justify-content-between">
                        <div class="m-0 py-2 font-weight-bold text-dark"><?= $projeto['titulo'] ?></div>
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

<!-- Modal remover entrega -->
<div class="modal fade" id="removerEntrega" tabindex="-1" role="dialog" aria-labelledby="removerEntregaLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="remover_entrega" value="remover_entrega" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removerEntregaLabel">Tem certeza?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span>
                    Será enviado um aviso para todos projetos desta turma que esta entrega foi cancelada.
                </span>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-center">
                <input type="hidden" id="re-id" name="re-id">
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

<!-- Modal Editar Entrega -->
<div class="modal fade" id="editarEntregaModal" tabindex="-1" role="dialog" aria-labelledby="editarEntregaModalLabel" aria-hidden="true">
    <form class="modal-dialog modal-lg" role="document" method="POST">
        <input type="hidden" name="editar_entrega" value="editar_entrega" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="editarEntregaModalLabel">EDITAR ENTREGA <span class="ee-titulo"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="ee-id" id="ee-id" />
                <input type="hidden" name="ee-titulo" id="ee-titulo" />
                <div class="form-group">
                    <label for="ee-data">Data de Entrega:</label>
                    <input type="date" name="ee-data" id="ee-data" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Salvar</button>
            </div>
        </div>
    </form>
</div>