-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2025 at 01:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assistencia`
--

-- --------------------------------------------------------

--
-- Table structure for table `assistencias`
--

CREATE TABLE `assistencias` (
  `cod` int NOT NULL,
  `nome_assistencia` varchar(255) NOT NULL,
  `situacao` enum('ativo','inativo') DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assistencias`
--

INSERT INTO `assistencias` (`cod`, `nome_assistencia`, `situacao`, `created_at`, `updated_at`) VALUES
(1, 'Troca de Tela', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(2, 'Formatação Completa 3', 'inativo', '2025-11-19 20:27:12', '2025-11-21 11:07:18'),
(3, 'Limpeza Interna', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(4, 'Troca de Bateria', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(5, 'Atualização de Sistema', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(6, 'Recuperação de Sistema', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(7, 'Reparo de Placa', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(8, 'Manutenção Geral', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(9, 'Instalação de Software', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(10, 'Diagnóstico Técnico', 'ativo', '2025-11-19 20:27:12', '2025-11-19 20:27:12'),
(11, 'Serviço 2', 'ativo', '2025-11-19 21:36:54', '2025-11-19 21:36:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assistencias`
--
ALTER TABLE `assistencias`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assistencias`
--
ALTER TABLE `assistencias`
  MODIFY `cod` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
