<!-- Page Heading -->
<div class="d-sm-flex flex-column mb-4">
    <h1 class="h3 mb-2 text-gray-800">Turmas</h1>
    <a data-toggle="modal" data-target="#turmaModal" class="btn btn-success shadow-sm btn-new text-white pointer">
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

</div>
<div class="row">

    <?php
    if (count($turmas) != 0) :
        foreach ($turmas as $turma) :
            ?>
            <div class="col-lg-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body d-flex">
                        <div class="row no-gutters w-100 align-items-center">
                            <a class="hover-turma col mr-2" href="<?= HOME ?>turmas/turma/<?= $turma['slug'] ?>" title="TURMA <?= $turma['nome'] ?>">
                                <div class="h5 font-weight-bold text-success text-uppercase mb-1">TURMA <?= $turma['nome'] ?></div>
                                <div class="text-xs mb-0 font-weight-bold text-gray-800"><?= $turma['qtdProjetoTurma'] ?></div>
                            </a>
                            <div class="col-auto d-flex align-items-center">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle p-3" href="#" role="button" id="dropdownMenuLink<?= $turma['idTurma'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa fa-fw text-success"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink<?= $turma['idTurma'] ?>">
                                        <div class="dropdown-header">Ações:</div>
                                        <a class="dropdown-item btn-editar-nome" href="#" rel="<?= $turma['hashInterno'] ?>" data-nome="<?= $turma['nome'] ?>">Editar nome</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn-apagar-turma" href="#" rel="<?= $turma['idTurma'] ?>" data-nome="<?= $turma['nome'] ?>">Apagar turma</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            endforeach;
        else :
            ?>
        <div class="col">
            <div class="alert alert-warning text-center">
                Que pena você não tem nenhuma turma :(
            </div>
        </div>
    <?php
    endif;
    ?>

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
                <h5 class="modal-title text-success" id="editaNomeModalLabel">EDITAR NOME</h5>
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
            <div class="modal-footer d-flex justify-content-between">
                <small>TURMA <span class="nome-turma"></span></small>
                <button class="btn btn-success" id="btn-editar-nome">Salvar</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal apagar turma -->
<div class="modal fade" id="apagarTurmaModal" tabindex="-1" role="dialog" aria-labelledby="apagarTurmaModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="apagar_turma" value="apagar_turma" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="apagarTurmaModalLabel">Tem certeza?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span>
                    Ao apagar você não terá mais acesso a nenhum dos projetos que pertencem a turma <b class="nome-turma"></b>.
                </span>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-center">
                <input type="hidden" class="at-id" name="at-id">
                <a class="btn btn-danger mr-2" href="#" data-dismiss="modal">Cancelar</a>
                <input type="submit" class="btn btn-success" value="Apagar">
            </div>
        </div>
    </form>
</div>