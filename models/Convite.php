<?php

class Convite extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function convidaOrientador($email, $idProjeto, $idRemetente)
	{
		$orientador = new Orientador($email);
		$hashConvite = $this->geraHash($idProjeto);
		if (!empty($orientador->getId())) {
			$sql = $this->db->prepare("INSERT INTO convite SET tipo = 'Orientador', hashConvite = :hashConvite, fkProjeto = :idProjeto, fkUsuario = :idOrientador, fkRemetente = :idRemetente");
			$sql->bindValue(":hashConvite", $hashConvite);
			$sql->bindValue(":idOrientador", $orientador->getId());
			$sql->bindValue(":idProjeto", $idProjeto);
			$sql->bindValue(":idRemetente", $idRemetente);
			$sql->execute();
			return true;
		} else {
			return false;
		}
	}

	public function convidaAluno($email, $hashProjeto, $idRemetente)
	{
		// PEGA O ID DO ALUNO
		$aluno = new Aluno($email);
		$idAluno = $aluno->getId();

		// PEGA O ID DO PROJETO
		$projeto = new Projeto();
		$idProjeto = $projeto->getIdForHash($hashProjeto);

		// GERA HASH
		$hashConvite = $this->geraHash($idProjeto);

		if (($this->possuiConvite($idProjeto, $idAluno, 'Aluno') == false) && ($this->alunoEstaNoGrupo($idProjeto, $idAluno) == false)) {
			$sql = $this->db->prepare("INSERT INTO convite SET tipo = 'Aluno', hashConvite = :hashConvite, fkProjeto = :idProjeto, fkUsuario = :idAluno, fkRemetente = :idRemetente");
			$sql->bindValue(":hashConvite", $hashConvite);
			$sql->bindValue(":idProjeto", $idProjeto);
			$sql->bindValue(":idAluno", $idAluno);
			$sql->bindValue("idRemetente", $idRemetente);
			$sql->execute();
			return true;
		} else {
			return false;
		}
	}

	public function aceitarConviteOrientador($id, $hash, $idTurma, $emailProfessor)
	{

		// Muda Status de Solicitado para Aceito
		$this->mudaStatus($id, $hash, "Aceito");

		// Pega o id do Projeto e Destinatario
		$convite = $this->getConvite($hash, $id, "Aceito");
		$idProjeto = $convite['fkProjeto'];
		$idDestinatario = $convite['fkRemetente'];

		// Adiciona o orientador no projeto
		$orientador = new Orientador($emailProfessor);
		$orientador->adicionaOrientador($idProjeto);

		// Adiciona Projeto na turma
		$projeto = new Projeto();
		$projeto->adicionaProjetoNaTurma($idProjeto, $idTurma);

		// Envia Notificação de convite aceito
		$notificacao = new Notificacao("aceito");
		$notificacao->notificacaoConvite($id, "Orientador", $idDestinatario, $emailProfessor, $idProjeto);

		// Exclui o Convite Aceito
		$this->excluiConvite($id, $hash, "Aceito");
	}

	public function aceitarConvite($id, $hash, $emailAluno)
	{
		// Muda Status de Solicitado para Aceito
		$this->mudaStatus($id, $hash, "Aceito");

		// Pega o id do Projeto
		$convite = $this->getConvite($hash, $id, "Aceito");
		$idProjeto = $convite['fkProjeto'];
		$idDestinatario = $convite['fkRemetente'];

		// Adiciona o aluno no projeto
		$aluno = new Aluno($emailAluno);
		$aluno->adicionaIntegrante($idProjeto);

		// Envia Notificação de convite aceito
		$notificacao = new Notificacao("aceito");
		$notificacao->notificacaoConvite($id, "Aluno", $idDestinatario, $emailAluno, $idProjeto);

		// Exclui o Convite Aceito
		$this->excluiConvite($id, $hash, "Aceito");
	}

	public function aceitarTodosConvites($id, $emailAluno)
	{
		// Muda status de todos convites de Solicitado para Aceito
		$this->mudaTodosStatus($id, "Aceito");

		// Pega o id dos Projetos
		$sql1 = $this->db->prepare("SELECT * FROM convite c WHERE fkUsuario = :idUsuario && c.status = 'Aceito'");
		$sql1->bindValue(":idUsuario", $id);
		$sql1->execute();
		$ids = $sql1->fetchAll();

		// Adiciona o aluno nos projetos
		foreach ($ids as $i) {
			$sql2 = $this->db->prepare("INSERT INTO projeto_tem_aluno SET tipoAluno = 'Integrante', fkProjeto = :idProjeto, fkAluno = :idAluno");
			$sql2->bindValue(":idProjeto", $i['fkProjeto']);
			$sql2->bindValue(":idAluno", $i['fkUsuario']);
			$sql2->execute();

			// Envia Notificação de convite aceito
			$notificacao = new Notificacao("aceito");
			$notificacao->notificacaoConvite($id, "Aluno", $i['fkRemetente'], $emailAluno, $i['fkProjeto']);
		}

		// Exclui Todos Convites Aceitos
		$this->excluiTodosConvites($id, "Aceito");
	}

	public function recusarConvite($id, $hash, $emailUsuario)
	{
		// Muda Status de Solicitado para Recusado
		$this->mudaStatus($id, $hash, "Recusado");

		// Pega o id do Projeto
		$convite = $this->getConvite($hash, $id, "Recusado");
		$idProjeto = $convite['fkProjeto'];
		$idDestinatario = $convite['fkRemetente'];
		$tipo = $convite['tipo'];

		// Envia Notificação de convite recusado
		$notificacao = new Notificacao("recusado");
		$notificacao->notificacaoConvite($id, $tipo, $idDestinatario, $emailUsuario, $idProjeto);

		// Excluir o convite recusado
		$this->excluiConvite($id, $hash, "Recusado");
	}

	public function recusarTodosConvites($id, $emailUsuario)
	{
		// Muda Status de todos convites de Solicitado para Recusado
		$this->mudaTodosStatus($id, "Recusado");

		// Pega o id dos Projetos
		$sql1 = $this->db->prepare("SELECT * FROM convite c WHERE fkUsuario = :idUsuario && c.status = 'Recusado'");
		$sql1->bindValue(":idUsuario", $id);
		$sql1->execute();
		$ids = $sql1->fetchAll();

		// Envia as Notificação de convite recusado
		foreach ($ids as $i) {
			$notificacao = new Notificacao("recusado");
			$notificacao->notificacaoConvite($id, $i['tipo'], $i['fkRemetente'], $emailUsuario, $i['fkProjeto']);
		}

		// Excluir todos convites recusados
		$this->excluiTodosConvites($id, "Recusado");
	}

	public function getConvites($idUsuario, $tipo)
	{
		$sql = "SELECT * FROM convite c INNER JOIN aluno a ON(fkRemetente = ra) INNER JOIN projeto p ON(fkProjeto = idProjeto) WHERE c.status = 'Solicitado' && fkUsuario = :idUsuario";
		if ($tipo == 'aluno') {
			$sql .= " && tipo = 'aluno'";
		} else {
			$sql .= " && tipo != 'aluno'";
		}
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':idUsuario', $idUsuario);
		$sql->execute();
		return $sql->fetchAll();
	}

	private function getConvite($hashConvite, $idUsuario, $status)
	{
		$sql = $this->db->prepare("SELECT * FROM convite c WHERE hashConvite = ? && fkUsuario = ? && c.status = ?");
		$sql->execute(array($hashConvite, $idUsuario, $status));
		$convite = $sql->fetch();
		return $convite;
	}

	private function excluiConvite($idUsuario, $hashConvite, $status)
	{
		$sql = $this->db->prepare("DELETE FROM convite WHERE fkUsuario = ? && hashConvite = ? && status = ?");
		$sql->execute(array($idUsuario, $hashConvite, $status));
	}

	private function excluiTodosConvites($idUsuario, $status)
	{
		$sql = $this->db->prepare("DELETE FROM convite WHERE fkUsuario = ? && status = ?");
		$sql->execute(array($idUsuario, $status));
	}

	private function mudaStatus($idUsuario, $hashConvite, $status)
	{
		$sql = $this->db->prepare("UPDATE convite c SET c.status = ? WHERE hashConvite = ? && fkUsuario = ?");
		$sql->execute(array($status, $hashConvite, $idUsuario));
	}

	private function mudaTodosStatus($idUsuario, $status)
	{
		$sql = $this->db->prepare("UPDATE convite c SET c.status = ? WHERE c.status = 'Solicitado' && fkUsuario = ?");
		$sql->execute(array($status, $idUsuario));
	}

	private function possuiConvite($idProjeto, $idUsuario, $tipo)
	{
		$sql = $this->db->prepare("SELECT * FROM convite WHERE fkProjeto = :idProjeto && fkUsuario = :idUsuario && tipo = :tipo");
		$sql->bindValue(":idProjeto", $idProjeto);
		$sql->bindValue(":idUsuario", $idUsuario);
		$sql->bindValue(":tipo", $tipo);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	private function alunoEstaNoGrupo($idProjeto, $idAluno)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto_tem_aluno WHERE fkProjeto = :idProjeto && fkAluno = :idAluno");
		$sql->bindValue(":idProjeto", $idProjeto);
		$sql->bindValue(":idAluno", $idAluno);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	private function geraHash($id)
	{
		return sha1($id);
	}
}
