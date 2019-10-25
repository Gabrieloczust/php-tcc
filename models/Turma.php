<?php

class Turma extends Model
{
    private $nome;
    private $orientador;

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
            $slug = $this->slug($novoNome);
            $id = $this->orientador->getId();
            $sql = $this->db->prepare("UPDATE turma SET nome = ?, slug = ? WHERE hashInterno = ? AND fkOrientador = ?");
            $sql->execute(array($novoNome, $slug, $hashInterno, $id));
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

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($n)
    {
        $this->nome = $n;
    }
}
