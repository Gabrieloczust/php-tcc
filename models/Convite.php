<?php

class Convite extends Model
{
	private $id;
	private $tipo;
	private $status;
	private $idProjeto;

	public function convidaOrientador($email, $idProjeto)
	{
		$orientador = new Orientador($email);
		if (!empty($orientador->getId())) {
			$sql = $this->db->prepare("INSERT INTO convite SET tipo = 'Orientador', fkProjeto = :idProjeto, fkUsuario = :idOrientador");
			$sql->bindValue(":idOrientador", $orientador->getId());
			$sql->bindValue(":idProjeto", $idProjeto);
			$sql->execute();
			return true;
		} else {
			return false;
		}
	}

	public function convidaAluno($email, $hashProjeto)
	{
		// PEGA O ID DO ALUNO
		$aluno = new Aluno($email);
		$idAluno = $aluno->getId();
		// PEGA O ID DO PROJETO
		$projeto = new Projeto();
		$idProjeto = $projeto->getIdForHash($hashProjeto);

		if ($this->possuiConvite($idProjeto, $idAluno) == false) {
			$sql = $this->db->prepare("INSERT INTO convite SET tipo = 'Aluno', fkProjeto = :idProjeto, fkUsuario = :idAluno");
			$sql->bindValue(":idProjeto", $idProjeto);
			$sql->bindValue(":idAluno", $idAluno);
			$sql->execute();
			if ($this->alunoEstaNoGrupo($idProjeto, $idAluno) == false) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
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
		$sql = $this->db->prepare("SELECT * FROM projeto_tem_aluno WHERE fkProjeto = :idProjeto && fkUsuario = :idAluno");
		$sql->bindValue(":idProjeto", $idProjeto);
		$sql->bindValue(":idAluno", $idAluno);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
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
