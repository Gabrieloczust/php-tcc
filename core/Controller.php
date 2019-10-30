<?php

class Controller
{
    public $usuarioLogado;
    public $usuarioLogadoTipo;

    public function __construct()
    {
        $u = new Usuario();
        if ($u->logado() == false) {
            header("Location:" . HOME . "login");
            exit;
        } else {
            $this->usuarioLogadoTipo = $_SESSION['userType'];
            $u = ucfirst($this->usuarioLogadoTipo);
            $this->usuarioLogado = new $u($_SESSION['user']);
        }
    }

    public function loadView($viewName, $viewData = array())
    {
        extract($viewData);
        require 'views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array())
    {
        // Nome do Usuario no menu
        $viewData["temaDark"] = $this->usuarioLogado->getTemaDark();
        $viewData["nome"] = $this->usuarioLogado->getNome();
        $viewData["letra"] = substr($this->usuarioLogado->getNome(), 0, 1);

        extract($viewData);
        require "views/template{$this->usuarioLogadoTipo}.php";
    }

    public function loadTemplateRegister($viewName, $viewData = array())
    {
        require 'views/templateRegister.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array())
    {
        extract($viewData);
        require 'views/' . $viewName . '.php';
    }

    public function loadJsInTemplate($viewName)
    {
        if (file_exists('assets/js/' . $viewName . '.js')) {
            echo "<script src='" . JS . $viewName . ".js'></script>";
        }
    }

    public function loadCssInTemplate($viewName)
    {
        if (file_exists('assets/css/' . $viewName . '.css')) {
            echo "<link rel='stylesheet' href='" . CSS . $viewName . ".css'>\n";
        }
    }
}
