-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 02/10/2025 às 02:45
-- Versão do servidor: 8.0.42-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.2-1ubuntu2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controledevalidade_luciana`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_produtos`
--

CREATE TABLE `cadastro_produtos` (
  `id` int NOT NULL,
  `produto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` int NOT NULL,
  `data_validade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `cadastro_produtos`
--

INSERT INTO `cadastro_produtos` (`id`, `produto`, `quantidade`, `data_validade`) VALUES
(31, 'Leite condensado MOÇA ', 0, '2025-12-01'),
(32, 'Creme de leite NESTLÊ', 0, '2025-12-01'),
(33, 'Creme de leite ITALAC', 0, '2025-12-24'),
(34, 'Creme de leite PIRACANJUBA', 0, '2025-10-17'),
(35, 'Leite condensado PIRACANJUBA O LACTOSE', 0, '2025-12-06'),
(36, 'Chantilly GRANFINALE 200 ml', 0, '2025-11-01'),
(37, 'Chantilly GRANFINALE 500 ml', 0, '2025-10-29'),
(38, 'Fermento em pó ROYAL 250 G', 0, '2025-11-16'),
(39, 'Fermento em pó ROYAL 100 G', 0, '2025-11-21'),
(41, 'Fermento Fleischmann 100 G', 0, '2025-10-14'),
(42, 'Fermento dr.Otker', 0, '2025-11-30'),
(43, 'Cobertura para sorvete morango', 0, '2025-11-14'),
(44, 'Cobertura para sorvete frutas vermelhas ', 0, '2025-11-05'),
(46, 'Margarina delícia 1kg ', 0, '2025-11-11'),
(47, 'Deline 250 G', 0, '2025-12-30'),
(48, 'Achocolatado Nescau 180 ml', 0, '2025-12-18'),
(49, 'Achocolatado neskuik 180 ml', 0, '2025-10-26'),
(50, 'Achocolatado chocolate 200 ml', 0, '2025-12-08'),
(51, 'PIRACANJUBA pro force chocolate ', 0, '2025-10-09'),
(52, 'Sereal matinal Sucrilhos Kellogg\'s ', 0, '2025-10-19'),
(54, 'Margarina delícia 250 G  ', 0, '2025-12-14'),
(55, 'Nescau bebida láctea ', 0, '2025-12-05'),
(56, 'Nescau bebida láctea cacau extra', 0, '2025-12-10'),
(57, 'Nescafé capuccino clássico pro energy', 0, '2025-10-29'),
(58, 'Mucilon arroz e aveia 600 G', 0, '2025-12-01'),
(59, 'Mucilon arroz e aveia ', 0, '2025-11-01'),
(60, 'Biscoito Vitarella água e sal', 0, '2025-12-10'),
(62, 'Ninho lata 0 lactose', 0, '2025-12-08'),
(63, 'Pão de forma capricho coco ', 0, '2025-10-07'),
(64, 'Pão de forma capricho milho', 0, '2025-10-05'),
(65, 'Pão de forma capricho integral ', 0, '2025-11-02'),
(66, 'Pão de forma capricho aveia ', 0, '2025-10-29'),
(67, 'Pão de forma Guimarães integral', 0, '2025-11-29'),
(68, 'Pão de forma Guimarães tradicional ', 0, '2025-11-23'),
(71, 'Pão de forma Bauducco multi grãos ', 0, '2025-10-25'),
(72, 'Pão de forma Bauducco tradicional ', 0, '2025-10-09'),
(73, 'Pão de forma valemix integral ', 0, '2025-10-20'),
(74, 'Pão de forma valemix ', 0, '2025-10-06'),
(77, 'Bisnaguinha capricho ', 0, '2025-10-08'),
(78, 'Facilia palitinho de leite ', 0, '2025-11-16'),
(85, 'Delicitá original ', 0, '2025-12-04'),
(86, 'Vitarella crocks ', 0, '2025-12-11'),
(87, 'Delicitá integral ', 0, '2025-11-20'),
(88, 'Vitarella cream cracker tradicional ', 0, '2025-12-03'),
(89, 'Vitarella água e sal ', 0, '2025-12-10'),
(90, 'Cream cracker pilar integral ', 0, '2025-11-15'),
(91, 'Wafer Nescau Nestlé ', 0, '2025-12-25'),
(92, 'Wafer Nestlé ', 0, '2025-11-22'),
(93, 'Wafer Bono morango', 0, '2025-11-11'),
(94, 'Wafer Bono morango', 0, '2025-11-11'),
(95, 'Wafer Negresco ', 0, '2025-12-15'),
(97, 'Wafer prestígio ', 0, '2025-11-29'),
(98, 'Bono wafer limão ', 0, '2025-12-26'),
(99, 'Calipso Nestlé ', 0, '2025-11-21'),
(100, 'Wafer toddy', 0, '2025-10-06'),
(101, 'Cocada cremosa sococo', 0, '2025-12-16'),
(105, 'Facilia cebola e pimenta ', 0, '2025-12-02'),
(106, 'Facilia cebola e pimenta ', 0, '2025-12-02'),
(107, 'Facilia tradicional azul', 0, '2025-12-09'),
(108, 'Facilia tradicional amarelo ', 0, '2025-12-17'),
(109, 'Facilia fracrock', 0, '2025-11-18'),
(110, 'Facilia palitinho de leite ', 0, '2025-11-16'),
(111, 'Delicitá original ', 0, '2025-12-04'),
(112, 'Delicitá integral ', 0, '2025-11-20'),
(113, 'Vitarella crocks ', 0, '2025-12-11'),
(114, 'Mistura de bolo baunilha Brandini ', 0, '2025-12-12'),
(115, 'Triunfo chocolate ', 0, '2025-11-28');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro_produtos`
--
ALTER TABLE `cadastro_produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro_produtos`
--
ALTER TABLE `cadastro_produtos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
