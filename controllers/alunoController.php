<?php
class alunoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Arrays para avisos de Validação
        $errors = array();
        $warnings = array();
        $successes = array();

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
                        array_push($successes, "Convite de Orientador enviado para <strong>$orientador</strong>");
                    } else {
                        array_push($warnings, 'Este e-mail não possui cadastro como professor!');
                    }
                } else {
                    array_push($warnings, 'Você já participa de um projeto com este título!');
                }
            } else {
                array_push($errors, 'Digite um título!');
            }
        }

        // Editar Titulo //
        $hashProjeto = filter_input(INPUT_POST, 'et-id');
        if (filter_input(INPUT_POST, 'edita_titulo') === "edita_titulo" && !empty($hashProjeto)) {
            $novoTitulo = filter_input(INPUT_POST, 'et-titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $validaTitulo = $projeto->editaTitulo($novoTitulo, $hashProjeto, $id);
            if ($validaTitulo == false) {
                array_push($warnings, "Título <strong>$novoTitulo</strong> já existe!");
            }
        }

        // Sair do Projeto //
        $spId = filter_input(INPUT_POST, 'sp-id');
        if (filter_input(INPUT_POST, 'sair_projeto') === "sair_projeto" && !empty($spId)) {
            $projeto->setAll($spId);
            $deletado = $projeto->sairProjeto($spId, $id);
            if ($deletado == true) {
                array_push($successes, "Projeto <strong>{$projeto->getTitulo()}</strong> removido com sucesso!");
            } else {
                array_push($errors, "Erro ao sair do projeto!");
            }
        }

        // Convidar Aluno //
        $caId = filter_input(INPUT_POST, 'ca-id');
        if (filter_input(INPUT_POST, 'convidar_aluno') === "convidar_aluno" && !empty($caId)) {
            $emails = $_POST['ca-aluno'];
            foreach ($emails as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL) && $aluno->vereficaEmail($email) == true) {
                    $convite = new Convite();
                    $enviado = $convite->convidaAluno($email, $caId, $id);
                    if ($enviado == true) {
                        array_push($successes, "Convite enviado para o email <strong>$email</strong>");
                    } else {
                        array_push($warnings, "Este email <strong>$email</strong> já possui convite!");
                    }
                } else {
                    array_push($errors, "Nenhum aluno possui cadastro com o email <strong>$email</strong>");
                }
            }
        }

        // Convida o Orientador //
        $omId = filter_input(INPUT_POST, 'om-id');
        if (filter_input(INPUT_POST, 'convidar_orientador') === "convidar_orientador" && !empty($omId)) {
            // Pega o E-mail do Orientador
            $orientador = filter_input(INPUT_POST, 'om-email', FILTER_VALIDATE_EMAIL);
            $convite = new Convite();
            $existeOrientador = $convite->convidaOrientador($orientador, $omId, $id);
            if ($existeOrientador == true) {
                array_push($successes, "Convite de Orientador enviado para <strong>$orientador</strong>");
            } else {
                array_push($warnings, 'Este e-mail não possui cadastro como professor!');
            }
        }

        $qtdProjetos = $projeto->qtdProjetos($id);
        $projetos = $projeto->getProjetos($id);

        $dados = array(
            'errors' => $errors,
            'warnings' => $warnings,
            'successes' => $successes,
            'qtd' => $qtdProjetos,
            'projetos' => $projetos
        );

        $this->loadTemplate("homealuno", $dados);
    }
}
