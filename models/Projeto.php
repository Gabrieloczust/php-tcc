<?php

class Projeto extends Model
{
	private $id;
	private $titulo;
	private $alunos;
	private $orientador;

	public function novoProjeto($titulo, $ra)
	{
		//Verifica se já existe um projeto deste usuario com o mesmo nome
		if (($this->existeEsseTitulo($titulo, $ra)) == false) {

			//Cria o projeto na tabela projeto
			$sql = $this->db->prepare("INSERT INTO projeto SET titulo = :titulo, fkAlunoLider = :lider");
			$sql->bindValue(":titulo", $titulo);
			$sql->bindValue(":lider", $ra);
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

			//Envia convite para o Professor Orientador

			return true;
		} else {
			return false;
		}
	}

	public function getProjetos($ra)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto_tem_aluno INNER JOIN projeto ON(fkProjeto = idProjeto) WHERE fkAluno = $ra");
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

	private function existeEsseTitulo($titulo, $ra)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto WHERE titulo = '{$titulo}' && fkAlunoLider = $ra");
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
}
