-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Nov-2019 às 02:23
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
-- Banco de dados: `meutcc17_tcc`
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
  `temaDark` enum('off','on') NOT NULL DEFAULT 'off',
  `ip_cadastro` varchar(45) DEFAULT NULL,
  `ip_ultimo_acesso` varchar(45) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_ultimo_acesso` timestamp NULL DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`ra`, `nome`, `email`, `telefone`, `curso`, `senha`, `temaDark`, `ip_cadastro`, `ip_ultimo_acesso`, `data_cadastro`, `data_ultimo_acesso`, `token`, `ativo`) VALUES
(1, 'EU', 'teste@teste.com', '(41) 99902-3899', 'SISTEMAS PARA INTERNET', '$2y$10$tW296n5PrPdDUQ.cfztYZ.gQh/.F32biELSWQhnPROaFlNwz/7bLK', 'off', '::1', '::1', '2019-10-27 01:24:42', '2019-11-05 23:08:45', '$2y$10$BecjMG6d3J7aE6jNE28eKe80tyj/kJUgPM6K3c9hpdKwxk5n4vRlO', 0),
(2, 'GABRIEL FAGUNDES', 'gabriel@gabriel.com', NULL, '', '$2y$10$XeCVejUoyrWXfFnWBGjEz.vwCrEPP.E8I.w1JiwCpJZ88HTvOTjzu', 'off', '::1', '::1', '2019-10-29 20:48:23', '2019-11-02 16:43:55', '$2y$10$6oA8K6olpCK3RJgC0OJw2.T6k6Ko6SEa4nOyHA7HqH9kvwlzYoGfa', 0);

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
-- Estrutura da tabela `entrega`
--

CREATE TABLE `entrega` (
  `idEntrega` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_solicitado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_entrega` timestamp NULL DEFAULT NULL,
  `fkTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entrega`
--

INSERT INTO `entrega` (`idEntrega`, `titulo`, `slug`, `descricao`, `data_solicitado`, `data_entrega`, `fkTurma`) VALUES
(36, 'INTRODUÇÃO', 'introducao', 'FPODJSOPDJDSPJF', '2019-11-05 23:28:19', '2019-11-15 03:00:00', 42),
(37, 'desenvolvimento', 'desenvolvimento', 'dfsg', '2019-11-06 00:42:28', '2019-11-14 03:00:00', 42);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `idNotificacao` int(11) NOT NULL,
  `tipo` enum('aceito','recusado') NOT NULL,
  `mensagem` text NOT NULL,
  `data_enviada` timestamp NOT NULL DEFAULT current_timestamp(),
  `lida` enum('true','false') NOT NULL DEFAULT 'false',
  `fkRemetente` int(11) DEFAULT NULL,
  `fkDestinatario` int(11) DEFAULT NULL,
  `tipoDestinatario` enum('Aluno','Orientador','Avaliador') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notificacao`
--

INSERT INTO `notificacao` (`idNotificacao`, `tipo`, `mensagem`, `data_enviada`, `lida`, `fkRemetente`, `fkDestinatario`, `tipoDestinatario`) VALUES
(118, 'aceito', 'Convite de Orientador para o projeto <b>teste1</b> aceito por <b>TESTADOR</b>', '2019-11-05 23:23:28', 'true', 1, 1, 'Aluno'),
(119, 'recusado', '<a href=\'http://localhost/tcc/projeto/teste1\'>Nova entrega: <b>INTRODUÇÃO</b><br> Projeto: <b>teste1</b><br> Data de entrega: <b>15/11/19</b></a>', '2019-11-05 23:28:19', 'true', NULL, 1, 'Aluno'),
(120, 'recusado', 'O projeto <b>teste1</b> não existe mais, foi apagado da turma <b>TURMA1</b> automaticamente', '2019-11-05 23:44:21', 'true', 1, 1, 'Orientador'),
(121, 'aceito', 'Convite de Orientador para o projeto <b>a</b> aceito por <b>TESTADOR</b>', '2019-11-05 23:45:24', 'true', 1, 1, 'Aluno'),
(122, 'aceito', 'Convite de Orientador para o projeto <b>calculadora de orçamentos</b> aceito por <b>TESTADOR</b>', '2019-11-06 00:36:34', 'true', 1, 1, 'Aluno'),
(123, 'recusado', '<a href=\'http://localhost/tcc/projeto/mytcc\'>Nova entrega: <b>desenvolvimento</b><br> Projeto: <b>mytcc</b><br> Data de entrega: <b>14/11/19</b></a>', '2019-11-06 00:42:28', 'true', NULL, 1, 'Aluno'),
(124, 'recusado', '<a href=\'http://localhost/tcc/projeto/calculadora-de-orcamentos\'>Nova entrega: <b>desenvolvimento</b><br> Projeto: <b>calculadora de orçamentos</b><br> Data de entrega: <b>14/11/19</b></a>', '2019-11-06 00:42:28', 'true', NULL, 1, 'Aluno'),
(125, 'recusado', '<a href=\'http://localhost/tcc/projeto/mytcc\'>Nova entrega: <b>desenvolvimento</b><br> Projeto: <b>mytcc</b><br> Data de entrega: <b>14/11/19</b></a>', '2019-11-06 00:43:22', 'true', NULL, 1, 'Aluno'),
(126, 'recusado', '<a href=\'http://localhost/tcc/projeto/calculadora-de-orcamentos\'>Nova entrega: <b>desenvolvimento</b><br> Projeto: <b>calculadora de orçamentos</b><br> Data de entrega: <b>14/11/19</b></a>', '2019-11-06 00:43:22', 'true', NULL, 1, 'Aluno');

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
  `temaDark` enum('off','on') NOT NULL DEFAULT 'off',
  `ip_cadastro` varchar(45) DEFAULT NULL,
  `ip_ultimo_acesso` varchar(45) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_ultimo_acesso` timestamp NULL DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`rp`, `nome`, `email`, `telefone`, `escola`, `senha`, `temaDark`, `ip_cadastro`, `ip_ultimo_acesso`, `data_cadastro`, `data_ultimo_acesso`, `token`, `ativo`) VALUES
(1, 'TESTADOR', 'teste@teste.com', NULL, 'EXATAS', '$2y$10$GGVAGZhV/hhS/.8rJKkAkOADbV4MwORYHGiiabdFQ4.DsFYa450m2', 'off', '::1', '::1', '2019-10-27 01:27:01', '2019-11-04 18:52:28', '$2y$10$Ait/riHjxAckbzGgO08qpe92tNHer8YwQGAwvOkRgbd74hY4b85Oq', 0),
(2, 'TESTE', 't@t.com', NULL, 'BIOLÓGICAS', '$2y$10$bu9.ELxeQFkrmzG8nFsc/u9Y1ZgChaTykiukBZVPW9jdWqp2iXw.S', 'off', '::1', '::1', '2019-10-29 20:16:10', '2019-10-29 20:16:14', '$2y$10$oSRC3WKs2r4jfZn1sySI7.gcKj6qGmuzpfB8xh2p3bT8UeXnWclZe', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `idProjeto` int(11) NOT NULL,
  `hashInterno` varchar(255) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `fkAlunoLider` int(11) NOT NULL,
  `fkTurma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`idProjeto`, `hashInterno`, `titulo`, `slug`, `data_criacao`, `fkAlunoLider`, `fkTurma`) VALUES
(216, '$2y$10$uL6rJj6eCj0yJRkWfb2SNewuxIdykgJkX5GdIabwI9GYhi.MCotG6', 'mytcc', 'mytcc', '2019-11-05 23:45:20', 1, 42),
(217, '$2y$10$Zyu9MJhSYl3ZgEKgmkAidupHE0dP7Q9zWmbVa1Wlutl0d2LQZRc9u', 'calculadora de orçamentos', 'calculadora-de-orcamentos', '2019-11-06 00:36:27', 1, 42);

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

--
-- Extraindo dados da tabela `projeto_tem_aluno`
--

INSERT INTO `projeto_tem_aluno` (`idAlunoProjeto`, `tipoAluno`, `fkProjeto`, `fkAluno`) VALUES
(204, 'Lider', 216, 1),
(205, 'Lider', 217, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_tem_entrega`
--

CREATE TABLE `projeto_tem_entrega` (
  `idProjetoEntrega` int(11) NOT NULL,
  `nota` int(3) DEFAULT NULL,
  `fkProjeto` int(11) NOT NULL,
  `fkEntrega` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto_tem_entrega`
--

INSERT INTO `projeto_tem_entrega` (`idProjetoEntrega`, `nota`, `fkProjeto`, `fkEntrega`) VALUES
(32, NULL, 215, 36),
(33, NULL, 216, 37);

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
-- Extraindo dados da tabela `projeto_tem_professor`
--

INSERT INTO `projeto_tem_professor` (`idProfProjeto`, `tipoProfessor`, `fkProjeto`, `fkProfessor`) VALUES
(81, 'Orientador', 215, 1),
(82, 'Orientador', 216, 1),
(83, 'Orientador', 217, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `hashInterno` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `fkOrientador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `nome`, `slug`, `hashInterno`, `data_criacao`, `fkOrientador`) VALUES
(42, 'TURMA1', 'turma1', '$2y$10$uOninmacGEK5lSDGD0qk9e.nHUTlfS94C04K8Gb7wdmVtSswfZ8q.', '2019-11-05 23:23:20', 1),
(43, 'TURMA2', 'turma2', '$2y$10$WWa8r7mFsL9kQ48JG3Q7SOlcmej5WychOUbLfdfnp11BXlVpezBzC', '2019-11-05 23:48:10', 1);

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
-- Índices para tabela `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`idEntrega`),
  ADD UNIQUE KEY `idEntrega` (`idEntrega`);

--
-- Índices para tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`idNotificacao`),
  ADD UNIQUE KEY `idNotificacao` (`idNotificacao`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`rp`),
  ADD UNIQUE KEY `rp` (`rp`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Índices para tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`idProjeto`),
  ADD UNIQUE KEY `idProjeto_UNIQUE` (`idProjeto`),
  ADD KEY `fkAlunoLider` (`fkAlunoLider`),
  ADD KEY `fkTurma` (`fkTurma`);

--
-- Índices para tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  ADD PRIMARY KEY (`idAlunoProjeto`),
  ADD UNIQUE KEY `idAlunoProjeto_UNIQUE` (`idAlunoProjeto`),
  ADD KEY `idProjeto_idx` (`fkProjeto`);

--
-- Índices para tabela `projeto_tem_entrega`
--
ALTER TABLE `projeto_tem_entrega`
  ADD PRIMARY KEY (`idProjetoEntrega`),
  ADD KEY `fkEntrega` (`fkEntrega`);

--
-- Índices para tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  ADD PRIMARY KEY (`idProfProjeto`),
  ADD UNIQUE KEY `idProfProjeto_UNIQUE` (`idProfProjeto`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`),
  ADD UNIQUE KEY `idTurma` (`idTurma`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `ra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Aluno', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `convite`
--
ALTER TABLE `convite`
  MODIFY `idConvite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `idEntrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `idNotificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `rp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Professor', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `idProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT de tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  MODIFY `idAlunoProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de tabela `projeto_tem_entrega`
--
ALTER TABLE `projeto_tem_entrega`
  MODIFY `idProjetoEntrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  MODIFY `idProfProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `convite`
--
ALTER TABLE `convite`
  ADD CONSTRAINT `fkProjeto` FOREIGN KEY (`fkProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `fkTurma` FOREIGN KEY (`fkTurma`) REFERENCES `turma` (`idTurma`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `projeto_tem_entrega`
--
ALTER TABLE `projeto_tem_entrega`
  ADD CONSTRAINT `fkEntrega` FOREIGN KEY (`fkEntrega`) REFERENCES `entrega` (`idEntrega`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
