<?php
class homeController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->usuarioLogadoTipo == 'aluno') {
			header('Location:' . HOME . 'projetos');
		} else {
			header('Location:' . HOME . 'turmas');
		}
	}
}
