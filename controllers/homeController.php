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

		// Cadastro de Novo Projeto //
		if (filter_input(INPUT_POST, 'novo_projeto') === "novo_projeto") {
			// Pega o Titulo
			$titulo = filter_input(INPUT_POST, 'ng-titulo', FILTER_SANITIZE_SPECIAL_CHARS);

			if (!empty($titulo)) {

				// Verifica se o aluno ja esta em um projeto com este titulo				
				$existeProjeto = $projeto->existeEsseTitulo($titulo, $id);

				if ($existeProjeto == false) {

					// Pega o E-mail do Orientador
					$orientador = filter_input(INPUT_POST, 'ng-emailProfessor', FILTER_VALIDATE_EMAIL);
					$prof = new Orientador($orientador);

					if (!empty($prof->getId())) {
						$projeto->novoProjeto($titulo, $id, $orientador);
						array_push($success, "Projeto <strong>$titulo</strong> criado com sucesso!");
						array_push($success, "Convite de Orientador enviado para <strong>$orientador</strong>");
					} else {
						array_push($errors, 'Este e-mail não possui cadastro de um professor!');
					}
				} else {
					array_push($errors, 'Você já participa de um projeto com este título!');
				}
			} else {
				array_push($errors, 'Digite um título!');
			}
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
