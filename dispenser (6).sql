-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Fev-2023 às 20:14
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
-- Estrutura da tabela `historic_add`
--

CREATE TABLE `historic_add` (
  `add_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `data_add` varchar(40) NOT NULL,
  `number_add` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `historic_add`
--

INSERT INTO `historic_add` (`add_id`, `medication_id`, `data_add`, `number_add`, `user_id`) VALUES
(1, 3, '', 10, 0),
(2, 4, '', 12, 0),
(3, 3, '', 10, 0),
(4, 3, '2023-02-10 13:23:56', 10, 0),
(5, 3, '2023-02-10 12:30:43', 20, 0),
(6, 17, '2023-02-10 13:04:14', 4, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historic_taken`
--

CREATE TABLE `historic_taken` (
  `id_taken` int(11) NOT NULL,
  `date_taken` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medications`
--

CREATE TABLE `medications` (
  `medication_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dose` varchar(50) NOT NULL,
  `frequency` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `medications`
--

INSERT INTO `medications` (`medication_id`, `name`, `dose`, `frequency`) VALUES
(1, 'Brufen', '2', '2'),
(3, 'Aerius', '1', '1'),
(4, 'Aspirina', '1', '1'),
(6, 'Voltaren', '1', '1'),
(7, 'Singulair', '1', '1'),
(8, 'Midazolam', '1', '1'),
(9, 'Rivaroxabana', '1', '1'),
(10, 'Rivaroxabana', '1', '1'),
(11, 'TEST', '1', '1'),
(14, 'ttesttt', '1', '1'),
(15, 'Testeeee', '1', '1'),
(16, 'test 66', '1', ''),
(17, 'test', '2', '2');

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
(10, 4, 1, '2023-01-26', '2023-01-27', 'test hour', 1, '20:00', 1),
(13, 4, 3, '2023-01-26', '2023-02-02', 'test 2 hour ', 2, '08:00/20:00', 1),
(15, 4, 4, '2023-01-26', '2023-01-31', '3 hour test adding one time', 3, '8:00/16:00/00:00', 0),
(17, 5, 7, '2023-01-26', '2023-01-31', 'test hours times', 2, '08:00/20:00', 0),
(18, 4, 7, '2023-01-30', '2023-02-07', 'test after broke', 1, '20:00', 0),
(19, 4, 8, '2023-02-03', '2023-02-28', 'test', 1, '12:00', 0),
(20, 4, 1, '2023-02-07', '2023-02-21', 'test med id', 1, '20:00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE `stock` (
  `deposit_number` int(11) DEFAULT NULL,
  `medication_id` int(11) NOT NULL,
  `number_of_pills` int(11) DEFAULT NULL
) ;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`deposit_number`, `medication_id`, `number_of_pills`) VALUES
(NULL, 1, 0),
(1, 3, 60),
(2, 4, 27),
(NULL, 6, 0),
(NULL, 7, 20),
(NULL, 8, 0),
(NULL, 10, 0),
(NULL, 11, 10),
(NULL, 15, 12),
(NULL, 16, 0),
(8, 17, 20);

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
  `profile_picture` varchar(60) NOT NULL,
  `is_archived` int(1) DEFAULT NULL,
  `alert_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `pathology`, `email`, `password`, `date`, `id_number`, `profile_picture`, `is_archived`, `alert_time`) VALUES
(4, 'Afonso', 'asma', 'afonsomota2001@gmail.com', '123456789', '2001-06-19', '100100123', '63de8d83e3d41.jpg', 0, '00:00:00'),
(5, 'Brigite', 'Hipertensão', '1200565@isep.ipp.pt', '123456789', '1977-07-04', '100000004', '63a9e4ef50d17.jpg', 0, '00:00:00'),
(6, 'PAulo', 'diabetes', 'jsdcuwdb@gmail.com', '123456789', '1973-05-24', '100000003', '63a9ea5054edf.jpg', 0, '00:00:00'),
(7, 'Afonso Mota', 'Alergia Ácaros ', 'afonsomota2001@gmail.com', '123456789', '2001-06-19', '123456789', '63aa134e96d64.jpg', 0, '00:00:00'),
(18, 'test', 'test', 'test', '123', '2001-12-12', '100000007', '63db8455206e1.jpg', 1, '00:00:00'),
(19, 'test', 'TESTE', 'test', 'test', '1212-12-12', '121212122', '63db84efb2071.jpg', 1, '00:00:00'),
(20, 'Teste', 'encript', '1200565@isep.ipp.pt', 'teste encript', '2001-01-01', '100000005', '63e3758f2d71d.jpg', 1, '00:00:00'),
(21, 'encript', 'encript', 'teste@test.com', 'encript', '2023-02-08', '100000007', '63e3762cf174b.jpg', 1, '00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `historic_add`
--
ALTER TABLE `historic_add`
  ADD PRIMARY KEY (`add_id`),
  ADD KEY `medication_id` (`medication_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Índices para tabela `historic_taken`
--
ALTER TABLE `historic_taken`
  ADD PRIMARY KEY (`id_taken`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `medication_id` (`medication_id`) USING BTREE;

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
  ADD KEY `medication_id` (`medication_id`) USING BTREE;

--
-- Índices para tabela `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`medication_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `historic_add`
--
ALTER TABLE `historic_add`
  MODIFY `add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `historic_taken`
--
ALTER TABLE `historic_taken`
  MODIFY `id_taken` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medications`
--
ALTER TABLE `medications`
  MODIFY `medication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `prescriptions_ibfk_2` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`);

--
-- Limitadores para a tabela `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
