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
