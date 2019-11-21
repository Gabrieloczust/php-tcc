<?php
class turmasController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->usuarioLogadoTipo != 'professor') {
			header("Location:" . HOME);
			exit;
		}
	}

	public function index()
	{
		// Arrays para avisos de Validação
		$errors = array();
		$warnings = array();
		$successes = array();

		$prof = new Professor($_SESSION['user']);
		$email = $prof->getEmail();

		$turma = new Turma($email);

		// Cadastro de Nova Turma //
		if (filter_input(INPUT_POST, 'nova_turma') === "nova_turma") {
			// Pega o nome da turma
			$nome = mb_strtoupper(filter_input(INPUT_POST, 'nt-nome', FILTER_SANITIZE_SPECIAL_CHARS));
			if (!empty($nome)) {
				if ($turma->novaTurma($nome) == true) {
					array_push($successes, "Turma <b>$nome</b> criada com sucesso!");
				} else {
					array_push($warnings, "Você já possui uma turma com o nome <b>$nome</b>!");
				}
			} else {
				array_push($errors, 'Digite um nome!');
			}
		}

		// Editar Nome //
		$hashTurma = filter_input(INPUT_POST, 'en-id');
		if (filter_input(INPUT_POST, 'edita_nome') === "edita_nome" && !empty($hashTurma)) {
			$novoNome = mb_strtoupper(filter_input(INPUT_POST, 'en-nome', FILTER_SANITIZE_SPECIAL_CHARS));
			$nomeAntigo = $_POST['en-nome-aviso'];
			$validaNome = $turma->editaNome($novoNome, $hashTurma);
			if ($validaNome == false) {
				array_push($warnings, "Você já possui uma turma com o nome <b>$novoNome</b>!");
			} else {
				array_push($successes, "Nome da turma <b>$nomeAntigo</b> alterado para <b>$novoNome</b> com sucesso!");
			}
		}

		// Apagar turma //
		$atId = filter_input(INPUT_POST, 'at-id');
		if (filter_input(INPUT_POST, 'apagar_turma') === "apagar_turma" && !empty($atId)) {
			$t = new Turma($email, $atId);
			$apagado = $t->apagarTurma($atId);
			if ($apagado == true) {
				array_push($successes, "Turma <strong>{$t->getNome()}</strong> apagada com sucesso!");
			} else {
				array_push($errors, "Erro ao apagar turma!");
			}
		}

		$turmas = $turma->getTurmas();

		$dados = array(
			'errors' => $errors,
			'warnings' => $warnings,
			'successes' => $successes,
			'turmas' => $turmas
		);

		$this->loadTemplate("turmas", $dados);
	}

	public function turma($slug = NULL)
	{
		// Arrays para avisos de Validação
		$errors = array();
		$warnings = array();
		$successes = array();

		$prof = new Professor($_SESSION['user']);
		$email = $prof->getEmail();

		$t = new Turma($email);
		$t->getTurma($slug);
		$idTurma = $t->getId();

		$entrega = new Entrega();

		// Alterar turma //
		$atId = filter_input(INPUT_POST, 'at-id');
		if (filter_input(INPUT_POST, 'alterar_turma') === "alterar_turma" && !empty($atId)) {
			$atTurma = $_POST['at-turma'];
			$nomeTurma = $_POST['nome-turma'];
			$nomeProjeto = $_POST['nome-projeto'];
			$novaTurma = $t->alterarTurma($atId, $atTurma);
			if ($novaTurma != false) {
				array_push($successes, "Projeto <b>$nomeProjeto</b> passou da turma <b>$nomeTurma</b> para a turma <a href='" . HOME . "turmas/turma/" . $t->getSlug() . "'><b>$novaTurma</b></a>");
			} else {
				array_push($errors, "Erro ao mudar a turma do projeto <b>$nomeProjeto</b>");
			}
		}

		// Remover Projeto //
		$rpId = filter_input(INPUT_POST, 'rp-id');
		if (filter_input(INPUT_POST, 'remover_projeto') === "remover_projeto" && !empty($rpId)) {
			$t = new Turma($email, $rpId);
			$nomeTurma = $_POST['nome-turma'];
			$nomeProjeto = $_POST['nome-projeto'];
			$removido = $t->removerProjeto($rpId);
			if ($removido == true) {
				array_push($successes, "Projeto <b>" . $nomeProjeto . "</b> removido da turma <b>" . $nomeTurma . "</b> com sucesso!");
			} else {
				array_push($errors, "Erro ao remover projeto!");
			}
		}

		// Solicitar Entrega //
		if (filter_input(INPUT_POST, 'solicitar_entrega') === "solicitar_entrega") {
			$seTitulo = filter_input(INPUT_POST, 'se-titulo');
			$seDescricao = filter_input(INPUT_POST, 'se-descricao');
			$seData = filter_input(INPUT_POST, 'se-data');
			$seNaoReceber = filter_input(INPUT_POST, 'se-projetos');
			$statusEntrega = $entrega->novaEntrega($seTitulo, $seDescricao, $seData, $seNaoReceber, $idTurma);
			if ($statusEntrega === true) :
				array_push($successes, "Entrega <b>" . mb_strtoupper($seTitulo) . "</b> solicitada com sucesso!");
			else :
				array_push($errors, $statusEntrega);
			endif;
		}

		// Editar data da Entrega //
		if (filter_input(INPUT_POST, 'editar_entrega') === "editar_entrega") {
			$eeId = filter_input(INPUT_POST, 'ee-id');
			$eeTitulo = filter_input(INPUT_POST, 'ee-titulo');
			$eeData = filter_input(INPUT_POST, 'ee-data');
			$statusEntrega = $entrega->editarDataEntrega($eeId, $eeData);
			if ($statusEntrega === true) :
				array_push($successes, "Data da entrega <b>" . mb_strtoupper($eeTitulo) . "</b> alterada com sucesso!");
			else :
				array_push($errors, $statusEntrega);
			endif;
		}

		// Apagar Entrega //
		if (filter_input(INPUT_POST, 'remover_entrega') === "remover_entrega") {
			$reId = filter_input(INPUT_POST, 're-id');
			$statusEntrega = $entrega->apagarEntrega($reId);
			if ($statusEntrega === true) :
				array_push($successes, "Entrega apagada com sucesso!");
			else :
				array_push($errors, $statusEntrega);
			endif;
		}

		// Turmas para listagem no modal Solicitar Entrega
		$turmas = $t->getTurmas();
		$qtdTurmas = count($turmas);

		// Pega os projetos da turma ativa
		$turma = $t->getTurma($slug);
		if (empty($turma)) {
			array_push($warnings, "Está turma não possui nenhum projeto! Aceite convites para começar esta turma!");
		}
		$qtdProjetos = count($turma);

		$entregas = $entrega->getEntregas($idTurma);
		$qtdEntregas = count($entregas);

		$dados = array(
			'errors' => $errors,
			'warnings' => $warnings,
			'successes' => $successes,
			'turma' => $turma,
			'qtdProjetos' => $qtdProjetos,
			'turmas' => $turmas,
			'qtdTurmas' => $qtdTurmas,
			'entregas' => $entregas,
			'qtdEntregas' => $qtdEntregas
		);

		$this->loadTemplate("turma", $dados);
	}

	public function entrega($id)
	{
		// Arrays para avisos de Validação
		$errors = array();
		$warnings = array();
		$successes = array();

		$entrega = new Entrega($id);
		$entregas = $entrega->getEntregasTurma();

		$entregues = $entrega->getEntregaTipo('entregue');
		$avaliados = $entrega->getEntregaTipo('avaliado');
		$pendentes = $entrega->getEntregaTipo('pendente');

		// AVALIAR //
		

		// ALTERAR NOTA //

		// ENVIAR LEMBRETE //


		$dados = array(
			'errors' => $errors,
			'warnings' => $warnings,
			'successes' => $successes,
			'entregas' => $entregas,
			'entregues' => $entregues,
			'avaliados' => $avaliados,
			'pendentes' => $pendentes
		);

		$this->loadTemplate("entregaProjetos", $dados);
	}

	public function projeto($id)
	{
		// Arrays para avisos de Validação
		$errors = array();
		$warnings = array();
		$successes = array();

		$prof = new Professor($_SESSION['user']);
		$entrega = new Entrega();

		$dados = array(
			'errors' => $errors,
			'warnings' => $warnings,
			'successes' => $successes
		);

		$this->loadTemplate("projetoEntregas", $dados);
	}
}
