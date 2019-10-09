<?php
class projetoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->loadTemplate("projeto{$_SESSION['userType']}");
    }
}
