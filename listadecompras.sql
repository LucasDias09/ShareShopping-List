-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Fev-2022 às 20:18
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `listadecompras`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `MediaGastos` (IN `custo` VARCHAR(255))  BEGIN select avg(lista.custo) as media from lista ; END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista`
--

CREATE TABLE `lista` (
  `ingredientes` char(50) NOT NULL,
  `custo` char(50) DEFAULT NULL,
  `id_compra` int(10) NOT NULL,
  `data` date DEFAULT current_timestamp(),
  `username` char(50) DEFAULT NULL,
  `quantidade` int(20) DEFAULT NULL,
  `FlagStock` int(10) DEFAULT NULL,
  `id_familia` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lista`
--

INSERT INTO `lista` (`ingredientes`, `custo`, `id_compra`, `data`, `username`, `quantidade`, `FlagStock`, `id_familia`) VALUES
('salmão', '2', 170, '2022-02-18', 'qwe', 2, 1, NULL),
('bacalhau', '3', 181, '2022-02-18', 'lucas', 2, 1, NULL),
('atum', '3', 182, '2022-02-18', 'lucas', 3, 1, NULL),
('corgete', '2', 186, '2022-02-18', 'qwe', 0, 1, NULL),
('batatas', '2', 187, '2022-02-18', 'qwe', 2, 1, NULL),
('arroz', '2', 189, '2022-02-18', 'qwe', 2, 1, NULL),
('Cenouras', '4', 194, '2022-02-20', 'qwe', 5, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mercado`
--

CREATE TABLE `mercado` (
  `id_ingred` int(10) NOT NULL,
  `ingredMarket` char(50) DEFAULT NULL,
  `localizacao` char(50) DEFAULT NULL,
  `tipeMarket` char(50) DEFAULT NULL,
  `tipoingrediente` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mercado`
--

INSERT INTO `mercado` (`id_ingred`, `ingredMarket`, `localizacao`, `tipeMarket`, `tipoingrediente`) VALUES
(3, 'papel', 'Continente', 'Grande', 'consumiveis'),
(4, 'ceriais', 'Continente', 'Grande', 'cereais'),
(5, 'Febras', 'Pingo Doce', 'Grande', 'carne'),
(6, 'Sif', 'Auchan', 'Grande', 'Limpeza'),
(7, 'Champô', 'Continente', 'Grande', 'Cosmetica'),
(8, 'Pão', 'Pingo Doce', 'Pequeno', 'Cereais'),
(9, 'Cenouras', 'Continente', 'Grande', 'Legumes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `username` char(50) NOT NULL,
  `email` char(50) DEFAULT NULL,
  `id_familia` char(50) DEFAULT NULL,
  `nif` int(9) DEFAULT NULL,
  `passwoard` char(100) DEFAULT NULL,
  `verified` int(2) DEFAULT NULL,
  `lnk` varchar(256) DEFAULT NULL,
  `foto` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`username`, `email`, `id_familia`, `nif`, `passwoard`, `verified`, `lnk`, `foto`) VALUES
('lilia', 'lis@hso.com', 'simoes', 123123123, '$2y$10$N99CjIDRZmLmf5Sy9qMTVOZBbySpmGYdxlgVHts5WKhVbT8ipzKK2', NULL, NULL, NULL),
('lucas', '123@qwe.com', 'dias', 123123123, '$2y$10$tP/D9iUh419ZU0Gdnf7.dOElmg9uh7wLnG6CT6xj9Uq8XrjemOq7u', NULL, NULL, 'avatar.jpg'),
('pau', 'qwe@qwe.com', 'qwe', 123123123, '$2y$10$F4K1ioviDCt1HeiAxK7UoOxI3PE7CRY1Ix22j3sFFOo/eXEGfVUsq', NULL, NULL, 'teste2.png'),
('qwe', 'qwe@qwe.com', 'qwe', 123123123, '$2y$10$8B8/VobwCe45tqODzOz3Y.ulAA5HDalc8JLn322Z2yX0vpB7iEMYq', NULL, NULL, 'avatar.jpg'),
('xaninha', 'qwe@qwe.com', 'qwe', 12312313, '$2y$10$.POaGjWAbTjT4QHSoD0pj.aZuP6drLX76J4fojEWjNWMY2fSESy1O', NULL, NULL, 'xana.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id_compra`),
  ADD UNIQUE KEY `ingredientes` (`ingredientes`);

--
-- Índices para tabela `mercado`
--
ALTER TABLE `mercado`
  ADD PRIMARY KEY (`id_ingred`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista`
--
ALTER TABLE `lista`
  MODIFY `id_compra` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT de tabela `mercado`
--
ALTER TABLE `mercado`
  MODIFY `id_ingred` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
