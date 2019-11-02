<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Configurações</h1>

<div class="row">

    <div class="col-lg-12">
        <?php
        foreach ($warnings as $w) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $w . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>';
        }
        ?>
    </div>

    <div class="col">

        <div class="card shadow mb-4">
            <a href="#collapseP" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseP">
                <h6 class="m-0 font-weight-bold text-primary">Perfil</h6>
            </a>
            <div class="collapse show" id="collapseP">
                <div class="card-body">
                    <p class="text-dark">Altere seus <strong>dados</strong>:</p>
                    <form class="form-config" data-toggle="validator" method="POST" action="<?= HOME ?>/configuracoesaluno/perfil" autocomplete="off">
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="text-dark" for="perfil-nome">Nome Completo:</label>
                                <input class="form-control input-uppercase" type="text" name="perfil-nome" id="perfil-nome" placeholder="<?= $nome ?>" data-minlength="3" data-error="Por favor, informe um nome">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="text-dark" for="perfil-email">E-mail:</label>
                                <input class="form-control input-lowercase" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" name="perfil-email" id="perfil-email" placeholder="<?= $email ?>" data-error="Por favor, informe um e-mail correto">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="text-dark" for="perfil-curso">Curso:</label>
                                <input class="form-control input-uppercase" type="text" name="perfil-curso" id="perfil-curso" placeholder="<?= $curso ?>">
                                <div class="help-block with-errors" data-minlength="2" data-error="Por favor, informe um curso"></div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="text-dark" for="perfil-celular">Celular:</label>
                                <input class="form-control input-number" type="tel" name="perfil-celular" id="perfil-celular" placeholder="<?= $celular ?>" data-minlength="14" data-error="Por favor, informe um celular válido">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="text-dark" for="perfil-senha">Nova Senha:</label>
                                <div class="input-group">
                                    <input class="form-control input-senha" type="password" name="perfil-senha" id="perfil-senha" data-minlength="6" data-error="Mínimo de seis (6) digitos!">
                                    <div class="input-group-append">
                                        <span class="input-group-text input-olho" title="Mostrar Senha"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="text-dark" for="perfil-c-senha">Confirmar Nova Senha:</label>
                                <div class="input-group">
                                    <input class="form-control input-senha" type="password" name="perfil-c-senha" id="perfil-c-senha" data-match="#perfil-senha" data-match-error="Atenção! As senhas não estão iguais.">
                                    <div class="input-group-append">
                                        <span class="input-group-text input-olho" title="Mostrar Senha"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary text-white" value="Salvar Alterações">
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <a href="#collapseF" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseF">
                <h6 class="m-0 font-weight-bold text-primary">Tema</h6>
            </a>
            <div class="collapse show" id="collapseF">
                <div class="card-body">
                    <p>Altere o sistema para o tema que lhe mais agradar:</p>
                    <div class="d-flex align-items-center my-3">
                        <label class="label-switch" for="muda-tema">Blue</label>
                        <label class="switch">
                            <input <?php if ($tema == 'on') {
                                        echo 'checked';
                                    } ?> class="check" type="checkbox" name="temadark" id="muda-tema" data-url="<?= HOME ?>">
                            <span class="slider bg-primary round"></span>
                        </label>
                        <label class="label-switch" for="muda-tema">Dark</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>