<?php
class professorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->loadTemplate("homeprofessor");
    }
}
