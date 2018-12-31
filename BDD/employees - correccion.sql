-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2018 a las 19:27:54
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reclutamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `empfullname` varchar(50) NOT NULL DEFAULT '',
  `employee_passwd` varchar(25) NOT NULL DEFAULT '',
  `apellidos` varchar(75) NOT NULL DEFAULT '',
  `employid` varchar(20) DEFAULT NULL,
  `edociv` varchar(50) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `nss` varchar(20) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `telefono` int(50) NOT NULL,
  `tipo` enum('0','1','2','3') NOT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`empfullname`, `employee_passwd`, `apellidos`, `employid`, `edociv`, `sexo`, `nss`, `email`, `telefono`, `tipo`, `foto`) VALUES
('admin', 'admin', 'apellido', '9999', 'soltero', 'masculino', 'abcdefghijkl', '', 0, '0', NULL),
('nombre', '1234', 'apellidos', '4321', 'Soltero', 'Masculino', 'abcdefghijkl', '', 0, '1', NULL),
('Eduardo Antonio', 'contraseña', 'Alvarado Castro', '2726', 'Soltero', 'Masculino', '123456789', '', 0, '0', NULL),
('asi', '91', 'asi', '19', 'Soltero/a', 'Femenino', 'a', 'a', 0, '1', NULL),
('rere', 'rere', 'rere', 'rere', 'rere', 'rere', 'rere', '', 0, '0', NULL),
('po', 'po', 'po', 'po', 'po', 'po', 'po', '', 0, '0', NULL),
('ultimo', '5421', 'ultimo', '1254', 'ultimo', 'ultimo', 'ultimo', '', 0, '1', NULL),
('Eduardo', '1211', 'Alvarado', '1211', 'Soltero', 'Masculino', '16497815263', '', 0, '0', NULL),
('q', '123', 'q', '123', 'q', 'q', 'q', '', 0, '1', NULL),
('yo tengo turno', '654321', 'otro apellido', '123456', 'no se', 'tampoco', '1233456789', 'mi-correo@hotmail.com', 0, '1', NULL),
('i', 'i', 'i', 'i', 'i', 'i', '1233456789', 'i', 0, '0', NULL),
('ty', 'ty', 'ty', 'ty', 'ty', 'Femenino', 'ty', 'ty', 0, '0', NULL),
('bn', 'bn', 'bn', 'bn', 'Casado/a', 'Masculino', 'bn', 'bn', 0, '0', NULL),
('pou', 'pou', 'pou', 'pou', 'Divorciado/a', 'Masculino', 'pou', 'pou', 0, '0', NULL),
('Prueba Editarme', '951', 'cambia', '159', 'Casado/a', 'Masculino', '16457982315', 'cambia', 0, '1', NULL),
('aver', '1546', 'm', '1546', 'Soltero/a', 'Masculino', 'm', 'm', 0, '1', NULL),
('p', 'p', 'p', 'p', 'Soltero/a', 'Femenino', 'p', 'p', 0, '0', NULL),
('iiiiiii', 'iii', 'iiiiii', 'iii', 'Viudo/a', 'Masculino', 'iiiiii', 'iiii', 0, '0', NULL),
('facil', '951753', 'apellidos', '951753', 'Soltero/a', 'Masculino', '1233456789', 'ad', 0, '1', NULL),
('Oboru', '4697', 'san', '4697', 'Casado/a', 'Masculino', '15487', 'no tengo', 0, '1', NULL),
('cliente', '1029', 'cliente', '1029', 'Soltero/a', 'Masculino', '123456789', 'no se', 0, '1', NULL),
('ciudad', '1423', 'ciudad', '1423', 'Soltero/a', 'Masculino', '1234567', 'a', 0, '1', NULL),
('', '', '', '', '', '', '', '', 0, '0', NULL),
('lkj', '', 'lkj', '77555', '5685', 'lkj', 'lkj', 'lkj', 5685, '0', NULL),
('lalin', '1423', 'lalin', '999', '123456789', 'masculino', 'casado', 'correogenerico@hotmail.com', 1234567, '0', 'fotos/carta.jpg'),
('lalos', '123', 'lalos', '888888', '1233456789', 'masculino', 'casado', 'correogenerico@hotmail.com', 1234567, '1', 'fotos/1454577469347.jpg'),
('Guardian Tresh', '123', 'lalos', '1', '1233456789', 'masculino', 'casado', 'correogenerico@hotmail.com', 1234567, '1', 'fotos/1461899693492.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empfullname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
