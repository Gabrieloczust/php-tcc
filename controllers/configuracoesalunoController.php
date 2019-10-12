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
            'curso' => $usuario->getCurso(),
            'celular' => $usuario->getTelefone()
        );
        $this->loadTemplate("configuracoesaluno", $dados);
    }
}
