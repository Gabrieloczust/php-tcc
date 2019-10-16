<?php
class conviteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function aceitar($hashConvite)
    {
        $id = $this->usuarioLogado->getId();
        $convite = new Convite();
        $convite->aceitarConvite($id, $hashConvite);
        header("Location:" . HOME);
    }
    public function aceitartodos()
    {
        $id = $this->usuarioLogado->getId();
        $convite = new Convite();
        $convite->aceitarTodosConvites($id);
        header("Location:" . HOME);
    }
    public function recusar($hashConvite)
    {
        $id = $this->usuarioLogado->getId();
        $convite = new Convite();
        $convite->recusarConvite($id, $hashConvite);
        header("Location:" . HOME);
    }
    public function recusartodos()
    {
        $id = $this->usuarioLogado->getId();
        $convite = new Convite();
        $convite->recusarTodosConvites($id);
        header("Location:" . HOME);
    }
}
