<?php
class ajaxController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function mudatema()
    {
        $usuario = $this->usuarioLogado;
        $usuario->mudarTema();
    }
}
