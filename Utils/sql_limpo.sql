-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Dez-2022 às 18:13
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aedb_php`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` int(11) NOT NULL,
  `nmaluno` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idaluno`, `nmaluno`) VALUES
(1, 'ADMINISTRADOR DO SISTEMA'),
(2, 'David Renan'),
(3, 'Pedro Henrique');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunomatriculado`
--

CREATE TABLE `alunomatriculado` (
  `idalunomatriculado` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idmateria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunomatriculado`
--

INSERT INTO `alunomatriculado` (`idalunomatriculado`, `idaluno`, `idmateria`) VALUES
(1, 1, 6),
(2, 1, 7),
(3, 1, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `idavaliacao` int(11) NOT NULL,
  `dsavaliacao` varchar(10) NOT NULL,
  `idmateria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`idavaliacao`, `dsavaliacao`, `idmateria`) VALUES
(11, 'Av1', 8),
(14, 'Av2', 9),
(15, 'Av3', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacaoaluno`
--

CREATE TABLE `avaliacaoaluno` (
  `idavaliacaoaluno` int(11) NOT NULL,
  `idavaliacao` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacaoaluno`
--

INSERT INTO `avaliacaoaluno` (`idavaliacaoaluno`, `idavaliacao`, `idaluno`, `nota`) VALUES
(11, 11, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `dslogin` varchar(50) NOT NULL,
  `dssenha` varchar(150) NOT NULL,
  `idaluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`dslogin`, `dssenha`, `idaluno`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia`
--

CREATE TABLE `materia` (
  `idmateria` int(11) NOT NULL,
  `dsmateria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `materia`
--

INSERT INTO `materia` (`idmateria`, `dsmateria`) VALUES
(6, 'a'),
(8, 'C#'),
(9, 'JavaScript'),
(10, 'PHP'),
(7, 'z');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoavaliacao`
--

CREATE TABLE `tipoavaliacao` (
  `tipoAv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoavaliacao`
--

INSERT INTO `tipoavaliacao` (`tipoAv`) VALUES
('Av1'),
('Av2'),
('Av3');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idaluno`);

--
-- Índices para tabela `alunomatriculado`
--
ALTER TABLE `alunomatriculado`
  ADD PRIMARY KEY (`idalunomatriculado`),
  ADD KEY `fk_idaluno` (`idaluno`),
  ADD KEY `fk_materia` (`idmateria`);

--
-- Índices para tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`idavaliacao`),
  ADD KEY `fk_mateira_ava` (`idmateria`);

--
-- Índices para tabela `avaliacaoaluno`
--
ALTER TABLE `avaliacaoaluno`
  ADD PRIMARY KEY (`idavaliacaoaluno`),
  ADD KEY `fk_idaluno_nota` (`idaluno`),
  ADD KEY `fk_idavaliacao_nota` (`idavaliacao`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`dslogin`),
  ADD KEY `fk_idaluno_login` (`idaluno`);

--
-- Índices para tabela `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idmateria`),
  ADD UNIQUE KEY `UK_dsmateria` (`dsmateria`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idaluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `alunomatriculado`
--
ALTER TABLE `alunomatriculado`
  MODIFY `idalunomatriculado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `idavaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `avaliacaoaluno`
--
ALTER TABLE `avaliacaoaluno`
  MODIFY `idavaliacaoaluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `materia`
--
ALTER TABLE `materia`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunomatriculado`
--
ALTER TABLE `alunomatriculado`
  ADD CONSTRAINT `fk_idaluno` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia` FOREIGN KEY (`idmateria`) REFERENCES `materia` (`idmateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_mateira_ava` FOREIGN KEY (`idmateria`) REFERENCES `materia` (`idmateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `avaliacaoaluno`
--
ALTER TABLE `avaliacaoaluno`
  ADD CONSTRAINT `fk_idaluno_nota` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idavaliacao_nota` FOREIGN KEY (`idavaliacao`) REFERENCES `avaliacao` (`idavaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_idaluno_login` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
