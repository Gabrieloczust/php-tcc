-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Out-2019 às 01:58
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `ra` int(11) NOT NULL COMMENT 'Registro do Aluno',
  `nome` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `curso` varchar(128) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `ip_cadastro` varchar(45) DEFAULT NULL,
  `ip_ultimo_acesso` varchar(45) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_ultimo_acesso` timestamp NULL DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `data` date NOT NULL,
  `ator` varchar(128) NOT NULL,
  `mensagem` text NOT NULL,
  `Documento_idDocumento` int(11) NOT NULL,
  `Documento_Projeto_idProjeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convite`
--

CREATE TABLE `convite` (
  `idConvite` int(11) NOT NULL,
  `tipo` enum('Aluno','Orientador','Avaliador') NOT NULL,
  `status` enum('Aceito','Recusado','Solicitado') DEFAULT 'Solicitado',
  `fkProjeto` int(11) NOT NULL,
  `fkUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `nota` decimal(2,2) NOT NULL DEFAULT 0.00,
  `data_upload` date NOT NULL,
  `formato` varchar(8) NOT NULL,
  `monografia` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = false\n1 = true\ndocumento final para avaliacao do Professor Avaliador e exposição na Biblioteca',
  `fkProjeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `rp` int(11) NOT NULL COMMENT 'Registro do Professor',
  `nome` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `escola` varchar(128) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `ip_cadastro` varchar(45) DEFAULT NULL,
  `ip_ultimo_acesso` varchar(45) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_ultimo_acesso` timestamp NULL DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `idProjeto` int(11) NOT NULL,
  `hashInterno` varchar(255) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `notaProjeto` decimal(2,2) NOT NULL DEFAULT 0.00,
  `notaRecuperacao` decimal(2,2) NOT NULL,
  `fkAlunoLider` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_tem_aluno`
--

CREATE TABLE `projeto_tem_aluno` (
  `idAlunoProjeto` int(11) NOT NULL,
  `tipoAluno` enum('Lider','Integrante') NOT NULL DEFAULT 'Integrante',
  `fkProjeto` int(11) NOT NULL,
  `fkAluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_tem_professor`
--

CREATE TABLE `projeto_tem_professor` (
  `idProfProjeto` int(11) NOT NULL,
  `tipoProfessor` enum('Orientador','Avaliador') NOT NULL,
  `fkProjeto` int(11) NOT NULL,
  `fkProfessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`ra`),
  ADD UNIQUE KEY `ra_UNIQUE` (`ra`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`,`Documento_idDocumento`,`Documento_Projeto_idProjeto`),
  ADD KEY `fk_Comentario_Documento1_idx` (`Documento_idDocumento`,`Documento_Projeto_idProjeto`);

--
-- Índices para tabela `convite`
--
ALTER TABLE `convite`
  ADD PRIMARY KEY (`idConvite`);

--
-- Índices para tabela `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`,`fkProjeto`),
  ADD KEY `fk_Documento_Projeto1_idx` (`fkProjeto`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`rp`),
  ADD UNIQUE KEY `rp` (`rp`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`idProjeto`);

--
-- Índices para tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  ADD PRIMARY KEY (`idAlunoProjeto`,`fkAluno`,`fkProjeto`),
  ADD KEY `fk_Aluno_has_Projeto_Projeto1_idx` (`fkProjeto`),
  ADD KEY `fk_Aluno_has_Projeto_Aluno_idx` (`fkAluno`);

--
-- Índices para tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  ADD PRIMARY KEY (`idProfProjeto`,`fkProjeto`,`fkProfessor`),
  ADD KEY `fk_Projeto_has_Professor_Professor1_idx` (`fkProfessor`),
  ADD KEY `fk_Projeto_has_Professor_Projeto1_idx` (`fkProjeto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `ra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Aluno', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `convite`
--
ALTER TABLE `convite`
  MODIFY `idConvite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `rp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Professor', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `idProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  MODIFY `idAlunoProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  MODIFY `idProfProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_Comentario_Documento1` FOREIGN KEY (`Documento_idDocumento`,`Documento_Projeto_idProjeto`) REFERENCES `documento` (`idDocumento`, `fkProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_Documento_Projeto1` FOREIGN KEY (`fkProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  ADD CONSTRAINT `fk_Aluno_has_Projeto_Aluno` FOREIGN KEY (`fkAluno`) REFERENCES `aluno` (`ra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Aluno_has_Projeto_Projeto1` FOREIGN KEY (`fkProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  ADD CONSTRAINT `fk_Projeto_has_Professor_Professor1` FOREIGN KEY (`fkProfessor`) REFERENCES `professor` (`rp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Projeto_has_Professor_Projeto1` FOREIGN KEY (`fkProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
