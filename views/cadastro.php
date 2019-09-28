<section class="register-left text-center text-white p-3">
    <img src="<?= IMG ?>login.png" alt="login" class="mb-3" />
    <p class="h2">Bem-Vindo</p>
    <p>Você está a 30 segundos de iniciar seu <br>primeiro projeto.</p>
    <a href="login" class="btn btn-outline-light mt-3">Login</a>
</section>
<section class="register-right">
    <div class="accordion" id="accordionExample">

        <?php foreach ($errors as $erro) { ?>
            <p class="alert alert-warning" role="alert"><?= $erro ?></p>
        <?php } ?>

        <div class="muda-form mb-3">
            <label class="muda-tipo muda-tipo-professor" for="check">Professor</label>
            <label class="switch">
                <input id="check" type="checkbox" checked>
                <span class="slider round"></span>
            </label>
            <label class="muda-tipo muda-tipo-aluno" for="check">Aluno</label>
        </div>

        <div id="aluno" class="forms">

            <h4 class="mb-3 titulo-register">Cadastro de Aluno</h4>
            <form class="row" data-toggle="validator" method="POST">
                <div class="col">
                    <input type="hidden" name="usuario" value="Aluno">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nome *" name="nome" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Curso" name="curso" />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Seu Email *" name="email" data-error="Por favor, informe um e-mail correto" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" minlength="9" maxlength="16" class="form-control" data-error="Por favor, informe um telefone correto" placeholder="Seu Celular" name="telefone" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="passA" placeholder="Senha *" name="senha1" data-minlength="6" data-error="Mínimo de seis (6) digitos!" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirmar Senha *" name="senha2" data-match="#passA" data-match-error="Atenção! As senhas não estão iguais." required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Cadastrar" />
                </div>
            </form>
        </div>

        <div id="professor" class="forms">
            <h4 class="mb-3 titulo-register">Cadastro de Professor</h4>
            <form class="row" data-toggle="validator" method="POST">
                <div class="col">
                    <input type="hidden" name="usuario" value="Professor">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nome *" name="nome" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Escola" name="escola" />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Seu Email *" name="email" data-error="Por favor, informe um e-mail correto" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" minlength="9" maxlength="16" class="form-control" data-error="Por favor, informe um telefone correto" placeholder="Seu Celular" name="telefone" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="pass" placeholder="Senha *" name="senha1" data-minlength="6" data-error="Mínimo de seis (6) digitos!" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirmar Senha *" name="senha2" data-match="#pass" data-match-error="Atenção! As senhas não estão iguais." required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Cadastrar" />
                </div>
            </form>
        </div>

    </div>
</section>