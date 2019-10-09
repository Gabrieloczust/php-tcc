<?php
class homeController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// Arrays para avisos de Validação
		$errors = array();
		$success = array();

		$aluno = new Aluno($_SESSION['user']);
		$id = $aluno->getId();

		$projeto = new Projeto();

		if (filter_input(INPUT_POST, 'novo_projeto') === "novo_projeto") {
			// Pega o Titulo
			$titulo = filter_input(INPUT_POST, 'ng-titulo', FILTER_SANITIZE_SPECIAL_CHARS);

			// Verifica se o aluno ja esta em um projeto com este titulo
			$existeProjeto = $projeto->novoProjeto($titulo, $id);
			$idProjeto = $projeto->getId();
			if ($existeProjeto == 1) {
				array_push($success, "Projeto <strong>$titulo</strong> criado com sucesso!");
			} else {
				array_push($errors, 'Você já participa de um projeto com este titulo!');
			}

			$orientador = filter_input(INPUT_POST, 'ng-emailProfessor', FILTER_VALIDATE_EMAIL);
			$convite = new Convite();
			$teste = $convite->convidaOrientador($orientador, $idProjeto);
			print_r($teste);
		}

		$qtdProjetos = $projeto->qtdProjetos($id);
		$projetos = $projeto->getProjetos($id);

		$dados = array(
			'errors' => $errors,
			'success' => $success,
			'qtd' => $qtdProjetos,
			'projetos' => $projetos
		);

		$this->loadTemplate("home{$_SESSION['userType']}", $dados);
	}
}
