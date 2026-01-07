-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         9.5.0 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.14.0.7165
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para 04masw
DROP DATABASE IF EXISTS `04masw`;
CREATE DATABASE IF NOT EXISTS `04masw` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `04masw`;

-- Volcando estructura para tabla 04masw.actores
DROP TABLE IF EXISTS `actores`;
CREATE TABLE IF NOT EXISTS `actores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `nacionalidad` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla 04masw.actores: ~19 rows (aproximadamente)
DELETE FROM `actores`;
INSERT INTO `actores` (`id`, `nombre`, `apellidos`, `fechaNacimiento`, `nacionalidad`) VALUES
	(1, 'Millie', 'Bobby Brown', '2004-02-19', 'Británica'),
	(2, 'Finn', 'Wolfhard', '2002-12-23', 'Canadiense'),
	(3, 'Claire', 'Foy', '1984-04-16', 'Británica'),
	(4, 'Olivia', 'Colman', '1974-01-30', 'Británica'),
	(5, 'Louis', 'Hofmann', '1997-06-03', 'Alemana'),
	(6, 'Lisa', 'Vicari', '1997-02-11', 'Alemana'),
	(7, 'Pedro', 'Pascal', '1975-04-02', 'Chilena'),
	(8, 'Wagner', 'Moura', '1976-06-27', 'Brasileña'),
	(9, 'Bryce Dallas', 'Howard', '1981-03-02', 'Estadounidense'),
	(10, 'Daniel', 'Kaluuya', '1989-02-24', 'Británica'),
	(11, 'Emilia', 'Clarke', '1986-10-23', 'Británica'),
	(12, 'Kit', 'Harington', '1986-12-26', 'Británica'),
	(13, 'Bella', 'Ramsey', '2003-09-30', 'Británica'),
	(14, 'Jared', 'Harris', '1961-08-24', 'Británica'),
	(15, 'Stellan', 'Skarsgård', '1951-06-13', 'Sueca'),
	(16, 'Zendaya', 'Coleman', '1996-09-01', 'Estadounidense'),
	(17, 'Hunter', 'Schafer', '1998-12-31', 'Estadounidense'),
	(18, 'Evan Rachel', 'Wood', '1987-09-07', 'Estadounidense'),
	(19, 'Anthony', 'Hopkins', '1937-12-31', 'Británica');

-- Volcando estructura para tabla 04masw.directores
DROP TABLE IF EXISTS `directores`;
CREATE TABLE IF NOT EXISTS `directores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `nacionalidad` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla 04masw.directores: ~3 rows (aproximadamente)
DELETE FROM `directores`;
INSERT INTO `directores` (`id`, `nombre`, `apellidos`, `fechaNacimiento`, `nacionalidad`) VALUES
	(1, 'Álex', 'Pina', '1967-06-23', 'Española'),
	(2, 'Vince', 'Gilligan', '1967-02-10', 'Estadounidense'),
	(3, 'David', 'Benioff', '1970-09-25', 'Estadounidense');

-- Volcando estructura para tabla 04masw.idiomas
DROP TABLE IF EXISTS `idiomas`;
CREATE TABLE IF NOT EXISTS `idiomas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `isoCode` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isoCode` (`isoCode`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla 04masw.idiomas: ~7 rows (aproximadamente)
DELETE FROM `idiomas`;
INSERT INTO `idiomas` (`id`, `nombre`, `isoCode`) VALUES
	(1, 'Español', 'es'),
	(2, 'Inglés', 'en'),
	(3, 'Francés', 'fr'),
	(4, 'Alemán', 'de'),
	(5, 'Portugués', 'pt'),
	(6, 'Italiano', 'it'),
	(7, 'Japonés', 'ja');

-- Volcando estructura para tabla 04masw.plataformas
DROP TABLE IF EXISTS `plataformas`;
CREATE TABLE IF NOT EXISTS `plataformas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla 04masw.plataformas: ~2 rows (aproximadamente)
DELETE FROM `plataformas`;
INSERT INTO `plataformas` (`id`, `nombre`) VALUES
	(1, 'Netflix'),
	(2, 'HBO Max');

-- Volcando estructura para tabla 04masw.series
DROP TABLE IF EXISTS `series`;
CREATE TABLE IF NOT EXISTS `series` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `plataformaId` int DEFAULT NULL,
  `directorId` int DEFAULT NULL,
  `actores` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `idiomasAudio` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `IdiomasSubtitulos` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_series_plataforma` (`plataformaId`),
  KEY `fk_series_director` (`directorId`),
  CONSTRAINT `fk_series_director` FOREIGN KEY (`directorId`) REFERENCES `directores` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_series_plataforma` FOREIGN KEY (`plataformaId`) REFERENCES `plataformas` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla 04masw.series: ~10 rows (aproximadamente)
DELETE FROM `series`;
INSERT INTO `series` (`id`, `titulo`, `plataformaId`, `directorId`, `actores`, `idiomasAudio`, `IdiomasSubtitulos`) VALUES
	(1, 'La Casa de Papel', 1, 1, 'Úrsula Corberó, Álvaro Morte', 'es,en', 'es,en,fr'),
	(2, 'Breaking Bad', 2, 2, 'Bryan Cranston, Aaron Paul', 'en,es', 'en,es,fr'),
	(3, 'Better Call Saul', 2, 2, 'Bob Odenkirk, Rhea Seehorn', 'en,es', 'en,es'),
	(4, 'Juego de Tronos', 2, 3, 'Emilia Clarke, Kit Harington', 'en,es', 'en,es,de'),
	(5, 'Dark', 1, 3, 'Louis Hofmann, Lisa Vicari', 'de,es,en', 'de,es,en'),
	(6, 'Stranger Things', 1, 2, 'Millie Bobby Brown, Finn Wolfhard', 'en,es', 'en,es,it'),
	(7, 'Narcos', 1, 1, 'Pedro Pascal, Wagner Moura', 'es,en', 'es,en,pt'),
	(8, 'Ozark', 1, 2, 'Jason Bateman, Laura Linney', 'en,es', 'en,es'),
	(9, 'Chernobyl', 2, 3, 'Jared Harris, Stellan Skarsgård', 'en,es', 'en,es,ru'),
	(10, 'The Witcher', 1, 3, 'Henry Cavill, Anya Chalotra', 'en,es', 'en,es,pl');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;