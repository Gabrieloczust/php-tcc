<?php
class conviteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function aceitarorientador($hashConvite)
    {
        $id = $this->usuarioLogado->getId();
        $emailOrientador = $this->usuarioLogado->getEmail();
        $turma = $_POST['turma'];
        $convite = new Convite();
        $convite->aceitarConviteOrientador($id, $hashConvite, $turma, $emailOrientador);
        header("Location:" . HOME);
    }
    public function aceitar($hashConvite)
    {
        $id = $this->usuarioLogado->getId();
        $emailAluno = $this->usuarioLogado->getEmail();
        $convite = new Convite();
        $convite->aceitarConvite($id, $hashConvite, $emailAluno);
        header("Location:" . HOME);
    }
    public function aceitartodos()
    {
        $id = $this->usuarioLogado->getId();
        $emailAluno = $this->usuarioLogado->getEmail();
        $convite = new Convite();
        $convite->aceitarTodosConvites($id, $emailAluno);
        header("Location:" . HOME);
    }
    public function recusar($hashConvite)
    {
        $id = $this->usuarioLogado->getId();
        $emailUsuario = $this->usuarioLogado->getEmail();
        $convite = new Convite();
        $convite->recusarConvite($id, $hashConvite, $emailUsuario);
        header("Location:" . HOME);
    }
    public function recusartodos()
    {
        $id = $this->usuarioLogado->getId();
        $emailUsuario = $this->usuarioLogado->getEmail();
        $convite = new Convite();
        $convite->recusarTodosConvites($id, $emailUsuario);
        header("Location:" . HOME);
    }
}
