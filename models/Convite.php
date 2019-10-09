<?php

class Convite extends Model
{
	private $id;
	private $tipo;
	private $status;
	private $idProjeto;

	public function convidaOrientador($email, $idProjeto)
	{
		$usuario = new Orientador($email);
		if (!empty($usuario->getId())) {
			if ($this->orientadorEstaProjeto($idProjeto, $usuario->getId())) {
				return true;
			}
		} else {
			return false;
		}
	}

	private function orientadorEstaProjeto($idProjeto, $idOrientador)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto_tem_professor WHERE tipoProfessor = 'Orientador' && fkProjeto = :idProjeto && fkProfessor = :idOrientador");
		$sql->execute(array($idProjeto, $idOrientador));
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
