-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2021 a las 05:32:44
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ubermvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `idchofer` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `precio` decimal(5,2) NOT NULL DEFAULT 20.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`idchofer`, `nombres`, `codigo`, `precio`) VALUES
(1, 'Jorge', 'A49P', '20.00'),
(2, 'Luis', 'F07O', '30.00'),
(3, 'Antonio', 'V29B', '40.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idimg` int(11) NOT NULL,
  `nombreimg` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idimg`, `nombreimg`, `url`) VALUES
(1, '0', '0'),
(2, '0', '0'),
(3, '0', '0'),
(4, '0', '0'),
(5, 'alga', 'alga.png'),
(6, 'debaa', 'amigo.png'),
(7, 'oliver', 'oliver.png'),
(8, 'otro', 'otro.png'),
(9, 'abas', 'abas.png'),
(10, 'rea', 'rea.png'),
(11, 'tgt', 'tgt.png'),
(12, 'wasa', 'wasa.jpg'),
(13, 'vers', 'vers.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motocicleta`
--

CREATE TABLE `motocicleta` (
  `idm` int(11) NOT NULL,
  `schedule` varchar(50) NOT NULL,
  `availability` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `motocicleta`
--

INSERT INTO `motocicleta` (`idm`, `schedule`, `availability`, `quantity`) VALUES
(1, '08:00 - 08:30', 0, 0),
(2, '08:30 - 09:00', 1, 2),
(3, '09:00 - 09:30', 1, 3),
(4, '09:30 - 10:00', 1, 3),
(5, '10:00 - 10:30', 1, 3),
(6, '10:30 - 11:00', 1, 3),
(7, '11:00 - 11:30', 1, 3),
(8, '11:30 - 12:00', 1, 3),
(9, '12:00 - 12:30', 1, 3),
(10, '12:30 - 13:00', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `password`, `role`) VALUES
(1, 'jorge', '$2y$10$uRkCWEkq5fc8reFIZ5VkWOAJUMqCn35iJiLkAiP2lXwdr5AZ0cpca', 'user'),
(2, 'marco', '$2y$10$qYnrf40xnlw5rRx3lVYrg.tV9cNJ/er4vj.B1WgsK3bVfYyCh5lXG', 'user'),
(3, 'otro', '$2y$10$H0l8upAuBoP8L8erj5xVXOnFRsMijIme.nN.Y89T2WqIQbdhNjbKa', 'user'),
(4, 'luis', '$2y$10$NFDZn21i7n.vVWOayGFmIeyPuZWefB1HIpQhi4N0MOvX8Ouu4J/Qa', 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariomotocicleta`
--

CREATE TABLE `usuariomotocicleta` (
  `idum` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `motor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_motor_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuariomotocicleta`
--

INSERT INTO `usuariomotocicleta` (`idum`, `user_id`, `motor_id`, `status`, `user_motor_id`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 3),
(3, 1, 3, 0, 0),
(4, 1, 4, 0, 0),
(5, 1, 5, 0, 0),
(6, 1, 6, 0, 0),
(7, 1, 7, 0, 0),
(8, 1, 8, 0, 0),
(9, 1, 9, 0, 0),
(10, 1, 10, 0, 0),
(11, 2, 1, 1, 1),
(12, 2, 2, 0, 0),
(13, 2, 3, 0, 0),
(14, 2, 4, 0, 0),
(15, 2, 5, 0, 0),
(16, 2, 6, 0, 0),
(17, 2, 7, 0, 0),
(18, 2, 8, 0, 0),
(19, 2, 9, 0, 0),
(20, 2, 10, 0, 0),
(21, 3, 1, 0, 0),
(22, 3, 2, 0, 0),
(23, 3, 3, 0, 0),
(24, 3, 4, 0, 0),
(25, 3, 5, 0, 0),
(26, 3, 6, 0, 0),
(27, 3, 7, 0, 0),
(28, 3, 8, 0, 0),
(29, 3, 9, 0, 0),
(30, 3, 10, 0, 0),
(31, 4, 1, 1, 2),
(32, 4, 2, 0, 0),
(33, 4, 3, 0, 0),
(34, 4, 4, 0, 0),
(35, 4, 5, 0, 0),
(36, 4, 6, 0, 0),
(37, 4, 7, 0, 0),
(38, 4, 8, 0, 0),
(39, 4, 9, 0, 0),
(40, 4, 10, 0, 0),
(81, 9, 1, 0, 0),
(82, 9, 2, 0, 0),
(83, 9, 3, 0, 0),
(84, 9, 4, 0, 0),
(85, 9, 5, 0, 0),
(86, 9, 6, 0, 0),
(87, 9, 7, 0, 0),
(88, 9, 8, 0, 0),
(89, 9, 9, 0, 0),
(90, 9, 10, 0, 0),
(91, 10, 1, 0, 0),
(92, 10, 2, 0, 0),
(93, 10, 3, 0, 0),
(94, 10, 4, 0, 0),
(95, 10, 5, 0, 0),
(96, 10, 6, 0, 0),
(97, 10, 7, 0, 0),
(98, 10, 8, 0, 0),
(99, 10, 9, 0, 0),
(100, 10, 10, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD PRIMARY KEY (`idchofer`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idimg`);

--
-- Indices de la tabla `motocicleta`
--
ALTER TABLE `motocicleta`
  ADD PRIMARY KEY (`idm`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuariomotocicleta`
--
ALTER TABLE `usuariomotocicleta`
  ADD PRIMARY KEY (`idum`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chofer`
--
ALTER TABLE `chofer`
  MODIFY `idchofer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idimg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `motocicleta`
--
ALTER TABLE `motocicleta`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuariomotocicleta`
--
ALTER TABLE `usuariomotocicleta`
  MODIFY `idum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
