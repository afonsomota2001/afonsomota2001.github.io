-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Fev-2023 às 10:46
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dispenser`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pathology` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(64) NOT NULL,
  `date` date NOT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `pathology`, `email`, `password`, `date`, `id_number`, `profile_picture`) VALUES
(4, 'Afonso', 'asma', 'afonsomota2001@gmail.com', '123456789', '2001-06-19', '100100123', '63a9eb40f2392.jpg'),
(5, 'Brigite', 'Hipertensão', '1200565@isep.ipp.pt', '123456789', '1977-07-04', '100000004', '63a9e4ef50d17.jpg'),
(6, 'PAulo', 'diabetes', 'jsdcuwdb@gmail.com', '123456789', '1973-05-24', '100000003', '63a9ea5054edf.jpg'),
(7, 'Afonso Mota', 'Alergia Ácaros ', 'afonsomota2001@gmail.com', '123456789', '2001-06-19', '123456789', '63aa134e96d64.jpg'),
(8, 'Test', 'test', 'test@gmail.com', '123456789', '2022-12-27', '100000000', '63ab2e97593cd.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
