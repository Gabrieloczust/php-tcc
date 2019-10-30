<?php

class Notificacao extends Model
{
    private $tipo;
    private $projeto;

    public function __construct($tipoNotificacao)
    {
        parent::__construct();
        $this->setTipo($tipoNotificacao);
        $this->projeto = new Projeto();
    }

    public function notificacaoConvite($idRemetente, $tipoDestinatario, $idDestinatario, $emailDestinatario, $idProjeto)
    {
        // Pega o titulo do projeto para enviar na mensagem
        $this->projeto->setAll($idProjeto);
        $tituloProjeto = $this->projeto->getTitulo();

        // Pega o nome do destinatario
        $destinatario = new $tipoDestinatario($emailDestinatario);
        $nomeDestinario = $destinatario->getNome();

        // Monta a mensagem da notificação
        $mensagem = "Convite de $tipoDestinatario para o projeto $tituloProjeto " . $this->getTipo() . " por $nomeDestinario";

        $sql = $this->db->prepare("INSERT INTO notificacao SET tipo = ?, mensagem = ?, fkRemetente = ?, fkDestinatario = ?, tipoDestinatario = ?");
        $sql->execute(array($this->getTipo(), $mensagem, $idRemetente, $idDestinatario, 'Aluno'));
    }

    public function orientadorSaiu($idOrientador, $nomeOrientador, $idProjeto)
    {
        // Pega o id dos alunos que receberam esta notificacao
        $sql = $this->db->prepare("SELECT fkAluno FROM projeto_tem_aluno WHERE fkProjeto = ?");
        $sql->execute(array($idProjeto));
        $ids = $sql->fetchAll();

        // Pega o nome do projeto
        $this->projeto->setAll($idProjeto);
        $nomeProjeto = $this->projeto->getTitulo();

        // Monta a mensagem
        $mensagem = "O Orientador $nomeOrientador saiu do projeto $nomeProjeto!";

        // Envia a notifacao para todos alunos
        foreach ($ids as $id) :
            $sql2 = $this->db->prepare("INSERT INTO notificacao SET tipo = 'recusado', mensagem = ?, fkRemetente = ?, fkDestinatario = ?, tipoDestinatario = 'Aluno'");
            $sql2->execute(array($mensagem, $idOrientador, $id['fkAluno']));
        endforeach;
    }

    public function getNoficacoes($idUsuario)
    {
        $sql = $this->db->prepare("SELECT * FROM notificacao WHERE tipoDestinatario = ? AND fkDestinatario = ? ORDER BY idNotificacao DESC");
        $sql->execute(array($this->getTipo(), $idUsuario));
        return $sql->fetchAll();
    }

    public function qtdNaoLidas($idUsuario)
    {
        $sql = $this->db->prepare("SELECT count(*) as qtdNaoLidas FROM notificacao WHERE tipoDestinatario = ? AND fkDestinatario = ? AND lida = 'false'");
        $sql->execute(array($this->getTipo(), $idUsuario));
        return $sql->fetch()['qtdNaoLidas'];
    }

    public function changeLidas($idUsuario)
    {
        $sql = $this->db->prepare("UPDATE notificacao SET lida = 'true' WHERE tipoDestinatario = ? AND fkDestinatario = ? AND lida = 'false'");
        $sql->execute(array($this->getTipo(), $idUsuario));
    }

    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($t)
    {
        $this->tipo = $t;
    }
}
