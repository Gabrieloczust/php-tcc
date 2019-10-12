<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Configurações</h1>

<div class="row">
    <div class="col">

        <div class="card shadow mb-4">
            <a href="#collapseP" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseP">
                <h6 class="m-0 font-weight-bold text-primary">Perfil</h6>
            </a>
            <div class="collapse show" id="collapseP">
                <div class="card-body">
                    <p class="text-dark">Altere seus <strong>dados</strong>:</p>
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-dark" for="perfil-nome">Nome Completo:</label>
                                <input class="form-control" class="text-primary" type="text" name="perfil-nome" id="perfil-nome" placeholder="<?= $nome ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-dark" for="perfil-email">E-mail:</label>
                                <input class="form-control" class="text-primary" type="email" name="perfil-email" id="perfil-email" placeholder="<?= $email ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-dark" for="perfil-curso">Curso:</label>
                                <input class="form-control" class="text-primary" type="text" name="perfil-curso" id="perfil-curso" placeholder="<?= $curso ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-dark" for="perfil-telefone">Celular:</label>
                                <input class="form-control input-number" class="text-primary" type="tel" name="perfil-telefone" id="perfil-telefone" placeholder="<?= $celular ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-dark" for="perfil-senha">Nova Senha:</label>
                                <input class="form-control" class="text-primary" type="password" name="perfil-senha" id="perfil-senha">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-dark" for="perfil-c-senha">Confirmar Nova Senha:</label>
                                <input class="form-control" class="text-primary" type="password" name="perfil-c-senha" id="perfil-c-senha">
                            </div>
                        </div>
                        <button class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <a href="#collapseN" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseN">
                <h6 class="m-0 font-weight-bold text-primary">Notificações</h6>
            </a>
            <div class="collapse show" id="collapseN">
                <div class="card-body">
                    <p>Selecione os tipos de notificações para receber por <strong>E-mail:</strong></p>
                    <div class="d-flex align-items-center my-3">
                        <label class="label-switch" for="e1">Prazo de entregas</label>
                        <label class="switch">
                            <input class="check" type="checkbox" id="e1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="d-flex align-items-center my-3">
                        <label class="label-switch" for="e2">Convite para um novo projeto</label>
                        <label class="switch">
                            <input class="check" type="checkbox" id="e2">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="d-flex align-items-center my-3">
                        <label class="label-switch" for="e2">Novo comentário</label>
                        <label class="switch">
                            <input class="check" type="checkbox" id="e2">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <a href="#collapseF" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseF">
                <h6 class="m-0 font-weight-bold text-primary">Temas</h6>
            </a>
            <div class="collapse show" id="collapseF">
                <div class="card-body">
                    <p>Altere o sistema para o tema que lhe mais agradar:</p>
                    <div class="d-flex align-items-center my-3">
                        <label class="label-switch" for="f1">Preto e Branco</label>
                        <label class="switch">
                            <input class="check" type="checkbox" id="f1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>