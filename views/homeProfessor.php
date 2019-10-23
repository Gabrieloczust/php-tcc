<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Turmas</h1>
    <a href="#" data-toggle="modal" data-target="#turmaModal" class="btn btn-success shadow-sm btn-new">
        <i class="fas fa-folder-plus fa-sm pr-1"></i> Nova Turma
    </a>
</div>

<div class="row">

    <div class="col-lg-12">
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

    <?php foreach ($turmas as $turma) { ?>
        <div class="col-lg-4">
            <div class="card border-left-success shadow py-2 mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">TURMA <?= $turma['nome'] ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10 PROJETOS</div>
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle p-3" href="#" role="button" id="dropdownMenuLink<?= $turma['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa fa-fw text-success"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink<?= $turma['id'] ?>">
                                    <div class="dropdown-header">Ações:</div>
                                    <a class="dropdown-item btn-convidar-avaliador" href="#" rel="<?= $turma['hashInterno'] ?>">Convidar Avaliador</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item btn-editar-nome" href="#" rel="<?= $turma['hashInterno'] ?>" data-nome="<?= $turma['nome'] ?>">Editar nome</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item btn-apagar-turma" href="#" rel="<?= $turma['hashInterno'] ?>">Apagar turma</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<!-- Modal Nova Turma -->
<div class="modal fade" id="turmaModal" tabindex="-1" role="dialog" aria-labelledby="turmaModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="nova_turma" value="nova_turma" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="turmaModalLabel">Nova Turma</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nt-nome">Nome da Turma: </label>
                    <input type="text" class="form-control input-uppercase" name="nt-nome" id="nt-nome" required />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Criar</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Editar Nome -->
<div class="modal fade" id="editaNomeModal" tabindex="-1" role="dialog" aria-labelledby="editaNomeModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="edita_nome" value="edita_nome" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="editaNomeModalLabel">Editar Nome</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="en-nome-aviso" name="en-nome-aviso">
                    <input type="hidden" class="en-id" name="en-id">
                    <label for="en-nome">Novo nome: </label>
                    <input type="text" class="form-control input-uppercase" name="en-nome" id="en-nome" required />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btn-editar-nome">Salvar</button>
            </div>
        </div>
    </form>
</div>