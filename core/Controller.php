<?php

class Controller
{
    public function loadView($viewName, $viewData = array())
    {
        extract($viewData);
        require 'views/' . $viewName . '.php';
    }

    public function loadTemplateAluno($viewName, $viewData = array())
    {
        extract($viewData);
        require 'views/templateAluno.php';
    }

    public function loadTemplateProfessor($viewName, $viewData = array())
    {
        extract($viewData);
        require 'views/templateProfessor.php';
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
