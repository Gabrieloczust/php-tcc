<!-- Page Heading -->
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
        foreach ($success as $s) {
            echo '<div class="alert alert-success" role="alert">' . $s . '</div>';
        }
        foreach ($errors as $e) {
            echo '<div class="alert alert-warning" role="alert">' . $e . '</div>';
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
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $projeto['titulo'] ?></h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Ações:</div>
                            <a class="dropdown-item" href="#">Convidar Aluno</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Editar Titulo</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Sair do Projeto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Novo Projeto Modal-->
    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
        <form class="modal-dialog" role="document" method="POST">
            <input type="hidden" name="novo_projeto" value="novo_projeto" />
            <div class="modal-ajax">
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
                        <button class="btn btn-primary" id="btn-novo-projeto">Criar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>