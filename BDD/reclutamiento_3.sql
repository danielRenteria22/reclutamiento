-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-01-2019 a las 01:26:46
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

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `promedio_ponderaciones` (`id_solicitud` INT) RETURNS DOUBLE BEGIN
	DECLARE peso int;
    DECLARE calificacion int;
	DECLARE suma int;
    DECLARE producto int;
    DECLARe suma_producto int;
    DECLARE promedio double;
    
    #variable booleana de control
    declare fin_cursor int default false; #cuando llegueos al final, cambiar a true
    #consulta select (cursor)
    declare cursor_respuestas cursor for
		SELECT a.calificacion,b.peso FROM respuestas_ponderaciones a INNER JOIN detalle_ponderacion b ON a.id_detalle_ponderacion = b.id WHERE a.id_solicitud = id_solicitud;
    #manejador (handler) para la variable booleana
    declare continue handler for not found set fin_cursor = true;
    
    SET suma = 0;
    SET suma_producto = 0;
    
    #usar cursos
    open cursor_respuestas;
    #usamos un ciclo para recorrerlo
    ciclo_cursor: loop
		#equivalente de iterate
        fetch cursor_respuestas into calificacion,peso;
        #al llegar al final se prodce la excepcion
        #not found, cambiamos la varbale fin_cursor a true
        if fin_cursor then
			leave ciclo_cursor;
		else 
			SET producto = calificacion * peso;
            SET suma = suma + peso;
            SET suma_producto = suma_producto + producto;
		end if;
    end loop;
    
    SET promedio = suma_producto / suma;
    
    RETURN promedio;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `promedio_referencias` (`id_solicitud_` INT) RETURNS DOUBLE BEGIN

	declare promedio double;
	SELECT AVG(calificacion) INTO promedio FROM referencias_personal
    WHERE id_solicitud = id_solicitud_;
    
    return promedio;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonos`
--

CREATE TABLE `bonos` (
  `id` int(75) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(75) NOT NULL,
  `entrevista` double DEFAULT NULL,
  `ponderacion` double DEFAULT NULL,
  `referencia` double DEFAULT NULL,
  `id_solicitud` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `entrevista`, `ponderacion`, `referencia`, `id_solicitud`) VALUES
(1, 1, 9.1875, 7, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(50) NOT NULL,
  `id_employee` int(50) NOT NULL,
  `comentario` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `contratoid` int(20) NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `empleadorid` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`contratoid`, `tipo`, `empleadorid`) VALUES
(2, 'otro contrato', 9),
(3, 'nuevo', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario_cancelacion_solicitud`
--

CREATE TABLE `cuestionario_cancelacion_solicitud` (
  `id_pregunta` int(11) NOT NULL,
  `pregunta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuestionario_cancelacion_solicitud`
--

INSERT INTO `cuestionario_cancelacion_solicitud` (`id_pregunta`, `pregunta`) VALUES
(1, 'Pregunta 1 Edit'),
(2, 'Pregunta 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario_referencias`
--

CREATE TABLE `cuestionario_referencias` (
  `id_cuestionario_referencias` int(11) NOT NULL,
  `pregunta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuestionario_referencias`
--

INSERT INTO `cuestionario_referencias` (`id_cuestionario_referencias`, `pregunta`) VALUES
(1, 'Pregunta 1 Edit'),
(4, 'Pregunta 2'),
(6, 'Pregunta 3'),
(7, 'Pregunta 5'),
(8, 'otra pregunta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ponderacion`
--

CREATE TABLE `detalle_ponderacion` (
  `id` int(50) NOT NULL,
  `id_ponderacion` int(50) NOT NULL,
  `nombre_campo` varchar(50) NOT NULL,
  `peso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_ponderacion`
--

INSERT INTO `detalle_ponderacion` (`id`, `id_ponderacion`, `nombre_campo`, `peso`) VALUES
(1, 1, 'Consideracion 5', '3'),
(2, 1, 'Consideracion 2', '5'),
(3, 2, 'Con 1 Edit', '5'),
(4, 2, 'Con 2 Edit2', '6'),
(5, 2, 'Con 3 Edit 3', '2'),
(6, 2, 'Con 4 Edit 3', '5'),
(7, 2, 'Con 5', '7'),
(12, 2, 'asd', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleador`
--

CREATE TABLE `empleador` (
  `empid` int(11) NOT NULL,
  `empleado` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleador`
--

INSERT INTO `empleador` (`empid`, `empleado`, `nombre`) VALUES
(6, 'asi me llamo', 'Empleador 6'),
(9, 'nombre', 'Empleador 9');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `rfc`, `direccion`, `logo`) VALUES
(1, 'Patito', 'APOMDOM78', 'Calle olivos #31, Fraccionamiento Las Huertas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrevista`
--

CREATE TABLE `entrevista` (
  `id` int(50) NOT NULL,
  `id_formato_entrevista` int(50) NOT NULL,
  `id_solicitud` int(50) NOT NULL,
  `calificacion` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrevista`
--

INSERT INTO `entrevista` (`id`, `id_formato_entrevista`, `id_solicitud`, `calificacion`, `nombre`) VALUES
(1, 1, 1, '10', 'mi nombre'),
(2, 1, 13, '10', 'mi otro nombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_req`
--

CREATE TABLE `estado_req` (
  `id` int(11) NOT NULL,
  `idRequisision` int(11) NOT NULL,
  `idPaso` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `autorizacion` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_req`
--

INSERT INTO `estado_req` (`id`, `idRequisision`, `idPaso`, `idUsuario`, `fecha`, `autorizacion`) VALUES
(1, 12, 1, 123, '2018-11-08', 1),
(2, 12, 2, 5, '2018-12-20', 1),
(3, 12, 3, 6, '2018-12-23', 1),
(4, 12, 4, 6, '2018-12-23', 1),
(5, 12, 5, 6, '2018-12-23', 1),
(7, 13, 1, 6, '2018-12-23', 1),
(8, 13, 2, 6, '2018-12-23', 1),
(9, 13, 3, 6, '2018-12-23', 1),
(10, 13, 4, 6, '2018-12-23', 1),
(11, 13, 5, NULL, NULL, 0),
(12, 14, 1, 6, '2018-12-23', 1),
(13, 14, 2, 6, '2018-12-23', 1),
(14, 14, 3, 6, '2018-12-23', 1),
(15, 14, 4, 6, '2018-12-23', 1),
(16, 14, 5, 6, '2018-12-23', 1),
(17, 15, 1, 6, '2018-12-23', 1),
(18, 15, 2, 6, '2018-12-23', 1),
(19, 15, 3, 6, '2018-12-23', 1),
(20, 15, 4, 6, '2018-12-23', 1),
(21, 15, 5, 6, '2018-12-23', 1),
(22, 16, 1, NULL, NULL, 0),
(23, 16, 2, NULL, NULL, 0),
(24, 16, 3, NULL, NULL, 0),
(25, 16, 4, NULL, NULL, 0),
(26, 16, 5, NULL, NULL, 0);

--
-- Disparadores `estado_req`
--
DELIMITER $$
CREATE TRIGGER `estado_req_AFTER_UPDATE` AFTER UPDATE ON `estado_req` FOR EACH ROW BEGIN
DECLARE total_pasos int;
    DECLARE pasos_autorizados int;
    DECLARE id_req int;
    
    SET id_req = NEW.idRequisision;
    SELECT COUNT(*) INTO total_pasos FROM estado_req WHERE idRequisision = id_req;
    SELECT COUNT(*) INTO pasos_autorizados FROM estado_req WHERE idRequisision = id_req AND autorizacion = 1;
    
    IF total_pasos = pasos_autorizados THEN
    UPDATE  requisicion SET autorizacion= 1 WHERE id = id_req;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id` int(50) NOT NULL,
  `id_detalle_ponderacion` int(50) DEFAULT NULL,
  `id_solicitud` int(50) NOT NULL,
  `calificacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factores_clave`
--

CREATE TABLE `factores_clave` (
  `id` int(50) NOT NULL,
  `id_competencia` int(50) NOT NULL,
  `desc_factor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_entrevista`
--

CREATE TABLE `formato_entrevista` (
  `id` int(50) NOT NULL,
  `competencia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formato_entrevista`
--

INSERT INTO `formato_entrevista` (`id`, `competencia`) VALUES
(1, 'no se');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuentes_talento`
--

CREATE TABLE `fuentes_talento` (
  `id` int(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `cont` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones_especiales`
--

CREATE TABLE `funciones_especiales` (
  `id` int(50) NOT NULL,
  `id_perfil` int(50) NOT NULL,
  `funcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funciones_especiales`
--

INSERT INTO `funciones_especiales` (`id`, `id_perfil`, `funcion`) VALUES
(1, 3, 'limpiar especial'),
(2, 3, 'prueba especial'),
(4, 3, 'esto es particular'),
(5, 1, 'prueba'),
(6, 1, 'particular'),
(7, 1, 'en comex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones_gles`
--

CREATE TABLE `funciones_gles` (
  `id` int(50) NOT NULL,
  `id_perfil` int(50) NOT NULL,
  `funcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funciones_gles`
--

INSERT INTO `funciones_gles` (`id`, `id_perfil`, `funcion`) VALUES
(1, 3, 'limpiar general'),
(3, 1, 'try'),
(4, 1, 'cath'),
(5, 1, 'd'),
(6, 1, 'another'),
(7, 2, 'one'),
(8, 3, 'bites'),
(9, 4, 'the'),
(10, 5, 'dust'),
(11, 0, 'another'),
(12, 0, 'dfdf'),
(13, 0, 'sa'),
(14, 0, 'yyy'),
(15, 0, 'fghj'),
(16, 0, 'yy'),
(18, 3, 'try'),
(19, 3, 'catch'),
(20, 3, 'funcionas?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `groupname` varchar(50) NOT NULL DEFAULT '',
  `groupid` int(10) NOT NULL,
  `officeid` int(10) NOT NULL DEFAULT '0',
  `nombre` varchar(75) NOT NULL,
  `rfc` varchar(75) NOT NULL,
  `direccion` varchar(75) NOT NULL,
  `correo` varchar(75) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`groupname`, `groupid`, `officeid`, `nombre`, `rfc`, `direccion`, `correo`) VALUES
('Workers', 1, 1, '', '', '', ''),
('tengo nombre cambiado', 6, 4, '', '', '', ''),
('OtroGrupoMas', 3, 2, '', '', '', ''),
('algun nombre', 7, 2, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `killer_question`
--

CREATE TABLE `killer_question` (
  `id` int(50) NOT NULL,
  `id_perfil` int(50) NOT NULL,
  `pregunta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `killer_question`
--

INSERT INTO `killer_question` (`id`, `id_perfil`, `pregunta`) VALUES
(1, 3, 'avaaf'),
(2, 6, 'taco'),
(3, 3, ''),
(4, 3, ''),
(5, 3, ''),
(6, 3, ''),
(7, 3, ''),
(8, 3, 'p'),
(9, 3, 'ty'),
(10, 3, ''),
(11, 3, 'dd'),
(12, 3, 'asca'),
(13, 3, 'u'),
(14, 3, 'yyyy'),
(15, 3, 'yyyy'),
(16, 3, 'dsdsd'),
(17, 3, 'asdf'),
(18, 3, 'ssss'),
(19, 3, 'ssss'),
(20, 3, 'ssss'),
(21, 3, 'r'),
(22, 3, 'p'),
(23, 3, 'yyyy'),
(24, 3, 'f'),
(25, 3, 't'),
(26, 3, 'dsdsdfsdgsegsegf'),
(27, 3, 'esto es una prueba'),
(28, 3, 'esto es una prueba'),
(29, 3, 'esto es una prueba'),
(31, 3, 'ahora con no'),
(32, 1, 'que haces?'),
(33, 1, 'prueba en kq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercado`
--

CREATE TABLE `mercado` (
  `id` int(75) NOT NULL,
  `mercado` enum('Interno','Externo','','') NOT NULL,
  `id_empleado` int(75) NOT NULL,
  `id_obra` int(75) NOT NULL,
  `id_cliente` int(75) NOT NULL,
  `id_ciudad` int(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offices`
--

CREATE TABLE `offices` (
  `officename` varchar(50) NOT NULL DEFAULT '',
  `officeid` int(10) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `rfc` varchar(75) NOT NULL,
  `direccion` varchar(75) NOT NULL,
  `correo` varchar(75) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `offices`
--

INSERT INTO `offices` (`officename`, `officeid`, `nombre`, `rfc`, `direccion`, `correo`) VALUES
('Office', 1, '', '', '', ''),
('UnaOfficeMas', 2, '', '', '', ''),
('prueba', 5, 'prueba', 'prueba', 'prueba', 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasos_reclutamiento`
--

CREATE TABLE `pasos_reclutamiento` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nivel_auto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasos_reclutamiento`
--

INSERT INTO `pasos_reclutamiento` (`id`, `nombre`, `nivel_auto`) VALUES
(4, 'Desarrollo', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasos_requisicion`
--

CREATE TABLE `pasos_requisicion` (
  `id` int(50) NOT NULL,
  `id_permisos` int(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasos_requisicion`
--

INSERT INTO `pasos_requisicion` (`id`, `id_permisos`, `numero`, `nombre`) VALUES
(1, 3, '', 'Creacion'),
(2, 3, '', 'Paso 2'),
(3, 5, '', 'Algo 2'),
(4, 5, '', 'Algo 4'),
(5, 5, '', 'Creacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_obra` int(11) NOT NULL,
  `id_ponderacion` int(11) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `id_empleador` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `fecha_inicio` int(11) NOT NULL,
  `tipo_de_contrato` int(11) NOT NULL,
  `sueldo` int(11) NOT NULL,
  `tope_de_bonos` int(11) NOT NULL,
  `descripcion_del_puesto` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `vacante` varchar(50) NOT NULL,
  `id_bonos` int(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `id_cliente`, `id_obra`, `id_ponderacion`, `id_ciudad`, `id_empleador`, `id_contrato`, `fecha_inicio`, `tipo_de_contrato`, `sueldo`, `tope_de_bonos`, `descripcion_del_puesto`, `nombre`, `vacante`, `id_bonos`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', 'Comex', '0', 0),
(3, 1, 1, 1, 1, 1, 1, 1997, 1, 123456, 55, 'jefe de departamento', 'encargado', 'comex', 0),
(4, 7, 1, 1, 1, 6, 2, 0, 0, 1234, 1234, 'trabajar', 'otro nombre', 'trabajo', 0),
(5, 7, 1, 1, 1, 6, 2, 0, 0, 123, 123, 'facil', 'nuevo perfil', 'alguna', 0),
(6, 3, 4, 2, 2, 6, 2, 0, 0, 0, 0, 'una', 'aqui', 'es', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_empleado`
--

CREATE TABLE `perfil_empleado` (
  `id` int(75) NOT NULL,
  `id_perfil` int(75) NOT NULL,
  `id_empleado` int(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(3, 'Administrador'),
(4, 'Cliente'),
(5, 'Reclutador'),
(6, 'we'),
(7, 'olo'),
(8, 'otro nivel de ejemplo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponderaciones`
--

CREATE TABLE `ponderaciones` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ponderaciones`
--

INSERT INTO `ponderaciones` (`id`, `nombre`) VALUES
(1, 'Ponderacion 1'),
(2, 'Ponderacion 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta_entrevista`
--

CREATE TABLE `pregunta_entrevista` (
  `id_pregunta_entrevista` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `id_entrevista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pregunta_entrevista`
--

INSERT INTO `pregunta_entrevista` (`id_pregunta_entrevista`, `pregunta`, `id_entrevista`) VALUES
(9, 'Pregunta 1', 4),
(10, 'Pregunta 2', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id` int(50) NOT NULL,
  `id_solicitud` int(50) NOT NULL,
  `id_pasos_reclutamiento` int(50) NOT NULL,
  `id_autorizacion` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias_personal`
--

CREATE TABLE `referencias_personal` (
  `id` int(50) NOT NULL,
  `id_solicitud` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `relacion` varchar(50) NOT NULL,
  `comentario` varchar(50) NOT NULL,
  `calificacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `referencias_personal`
--

INSERT INTO `referencias_personal` (`id`, `id_solicitud`, `nombre`, `telefono`, `relacion`, `comentario`, `calificacion`) VALUES
(1, 2, 'no tengo', '123456', 'tampoco', '', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisicion`
--

CREATE TABLE `requisicion` (
  `id` int(50) NOT NULL,
  `id_encargado` int(50) NOT NULL,
  `id_reclutador` int(50) NOT NULL,
  `id_perfil` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `mercado_interno` tinyint(1) NOT NULL,
  `mercado_externo` tinyint(1) NOT NULL,
  `autorizacion` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creacion` date NOT NULL,
  `fecha_contratacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `requisicion`
--

INSERT INTO `requisicion` (`id`, `id_encargado`, `id_reclutador`, `id_perfil`, `nombre`, `mercado_interno`, `mercado_externo`, `autorizacion`, `fecha_creacion`, `fecha_contratacion`) VALUES
(1, 4697, 6, 1, 'Req 1', 1, 1, 0, '0000-00-00', NULL),
(2, 4697, 6, 1, 'Req 2', 1, 1, 0, '2018-11-05', NULL),
(5, 4697, 6, 1, 'trttrbr', 0, 0, 0, '2018-11-05', NULL),
(6, 4697, 6, 1, 'sdcvwrvwrv', 0, 0, 0, '2018-11-05', NULL),
(7, 4697, 6, 1, 'erververv', 0, 0, 0, '2018-11-05', NULL),
(8, 4697, 6, 1, 'tyty', 0, 0, 0, '2018-11-05', NULL),
(9, 4697, 6, 1, 'rgtg', 0, 0, 0, '2018-11-05', NULL),
(10, 4697, 6, 1, 'Ultima prueba', 0, 0, 0, '2018-11-05', NULL),
(11, 4697, 6, 1, 'Ultima prueba', 0, 0, 0, '2018-11-05', NULL),
(12, 4697, 6, 1, 'Prueba finL 2 Eitada', 1, 1, 0, '2018-11-05', NULL),
(13, 1, 1, 1, 'prueba', 1, 1, 0, '2018-12-22', NULL),
(14, 1, 1, 6, 'req de prueba', 1, 1, 1, '2018-12-23', NULL),
(15, 1, 1, 6, 'otro nombre', 1, 1, 1, '2018-12-23', NULL),
(16, 6, 6, 6, 'por los jajas', 1, 1, 0, '2018-12-23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(50) NOT NULL,
  `id_killer_question` int(50) NOT NULL,
  `respuesta` varchar(50) NOT NULL,
  `descalificar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `id_killer_question`, `respuesta`, `descalificar`) VALUES
(1, 27, 'Si', 'Si'),
(2, 28, 'Si', 'Si'),
(3, 29, 'Si', 'Si'),
(5, 31, 'No', 'No'),
(6, 32, 'Si', 'Si'),
(7, 33, 'Si', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_cuestionario_referencias`
--

CREATE TABLE `respuestas_cuestionario_referencias` (
  `id_respuesta` int(11) NOT NULL,
  `id_referencia` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `id_cuestionario_referencias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuestas_cuestionario_referencias`
--

INSERT INTO `respuestas_cuestionario_referencias` (`id_respuesta`, `id_referencia`, `respuesta`, `id_cuestionario_referencias`) VALUES
(4, 1, 'Res 1', 1),
(5, 1, 'Res 2', 4),
(6, 1, 'Res3', 5),
(7, 1, 'wererg', 1),
(8, 1, 'ergerg', 4),
(9, 1, 'ergerg', 6),
(10, 1, 'ergerg', 7),
(11, 1, 'lalo', 1),
(12, 1, 'estuvo', 4),
(13, 1, 'aqui', 6),
(14, 1, 'en la maÃ±ana', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_ponderaciones`
--

CREATE TABLE `respuestas_ponderaciones` (
  `id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_detalle_ponderacion` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuestas_ponderaciones`
--

INSERT INTO `respuestas_ponderaciones` (`id`, `id_solicitud`, `id_detalle_ponderacion`, `calificacion`) VALUES
(13, 2, 1, 3),
(14, 2, 2, 7),
(15, 1, 1, 7),
(16, 1, 2, 10),
(17, 3, 1, 5),
(18, 3, 2, 5),
(19, 3, 1, 5),
(20, 3, 2, 5),
(21, 12, 1, 10),
(22, 12, 2, 7),
(23, 13, 1, 10),
(24, 13, 2, 8),
(25, 13, 1, 9),
(26, 13, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_entrevista`
--

CREATE TABLE `respuesta_entrevista` (
  `id_respuesta_entrevista` int(11) NOT NULL,
  `id_pregunta_entrevista` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta_entrevista`
--

INSERT INTO `respuesta_entrevista` (`id_respuesta_entrevista`, `id_pregunta_entrevista`, `respuesta`, `id_solicitud`) VALUES
(9, 4, '0', 1),
(10, 6, '1', 1),
(11, 7, '3', 1),
(12, 8, '4', 1),
(13, 9, 'Respuesta 1', 1),
(14, 10, 'Respuesta 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resp_killer_questions`
--

CREATE TABLE `resp_killer_questions` (
  `id` int(50) NOT NULL,
  `id_solicitud` int(50) NOT NULL,
  `id_killer_question` int(50) NOT NULL,
  `id_respuesta` int(50) NOT NULL,
  `respuesta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resp_killer_questions`
--

INSERT INTO `resp_killer_questions` (`id`, `id_solicitud`, `id_killer_question`, `id_respuesta`, `respuesta`) VALUES
(1, 3, 32, 6, ''),
(2, 3, 33, 7, ''),
(3, 4, 32, 6, ''),
(4, 4, 33, 7, ''),
(5, 5, 32, 6, ''),
(6, 5, 33, 7, ''),
(7, 6, 32, 6, ''),
(8, 6, 33, 7, ''),
(9, 7, 32, 6, 'No'),
(10, 7, 33, 7, 'Si'),
(11, 8, 32, 6, 'Si'),
(12, 8, 33, 7, 'Si'),
(13, 9, 32, 6, 'No'),
(14, 9, 33, 7, 'No'),
(15, 10, 32, 6, 'Si'),
(16, 10, 33, 7, 'No'),
(17, 12, 32, 6, 'Si'),
(18, 12, 33, 7, 'Si'),
(19, 13, 32, 6, 'Si'),
(20, 13, 33, 7, 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(50) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `id_requisicion` int(50) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `calificacion_entrevista` int(11) DEFAULT NULL,
  `descalificado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `id_usuario`, `id_requisicion`, `fecha`, `calificacion_entrevista`, `descalificado`) VALUES
(1, 9999, 2, 'hoy', NULL, 0),
(2, 1, 12, '2018/12/19', NULL, 0),
(3, 9999, 1, '2018/12/23', 0, 0),
(4, 9999, 5, '2018/12/23', 0, 0),
(5, 9999, 10, '2018/12/23', 0, 0),
(6, 9999, 12, '2018/12/23', 0, 0),
(7, 9999, 11, '2018/12/23', 0, 0),
(8, 2726, 1, '2018/12/23', 0, 0),
(9, 2726, 2, '2018/12/23', 0, 0),
(10, 2726, 5, '2018/12/23', 0, 0),
(11, 9999, 16, '2018/12/23', 0, 0),
(12, 999, 1, '2018/12/23', 0, 0),
(13, 999, 2, '2018/12/23', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `telefonoid` int(20) NOT NULL,
  `workid` varchar(50) DEFAULT NULL,
  `numero` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `telefonos`
--

INSERT INTO `telefonos` (`telefonoid`, `workid`, `numero`) VALUES
(1, 'Alsuper', '6784512'),
(2, 'Alsuper', '698547123'),
(3, 'Alsuper', '1234567'),
(5, 'www', '159753'),
(6, 'eee', 'eee'),
(7, 'prueba', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `jobid` int(20) NOT NULL,
  `employid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `officeid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `groupid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `workid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `turnid` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`jobid`, `employid`, `officeid`, `groupid`, `workid`, `turnid`) VALUES
(15, 'Prueba Editarme', 'UnaOfficeMas', 'OtroGrupoMas', 'UnWorkMas', 'torn'),
(16, 'aver', 'Office', 'Workers', 'Alsuper', 'dia'),
(17, 'yo tengo turno', 'Office', 'Workers', 'Alsuper', 'dia'),
(20, 'yo tengo turno', 'Office', 'Workers', 'Alsuper', 'tarde'),
(21, 'p', 'Office', 'Workers', 'Alsuper', 'dia'),
(22, 'yo tengo turno', 'UnaOfficeMas', 'OtroGrupoMas', 'UnWorkMas', 'torn'),
(23, 'ultimo', 'UnaOfficeMas', 'OtroGrupoMas', 'UnWorkMas', 'tunini'),
(27, 'iiiiiii', 'Office', 'Workers', 'Alsuper', 'dia'),
(28, 'facil', 'UnaOfficeMas', 'OtroGrupoMas', 'UnWorkMas', 'tunini'),
(29, 'Oboru', 'UnaOfficeMas', 'OtroGrupoMas', 'UnWorkMas', 'tunini'),
(30, 'cliente', 'UnaOfficeMas', 'OtroGrupoMas', 'UnWorkMas', 'tunini'),
(31, 'ciudad', 'UnaOfficeMas', 'OtroGrupoMas', 'UnWorkMas', 'tunini'),
(32, 'asi', 'Office', 'Workers', 'Alsuper', 'dia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turn`
--

CREATE TABLE `turn` (
  `turnid` int(20) UNSIGNED ZEROFILL NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `inicio` int(10) DEFAULT NULL,
  `fin` int(10) DEFAULT NULL,
  `IDWork` varchar(50) DEFAULT NULL,
  `L` int(1) NOT NULL DEFAULT '0',
  `MA` int(1) NOT NULL DEFAULT '0',
  `MI` int(1) NOT NULL DEFAULT '0',
  `J` int(1) NOT NULL DEFAULT '0',
  `V` int(1) NOT NULL DEFAULT '0',
  `S` int(1) NOT NULL DEFAULT '0',
  `D` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turn`
--

INSERT INTO `turn` (`turnid`, `nombre`, `inicio`, `fin`, `IDWork`, `L`, `MA`, `MI`, `J`, `V`, `S`, `D`) VALUES
(00000000000000000001, 'dia', 8, 16, 'Alsuper', 0, 0, 0, 0, 0, 0, 0),
(00000000000000000003, 'noche', 22, 6, 'Alsuper', 0, 0, 0, 0, 0, 0, 0),
(00000000000000000004, 'tunini', 10, 11, 'UnWorkMas', 0, 0, 0, 0, 0, 0, 0),
(00000000000000000007, 'torn', 12, 16, 'UnWorkMas', 0, 0, 0, 0, 0, 0, 0),
(00000000000000000009, 'naci en mi bdd', 12, 12, 'Pruebadesdeweb', 1, 0, 1, 0, 1, 0, 1),
(00000000000000000010, 'probando dias', 11, 11, 'Pruebadesdeweb', 0, 1, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `permisos` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `username`, `nombre`, `apellidos`, `password`, `permisos`, `correo`) VALUES
(1, 'daniel_r', 'Daniel', 'Renteria', '123', 3, 'danial@hotmail.com'),
(5, 'user2', 'Ususario 2', 'Numero 2', '123', 3, 'user2@gmai.com'),
(6, 'lalo', 'Eduardo', 'Alvarado', '123', 5, 'uncorreogenerico@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `works`
--

CREATE TABLE `works` (
  `Workname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `IDWork` int(10) NOT NULL,
  `groupid` int(10) NOT NULL DEFAULT '0',
  `phone` int(12) DEFAULT NULL,
  `nombre` varchar(75) CHARACTER SET utf8 NOT NULL,
  `rfc` varchar(75) CHARACTER SET utf8 NOT NULL,
  `direccion` varchar(75) CHARACTER SET utf8 NOT NULL,
  `correo` varchar(75) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `works`
--

INSERT INTO `works` (`Workname`, `IDWork`, `groupid`, `phone`, `nombre`, `rfc`, `direccion`, `correo`) VALUES
('Alsuper', 1, 1, 123456, '', '', '', ''),
('Pruebadesdeweb', 3, 1, 123456789, '', '', '', ''),
('UnWorkMas', 4, 3, 784512369, '', '', '', ''),
('prueba', 7, 3, 1234, '', '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bonos`
--
ALTER TABLE `bonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`contratoid`);

--
-- Indices de la tabla `cuestionario_cancelacion_solicitud`
--
ALTER TABLE `cuestionario_cancelacion_solicitud`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `cuestionario_referencias`
--
ALTER TABLE `cuestionario_referencias`
  ADD PRIMARY KEY (`id_cuestionario_referencias`);

--
-- Indices de la tabla `detalle_ponderacion`
--
ALTER TABLE `detalle_ponderacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ponderacion` (`id_ponderacion`);

--
-- Indices de la tabla `empleador`
--
ALTER TABLE `empleador`
  ADD PRIMARY KEY (`empid`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empfullname`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrevista`
--
ALTER TABLE `entrevista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_req`
--
ALTER TABLE `estado_req`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factores_clave`
--
ALTER TABLE `factores_clave`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formato_entrevista`
--
ALTER TABLE `formato_entrevista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fuentes_talento`
--
ALTER TABLE `fuentes_talento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funciones_especiales`
--
ALTER TABLE `funciones_especiales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funciones_gles`
--
ALTER TABLE `funciones_gles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupid`);

--
-- Indices de la tabla `killer_question`
--
ALTER TABLE `killer_question`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mercado`
--
ALTER TABLE `mercado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_empleado_2` (`id_empleado`),
  ADD KEY `id_obra` (`id_obra`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`officeid`);

--
-- Indices de la tabla `pasos_reclutamiento`
--
ALTER TABLE `pasos_reclutamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pasos_requisicion`
--
ALTER TABLE `pasos_requisicion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`),
  ADD KEY `id_bonos` (`id_bonos`);

--
-- Indices de la tabla `perfil_empleado`
--
ALTER TABLE `perfil_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ponderaciones`
--
ALTER TABLE `ponderaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pregunta_entrevista`
--
ALTER TABLE `pregunta_entrevista`
  ADD PRIMARY KEY (`id_pregunta_entrevista`),
  ADD KEY `fk_entrevista` (`id_entrevista`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `referencias_personal`
--
ALTER TABLE `referencias_personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas_cuestionario_referencias`
--
ALTER TABLE `respuestas_cuestionario_referencias`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `fk_referencia` (`id_referencia`),
  ADD KEY `fk_pregunta` (`id_cuestionario_referencias`);

--
-- Indices de la tabla `respuestas_ponderaciones`
--
ALTER TABLE `respuestas_ponderaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitud_id` (`id_solicitud`),
  ADD KEY `fk_detalle_ponderracion` (`id_detalle_ponderacion`);

--
-- Indices de la tabla `respuesta_entrevista`
--
ALTER TABLE `respuesta_entrevista`
  ADD PRIMARY KEY (`id_respuesta_entrevista`),
  ADD KEY `fk_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `resp_killer_questions`
--
ALTER TABLE `resp_killer_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`telefonoid`);

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`jobid`);

--
-- Indices de la tabla `turn`
--
ALTER TABLE `turn`
  ADD PRIMARY KEY (`turnid`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_permisos` (`permisos`);

--
-- Indices de la tabla `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`IDWork`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bonos`
--
ALTER TABLE `bonos`
  MODIFY `id` int(75) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(75) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `contratoid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cuestionario_cancelacion_solicitud`
--
ALTER TABLE `cuestionario_cancelacion_solicitud`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuestionario_referencias`
--
ALTER TABLE `cuestionario_referencias`
  MODIFY `id_cuestionario_referencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_ponderacion`
--
ALTER TABLE `detalle_ponderacion`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empleador`
--
ALTER TABLE `empleador`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entrevista`
--
ALTER TABLE `entrevista`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_req`
--
ALTER TABLE `estado_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `formato_entrevista`
--
ALTER TABLE `formato_entrevista`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `funciones_especiales`
--
ALTER TABLE `funciones_especiales`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `funciones_gles`
--
ALTER TABLE `funciones_gles`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `groupid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `killer_question`
--
ALTER TABLE `killer_question`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `offices`
--
ALTER TABLE `offices`
  MODIFY `officeid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pasos_reclutamiento`
--
ALTER TABLE `pasos_reclutamiento`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pasos_requisicion`
--
ALTER TABLE `pasos_requisicion`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `perfil_empleado`
--
ALTER TABLE `perfil_empleado`
  MODIFY `id` int(75) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ponderaciones`
--
ALTER TABLE `ponderaciones`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pregunta_entrevista`
--
ALTER TABLE `pregunta_entrevista`
  MODIFY `id_pregunta_entrevista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `respuestas_cuestionario_referencias`
--
ALTER TABLE `respuestas_cuestionario_referencias`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `respuestas_ponderaciones`
--
ALTER TABLE `respuestas_ponderaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `respuesta_entrevista`
--
ALTER TABLE `respuesta_entrevista`
  MODIFY `id_respuesta_entrevista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `resp_killer_questions`
--
ALTER TABLE `resp_killer_questions`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `works`
--
ALTER TABLE `works`
  MODIFY `IDWork` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ponderacion`
--
ALTER TABLE `detalle_ponderacion`
  ADD CONSTRAINT `detalle_ponderacion_ibfk_1` FOREIGN KEY (`id_ponderacion`) REFERENCES `ponderaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas_ponderaciones`
--
ALTER TABLE `respuestas_ponderaciones`
  ADD CONSTRAINT `fk_detalle_ponderracion` FOREIGN KEY (`id_detalle_ponderacion`) REFERENCES `detalle_ponderacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_solicitud_id` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_permisos` FOREIGN KEY (`permisos`) REFERENCES `permisos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
