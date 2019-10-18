<?php
class configuracoesprofessorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->usuarioLogadoTipo != 'professor') {
            header("Location:" . HOME . "notfound");
            exit;
        }
    }

    public function index()
    {
        // Arrays para avisos de Validação
        $errors = array();
        $warnings = array();
        $successes = array();

        $usuario = $this->usuarioLogado;

        $dados = array(
            'errors' => $errors,
            'warnings' => $warnings,
            'successes' => $successes,
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'escola' => $usuario->getEscola(),
            'celular' => $usuario->getTelefone(),
            'tema' => $usuario->getTemaDark()
        );
        $this->loadTemplate("configuracoesprofessor", $dados);
    }

    public function perfil()
    {

        $usuario = $this->usuarioLogado;

        // Array para update
        $update = array();

        // Nome
        if (!empty($_POST['perfil-nome'])) {
            $nome = filter_input(INPUT_POST, 'perfil-nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $update['nome'] = $nome;
        } else {
            $update['nome'] = $usuario->getNome();
        }

        // E-mail
        $verificaEmail1 = filter_input(INPUT_POST, 'perfil-email', FILTER_VALIDATE_EMAIL);
        $verificaEmail2 = $usuario->vereficaEmail($verificaEmail1);
        if (!empty($verificaEmail1) && $verificaEmail2 == false) {
            $update['email'] = $verificaEmail1;
        } else {
            $update['email'] = $usuario->getEmail();
        }

        // Escola
        if (!empty($_POST['perfil-escola'])) {
            $escola = filter_input(INPUT_POST, 'perfil-escola', FILTER_SANITIZE_SPECIAL_CHARS);
            $update['escola'] = $escola;
        } else {
            $update['escola'] = $usuario->getEscola();
        }

        // Celular
        if (!empty($_POST['perfil-celular'])) {
            $celular = $_POST['perfil-celular'];
            $update['celular'] = $celular;
        } else {
            $update['celular'] = $usuario->getTelefone();
        }

        //Validação Senhas
        $senha = $_POST['perfil-senha'];
        $senhaConfirma = $_POST['perfil-c-senha'];
        if ((!empty($senha) && !empty($senhaConfirma)) && ($senha == $senhaConfirma)) {
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
            $update['senha'] = $senhaHash;
        } else {
            $update['senha'] = $usuario->getSenha();
        }

        $usuario->atualizar($update);

        header("Location:" . HOME . "configuracoesprofessor");
    }

    public function tema()
    {
        $usuario = $this->usuarioLogado;

        $usuario->mudarTema();

        header("Location:" . HOME . 'configuracoesprofessor');
    }
}
