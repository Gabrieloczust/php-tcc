<?php

class Turma extends Model
{
    private $id;
    private $nome;
    private $orientador;

    public function __construct($emailOrientador = NULL, $idTurma = NULL)
    {
        parent::__construct();
        if (!empty($emailOrientador)) :
            $this->orientador = new Orientador($emailOrientador);
        endif;
        if (!empty($idTurma)) :
            $sql01 = $this->db->prepare("SELECT * FROM turma WHERE idTurma = ?");
            $sql01->execute(array($idTurma));
            $t = $sql01->fetch();
            $this->setId($t['idTurma']);
            $this->setNome($t['nome']);
        endif;
    }

    public function novaTurma($nome)
    {
        if ($this->existeNome($nome) == false) {
            $id = $this->orientador->getId();
            $hashInterno = $this->geraHash($nome);
            $slug = $this->slug($nome);

            $sql = $this->db->prepare("INSERT INTO turma SET nome = ?, slug = ?, fkOrientador = ?, hashInterno = ?");
            $sql->execute(array($nome, $slug, $id, $hashInterno));
            if ($sql->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editaNome($novoNome, $hashInterno)
    {
        if ($this->existeNome($novoNome) == false) {
            $slug = $this->slug($novoNome);
            $id = $this->orientador->getId();
            $sql = $this->db->prepare("UPDATE turma SET nome = ?, slug = ? WHERE hashInterno = ? AND fkOrientador = ?");
            $sql->execute(array($novoNome, $slug, $hashInterno, $id));
            return true;
        } else {
            return false;
        }
    }

    public function getTurma($slug)
    {
        $idOrientador = $this->orientador->getId();
        $sql = $this->db->prepare("SELECT * FROM turma as t INNER JOIN projeto as p ON(idTurma = fkTurma) WHERE fkOrientador = ? AND t.slug = ?");
        $sql->execute(array($idOrientador, $slug));
        if ($sql->rowCount() > 0) :
            return $sql->fetchAll();
        else :
            return array();
        endif;
    }

    public function getTurmas()
    {
        $id = $this->orientador->getId();
        $sql = $this->db->prepare("SELECT * FROM turma WHERE fkOrientador = ? ORDER BY idTurma DESC");
        $sql->execute(array($id));

        $results = $sql->fetchAll();
        $turmas = [];

        // Adiciona a qtd de projetos por turma
        foreach ($results as $result) {
            $a = $this->getQtdProjetoTurma($result['idTurma']);
            $a['qtdProjetoTurma'] = $a['qtdProjetoTurma'] == 1 ? $a['qtdProjetoTurma'] . " PROJETO" : $a['qtdProjetoTurma'] . " PROJETOS";
            array_push($turmas, array_merge($a, $result));
        }
        return $turmas;
    }

    public function apagarTurma()
    {
        $idTurma = $this->getId();
        $notificacao = new Notificacao("recusado");
        $idOrientador = $this->orientador->getId();
        $nomeOrientador = $this->orientador->getNome();

        $sql2 = $this->db->prepare("SELECT * FROM projeto_tem_professor INNER JOIN projeto ON(fkProjeto = idProjeto) WHERE fkProfessor = ? AND fkTurma = ?");
        $sql2->execute(array($idOrientador, $idTurma));
        if ($sql2->rowCount() > 0) {
            // Remover orientador dos projetos relacionados a essa turma
            foreach ($sql2->fetchAll() as $projeto) {
                // Enviar notificacao para os alunos que o orientador saiu do projeto
                $notificacao->orientadorSaiu($idOrientador, $nomeOrientador, $projeto['idProjeto']);

                $sql3 = $this->db->prepare("DELETE FROM projeto_tem_professor WHERE idProfProjeto = ?");
                $sql3->execute(array($projeto['idProfProjeto']));
            }

            $sql = $this->db->prepare("DELETE FROM turma WHERE idTurma = ?");
            $sql->execute(array($idTurma));
            if ($sql->rowCount() == 1) :
                return true;
            endif;
        }
        return false;
    }

    private function getQtdProjetoTurma($idTurma)
    {
        $sql = $this->db->prepare("SELECT count(*) as qtdProjetoTurma FROM projeto WHERE fkTurma = ?");
        $sql->execute(array($idTurma));
        $array = $sql->fetch();
        return $array;
    }

    private function existeNome($nome)
    {
        $sql = $this->db->prepare("SELECT nome FROM turma WHERE nome = ?");
        $sql->execute(array($nome));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function geraHash($nome)
    {
        return password_hash($nome, PASSWORD_BCRYPT);
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
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($n)
    {
        $this->nome = $n;
    }
}
