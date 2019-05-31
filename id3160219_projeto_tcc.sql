-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 30-Maio-2019 às 15:53
-- Versão do servidor: 10.3.14-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3160219_projeto_tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `analise_academica`
--

CREATE TABLE `analise_academica` (
  `num_processo_fk` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `situacao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_geracao` date DEFAULT NULL,
  `unidade` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsavel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comissao` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_fim_analise` date DEFAULT NULL,
  `prazo_para_analise` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_estrangeiro`
--

CREATE TABLE `curso_estrangeiro` (
  `num_processo_fk_curso` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `instituicao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `regiao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dominacao_curso_area` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `semestre_ano` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_coletados`
--

CREATE TABLE `dados_coletados` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_solicitacao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `curso` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nacionalidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `instituicao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prazo_analize` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_processo`
--

CREATE TABLE `historico_processo` (
  `id` int(11) NOT NULL,
  `num_processo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `etapa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `situacao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data_alteracao` date NOT NULL,
  `duracao_dias` int(11) NOT NULL,
  `responsavel` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `identificacao_requerente`
--

CREATE TABLE `identificacao_requerente` (
  `num_processo_fk_processos` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nacionalidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_nascimento` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

CREATE TABLE `processos` (
  `num_processo` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cpf_rne` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `curso_area` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `etapa_situacao` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(80) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email_notificacao` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha_cb` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sobrenome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analise_academica`
--
ALTER TABLE `analise_academica`
  ADD PRIMARY KEY (`num_processo_fk`);

--
-- Indexes for table `curso_estrangeiro`
--
ALTER TABLE `curso_estrangeiro`
  ADD PRIMARY KEY (`num_processo_fk_curso`);

--
-- Indexes for table `dados_coletados`
--
ALTER TABLE `dados_coletados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_fk` (`id_usuario`);

--
-- Indexes for table `historico_processo`
--
ALTER TABLE `historico_processo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_processo` (`num_processo`);

--
-- Indexes for table `identificacao_requerente`
--
ALTER TABLE `identificacao_requerente`
  ADD PRIMARY KEY (`num_processo_fk_processos`);

--
-- Indexes for table `processos`
--
ALTER TABLE `processos`
  ADD PRIMARY KEY (`num_processo`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dados_coletados`
--
ALTER TABLE `dados_coletados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historico_processo`
--
ALTER TABLE `historico_processo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `analise_academica`
--
ALTER TABLE `analise_academica`
  ADD CONSTRAINT `num_processo_fk` FOREIGN KEY (`num_processo_fk`) REFERENCES `processos` (`num_processo`);

--
-- Limitadores para a tabela `curso_estrangeiro`
--
ALTER TABLE `curso_estrangeiro`
  ADD CONSTRAINT `num_processo_fk_curso` FOREIGN KEY (`num_processo_fk_curso`) REFERENCES `processos` (`num_processo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `dados_coletados`
--
ALTER TABLE `dados_coletados`
  ADD CONSTRAINT `id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historico_processo`
--
ALTER TABLE `historico_processo`
  ADD CONSTRAINT `fk_num_processo` FOREIGN KEY (`num_processo`) REFERENCES `processos` (`num_processo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `identificacao_requerente`
--
ALTER TABLE `identificacao_requerente`
  ADD CONSTRAINT `num_processo_fk_processos` FOREIGN KEY (`num_processo_fk_processos`) REFERENCES `processos` (`num_processo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `processos`
--
ALTER TABLE `processos`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
