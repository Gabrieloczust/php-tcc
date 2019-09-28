<?php

class Professor extends Usuario {

    private $escola;

    public function __construct($e)
    {
        parent::__construct();
        $sql = "SELECT * FROM professor WHERE email = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($e));
        if ($sql->rowCount() > 0) {
            $user = $sql->fetch();
            $this->setId($user['rp']);
            $this->setNome($user['nome']);
            $this->setEmail($user['email']);
            $this->setTelefone($user['telefone']);
            $this->setSenha($user['senha']);
            $this->setTipo('Professor');
            $this->setEscola($user['escola']);
        }
    }

    public function getEscola() {
        return $this->escola;
    }

    public function setEscola($escola) {
        $this->escola = $escola;
    }

}
