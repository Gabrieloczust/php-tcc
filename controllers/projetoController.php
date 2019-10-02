<?php
class projetoController extends Controller
{

    public function index()
    {
        $this->loadTemplate("projeto{$_SESSION['userType']}");
    }
}
