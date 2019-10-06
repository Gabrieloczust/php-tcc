<?php

class Projeto extends Model
{
    private $id;
    private $titulo;
    private $alunos;
    private $orientador;

    public function novoProjeto($titulo, $orientador, $alunos = NULL)
    { 
        $sql = $this->db->prepare("INSERT INTO projeto SET titulo = :titulo");
        $sql->bindValue(":titulo", $titulo);
        $sql->execute();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($t)
    {
        $this->titulo = $t;
    }
}
