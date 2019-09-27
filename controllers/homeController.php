<?php
class homeController extends Controller
{
    public function __construct()
    {
        $u = new Usuario();
        if ($u->logado() == false) {
            header("Location:" . HOME . "login");
            exit;
        }
    }

    public function index()
    {
        $tipo = $_SESSION['userType'];
        $user = new $tipo($_SESSION['user']);

        $dados = array(
            "nome" => $user->getNome(),
            "letra" => substr($user->getNome(),0, 1)
        );
        $this->loadTemplate('home', $dados);
    }
}
