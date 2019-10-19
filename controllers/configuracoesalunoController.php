<?php
class configuracoesalunoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->usuarioLogadoTipo != 'aluno') {
            header("Location:" . HOME . "notfound");
            exit;
        }
    }

    public function index()
    {
        // Array para avisos de validação
        $warnings = array();

        if (isset($_SESSION['avisos'])) {
            array_push($warnings, $_SESSION['avisos']);
        }

        $usuario = $this->usuarioLogado;

        $dados = array(
            "warnings" => $warnings,
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'curso' => $usuario->getCurso(),
            'celular' => $usuario->getTelefone(),
            'tema' => $usuario->getTemaDark()
        );
        $this->loadTemplate("configuracoesaluno", $dados);
    }

    public function perfil()
    {

        $usuario = $this->usuarioLogado;

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
        if (!empty($verificaEmail1)) {
            $verificaEmail2 = $usuario->vereficaEmail($verificaEmail1);
            if ($verificaEmail2 == false) {
                $update['email'] = $verificaEmail1;
                unset($_SESSION['avisos']);
            } else {
                $update['email'] = $usuario->getEmail();
                $_SESSION['avisos'] = "Este e-mail ja possui cadastro!";
            }
        } else {
            $update['email'] = $usuario->getEmail();
            unset($_SESSION['avisos']);
        }

        // Curso
        if (!empty($_POST['perfil-curso'])) {
            $curso = filter_input(INPUT_POST, 'perfil-curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $update['curso'] = $curso;
        } else {
            $update['curso'] = $usuario->getCurso();
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

        header("Location:" . HOME . 'configuracoesaluno');
    }
}
