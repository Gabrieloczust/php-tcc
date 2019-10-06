<?php
class homeController extends Controller
{
    public function index()
    {
        $this->loadTemplate("home{$_SESSION['userType']}");
    }

    public function novo_projeto()
    {
        // Array de retorno para o Template
        $dados = [];

        // Arrays para avisos de Validação
        $errors = array();
        $success = array();

        if (filter_input(INPUT_POST, 'novo_projeto') === "novo_projeto") {
            $titulo = filter_input(INPUT_POST, 'ng-titulo', FILTER_SANITIZE_SPECIAL_CHARS);
            $orientador = filter_input(INPUT_POST, 'ng-emailProfessor', FILTER_VALIDATE_EMAIL);

            $alunos = $_POST["emailAluno"];
            foreach ($alunos as $aluno) {
                $a = new Aluno($aluno);
                if ($a->vereficaEmail($aluno) == false) {
                    array_push($errors, "O e-mail $aluno não possui cadastro como Aluno!");
                } else {
                    $nome = $a->getNome();
                    array_push($success, "O Aluno $nome recebeu seu convite!");
                }
            }

            $projeto = new Projeto();
            $projeto->novoProjeto($titulo, $orientador, $alunos);
        }

        $dados = array(
            'errors' => $errors,
            'success' => $success
        );
        
        header("Location: " . HOME);
    }
}
