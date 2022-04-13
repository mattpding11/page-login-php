-- Ejecutar este codigo en consulta en cliente de sql para crear base de datos, tablas, registros
-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2019 a las 03:14:06
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
use cd_db;
--
-- Base de datos: `cd_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cd_db`
--

CREATE TABLE `cd` (
  `cd_id` int(11) NOT NULL,
  `cd_condition` varchar(50) NOT NULL DEFAULT 'Indeterminado',
  `cd_location` varchar(50) NOT NULL DEFAULT 'Indeterminado',
  `cd_status` varchar(15) NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cd`
--

INSERT INTO `cd` (`cd_id`, `cd_condition`, `cd_location`, `cd_status`) VALUES
(1, 'Bueno', 'A-1', 'Prestado'),
(2, 'Bueno', 'A-2', 'Disponible'),
(3, 'Mediano', 'A-3', 'Prestado'),
(4, 'Bueno', 'A-4', 'Disponible'),
(5, 'Bueno', 'A-5', 'Prestado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_direction` varchar(50) NOT NULL,
  `client_phone` varchar(20) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_nro_dni` varchar(20) NOT NULL,
  `client_date_birth` varchar(11) NOT NULL,
  `client_registration_date` varchar(11) NOT NULL,
  `client_topic_interest` varchar(50) NOT NULL,
  `client_status` varchar(10) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`client_id`, `client_direction`, `client_phone`, `client_name`, `client_email`, `client_nro_dni`, `client_date_birth`, `client_registration_date`, `client_topic_interest`, `client_status`) VALUES
(1, 'cr 50A#3-2', '6897742', 'matias alcantara', 'matias_alcantara@gmail.com', '34534543543', '05/12/2019', '18/12/2019', '', 'Activo'),
(2, 'cr 50A#3-2', '6897742', 'marcos zukaritas', 'marcoszucaritas@hotmail.com', '435546656', '01/10/1991', '01/05/2019', 'Peliculas', 'Activo'),
(3, 'cr 09B #33-55', '6666666', 'thanos edward', 't.edward@hotmail.com', '977127466', '01/10/1991', '01/10/1991', 'Peliculas', 'Activo'),
(4, 'av 25A', '4599004', 'Julian zapata', 'julia_z@outlook.com', '446487344', '11/05/1987', '22/08/2019', 'Juegos', 'Activo'),
(5, 'cr 25A #19-22 av 08', '11132433', 'Elonk mosquera', 'moquera@outlook.com', '87655577', '18/03/1995', '01/12/2019', 'Programas', 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rental`
--

CREATE TABLE `rental` (
  `rental_id` int(11) NOT NULL,
  `fk_client_id` int(11) NOT NULL,
  `rental_date` varchar(11) NOT NULL DEFAULT '00/00/0000',
  `rental_value` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rental`
--

INSERT INTO `rental` (`rental_id`, `fk_client_id`, `rental_date`, `rental_value`) VALUES
(1, 1, '12/05/2019', 20000),
(2, 2, '07/08/2019', 120000),
(3, 3, '19/05/2019', 90000),
(4, 4, '13/10/2019', 50000),
(5, 5, '01/12/2019', 60000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rentaldetail`
--

CREATE TABLE `rentaldetail` (
  `rentaldetail_id` int(11) NOT NULL,
  `fk_rental_id` int(11) NOT NULL,
  `fk_cd_id` int(11) NOT NULL,
  `rentaldetail_loan_days` varchar(3) NOT NULL DEFAULT '0',
  `rentaldetail_return_date` varchar(11) NOT NULL DEFAULT '00/00/0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rentaldetail`
--

INSERT INTO `rentaldetail` (`rentaldetail_id`, `fk_rental_id`, `fk_cd_id`, `rentaldetail_loan_days`, `rentaldetail_return_date`) VALUES
(1, 1, 1, '5', '12/10/2019'),
(2, 2, 2, '10', '17/08/2019'),
(3, 3, 3, '20', '15/06/2019'),
(4, 4, 4, '11', '24/10/2019'),
(5, 5, 5, '17', '00/00/0000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanction`
--

CREATE TABLE `sanction` (
  `sanction_id` int(11) NOT NULL,
  `fk_client_id` int(11) NOT NULL,
  `fk_rental_id` int(11) NOT NULL,
  `sanction_type_penalization` varchar(20) NOT NULL DEFAULT 'No',
  `sanction_nrodays_penalization` varchar(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sanction`
--

INSERT INTO `sanction` (`sanction_id`, `fk_client_id`, `fk_rental_id`, `sanction_type_penalization`, `sanction_nrodays_penalization`) VALUES
(1, 1, 1, 'No', '0'),
(2, 2, 2, 'No', '0'),
(3, 3, 3, 'SI', '40'),
(4, 4, 4, 'No', '0'),
(5, 5, 5, 'Si', '300');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cd`
--
ALTER TABLE `cd`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indices de la tabla `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rental_id`),
  ADD UNIQUE KEY `fk_client_id` (`fk_client_id`);

--
-- Indices de la tabla `rentaldetail`
--
ALTER TABLE `rentaldetail`
  ADD PRIMARY KEY (`rentaldetail_id`),
  ADD UNIQUE KEY `fk_rental_id` (`fk_rental_id`),
  ADD UNIQUE KEY `fk_cd_id` (`fk_cd_id`);

--
-- Indices de la tabla `sanction`
--
ALTER TABLE `sanction`
  ADD PRIMARY KEY (`sanction_id`),
  ADD KEY ` fk_client_id2` (`fk_client_id`),
  ADD KEY `fk_rental_id` (`fk_rental_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cd`
--
ALTER TABLE `cd`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rental`
--
ALTER TABLE `rental`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rentaldetail`
--
ALTER TABLE `rentaldetail`
  MODIFY `rentaldetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sanction`
--
ALTER TABLE `sanction`
  MODIFY `sanction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`fk_client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rentaldetail`
--
ALTER TABLE `rentaldetail`
  ADD CONSTRAINT `fk_cd_id` FOREIGN KEY (`fk_cd_id`) REFERENCES `cd` (`cd_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rental_id2` FOREIGN KEY (`fk_rental_id`) REFERENCES `rental` (`rental_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sanction`
--
ALTER TABLE `sanction`
  ADD CONSTRAINT ` fk_client_id2` FOREIGN KEY (`fk_client_id`) REFERENCES `rental` (`fk_client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rental_id` FOREIGN KEY (`fk_rental_id`) REFERENCES `rental` (`rental_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
