-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Fev-2023 às 11:30
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
-- Estrutura da tabela `archivedprescriptions`
--

CREATE TABLE `archivedprescriptions` (
  `Arch_prescription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `Arch_start_date` date NOT NULL,
  `Arch_end_date` date NOT NULL,
  `Arch_notes` varchar(255) NOT NULL,
  `Arch_times_per_day` int(11) DEFAULT NULL,
  `Arch_hours_to_take` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medications`
--

CREATE TABLE `medications` (
  `medication_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dose` varchar(50) NOT NULL,
  `frequency` varchar(50) NOT NULL,
  `number_of_pills` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `medications`
--

INSERT INTO `medications` (`medication_id`, `name`, `dose`, `frequency`, `number_of_pills`) VALUES
(1, 'Brufen', '2', '2', 30),
(3, 'Aerius', '1', '1', 12),
(4, 'Aspirina', '1', '1', NULL),
(6, 'Voltaren', '1', '1', NULL),
(7, 'Singulair', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `times_per_day` int(11) DEFAULT NULL,
  `hours_to_take` varchar(255) DEFAULT NULL,
  `is_archived` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_id`, `user_id`, `medication_id`, `start_date`, `end_date`, `notes`, `times_per_day`, `hours_to_take`, `is_archived`) VALUES
(10, 4, 1, '2023-01-26', '2023-01-27', 'test hour', 1, '20:00', 0),
(13, 4, 3, '2023-01-26', '2023-02-02', 'test 2 hour ', 2, '08:00/20:00', 0),
(15, 4, 4, '2023-01-26', '2023-01-31', '3 hour test adding one time', 3, '8:00/16:00/00:00', 0),
(17, 5, 7, '2023-01-26', '2023-01-31', 'test hours times', 2, '08:00/20:00', 0),
(18, 4, 7, '2023-01-30', '2023-02-07', 'test after broke', 1, '20:00', 0);

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
-- Índices para tabela `archivedprescriptions`
--
ALTER TABLE `archivedprescriptions`
  ADD PRIMARY KEY (`Arch_prescription_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `medication_id` (`medication_id`);

--
-- Índices para tabela `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`medication_id`);

--
-- Índices para tabela `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `medication_id` (`medication_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `archivedprescriptions`
--
ALTER TABLE `archivedprescriptions`
  MODIFY `Arch_prescription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medications`
--
ALTER TABLE `medications`
  MODIFY `medication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
