<section class="register-left text-center text-white p-3">
    <img src="<?= IMG ?>login.png" alt="login" class="mb-3" />
    <p class="h2">Bem-Vindo ao MeuTCC</p>
    <p>Você está a 1 minuto de iniciar seu <br>primeiro projeto.</p>
    <a href="login" class="btn btn-outline-light mt-3">Login</a>
</section>
<section class="register-right">
    <div class="accordion" id="accordionExample">

        <?php foreach ($errors as $erro) { ?>
            <p class="alert alert-warning" role="alert"><?= $erro ?></p>
        <?php } ?>

        <div id="aluno" class="forms">

            <h4 class="mb-3 titulo-register">Cadastro</h4>
            <form class="row" data-toggle="validator" method="POST">
                <div class="col">
                    <input type="hidden" name="usuario" value="aluno">
                    <div class="form-group">
                        <select class="form-control change-form" name="usuario" data-error="Selecione uma opção..." required>
                            <option selected disabled value="">Tipo de Usuario...</option>
                            <option value="aluno">Aluno</option>
                            <option value="professor">Professor</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nome Completo *" name="nome" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Curso" name="curso" />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-lowercase" placeholder="Seu E-mail *" name="email" data-error="Por favor, informe um e-mail correto" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="tel" minlength="14" class="form-control input-number" data-error="Por favor, informe um telefone correto" placeholder="Seu Celular" name="telefone" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control input-senha" id="passA" placeholder="Senha *" name="senha1" data-minlength="6" data-error="Mínimo de seis (6) digitos!" required />
                            <div class="input-group-append">
                                <span class="input-group-text input-olho" title="Mostrar Senhas"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control input-senha" placeholder="Confirmar Senha *" name="senha2" data-match="#passA" data-match-error="Atenção! As senhas não estão iguais." required />
                            <div class="input-group-append">
                                <span class="input-group-text input-olho" title="Mostrar Senhas"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Cadastrar" />
                </div>
            </form>
        </div>

        <div id="professor" class="forms">
            <h4 class="mb-3 titulo-register">Cadastro</h4>
            <form class="row" data-toggle="validator" method="POST">
                <div class="col">
                    <input type="hidden" name="usuario" value="professor">
                    <div class="form-group">
                        <select class="form-control change-form" name="usuario" data-error="Selecione uma opção..." required>
                            <option disabled value="">Tipo de Usuario...</option>
                            <option value="aluno">Aluno</option>
                            <option selected value="professor">Professor</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nome Completo *" name="nome" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="escola" data-error="Selecione uma opção..." required>
                            <option disabled selected value="">Escola de Atuação:</option>
                            <option value="EXATAS">Exatas</option>
                            <option value="HUMANAS">Humanas</option>
                            <option value="BIOLÓGICAS">Biológicas</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-lowercase" placeholder="Seu E-mail *" name="email" data-error="Por favor, informe um e-mail correto" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="tel" minlength="14" class="form-control input-number" data-error="Por favor, informe um telefone correto" placeholder="Seu Celular" name="telefone" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control input-senha" id="passC" placeholder="Senha *" name="senha1" data-minlength="6" data-error="Mínimo de seis (6) digitos!" required />
                            <div class="input-group-append">
                                <span class="input-group-text input-olho" title="Mostrar Senhas"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control input-senha" placeholder="Confirmar Senha *" name="senha2" data-match="#passC" data-match-error="Atenção! As senhas não estão iguais." required />
                            <div class="input-group-append">
                                <span class="input-group-text input-olho" title="Mostrar Senhas"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Cadastrar" />
                </div>
            </form>
        </div>

    </div>
</section>