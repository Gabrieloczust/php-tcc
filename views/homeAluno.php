<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Meus Projetos</h1>
    <a href="#" data-toggle="modal" data-target="#projectModal" class="btn btn-primary shadow-sm btn-new">
        <i class="fas fa-folder-plus fa-sm pr-1"></i> Novo Projeto
    </a>
</div>

<!-- Page Body -->
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

    <div class="col-lg-12">
        <div class="card border-left-primary shadow py-2 mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">EM ANDAMENTO</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $qtd ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hourglass-start fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($projetos as $projeto) { ?>
        <div class="col-lg-6">
            <div class="card card-projeto shadow mb-4">
                <div class="card-header pt-0 pb-0 pr-0 d-flex flex-row align-items-center justify-content-between">
                    <a href="<?= HOME ?>projeto" class="m-0 py-3 font-weight-bold text-primary"><?= $projeto['titulo'] ?></a>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle p-3" href="#" role="button" id="dropdownMenuLink<?= $projeto['idProjeto'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink<?= $projeto['idProjeto'] ?>">
                            <div class="dropdown-header">Ações:</div>
                            <a class="dropdown-item btn-convidar-aluno" href="#" rel="<?= $projeto['hashInterno'] ?>">Convidar Aluno</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn-editar-titulo" href="#" rel="<?= $projeto['hashInterno'] ?>">Editar Titulo</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn-sair-projeto" href="#" rel="<?= $projeto['idProjeto'] ?>">Sair do Projeto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<!-- Modal Novo Projeto -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="novo_projeto" value="novo_projeto" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Novo Projeto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="ng-titulo" class="text-primary">Título do Projeto: </label>
                    <input type="text" class="form-control" name="ng-titulo" id="ng-titulo" required />
                </div>
                <div class="form-group">
                    <label class="text-primary">Convidar Orientador: </label>
                    <div class="input-group">
                        <input type="email" id="inviteOrientador" class="form-control" placeholder="E-mail do Professor Orientador *" name="ng-emailProfessor" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Criar</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Convidar Aluno -->
<div class="modal fade" id="alunoModal" tabindex="-1" role="dialog" aria-labelledby="alunoModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="convidar_aluno" value="convidar_aluno" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alunoModalLabel">Convidar Aluno</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="ca-id" name="ca-id">
                <div class="input-group my-3">
                    <input type="email" class="form-control" name="ca-aluno[]" placeholder="E-mail do aluno 1" required />
                </div>
                <div id="novos-alunos"></div>
                <a class="add-novo-aluno text-info" href="#">Adiconar mais <i class="fas fa-plus"></i></a>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btn-editar-titulo">Enviar Convites</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Novo Projeto -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="novo_projeto" value="novo_projeto" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Novo Projeto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="ng-titulo" class="text-primary">Título do Projeto: </label>
                    <input type="text" class="form-control" name="ng-titulo" id="ng-titulo" required />
                </div>
                <div class="form-group">
                    <label class="text-primary">Convidar Orientador: </label>
                    <div class="input-group">
                        <input type="email" id="inviteOrientador" class="form-control" placeholder="E-mail do Professor Orientador *" name="ng-emailProfessor" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Criar</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Editar Projeto -->
<div class="modal fade" id="editaTituloModal" tabindex="-1" role="dialog" aria-labelledby="editaTituloModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="edita_titulo" value="edita_titulo" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editaTituloModalLabel">Editar Título</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="et-id" name="et-id">
                    <label for="et-titulo" class="text-primary">Novo título: </label>
                    <input type="text" class="form-control" name="et-titulo" id="et-titulo" required />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btn-editar-titulo">Salvar</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal Sair do Projeto -->
<div class="modal fade" id="sairProjetoModal" tabindex="-1" role="dialog" aria-labelledby="sairProjetoModalLabel" aria-hidden="true">
    <form class="modal-dialog" role="document" method="POST">
        <input type="hidden" name="sair_projeto" value="sair_projeto" />
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sairProjetoModalLabel">Tem certeza?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <input type="hidden" class="sp-id" name="sp-id">
                <a class="btn btn-danger mr-2" href="#" data-dismiss="modal">Não</a>
                <input type="submit" class="btn btn-primary" value="Sim">
            </div>
        </div>
    </form>
</div>