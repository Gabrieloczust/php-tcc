<?php

class Projeto extends Model
{
	private $id;
	private $titulo;
	private $alunos;
	private $orientador;
	private $avaliadores;

	public function setAll($id)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto WHERE idProjeto = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
		$projeto = $sql->fetch();
		$this->setId($id);
		$this->setTitulo($projeto['titulo']);
	}

	public function novoProjeto($titulo, $ra, $orientador)
	{
		$hashInterno = $this->geraHash($titulo);

		//Cria o projeto na tabela projeto
		$sql = $this->db->prepare("INSERT INTO projeto SET titulo = :titulo, fkAlunoLider = :lider, hashInterno = :hashInterno");
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":lider", $ra);
		$sql->bindValue(":hashInterno", $hashInterno);
		$sql->execute();

		//Pega o ID do projeto criado
		$sql2 = $this->db->prepare("SELECT idProjeto FROM `projeto` WHERE fkAlunoLider = {$ra} ORDER BY idProjeto DESC LIMIT 1");
		$sql2->execute();
		$this->setId($sql2->fetch()['idProjeto']);

		//Assosia o Projeto ao Aluno que criou como Lider do Projeto
		$sql3 = $this->db->prepare("INSERT INTO projeto_tem_aluno SET fkAluno = :ra, fkProjeto = :idProjeto, tipoAluno = 'Lider'");
		$sql3->bindValue(":ra", $ra);
		$sql3->bindValue(":idProjeto", $this->getId());
		$sql3->execute();

		// Convida o Orientador
		$convite = new Convite();
		$convite->convidaOrientador($orientador, $this->getId(), $ra);
	}

	public function editaTitulo($titulo, $hash, $ra)
	{
		if ($this->existeEsseTitulo($titulo, $ra) == 0) {
			$sql = $this->db->prepare("UPDATE projeto SET titulo = :titulo WHERE hashInterno = :hashInterno");
			$sql->bindValue(":titulo", $titulo);
			$sql->bindValue(":hashInterno", $hash);
			$sql->execute();
			return true;
		}
		return false;
	}

	public function sairProjeto($idProjeto, $ra)
	{
		// Remove o aluno do projeto
		$sql = $this->db->prepare("DELETE FROM projeto_tem_aluno WHERE fkProjeto = :idProjeto && fkAluno = :ra");
		$sql->bindValue(":ra", $ra);
		$sql->bindValue(":idProjeto", $idProjeto);
		$sql->execute();

		//Verifica quantas pessoas tem no projeto
		$sql2 = $this->db->prepare("SELECT * FROM projeto_tem_aluno WHERE fkProjeto = :idProjeto");
		$sql2->bindValue(":idProjeto", $idProjeto);
		$sql2->execute();

		// Se não houver usuario no projeto remove o projeto e se houver convites deleta
		if ($sql2->rowCount() == 0) {
			$sql4 = $this->db->prepare("DELETE FROM convite WHERE fkProjeto = :idProjeto");
			$sql4->bindValue(":idProjeto", $idProjeto);
			$sql4->execute();

			$sql3 = $this->db->prepare("DELETE FROM projeto WHERE idProjeto = :idProjeto");
			$sql3->bindValue(":idProjeto", $idProjeto);
			$sql3->execute();
		}

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function getProjetos($ra)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto_tem_aluno INNER JOIN projeto ON(fkProjeto = idProjeto) WHERE fkAluno = $ra ORDER BY idAlunoProjeto DESC");
		$sql->execute();
		$projetos = $sql->fetchAll();
		return $projetos;
	}

	public function qtdProjetos($ra)
	{
		$sql = $this->db->prepare("SELECT count(fkAluno) as qtd FROM projeto_tem_aluno WHERE fkAluno = $ra");
		$sql->execute();
		$qtd = $sql->fetch()['qtd'];
		return $qtd;
	}

	public function existeEsseTitulo($titulo, $ra)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto INNER JOIN projeto_tem_aluno ON(idProjeto = fkProjeto) WHERE titulo = '{$titulo}' && fkAlunoLider = $ra");
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getIdForHash($hash)
	{
		$sql = $this->db->prepare("SELECT idProjeto FROM projeto WHERE hashInterno = :hashInterno");
		$sql->bindValue(":hashInterno", $hash);
		$sql->execute();
		return $sql->fetch()['idProjeto'];
	}

	private function geraHash($titulo)
	{
		return password_hash($titulo, PASSWORD_BCRYPT);
	}

	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getTitulo()
	{
		return $this->titulo;
	}
	public function setTitulo($t)
	{
		$this->titulo = $t;
	}
	public function getAlunos()
	{
		return $this->alunos;
	}
	public function setAlunos($a)
	{
		$this->alunos = $a;
	}
	public function getOrientador()
	{
		return $this->orientador;
	}
	public function setOrientador($o)
	{
		$this->orientador = $o;
	}
	public function getAvaliadores()
	{
		return $this->avaliadores;
	}
	public function setAvaliadores($a)
	{
		$this->avaliadores = $a;
	}
}
