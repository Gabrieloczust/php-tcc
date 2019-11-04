-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Nov-2019 às 02:36
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
(1, 'ALUNO TESTE', 'teste@teste.com', '(41) 99902-3899', 'SISTEMAS PARA INTERNET', '$2y$10$tW296n5PrPdDUQ.cfztYZ.gQh/.F32biELSWQhnPROaFlNwz/7bLK', 'off', '::1', '::1', '2019-10-27 01:24:42', '2019-11-03 21:59:27', '$2y$10$BecjMG6d3J7aE6jNE28eKe80tyj/kJUgPM6K3c9hpdKwxk5n4vRlO', 0),
(2, 'GABRIEL FAGUNDEZ', 'gabriel@gabriel.com', NULL, '', '$2y$10$XeCVejUoyrWXfFnWBGjEz.vwCrEPP.E8I.w1JiwCpJZ88HTvOTjzu', 'off', '::1', '::1', '2019-10-29 20:48:23', '2019-11-02 16:43:55', '$2y$10$6oA8K6olpCK3RJgC0OJw2.T6k6Ko6SEa4nOyHA7HqH9kvwlzYoGfa', 0);

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
  `fkOrientador` int(11) NOT NULL,
  `fkProjeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(64, 'aceito', 'Convite de Aluno para o projeto <b>teste2</b> aceito por <b>GABRIEL OCZUST</b>', '2019-11-02 16:47:40', 'true', 1, 2, 'Aluno'),
(65, 'aceito', 'Convite de Aluno para o projeto <b>teste1</b> aceito por <b>ALUNO TESTE</b>', '2019-11-02 16:49:24', 'true', 1, 2, 'Aluno'),
(66, 'aceito', 'Convite de Aluno para o projeto <b>14</b> aceito por <b>GABRIEL FAGUNDEZ</b>', '2019-11-02 16:49:25', 'true', 2, 1, 'Aluno'),
(67, 'recusado', 'O aluno <b>ALUNO TESTE</b> saiu do projeto <b>teste1</b>', '2019-11-02 16:59:42', 'true', 1, 2, 'Aluno'),
(68, 'recusado', 'O aluno <b>GABRIEL FAGUNDEZ</b> saiu do projeto <b>14</b>', '2019-11-02 16:59:58', 'true', 2, 1, 'Aluno'),
(69, 'recusado', 'Convite de Aluno para o projeto <b>teste3</b> recusado por <b>ALUNO TESTE</b>', '2019-11-02 17:01:22', 'true', 1, 2, 'Aluno'),
(70, 'recusado', 'Convite de Aluno para o projeto <b>y</b> recusado por <b>ALUNO TESTE</b>', '2019-11-02 17:01:31', 'true', 1, 2, 'Aluno'),
(71, 'aceito', 'Convite de Orientador para o projeto <b>10</b> aceito por <b>TESTADOR</b>', '2019-11-02 17:04:10', 'true', 1, 1, 'Aluno'),
(72, 'aceito', 'Convite de Orientador para o projeto <b>11</b> aceito por <b>TESTADOR</b>', '2019-11-02 17:04:17', 'true', 1, 1, 'Aluno'),
(73, 'aceito', 'Convite de Orientador para o projeto <b>13</b> aceito por <b>TESTADOR</b>', '2019-11-02 17:04:20', 'true', 1, 1, 'Aluno'),
(74, 'aceito', 'Convite de Orientador para o projeto <b>12</b> aceito por <b>TESTADOR</b>', '2019-11-02 17:04:25', 'true', 1, 1, 'Aluno'),
(75, 'aceito', 'Convite de Orientador para o projeto <b>14</b> aceito por <b>TESTADOR</b>', '2019-11-02 17:04:28', 'true', 1, 1, 'Aluno'),
(76, 'recusado', 'O Orientador <b>TESTADOR</b> saiu do projeto <b>13</b>', '2019-11-03 21:41:54', 'true', 1, 1, 'Aluno'),
(77, 'aceito', 'Convite de Orientador para o projeto <b>dgsg</b> aceito por <b>TESTADOR</b>', '2019-11-03 21:45:16', 'true', 1, 1, 'Aluno'),
(78, 'aceito', 'Convite de Orientador para o projeto <b>dfssfdfhgdh</b> aceito por <b>TESTADOR</b>', '2019-11-03 21:45:19', 'true', 1, 1, 'Aluno'),
(79, 'aceito', 'Convite de Orientador para o projeto <b>ukhjkjhkhjk</b> aceito por <b>TESTADOR</b>', '2019-11-03 21:45:23', 'true', 1, 1, 'Aluno'),
(80, 'recusado', 'O Orientador <b>TESTADOR</b> saiu do projeto <b>dgsg</b>', '2019-11-03 21:45:51', 'true', 1, 1, 'Aluno'),
(81, 'recusado', 'O Orientador <b>TESTADOR</b> saiu do projeto <b>dfssfdfhgdh</b>', '2019-11-03 21:51:02', 'true', 1, 1, 'Aluno'),
(82, 'recusado', 'O Orientador <b>TESTADOR</b> saiu do projeto <b>ukhjkjhkhjk</b>', '2019-11-03 21:54:53', 'true', 1, 1, 'Aluno'),
(83, 'aceito', 'Convite de Orientador para o projeto <b>ukhjkjhkhjk</b> aceito por <b>TESTADOR</b>', '2019-11-03 22:00:06', 'false', 1, 1, 'Aluno'),
(84, 'aceito', 'Convite de Orientador para o projeto <b>dgsg</b> aceito por <b>TESTADOR</b>', '2019-11-03 22:00:09', 'false', 1, 1, 'Aluno'),
(85, 'aceito', 'Convite de Orientador para o projeto <b>dfssfdfhgdh</b> aceito por <b>TESTADOR</b>', '2019-11-03 22:00:11', 'false', 1, 1, 'Aluno'),
(86, 'aceito', 'Convite de Orientador para o projeto <b>teste2</b> aceito por <b>TESTADOR</b>', '2019-11-03 22:00:15', 'false', 1, 1, 'Aluno'),
(87, 'aceito', 'Convite de Orientador para o projeto <b>3</b> aceito por <b>TESTADOR</b>', '2019-11-03 22:01:01', 'false', 1, 1, 'Aluno');

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
(1, 'TESTADOR', 'teste@teste.com', NULL, 'EXATAS', '$2y$10$GGVAGZhV/hhS/.8rJKkAkOADbV4MwORYHGiiabdFQ4.DsFYa450m2', 'off', '::1', '::1', '2019-10-27 01:27:01', '2019-11-03 22:00:03', '$2y$10$Ait/riHjxAckbzGgO08qpe92tNHer8YwQGAwvOkRgbd74hY4b85Oq', 0),
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
(181, '$2y$10$Q3O4YrqVKr9vjfNHhzBN0OZIjSPiuhTAJZWzg4REwiCRGYMaa77Ha', 'mytcc', 'mytcc', '2019-10-27 01:27:42', 1, NULL),
(183, '$2y$10$LpZ9Z8mrrO0BcKxs4qlwKOeH0cTyjsfapKFNT5xz1cOyESOjmcqy.', 'a', 'a', '2019-10-29 19:53:39', 1, NULL),
(185, '$2y$10$5ob0ppLIoFtXfb2hjabCOewld99sUuSTP0TU/sZ8V7q2EOTU98H/K', 'gabriel@gabriel.com', 'gabriel-gabriel-com', '2019-10-29 20:48:36', 2, NULL),
(186, '$2y$10$94aC81PgRjo/O.7mNWpbv.pHTD8AYUBuApIy7Oj5S1PrM3IMJNB46', 'faf', 'faf', '2019-10-29 21:28:22', 2, NULL),
(187, '$2y$10$XWQhXDhVdHcSwpfyjG3KoO/og4ITxCYW5VyAUGRncXfc03LofVnzy', 'sdfdf', 'sdfdf', '2019-10-29 21:28:26', 2, NULL),
(188, '$2y$10$0I8XVLiVTnY8TCx4Ri0a4OuIs3/8sJVDD.HXL53XEj0zShJ5vr/j.', 'aaaasdfsdf', 'aaaasdfsdf', '2019-10-29 23:21:17', 1, NULL),
(189, '$2y$10$Zic/EISH9V076CRIcgepI.m2IkUtLLFlx3oHuY8x0kapdpr.67Hp6', 'projeto', 'projeto', '2019-10-29 23:21:33', 2, NULL),
(190, '$2y$10$o2jnOktwbPyFMHEnhCf8JubBIAUV2wYcg1eJ4p8o2Wvkg7oR09OVS', 'y', 'y', '2019-10-29 23:56:01', 2, NULL),
(191, '$2y$10$frLLY2hUkyJQjj0voOJf2./bTJ6a7zu3Aqj3eb5x8o8pGDNzP.GtG', 'x', 'x', '2019-10-29 23:56:51', 2, NULL),
(192, '$2y$10$ishfo7xwUwGwKOYjEVv2keRPTmVdDM0C8x4c.CD8ZkvAj6QS28ws.', 'teste1', 'teste1', '2019-10-30 00:40:27', 1, NULL),
(193, '$2y$10$psQnAjfRR9.tN7jMmpjDpeo/xVPdUKXxD.39uR9CSL5Y9LtxqaPf2', 'teste2', 'teste2', '2019-10-30 00:40:33', 1, 41),
(194, '$2y$10$VrC.f73SSU1PwBf4GyIPFOIiDn0uJrW4weNQ3WXCarNXdiXeKioaS', 'teste3', 'teste3', '2019-10-30 00:40:37', 1, NULL),
(197, '$2y$10$BtjFACAlOjflFLp.Qly2eO78BmtXSyqI3nxe7IuIk0SL.JGJXbtYO', 'ajax', 'ajax', '2019-11-02 14:28:02', 1, NULL),
(198, '$2y$10$N4uMj/Eh/UsViI1.2kgw5.rpQpl/g80OFiDFzeVs/XwzxsKh5tuzy', '1', '1', '2019-11-02 14:33:09', 1, NULL),
(199, '$2y$10$c/FZki8I3LfArskKLXKiWO9W40sVHlY00gP19VwO07CJs7hSnVSK6', '2', '2', '2019-11-02 14:33:12', 1, NULL),
(200, '$2y$10$B3O2DvBz8JtXQO4M4tkIUOL404YgICJvfiJ7kde5qHVZgHUbKA7W.', '3', '3', '2019-11-02 14:33:15', 1, 41),
(201, '$2y$10$0hUCpfX2rDbtZ94drFs6seCvdQ7Ta/rFye0WJt2NeHJZOPXneoXja', '4', '4', '2019-11-02 14:33:22', 1, NULL),
(206, '$2y$10$hXXY10c9jSIUGjrqaLuQHOuga6tGp54ZaCi3WRbP7Wz7GJ0uBzJeW', '9', '9', '2019-11-02 14:35:44', 1, NULL),
(207, '$2y$10$nny3KFCFlE1RknZ.6aard.e5/vIS6UZvZS5o9mQcscJkxIEL2Vn3W', '10', '10', '2019-11-02 14:35:47', 1, NULL),
(208, '$2y$10$Y.pGq8aSZEupn.IYzLH0QevH/G4ncVc8XL3CnnnOONPFHufQvGRT6', '11a', '11a', '2019-11-02 14:35:50', 1, NULL),
(209, '$2y$10$YKzZ.3Ww.CTLbEUIV4YTl.1coqA9ACh7IWU8IrImPCJbiv9TAhOo6', '13', '13', '2019-11-02 14:35:56', 1, NULL),
(210, '$2y$10$QICUSjqIjvxY9pvfNMqBKOlcTktOa4GW2A.X3F6Qc1ooKdOwjPy8a', '12', '12', '2019-11-02 14:36:00', 1, NULL),
(211, '$2y$10$UND2Wx17rtU2HxfjRSJmeOHeRB6eDbWGMsFthbCXknTn9RTyjuopK', '14', '14', '2019-11-02 14:36:05', 1, NULL),
(212, '$2y$10$Cqc2p0HMAtZlCjBKTyaPK.a5X5vCO5L3vBvs2FOiWePEnRQ0GO7iy', 'dgsg', 'dgsg', '2019-11-03 21:44:52', 1, 41),
(213, '$2y$10$M0fAtmvAKr4VTB9dt2570Odz3RhbEfnUJLkJx98V180UN62zZ9jQq', 'dfssfdfhgdh', 'dfssfdfhgdh', '2019-11-03 21:44:57', 1, 41),
(214, '$2y$10$C8tTKdZ0xVA4waoa1exUq.gkv1L14JnH9EA893J4cCvddEPXClY8C', 'ukhjkjhkhjk', 'ukhjkjhkhjk', '2019-11-03 21:45:01', 1, 41);

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
(161, 'Lider', 185, 2),
(162, 'Integrante', 183, 2),
(163, 'Lider', 186, 2),
(164, 'Lider', 187, 2),
(168, 'Lider', 189, 2),
(170, 'Lider', 190, 2),
(171, 'Lider', 191, 2),
(176, 'Integrante', 188, 2),
(177, 'Integrante', 192, 2),
(178, 'Integrante', 194, 2),
(179, 'Integrante', 193, 2),
(182, 'Lider', 197, 1),
(183, 'Lider', 198, 1),
(184, 'Lider', 199, 1),
(185, 'Lider', 200, 1),
(186, 'Lider', 201, 1),
(191, 'Lider', 206, 1),
(192, 'Lider', 207, 1),
(193, 'Lider', 208, 1),
(194, 'Lider', 209, 1),
(195, 'Lider', 210, 1),
(196, 'Lider', 211, 1),
(197, 'Integrante', 193, 1),
(200, 'Lider', 212, 1),
(201, 'Lider', 213, 1),
(202, 'Lider', 214, 1);

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
(59, 'Orientador', 195, 1),
(60, 'Orientador', 194, 1),
(61, 'Orientador', 196, 1),
(63, 'Orientador', 202, 1),
(64, 'Orientador', 203, 1),
(65, 'Orientador', 204, 1),
(66, 'Orientador', 205, 1),
(67, 'Orientador', 206, 1),
(68, 'Orientador', 207, 1),
(69, 'Orientador', 208, 1),
(70, 'Orientador', 209, 1),
(71, 'Orientador', 210, 1),
(72, 'Orientador', 211, 1),
(76, 'Orientador', 214, 1),
(77, 'Orientador', 212, 1),
(78, 'Orientador', 213, 1),
(79, 'Orientador', 193, 1),
(80, 'Orientador', 200, 1);

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
(39, 'TCC', 'tcc', '$2y$10$jRF5bNTDFEEfrcpW.v.Ml.WK0sLrzX4k316an0O1Ogv9L0PMRHdre', '2019-10-30 01:35:09', 1),
(40, 'GESTÃO', 'gestao', '$2y$10$y2EGCttooFItCb0Pv1IleeyXOf6FNVYPEl7qzRYLpuJMs2TDBeutS', '2019-11-02 14:48:03', 1),
(41, 'ABC', 'abc', '$2y$10$z2z08FqF0r8NMLdkiFKRuum.qTIR6NBcU1jN04iGE25acjxlUyoyS', '2019-11-02 21:54:32', 1);

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
  ADD UNIQUE KEY `idEntrega` (`idEntrega`),
  ADD KEY `fkOrientador` (`fkOrientador`);

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
  MODIFY `idConvite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `idEntrega` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `idNotificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `rp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registro do Professor', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `idProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de tabela `projeto_tem_aluno`
--
ALTER TABLE `projeto_tem_aluno`
  MODIFY `idAlunoProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT de tabela `projeto_tem_entrega`
--
ALTER TABLE `projeto_tem_entrega`
  MODIFY `idProjetoEntrega` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `projeto_tem_professor`
--
ALTER TABLE `projeto_tem_professor`
  MODIFY `idProfProjeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `convite`
--
ALTER TABLE `convite`
  ADD CONSTRAINT `fkProjeto` FOREIGN KEY (`fkProjeto`) REFERENCES `projeto` (`idProjeto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `fkOrientador` FOREIGN KEY (`fkOrientador`) REFERENCES `professor` (`rp`) ON DELETE CASCADE ON UPDATE CASCADE;

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
