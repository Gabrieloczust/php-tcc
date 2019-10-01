<?php

class Controller
{

    public function __construct()
    {
        $u = new Usuario();
        if ($u->logado() == false) {
            header("Location:" . HOME . "login");
            exit;
        }
    }


    public function loadView($viewName, $viewData = array())
    {
        extract($viewData);
        require 'views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array())
    {
        $tipoUsuario = $_SESSION['userType'];
        $usuario = new $tipoUsuario($_SESSION['user']);

        $viewData["nome"] = $usuario->getNome();
        $viewData["letra"] = substr($usuario->getNome(), 0, 1);
        $viewData["email"] = $usuario->getEmail();

        extract($viewData);
        require "views/template{$tipoUsuario}.php";
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
