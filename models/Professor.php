<?php

class Professor extends Usuario
{

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
            $this->setTemaDark($user['temaDark']);
            $this->setTipo('professor');
            $this->setEscola($user['escola']);
        }
    }

    public function mudarTema()
    {
        $sql = $this->db->prepare("SELECT temaDark FROM professor WHERE rp = {$this->getId()}");
        $sql->execute();
        $valor = $sql->fetch()['temaDark'];
        $valor = $valor == 'on' ? 'off' : 'on';

        $sql1 = $this->db->prepare("UPDATE professor SET temaDark = ? WHERE rp = {$this->getId()}");
        $sql1->execute(array($valor));
    }

    public function getEscola()
    {
        return $this->escola;
    }

    public function setEscola($escola)
    {
        $this->escola = $escola;
    }
}
