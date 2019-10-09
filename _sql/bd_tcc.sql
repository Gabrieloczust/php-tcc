-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Out-2019 às 03:55
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

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`ra`, `nome`, `email`, `telefone`, `curso`, `senha`, `ip_cadastro`, `ip_ultimo_acesso`, `data_cadastro`, `data_ultimo_acesso`, `token`, `ativo`) VALUES
(18, 'Gabriel Oczust', 'gabriel@gabriel.com', NULL, 'Teste', '$2y$10$HCA4o9hLk2LrRUYQc.Bth.sJ4Z9FraZcrzQ92nOdPD4O9iYWhlN5C', '::1', NULL, '2019-09-25 19:42:25', NULL, '$2y$10$ETU7GKBOOpxovohqkYoTpeVM0GxWXb6htHKQ4SgY21xVYC8qofZvm', 0),
(19, 'Gabriel Oczust', 'teste@teste.com', NULL, '', '$2y$10$hzTxDyg3ZGxeUWxo8zttUuUwWnVj8UNQkRPu78h63mEKfuE2d3RDi', '::1', NULL, '2019-10-05 23:29:29', NULL, '$2y$10$vPftjYJiMwNuYusOPDS4W.SjaVZw/JQxUHdTW8jKLo4vzDVfikS3S', 0);

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
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `nota` decimal(2,2) NOT NULL DEFAULT 0.00,
  `data_upload` date NOT NULL,
  `formato` varchar(8) NOT NULL,
  `monografia` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = false\n1 = true\ndocumento final para avaliacao do Professor Avaliador e exposição na Biblioteca',
  `Projeto_idProjeto` int(11) NOT NULL
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

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`rp`, `nome`, `email`, `telefone`, `escola`, `senha`, `ip_cadastro`, `ip_ultimo_acesso`, `data_cadastro`, `data_ultimo_acesso`, `token`, `ativo`) VALUES
(12, 'Josnaldo Da Silba Santos', 'teste@teste.com', NULL, 'Exatas', '$2y$10$xfVqogAXtVBl9OGsG.2TTOSScgyrN11g9ZZuKarPAWBA3lli/7klq', '::1', NULL, '2019-10-05 23:28:51', NULL, '$2y$10$rwpb.t5b0vuLOweY3NrW2.DA9APGSBBjpOBxpUtG2WabmygvjseyK', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_avalia_projeto`
--

CREATE TABLE `professor_avalia_projeto` (
  `id_pp` int(11) NOT NULL,
  `fk_idProjeto` int(11) NOT NULL,
  `fk_rp` int(11) NOT NULL,
  `tipoProfessor` enum('Orientador','Avaliador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `idProjeto` int(11) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `notaProjeto` decimal(2,2) NOT NULL DEFAULT 0.00,
  `notaRecuperacao` decimal(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`idProjeto`, `titulo`, `data_criacao`, `notaProjeto`, `notaRecuperacao`) VALUES
(8, 'dfssdf', '2019-10-06 00:30:56', '0.00', '0.00'),
(9, 'dfssdf', '2019-10-06 00:32:00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_tem_aluno`
--

CREATE TABLE `projeto_tem_aluno` (
  `id_pa` int(11) NOT NULL,
  `fk_ra` int(11) NOT NULL,
  `fk_idProjeto` int(11) NOT NULL,
  `tipoAluno` enum('Lider','Integrante') NOT NULL DEFAULT 'Integrante'
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
-- Índices para tabela `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`,`Projeto_idProjeto`),
  ADD KEY `fk_Documento_Projeto1_idx` (`Projeto_idProjeto`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`rp`),
  ADD UNIQUE KEY `rp` (`rp`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `professor_avalia_projeto`
--
ALTER TABLE `professor_avalia_projeto`
  ADD PRIMARY KEY (`id_pp`,`fk_idProjeto`,`fk_rp`),
  ADD KEY `fk_Projeto_has_Professor_Professor1_idx` (`fk_rp`),
  ADD KEY `fk_Projeto_has_Professor_Projeto1_idx` (`fk_idProjeto`);

--
-- Índices para tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`idProjeto`);

--
-- Índices para tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  ADD PRIMARY KEY (`id_pa`,`fk_ra`,`fk_idProjeto`),
  ADD KEY `fk_Aluno_has_Projeto_Projeto1_idx` (`fk_idProjeto`),
  ADD KEY `fk_Aluno_has_Projeto_Aluno_idx` (`fk_ra`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `ra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Aluno', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `rp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Professor', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `professor_avalia_projeto`
--
ALTER TABLE `professor_avalia_projeto`
  MODIFY `id_pp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `idProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  MODIFY `id_pa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_Comentario_Documento1` FOREIGN KEY (`Documento_idDocumento`,`Documento_Projeto_idProjeto`) REFERENCES `documento` (`idDocumento`, `Projeto_idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_Documento_Projeto1` FOREIGN KEY (`Projeto_idProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `professor_avalia_projeto`
--
ALTER TABLE `professor_avalia_projeto`
  ADD CONSTRAINT `fk_Projeto_has_Professor_Professor1` FOREIGN KEY (`fk_rp`) REFERENCES `professor` (`rp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Projeto_has_Professor_Projeto1` FOREIGN KEY (`fk_idProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  ADD CONSTRAINT `fk_Aluno_has_Projeto_Aluno` FOREIGN KEY (`fk_ra`) REFERENCES `aluno` (`ra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Aluno_has_Projeto_Projeto1` FOREIGN KEY (`fk_idProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
