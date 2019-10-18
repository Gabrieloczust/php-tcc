<?php

class Usuario extends Model
{

    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $senha;
    protected $temaDark;
    public $tipo;

    public function cadastra($nome, $email, $telefone, $escola_curso, $senha)
    {
        if ($this->vereficaEmail($email) == 0) {

            $tipo = $this->getTipo();
            $ip = $this->getIP();
            $token = $this->geraToken();

            $nome = strtoupper(strtolower($nome));
            $escola_curso = strtoupper(strtolower($escola_curso));

            $sql = "INSERT INTO {$tipo} SET nome = ?, email = ?, telefone = ?, senha = ?, ip_cadastro = ?, token = ?";
            if ($tipo == 'aluno') {
                $sql .= ", curso = ?";
            } elseif ($tipo == 'professor') {
                $sql .= ", escola = ?";
            }
            $sql = $this->db->prepare($sql);
            $sql->execute(array($nome, $email, $telefone, $senha, $ip, $token, $escola_curso));
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $senha)
    {
        $sql = "SELECT * FROM {$this->getTipo()} WHERE email = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email));
        if ($sql->rowCount() > 0) {
            $hash = $sql->fetch()['senha'];
            if (password_verify($senha, $hash)) {
                $_SESSION['user'] = $email;
                $_SESSION['userType'] = $this->getTipo();
                return true;
            }
        } else {
            return false;
        }
    }

    public function logado()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    public function vereficaEmail($email)
    {
        $sql = "SELECT * FROM {$this->getTipo()} WHERE email = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    private function geraToken()
    {
        return password_hash(time() . rand(0, 99999), PASSWORD_BCRYPT);
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

    public function setNome($name)
    {
        $this->nome = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($mail)
    {
        $this->email = $mail;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getTemaDark()
    {
        return $this->temaDark;
    }

    public function setTemaDark($tema)
    {
        $this->temaDark = $tema;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
}
