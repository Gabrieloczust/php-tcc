<?php

class Aluno extends Usuario
{

    private $curso;

    public function __construct($e)
    {
        parent::__construct();
        $sql = "SELECT * FROM aluno WHERE email = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($e));
        if ($sql->rowCount() > 0) {
            $user = $sql->fetch();
            $this->setId($user['ra']);
            $this->setNome($user['nome']);
            $this->setEmail($user['email']);
            $this->setTelefone($user['telefone']);
            $this->setSenha($user['senha']);
            $this->setTipo('aluno');
            $this->setCurso($user['curso']);
            return true;
        }
    }

    public function atualizar($update)
    {
        extract($update);
        $sql = $this->db->prepare("UPDATE aluno SET nome = ?, email = ?, telefone = ?, curso = ?, senha = ? WHERE ra = {$this->getId()}");
        $sql->execute(array($nome, $email, $celular, $curso, $senha));
        $_SESSION['user'] = $email;
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurso()
    {
        return $this->curso;
    }

    public function setCurso($curso)
    {
        $this->curso = $curso;
    }
}
