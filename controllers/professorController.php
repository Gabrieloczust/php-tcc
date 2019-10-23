<?php
class professorController extends Controller
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

        $prof = new Professor($_SESSION['user']);
        $email = $prof->getEmail();

        $turma = new Turma($email);

        // Cadastro de Nova Turma //
        if (filter_input(INPUT_POST, 'nova_turma') === "nova_turma") {
            // Pega o nome da turma
            $nome = strtoupper(filter_input(INPUT_POST, 'nt-nome', FILTER_SANITIZE_SPECIAL_CHARS));
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
            $novoNome = strtoupper(filter_input(INPUT_POST, 'en-nome', FILTER_SANITIZE_SPECIAL_CHARS));
            $nomeAntigo = $_POST['en-nome-aviso'];
            $validaNome = $turma->editaNome($novoNome, $hashTurma);
            if ($validaNome == false) {
                array_push($warnings, "Você já possui uma turma com o nome <b>$novoNome</b>!");
            } else {
                array_push($successes, "Nome da turma <b>$nomeAntigo</b> alterado para <b>$novoNome</b> com sucesso!");
            }
        }

        $turmas = $turma->getTurmas();

        $dados = array(
            'errors' => $errors,
            'warnings' => $warnings,
            'successes' => $successes,
            'turmas' => $turmas
        );

        $this->loadTemplate("homeprofessor", $dados);
    }
}
