-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Out-2019 às 20:28
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
  `token` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convite`
--

CREATE TABLE `convite` (
  `idConvite` int(11) NOT NULL,
  `tipo` enum('Aluno','Orientador','Avaliador') NOT NULL,
  `status` enum('Aceito','Recusado','Solicitado') DEFAULT 'Solicitado',
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `hashConvite` varchar(255) NOT NULL,
  `fkProjeto` int(11) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `fkRemetente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `idNotificacao` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `tipo` enum('Sucesso','Aviso','Fracasso') NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `fkAluno` int(11) DEFAULT NULL,
  `fkProfessor` int(11) DEFAULT NULL
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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`);

--
-- Índices para tabela `convite`
--
ALTER TABLE `convite`
  ADD PRIMARY KEY (`idConvite`),
  ADD UNIQUE KEY `idConvite_UNIQUE` (`idConvite`),
  ADD KEY `fkProjeto_idx` (`fkProjeto`);

--
-- Índices para tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`idNotificacao`),
  ADD KEY `fkAluno` (`fkAluno`),
  ADD KEY `fkProfessor` (`fkProfessor`);

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
  ADD PRIMARY KEY (`idProjeto`),
  ADD UNIQUE KEY `idProjeto_UNIQUE` (`idProjeto`),
  ADD UNIQUE KEY `hashInterno_UNIQUE` (`hashInterno`);

--
-- Índices para tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  ADD PRIMARY KEY (`idAlunoProjeto`,`fkAluno`,`fkProjeto`),
  ADD UNIQUE KEY `idAlunoProjeto_UNIQUE` (`idAlunoProjeto`),
  ADD KEY `fk_Aluno_has_Projeto_Projeto1_idx` (`fkProjeto`),
  ADD KEY `fk_Aluno_has_Projeto_Aluno_idx` (`fkAluno`);

--
-- Índices para tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  ADD PRIMARY KEY (`idProfProjeto`,`fkProjeto`,`fkProfessor`),
  ADD UNIQUE KEY `idProfProjeto_UNIQUE` (`idProfProjeto`),
  ADD KEY `fk_Projeto_has_Professor_Professor1_idx` (`fkProfessor`),
  ADD KEY `fk_Projeto_has_Professor_Projeto1_idx` (`fkProjeto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `ra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Aluno', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `convite`
--
ALTER TABLE `convite`
  MODIFY `idConvite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `idNotificacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `rp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Professor', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `idProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  MODIFY `idAlunoProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  MODIFY `idProfProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `convite`
--
ALTER TABLE `convite`
  ADD CONSTRAINT `fkProjeto` FOREIGN KEY (`fkProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `fkAluno` FOREIGN KEY (`fkAluno`) REFERENCES `aluno` (`ra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkProfessor` FOREIGN KEY (`fkProfessor`) REFERENCES `professor` (`rp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
