<?php

class Entrega extends Model
{
    private $id, $titulo, $slug, $descricao, $nota, $data_solicitado, $data_entrega;
    public $orientador, $projeto;

    public function __construct($idOrientador, $idProjeto, $idEntrega = NULL)
    {
        parent::__construct();
        $this->projeto = $idProjeto;
        $this->orientador = $idOrientador;

        if (!empty($idEntrega)) :
            $this->setAll($idEntrega);
        endif;
    }

    public function setAll($idEntrega)
    {
        $sql = $this->db->prepare("SELECT * FROM entrega WHERE idEntrega = ?");
        $sql->execute(array($idEntrega));
        $entrega = $sql->fetch();
        $this->setId($entrega['idEntrega']);
        $this->setTitulo($entrega['titulo']);
        $this->setSlug($entrega['slug']);
        $this->setDescricao($entrega['descricao']);
        $this->setData_Solicitado($entrega['data_solicitado']);
        $this->setData_Entrega($entrega['data_entrega']);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($x)
    {
        $this->id = $x;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($x)
    {
        $this->titulo = $x;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function setSlug($x)
    {
        $this->slug = $x;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($x)
    {
        $this->descricao = $x;
    }
    public function getNota()
    {
        return $this->nota;
    }
    public function setNota($x)
    {
        $this->nota = $x;
    }
    public function getData_Solicitado()
    {
        return $this->data_solicitado;
    }
    public function setData_Solicitado($x)
    {
        $this->data_solicitado = $x;
    }
    public function getData_Entrega()
    {
        return $this->data_entrega;
    }
    public function setData_Entrega($x)
    {
        $this->data_entrega = $x;
    }
}
