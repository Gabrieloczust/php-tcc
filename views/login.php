<section class="container login">

	<h3 class="mb-3 text-dark">Login</h3>

	<?php
	foreach ($success as $s) {
		echo '<p class="alert alert-success" role="alert">' . $s . '</p>';
	}
	foreach ($errors as $e) {
		echo '<p class="alert alert-warning" role="alert">' . $e . '</p>';
	}
	?>

	<ul class="circles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>

	<form class="row" data-toggle="validator" method="POST">
		<div class="col">
			<input type="hidden" name="login" value="login">
			<div class="form-group">
				<select id="check" class="form-control change-form" name="usuario" data-error="Selecione uma opção..." required>
					<option selected disabled value="">Tipo de Usuario...</option>
					<option value="aluno">Aluno</option>
					<option value="professor">Professor</option>
				</select>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<input type="email" class="form-control input-lowercase" placeholder="Seu e-mail" name="email" data-error="Por favor, informe um e-mail correto" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" required />
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<input class="form-control input-senha" type="password" placeholder="Sua senha" name="senha" data-minlength="6" data-error="Mínimo de seis (6) digitos!" required>
					<div class="input-group-append">
						<span class="input-group-text input-olho" title="Mostrar Senha"><i class="fa fa-eye" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="help-block with-errors"></div>
			</div>
			<div class="d-flex justify-content-between align-items-center mt-3">
				<div class="d-flex flex-column">
					<a href="" data-toggle="modal" data-target="#exampleModal">Esqueci minha senha</a>
					<a href="cadastro" class="mt-1">Criar conta</a>
				</div>
				<div>
					<button type="submit" class="btn btn-success">Entrar</button>
				</div>
			</div>

		</div>
	</form>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<form class="modal-content" data-toggle="validator" method="POST">
			<input type="hidden" name="login" value="recuperar">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<select class="form-control" name="usuario-recuperar" data-error="Selecione uma opção..." required>
						<option selected disabled="">Tipo de Usuario...</option>
						<option value="aluno">Aluno</option>
						<option value="professor">Professor</option>
					</select>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" placeholder="E-mail" name="email-recuperar" data-error="Por favor, informe um e-mail correto" required />
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" value="Enviar" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>