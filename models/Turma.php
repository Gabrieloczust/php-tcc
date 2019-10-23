<?php

class Turma extends Model
{
    private $nome;
    private $orientador;
    private $projetos;

    public function __construct($emailOrientador)
    {
        parent::__construct();
        $this->orientador = new Orientador($emailOrientador);
    }

    public function novaTurma($nome)
    {
        if ($this->existeNome($nome) == false) {
            $id = $this->orientador->getId();
            $hashInterno = $this->geraHash($nome);

            $sql = $this->db->prepare("INSERT INTO turma SET nome = ?, fkOrientador = ?, hashInterno = ?");
            $sql->execute(array($nome, $id, $hashInterno));
            if ($sql->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getTurmas()
    {
        $id = $this->orientador->getId();
        $sql = $this->db->prepare("SELECT * FROM turma WHERE fkOrientador = ?");
        $sql->execute(array($id));
        return $sql->fetchAll();
    }

    public function editaNome($novoNome, $hashInterno)
    {
        if ($this->existeNome($novoNome) == false) {
            $id = $this->orientador->getId();
            $sql = $this->db->prepare("UPDATE turma SET nome = ? WHERE hashInterno = ? AND fkOrientador = ?");
            $sql->execute(array($novoNome, $hashInterno, $id));
            return true;
        } else {
            return false;
        }
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

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($n)
    {
        $this->nome = $n;
    }
}
