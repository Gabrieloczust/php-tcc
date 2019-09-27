<?php

class loginController extends Controller
{
    public function __construct()
    {
        $u = new Usuario();
        if ($u->logado() == true) {
            header("Location:" . HOME);
            exit;
        }
    }

    public function index()
    {
        // Arrays para avisos de Validação
        $errors = array();
        $success = array();

        /*
        // Model Recuperação de Senha
        if (!empty($_POST) && ($_POST['login'] == 'recuperar')) :
            $u = new Usuario();
            $t = $_POST['usuario-recuperar'];
            $tipo = !empty($t) ? $t : array_push($errors, 'Selecione o Tipo!');
            $u->setTipo($tipo);

            $e = $_POST['email-recuperar'];
            $email = filter_var($e, FILTER_VALIDATE_EMAIL) ? $e : array_push($errors, 'Digite um e-mail valido!');

            $modal = $u->geraToken($email);
            if ($modal == 1) {
                array_push($success, 'Confira seu e-mail para redefinir sua senha!');
            } else {
                array_push($errors, "Este e-mail não possue cadastro como " . $u->getTipo() . "!");
            }

        endif;
        */

        // LOGIN
        if (!empty($_POST) && ($_POST['login'] == 'login')) :

            $u = new Usuario();
            $t = $_POST['usuario'];
            $tipo = !empty($t) ? $t : array_push($errors, 'Selecione o Tipo!');
            $u->setTipo($tipo);

            $e = $_POST['email'];
            $email = filter_var($e, FILTER_VALIDATE_EMAIL) ? $e : array_push($errors, 'Digite um e-mail valido!');

            $s = $_POST['senha'];
            $senha = !empty($s) ? $s : array_push($errors, 'Digite sua senha!');

            $logado = $u->login($email, $senha);
            if ($logado == 1) {
                header("Location:" . HOME);
            } else {
                array_push($errors, 'E-mail e/ou Senha incorretos!');
            }

        endif;

        $dados = array(
            'errors' => $errors,
            'success' => $success
        );

        $this->loadTemplateRegister('login', $dados);
    }
}
