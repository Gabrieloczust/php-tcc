<?php

class Entrega extends Model
{
    private $id, $titulo, $slug, $descricao, $nota, $data_solicitado, $data_entrega;

    public function __construct($idEntrega = NULL)
    {
        parent::__construct();
        if (!empty($idEntrega)) :
            $this->setAll($idEntrega);
        endif;
    }

    public function novaEntrega($titulo, $descricao, $data, $naoReceber, $idTurma)
    {
        // Cadastra a entrega
        $slug = $this->slug($titulo);
        $sql = $this->db->prepare("INSERT INTO entrega SET titulo = ?, slug = ?, descricao = ?, data_entrega = ?, fkTurma = ?");
        $sql->execute(array(mb_strtoupper($titulo), $slug, $descricao, $data, $idTurma));

        // Pega o id da entrega cadastrada
        $idEntrega = $this->db->query("SELECT idEntrega FROM entrega ORDER BY idEntrega DESC LIMIT 1");
        $idEntrega = $idEntrega->fetch()[0];

        // Monta o WHERE se houver algum projeto na lista Nao Receber
        $whereTurma = str_replace(",", " AND idProjeto != ", $naoReceber);
        $whereTurma = empty($whereTurma) ? " idProjeto IS NOT NULL" : "idProjeto != " . $whereTurma;

        // Pega o id dos projetos que vao receber
        $sql1 = $this->db->prepare("SELECT GROUP_CONCAT(idProjeto) as ids FROM projeto WHERE fkTurma = ? AND $whereTurma");
        $sql1->execute(array($idTurma));
        $receber = $sql1->fetch()['ids'];
        $projetoIds = explode(",", $receber);

        // Associa a entrega a cada projeto que faz parte da turma
        foreach ($projetoIds as $projetoId) :
            $sql2 = $this->db->prepare("INSERT INTO projeto_tem_entrega SET fkProjeto = ?, fkEntrega = ?");
            $sql2->execute(array($projetoId, $idEntrega));
            // Envia notificação de nova entrega
            $notificacao = new Notificacao("recusado");
            $notificacao->novaEntrega($idEntrega, $projetoId);
        endforeach;
    }

    public function getEntregas($idTurma)
    {
        $sql = $this->db->prepare("SELECT * FROM entrega WHERE fkTurma = ? ORDER BY data_entrega");
        $sql->execute(array($idTurma));
        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        } else {
            return [];
        }
    }

    public function getEntregasProjeto($idProjeto)
    {
        $sql = $this->db->prepare("SELECT * FROM projeto_tem_entrega INNER JOIN entrega ON(fkEntrega = idEntrega) WHERE fkProjeto = ? ORDER BY data_entrega");
        $sql->execute(array($idProjeto));
        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        } else {
            return [];
        }
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
        $this->setDataSolicitado($entrega['data_solicitado']);
        $this->setDataEntrega($entrega['data_entrega']);
    }

    private function slug($string)
    {
        $str = strtolower(utf8_decode($string));
        $i = 1;
        $str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûüýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuuyyy');
        $str = preg_replace("/([^a-z0-9])/", '-', utf8_encode($str));
        while ($i > 0) $str = str_replace('--', '-', $str, $i);
        if (substr($str, -1) == '-') $str = substr($str, 0, -1);
        return $str;
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
    public function getDataSolicitado()
    {
        return $this->data_solicitado;
    }
    public function setDataSolicitado($x)
    {
        $this->data_solicitado = date("d/m/y", strtotime($x));
    }
    public function getDataEntrega()
    {
        return $this->data_entrega;
    }
    public function setDataEntrega($x)
    {
        $this->data_entrega = date("d/m/y", strtotime($x));
    }
}
