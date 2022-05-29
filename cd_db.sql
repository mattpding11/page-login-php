-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.5.3-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para cd_db
CREATE DATABASE IF NOT EXISTS `cd_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cd_db`;

-- Volcando estructura para tabla cd_db.cd
CREATE TABLE IF NOT EXISTS `cd` (
  `cd_id` int(11) NOT NULL AUTO_INCREMENT,
  `cd_condition` varchar(50) NOT NULL DEFAULT 'Indeterminado',
  `cd_location` varchar(50) NOT NULL DEFAULT 'Indeterminado',
  `cd_status` varchar(15) NOT NULL DEFAULT 'Disponible',
  PRIMARY KEY (`cd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla cd_db.cd: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `cd` DISABLE KEYS */;
INSERT INTO `cd` (`cd_id`, `cd_condition`, `cd_location`, `cd_status`) VALUES
	(1, 'Bueno', 'A-1', 'Prestado'),
	(2, 'Bueno', 'A-2', 'Disponible'),
	(3, 'Mediano', 'A-3', 'Prestado'),
	(4, 'Bueno', 'A-4', 'Disponible'),
	(5, 'Bueno', 'A-5', 'Prestado');
/*!40000 ALTER TABLE `cd` ENABLE KEYS */;

-- Volcando estructura para tabla cd_db.client
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_direction` varchar(50) NOT NULL,
  `client_phone` varchar(20) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_nro_dni` varchar(20) NOT NULL,
  `client_date_birth` varchar(11) NOT NULL,
  `client_registration_date` varchar(11) NOT NULL,
  `client_topic_interest` varchar(50) NOT NULL,
  `client_status` varchar(10) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla cd_db.client: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`client_id`, `client_direction`, `client_phone`, `client_name`, `client_email`, `client_nro_dni`, `client_date_birth`, `client_registration_date`, `client_topic_interest`, `client_status`) VALUES
	(1, 'cr 50A#3-2', '6897742', 'matias alcantara', 'matias_alcantara@gmail.com', '123', '05/12/2019', '18/12/2019', '', 'Activo'),
	(2, 'cr 50A#3-2', '6897742', 'marcos zukaritas', 'marcoszucaritas@hotmail.com', '456', '01/10/1991', '01/05/2019', 'Peliculas', 'Activo'),
	(3, 'cr 09B #33-55', '6666666', 'thanos edward', 't.edward@hotmail.com', '789', '01/10/1991', '01/10/1991', 'Peliculas', 'Activo'),
	(4, 'av 25A', '4599004', 'Julian zapata', 'julia_z@outlook.com', '1011', '11/05/1987', '22/08/2019', 'Juegos', 'Activo'),
	(5, 'cr 25A #19-22 av 08', '11132433', 'Elonk mosquera', 'moquera@outlook.com', '1213', '18/03/1995', '01/12/2019', 'Programas', 'Inactivo');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

-- Volcando estructura para tabla cd_db.rental
CREATE TABLE IF NOT EXISTS `rental` (
  `rental_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_client_id` int(11) NOT NULL,
  `rental_date` varchar(11) NOT NULL DEFAULT '00/00/0000',
  `rental_value` int(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rental_id`),
  UNIQUE KEY `fk_client_id` (`fk_client_id`),
  CONSTRAINT `fk_client_id` FOREIGN KEY (`fk_client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla cd_db.rental: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `rental` DISABLE KEYS */;
INSERT INTO `rental` (`rental_id`, `fk_client_id`, `rental_date`, `rental_value`) VALUES
	(1, 1, '12/05/2019', 20000),
	(2, 2, '07/08/2019', 120000),
	(3, 3, '19/05/2019', 90000),
	(4, 4, '13/10/2019', 50000),
	(5, 5, '01/12/2019', 60000);
/*!40000 ALTER TABLE `rental` ENABLE KEYS */;

-- Volcando estructura para tabla cd_db.rentaldetail
CREATE TABLE IF NOT EXISTS `rentaldetail` (
  `rentaldetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_rental_id` int(11) NOT NULL,
  `fk_cd_id` int(11) NOT NULL,
  `rentaldetail_loan_days` varchar(3) NOT NULL DEFAULT '0',
  `rentaldetail_return_date` varchar(11) NOT NULL DEFAULT '00/00/0000',
  PRIMARY KEY (`rentaldetail_id`),
  UNIQUE KEY `fk_rental_id` (`fk_rental_id`),
  UNIQUE KEY `fk_cd_id` (`fk_cd_id`),
  CONSTRAINT `fk_cd_id` FOREIGN KEY (`fk_cd_id`) REFERENCES `cd` (`cd_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rental_id2` FOREIGN KEY (`fk_rental_id`) REFERENCES `rental` (`rental_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla cd_db.rentaldetail: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `rentaldetail` DISABLE KEYS */;
INSERT INTO `rentaldetail` (`rentaldetail_id`, `fk_rental_id`, `fk_cd_id`, `rentaldetail_loan_days`, `rentaldetail_return_date`) VALUES
	(1, 1, 1, '5', '12/10/2019'),
	(2, 2, 2, '10', '17/08/2019'),
	(3, 3, 3, '20', '15/06/2019'),
	(4, 4, 4, '11', '24/10/2019'),
	(5, 5, 5, '17', '00/00/0000');
/*!40000 ALTER TABLE `rentaldetail` ENABLE KEYS */;

-- Volcando estructura para tabla cd_db.sanction
CREATE TABLE IF NOT EXISTS `sanction` (
  `sanction_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_client_id` int(11) NOT NULL,
  `fk_rental_id` int(11) NOT NULL,
  `sanction_type_penalization` varchar(20) NOT NULL DEFAULT 'No',
  `sanction_nrodays_penalization` varchar(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sanction_id`),
  KEY ` fk_client_id2` (`fk_client_id`),
  KEY `fk_rental_id` (`fk_rental_id`),
  CONSTRAINT ` fk_client_id2` FOREIGN KEY (`fk_client_id`) REFERENCES `rental` (`fk_client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rental_id` FOREIGN KEY (`fk_rental_id`) REFERENCES `rental` (`rental_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla cd_db.sanction: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `sanction` DISABLE KEYS */;
INSERT INTO `sanction` (`sanction_id`, `fk_client_id`, `fk_rental_id`, `sanction_type_penalization`, `sanction_nrodays_penalization`) VALUES
	(1, 1, 1, 'No', '0'),
	(2, 2, 2, 'No', '0'),
	(3, 3, 3, 'SI', '40'),
	(4, 4, 4, 'No', '0'),
	(5, 5, 5, 'Si', '300');
/*!40000 ALTER TABLE `sanction` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
