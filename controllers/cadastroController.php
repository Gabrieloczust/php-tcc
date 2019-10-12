<?php

class cadastroController extends Controller
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

        // Array para erros de Validação
        $errors = array();

        // Validação //
        if (!empty($_POST)) :

            $t = $_POST['usuario'];
            $tipo = !empty($t) ? $t : array_push($errors, 'Selecione o Tipo!');

            $nome = $_POST['nome'];

            $curso = !empty($_POST['curso']) ? $_POST['curso'] : NULL;
            $escola = !empty($_POST['escola']) ? $_POST['escola'] : NULL;
            $curso_escola = ($tipo == 'aluno') ? $curso : $escola;

            $e = strtolower($_POST['email']);
            $email = filter_var($e, FILTER_VALIDATE_EMAIL) ? $e : array_push($errors, 'E-mail Inválido!');

            $tel = $_POST['telefone'];
            $telefone = !empty($tel) ? $tel : NULL;


            //Validação Senhas
            if (!empty($_POST['senha1']) && !empty($_POST['senha2'])) {
                $senha = $_POST['senha1'];
                $senhaConfirma = $_POST['senha2'];
                if ($senha == $senhaConfirma) {
                    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
                }
            } else {
                array_push($errors, 'As senhas não estão iguais!');
            }

            if (count($errors) < 1) {
                $u = new Usuario();
                $u->setTipo($tipo);
                $cadastrado = $u->cadastra($nome, $email, $telefone, $curso_escola, $senhaHash);
                if ($cadastrado == 1) {
                    header('Location:' . HOME . 'login');
                    exit();
                } else {
                    array_push($errors, 'Este e-mail já possui cadastro!');
                }
            }
        endif;

        $dados = array(
            'errors' => $errors
        );
        $this->loadTemplateRegister('cadastro', $dados);
    }
}
