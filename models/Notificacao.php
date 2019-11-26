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
        $mensagem = "Convite de $tipoDestinatario para o projeto <b>$tituloProjeto</b> " . $this->getTipo() . " por <b>$nomeDestinario</b>";

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
        $mensagem = "O Orientador <b>$nomeOrientador</b> saiu do projeto <b>$nomeProjeto</b>";

        // Envia a notifacao para todos alunos
        foreach ($ids as $id) :
            $sql2 = $this->db->prepare("INSERT INTO notificacao SET tipo = 'recusado', mensagem = ?, fkRemetente = ?, fkDestinatario = ?, tipoDestinatario = 'Aluno'");
            $sql2->execute(array($mensagem, $idOrientador, $id['fkAluno']));
        endforeach;
    }

    public function alunoSaiu($idProjeto, $ra)
    {
        // Pega o titulo do Projeto
        $this->projeto->setAll($idProjeto);
        $titulo = $this->projeto->getTitulo();

        // Pega o nome do aluno
        $sql = $this->db->prepare("SELECT nome FROM aluno WHERE ra = ?");
        $sql->execute(array($ra));
        $nome = $sql->fetch()['nome'];

        // Pega o id dos alunos que receberam esta notificacao
        $sql1 = $this->db->prepare("SELECT fkAluno FROM projeto_tem_aluno WHERE fkProjeto = ? AND fkAluno != ?");
        $sql1->execute(array($idProjeto, $ra));
        $ids = $sql1->fetchAll();

        // Monta mensagem
        $mensagem = "O aluno <b>$nome</b> saiu do projeto <b>$titulo</b>";

        // Envia a notifacao para os alunos do projeto
        foreach ($ids as $id) :
            $sql2 = $this->db->prepare("INSERT INTO notificacao SET tipo = 'recusado', mensagem = ?, fkRemetente = ?, fkDestinatario = ?, tipoDestinatario = 'Aluno'");
            $sql2->execute(array($mensagem, $ra, $id['fkAluno']));
        endforeach;
    }

    public function projetoApagado($idProjeto, $ra)
    {
        // Pega o id da turma, id do orientador e nome do Projeto
        $this->projeto->setAll($idProjeto);
        $tituloProjeto = $this->projeto->getTitulo();
        $idOrientador = $this->projeto->getOrientador();
        $idTurma = $this->projeto->getTurma();
        $turma = new Turma(NULL, $idTurma);
        $nomeTurma = $turma->getNome();

        // Monta mensagem
        $mensagem = "O projeto <b>$tituloProjeto</b> não existe mais, foi apagado da turma <b>$nomeTurma</b> automaticamente";

        $sql = $this->db->prepare("INSERT INTO notificacao SET tipo = ?, mensagem = ?, fkRemetente = ?, fkDestinatario = ?, tipoDestinatario = ?");
        $sql->execute(array($this->getTipo(), $mensagem, $ra, $idOrientador, 'Orientador'));
    }

    public function novaEntrega($idEntrega, $idProjeto)
    {
        // Nome e data da entrega
        $entrega = new Entrega($idEntrega);
        $tituloEntrega = $entrega->getTitulo();
        $dataEntrega = $entrega->getDataEntrega();

        // Titulo do Projeto
        $this->projeto->setAll($idProjeto);
        $tituloProjeto = $this->projeto->getTitulo();
        //$slugProjeto = $this->projeto->getSlug();

        // Pega o id dos alunos que receberam esta notificacao
        $sql1 = $this->db->prepare("SELECT fkAluno FROM projeto_tem_aluno WHERE fkProjeto = ?");
        $sql1->execute(array($idProjeto));
        $ids = $sql1->fetchAll();

        //$mensagem = "<a href='" . HOME . "projetos/projeto/$slugProjeto'>Nova entrega: <b>$tituloEntrega</b><br> Projeto: <b>$tituloProjeto</b><br> Data de entrega: <b>$dataEntrega</b></a>";
        $mensagem = "Nova entrega: <b>$tituloEntrega</b><br> Projeto: <b>$tituloProjeto</b><br> Data de entrega: <b>$dataEntrega</b>";

        // Envia a notifacao para todos os alunos de todos projetos participantes da turma
        foreach ($ids as $id) :
            $sql = $this->db->prepare("INSERT INTO notificacao SET tipo = ?, mensagem = ?, fkDestinatario = ?, tipoDestinatario = 'Aluno'");
            $sql->execute(array($this->getTipo(), $mensagem, $id['fkAluno']));
        endforeach;
    }

    public function entregaRealizada($idProjetoEentrega)
    {
        $sql = $this->db->prepare("SELECT *, t.slug as slugTurma FROM projeto_tem_entrega pe INNER JOIN entrega e ON(pe.fkEntrega = e.idEntrega) INNER JOIN turma t ON(e.fkTurma = t.idTurma) WHERE idProjetoEntrega = ?");
        $sql->execute(array($idProjetoEentrega));
        $result = $sql->fetch();

        $idProjeto = $result['fkProjeto'];
        $projeto = new Projeto();
        $projeto->setAll($idProjeto);
        $projetoTitulo = $projeto->getTitulo();

        $idOrientador = $result['fkOrientador'];
        $entrega = $result['titulo'];

        //$slugTurma = $result['slugTurma'];
        //$link = HOME . 'turmas/turma/' . $slugTurma;
        //$mensagem = "<a href='$link'>Projeto <b>$projetoTitulo</b>  realizou a entrega <b>$entrega</b></a>";

        $mensagem = "Projeto <b>$projetoTitulo</b> realizou a entrega <b>$entrega</b>";
        $sql1 = $this->db->prepare("INSERT INTO notificacao SET tipo = ?, mensagem = ?, fkDestinatario = ?, tipoDestinatario = 'Orientador'");
        $sql1->execute(array($this->getTipo(), $mensagem, $idOrientador));
    }

    public function dataEntrega($data, $idEntrega)
    {
        $sql1 = $this->db->prepare("SELECT p.idProjeto, e.titulo as tituloEntrega, p.titulo as tituloProjeto FROM entrega e INNER JOIN projeto p ON(e.fkTurma = p.fkTurma) WHERE idEntrega = ?");
        $sql1->execute(array($idEntrega));
        $idsProjetos = $sql1->fetchAll();

        // Envia a notifacao para todos os alunos de todos projetos participantes da turma
        foreach ($idsProjetos as $idProjeto) :
            $mensagem = "A data da entrega <b>" . $idProjeto['tituloEntrega'] . "</b> do projeto <b>" . $idProjeto['tituloProjeto'] . "</b> foi alterada para <b>" . date("d/m/Y", strtotime($data)) . "</b>";
            $sql2 = $this->db->prepare("SELECT * FROM projeto_tem_aluno WHERE fkProjeto = ?");
            $sql2->execute(array($idProjeto['idProjeto']));
            $ids = $sql2->fetchAll();
            foreach ($ids as $id) :
                $sql = $this->db->prepare("INSERT INTO notificacao SET tipo = ?, mensagem = ?, fkDestinatario = ?, tipoDestinatario = 'Aluno'");
                $sql->execute(array($this->getTipo(), $mensagem, $id['fkAluno']));
            endforeach;
        endforeach;
    }

    public function apagarEntrega($idEntrega)
    {
        $sql1 = $this->db->prepare("SELECT p.idProjeto, e.titulo as tituloEntrega, p.titulo as tituloProjeto FROM entrega e INNER JOIN projeto p ON(e.fkTurma = p.fkTurma) WHERE idEntrega = ?");
        $sql1->execute(array($idEntrega));
        $idsProjetos = $sql1->fetchAll();

        // Envia a notifacao para todos os alunos de todos projetos participantes da turma
        foreach ($idsProjetos as $idProjeto) :
            $mensagem = "A entrega <b>" . $idProjeto['tituloEntrega'] . "</b> do projeto <b>" . $idProjeto['tituloProjeto'] . "</b> foi apagada";
            $sql2 = $this->db->prepare("SELECT * FROM projeto_tem_aluno WHERE fkProjeto = ?");
            $sql2->execute(array($idProjeto['idProjeto']));
            $ids = $sql2->fetchAll();
            foreach ($ids as $id) :
                $sql = $this->db->prepare("INSERT INTO notificacao SET tipo = ?, mensagem = ?, fkDestinatario = ?, tipoDestinatario = 'Aluno'");
                $sql->execute(array($this->getTipo(), $mensagem, $id['fkAluno']));
            endforeach;
        endforeach;
    }

    public function entregaAvaliada($idProjetoEntrega, $nota)
    {
        $sql = $this->db->prepare("SELECT idProjeto, p.titulo as tituloProjeto, e.titulo as tituloEntrega FROM projeto_tem_entrega pe INNER JOIN entrega e ON (pe.fkEntrega = e.idEntrega) INNER JOIN projeto p ON (pe.fkProjeto = p.idProjeto) WHERE idProjetoEntrega = ?");
        $sql->execute(array($idProjetoEntrega));
        $result = $sql->fetch();

        $mensagem = "A entrega <b>{$result['tituloEntrega']}</b> do projeto <b>{$result['tituloProjeto']}</b> recebeu a nota <b>$nota</b>";

        // Envia a notifacao para todos os alunos do projeto
        $sql2 = $this->db->prepare("SELECT * FROM projeto_tem_aluno WHERE fkProjeto = ?");
        $sql2->execute(array($result['idProjeto']));
        $ids = $sql2->fetchAll();
        foreach ($ids as $id) :
            $sql = $this->db->prepare("INSERT INTO notificacao SET tipo = ?, mensagem = ?, fkDestinatario = ?, tipoDestinatario = 'Aluno'");
            $sql->execute(array($this->getTipo(), $mensagem, $id['fkAluno']));
        endforeach;
    }

    public function getNoficacoes($idUsuario)
    {
        $sql = $this->db->prepare("SELECT *, TIMESTAMPDIFF(MINUTE,data_enviada,NOW()) as tempo FROM notificacao WHERE tipoDestinatario = ? AND fkDestinatario = ? ORDER BY idNotificacao DESC");
        $sql->execute(array($this->getTipo(), $idUsuario));
        $results = $sql->fetchAll();
        foreach ($results as $key => $result) :
            if ($result['tempo'] > 59 && $result['tempo'] < 1440) :
                $results[$key]['tempo'] = floor($result['tempo'] /= 60) . " h";
            elseif ($result['tempo'] > 1439) :
                $results[$key]['tempo'] = floor($result['tempo'] /= 1440) . " d";
            else :
                $results[$key]['tempo'] = $result['tempo'] . " min";
            endif;
        endforeach;
        return $results;
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

    public function apagar($idNotificacao)
    {
        $sql = $this->db->prepare("DELETE FROM notificacao WHERE idNotificacao = ?");
        $sql->execute(array($idNotificacao));
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
