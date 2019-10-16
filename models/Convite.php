<?php

class Convite extends Model
{
	private $id;
	private $tipo;
	private $status;
	private $idProjeto;

	public function convidaOrientador($email, $idProjeto, $idRemetente)
	{
		$orientador = new Orientador($email);
		// GERA HASH
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

		if (($this->possuiConvite($idProjeto, $idAluno) == false) && ($this->alunoEstaNoGrupo($idProjeto, $idAluno) == false)) {
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

	public function aceitarConvite($id, $hash)
	{
		// Muda status de Solicitado para Aceito
		$sql = $this->db->prepare("UPDATE convite c SET c.status = 'Aceito' WHERE hashConvite = :hashConvite && fkUsuario = :idUsuario");
		$sql->bindValue(":hashConvite", $hash);
		$sql->bindValue(":idUsuario", $id);
		$sql->execute();

		// Pega o id do Projeto e do Convite
		$sql1 = $this->db->prepare("SELECT * FROM convite c WHERE hashConvite = :hashConvite && fkUsuario = :idUsuario && c.status = 'Aceito'");
		$sql1->bindValue(":hashConvite", $hash);
		$sql1->bindValue(":idUsuario", $id);
		$sql1->execute();
		$ids = $sql1->fetch();
		$idProjeto = $ids['fkProjeto'];
		$idConvite = $ids['idConvite'];

		// Adiciona o usuario no projeto
		$sql2 = $this->db->prepare("INSERT INTO projeto_tem_aluno SET tipoAluno = 'Integrante', fkProjeto = :idProjeto, fkAluno = :idAluno");
		$sql2->bindValue(":idProjeto", $idProjeto);
		$sql2->bindValue(":idAluno", $id);
		$sql2->execute();

		// Enviar Notificação de Convite Aceito antes de Excluir

		// Exclui Convite
		$sql3 = $this->db->prepare("DELETE FROM convite WHERE idConvite = :idConvite");
		$sql3->bindValue(":idConvite", $idConvite);
		$sql3->execute();
	}

	public function aceitarTodosConvites($id)
	{
		// Muda status de Solicitado para Aceito
		$sql = $this->db->prepare("UPDATE convite c SET c.status = 'Aceito' WHERE c.status = 'Solicitado' && fkUsuario = :idUsuario");
		$sql->bindValue(":idUsuario", $id);
		$sql->execute();

		// Pega o id do Projeto e do Convite
		$sql1 = $this->db->prepare("SELECT * FROM convite c WHERE fkUsuario = :idUsuario && c.status = 'Aceito'");
		$sql1->bindValue(":idUsuario", $id);
		$sql1->execute();
		$ids = $sql1->fetchAll();
		
		// Adiciona o usuario no projeto
		foreach ($ids as $i) {
			$sql2 = $this->db->prepare("INSERT INTO projeto_tem_aluno SET tipoAluno = 'Integrante', fkProjeto = :idProjeto, fkAluno = :idAluno");
			$sql2->bindValue(":idProjeto", $i['fkProjeto']);
			$sql2->bindValue(":idAluno", $i['fkUsuario']);
			$sql2->execute();
		}

		// Enviar Notificação de Convite Aceito antes de Excluir

		// Exclui Convite
		$sql3 = $this->db->prepare("DELETE FROM convite WHERE status = 'Aceito' && fkUsuario = :idUsuario");
		$sql3->bindValue(":idUsuario", $id);
		$sql3->execute();
	}

	public function recusarConvite($id, $hash)
	{
		// Muda status de Solicitado para Recusado
		$sql = $this->db->prepare("UPDATE convite c SET c.status = 'Recusado' WHERE hashConvite = :hashConvite && fkUsuario = :idUsuario");
		$sql->bindValue(":hashConvite", $hash);
		$sql->bindValue(":idUsuario", $id);
		$sql->execute();

		// Enviar Notificação de Convite Recusado antes de Excluir

		// Exclui Convite
		$sql3 = $this->db->prepare("DELETE FROM convite WHERE hashConvite = :hashConvite && fkUsuario = :idUsuario && status = 'Recusado'");
		$sql3->bindValue(":hashConvite", $hash);
		$sql3->bindValue(":idUsuario", $id);
		$sql3->execute();
	}

	public function recusarTodosConvites($id)
	{
		// Muda status de Solicitado para Recusado
		$sql = $this->db->prepare("UPDATE convite c SET c.status = 'Recusado' WHERE c.status = 'Solicitado' && fkUsuario = :idUsuario");
		$sql->bindValue(":idUsuario", $id);
		$sql->execute();

		// Enviar Notificação de Convite Recusado antes de Excluir

		// Exclui Convite
		$sql3 = $this->db->prepare("DELETE FROM convite WHERE fkUsuario = :idUsuario && status = 'Recusado'");
		$sql3->bindValue(":idUsuario", $id);
		$sql3->execute();
	}

	private function possuiConvite($idProjeto, $idUsuario)
	{
		$sql = $this->db->prepare("SELECT * FROM convite WHERE fkProjeto = :idProjeto && fkUsuario = :idUsuario");
		$sql->bindValue(":idProjeto", $idProjeto);
		$sql->bindValue(":idUsuario", $idUsuario);
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

	public function getId()
	{
		return $this->id;
	}

	public function getTipo()
	{
		return $this->tipo;
	}

	public function setTipo($t)
	{
		$this->tipo = $t;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($s)
	{
		$this->status = $s;
	}

	public function getIdProjeto()
	{
		return $this->idProjeto;
	}
}
