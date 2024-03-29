<?php

class Projeto extends Model
{
	private $id;
	private $titulo;
	private $slug;
	private $lider;
	private $turma;
	private $orientador;

	public function setAll($id)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto LEFT JOIN projeto_tem_professor ON(idProjeto = fkProjeto) WHERE idProjeto = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
		$projeto = $sql->fetch();
		$this->setId($id);
		$this->setTitulo($projeto['titulo']);
		$this->setSlug($projeto['slug']);
		$this->setTurma($projeto['fkTurma']);
		$this->setOrientador($projeto['fkProfessor']);
	}

	public function novoProjeto($titulo, $ra, $orientador)
	{
		$hashInterno = $this->geraHash($titulo);
		$slug = $this->slug($titulo);

		//Cria o projeto na tabela projeto
		$sql = $this->db->prepare("INSERT INTO projeto SET titulo = :titulo, slug = :slug, fkAlunoLider = :lider, hashInterno = :hashInterno");
		$sql->bindValue(":titulo", mb_strtoupper($titulo));
		$sql->bindValue(":slug", $slug);
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
			$slug = $this->slug($titulo);
			$sql = $this->db->prepare("UPDATE projeto SET titulo = :titulo, slug = :slug WHERE hashInterno = :hashInterno");
			$sql->bindValue(":titulo", mb_strtoupper($titulo));
			$sql->bindValue(":slug", $slug);
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
			// Notificacao ao orientador do projeto
			$notificacao = new Notificacao("recusado");
			$notificacao->projetoApagado($idProjeto, $ra);

			$sql3 = $this->db->prepare("DELETE FROM projeto WHERE idProjeto = :idProjeto");
			$sql3->bindValue(":idProjeto", $idProjeto);
			$sql3->execute();
		} else {
			// Notificacao aos alunos do projeto
			$notificacao = new Notificacao("recusado");
			$notificacao->alunoSaiu($idProjeto, $ra);
		}

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getProjeto($ra, $slug)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto p LEFT JOIN projeto_tem_aluno a ON(p.idProjeto = a.FkProjeto) LEFT JOIN projeto_tem_professor pp ON(p.IdProjeto = pp.fkProjeto) LEFT join professor pf ON(pp.fkProfessor = pf.rp) WHERE fkAluno = ? AND slug = ?");
		$sql->execute(array($ra, $slug));

		$result = $sql->fetch();
		if (!empty($result)) {
			$this->setAll($result['idProjeto']);
			$projeto = [];

			// Adiciona o nome dos alunos participantes
			$participantes = $this->getNomeParticipantes($result['idProjeto']);
			$array = array_merge($participantes, $result);
			array_push($projeto, $array);

			return $projeto;
		} else {
			return [];
		}
	}

	public function getProjetos($ra)
	{
		$sql = $this->db->prepare("SELECT * FROM projeto_tem_aluno INNER JOIN projeto ON(fkProjeto = idProjeto) INNER JOIN aluno ON(fkAlunoLider = ra) WHERE fkAluno = $ra ORDER BY idAlunoProjeto DESC");
		$sql->execute();
		$results = $sql->fetchAll();
		$projetos = [];

		// Adiciona o nome dos alunos participantes
		foreach ($results as $result) {
			$participantes = $this->getNomeParticipantes($result['idProjeto']);
			$array = array_merge($participantes, $result);
			// Verifica se possui orientador
			$sql1 = $this->db->prepare("SELECT fkProjeto FROM projeto_tem_professor WHERE fkProjeto = ? UNION SELECT fkProjeto FROM convite WHERE fkProjeto = ?");
			$sql1->execute(array($result['idProjeto'], $result['idProjeto']));
			if ($sql1->rowCount() > 0) {
				$possui['temOrientador'] = true;
			} else {
				$possui['temOrientador'] = false;
			}
			$array = array_merge($possui, $array);
			array_push($projetos, $array);
		}
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

	private function getNomeParticipantes($idProjeto)
	{
		$sql = $this->db->prepare("SELECT GROUP_CONCAT(SUBSTRING_INDEX(SUBSTRING_INDEX(nome, ' ', 1), ' ', -1) SEPARATOR ' - ') as alunosParticipantes FROM `projeto_tem_aluno` INNER JOIN aluno ON(ra = fkAluno) WHERE fkProjeto = ?");
		$sql->execute(array($idProjeto));
		$array = $sql->fetch();
		return array_unique($array, SORT_STRING);
	}

	public function getIdForHash($hash)
	{
		$sql = $this->db->prepare("SELECT idProjeto FROM projeto WHERE hashInterno = :hashInterno");
		$sql->bindValue(":hashInterno", $hash);
		$sql->execute();
		return $sql->fetch()['idProjeto'];
	}

	public function adicionaProjetoNaTurma($idProjeto, $turma)
	{
		$sql4 = $this->db->prepare("UPDATE projeto SET fkTurma = ? WHERE idProjeto = ?");
		$sql4->execute(array($turma, $idProjeto));
	}

	public function getNota()
	{
		$sql = $this->db->prepare("SELECT AVG(nota) as media FROM projeto_tem_entrega WHERE fkProjeto = ?");
		$sql->execute(array($this->getId()));
		return round($sql->fetch()['media'], 2);
	}

	private function slug($string)
	{
		$str = strtolower(utf8_decode($string));
		$i = 1;
		$str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûüýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuuyyy');
		$str = preg_replace("/([^a-z0-9])/", '-', utf8_encode($str));
		while ($i > 0) $str = str_replace('--', '-', $str, $i);
		if (substr($str, -1) == '-') $str = substr($str, 0, -1);
		return $str;
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
	public function getSlug()
	{
		return $this->slug;
	}
	public function setSlug($s)
	{
		$this->slug = $s;
	}
	public function getLider()
	{
		return $this->lider;
	}
	public function setLider($l)
	{
		$this->lider = $l;
	}
	public function getTurma()
	{
		return $this->turma;
	}
	public function setTurma($t)
	{
		$this->turma = $t;
	}
	public function getOrientador()
	{
		return $this->orientador;
	}
	public function setOrientador($o)
	{
		$this->orientador = $o;
	}
}
