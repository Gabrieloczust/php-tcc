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
        $sql->execute(array($this->getTipo(), $mensagem, $idRemetente, $idDestinatario, $tipoDestinatario));
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
