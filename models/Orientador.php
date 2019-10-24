<?php

class Orientador extends Professor
{
    public function __construct($email)
    {
        parent::__construct($email);
    }

    public function adicionaOrientador($idProjeto)
    {
        $sql = $this->db->prepare("INSERT INTO projeto_tem_professor SET tipoProfessor = 'Orientador', fkProjeto = ?, fkProfessor = ?");
        $sql->execute(array($idProjeto, $this->getId()));
    }
}
