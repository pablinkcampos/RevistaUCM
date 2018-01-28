-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-01-2018 a las 17:35:40
-- Versión del servidor: 5.7.20-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `articulos_ucm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo_investigacion`
--

CREATE TABLE `campo_investigacion` (
  `id_campo` int(11) NOT NULL,
  `nombre_campo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `campo_investigacion`
--

INSERT INTO `campo_investigacion` (`id_campo`, `nombre_campo`) VALUES
(9, 'Minería de Datos'),
(10, 'Ingeniería de Software'),
(11, 'Inteligencia Artificial'),
(12, 'Bases de Datos'),
(13, 'Lenguajes de Programación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo_revisor`
--

CREATE TABLE `campo_revisor` (
  `id_campo_usuario` int(11) NOT NULL,
  `id_campo` int(11) NOT NULL,
  `id_revisor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `campo_revisor`
--

INSERT INTO `campo_revisor` (`id_campo_usuario`, `id_campo`, `id_revisor`) VALUES
(3, 11, 14),
(4, 12, 14),
(5, 13, 14),
(6, 9, 15),
(7, 10, 15),
(8, 11, 15),
(9, 12, 15),
(10, 13, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo_usuario`
--

CREATE TABLE `campo_usuario` (
  `id_campo_usuario` int(11) NOT NULL,
  `id_campo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

CREATE TABLE `contenidos` (
  `contenido` varchar(100) NOT NULL,
  `texto_espanol` varchar(10000) NOT NULL,
  `texto_ingles` varchar(10000) NOT NULL,
  `texto_portugues` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contenidos`
--

INSERT INTO `contenidos` (`contenido`, `texto_espanol`, `texto_ingles`, `texto_portugues`) VALUES
('nosotros', 'Somos una entidad Pro en busca de lo mejor.', 'Changed to english', 'cambious to portuguese'),
('numeros', 'Algo de utilidad puede tener, añadir lo que se desee en este item.', 'Changed to English', 'Camboya to portugueses'),
('politicas', '<p><span style="font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>\r\n<pre style="padding-left: 60px;"><strong><span style="font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;">1. Mas politicas</span></strong><br /><br /><strong><span style="font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;">2. Menos politicas</span></strong></pre>\r\n<p style="text-align: center;"><em><strong><span style="font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;">Recordar que las pol&iacute;ticas son imperantes.</span></strong></em></p>\r\n<p>&nbsp;</p>', 'Changed to english', 'cambuite to portuguese');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(1, 'En Espera'),
(3, 'Asignado'),
(4, 'Rechazado'),
(5, 'Aceptado'),
(6, 'Aceptado con comentarios'),
(7, 'En Edicion'),
(8, 'Publicado'),
(9, 'Rechazado por TimeOut'),
(10, 'Incluye Modificaciones'),
(11, 'No incluye Modificaciones'),
(12, 'Esperando PDF paginado'),
(13, 'PDF Paginado Recibido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `final_magazine`
--

CREATE TABLE `final_magazine` (
  `ID` int(11) NOT NULL,
  `ID_articulo` int(11) NOT NULL,
  `ID_magazine` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `pagina_inicio` int(11) NOT NULL,
  `pagina_fin` int(11) NOT NULL,
  `file_papper` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `final_magazine`
--

INSERT INTO `final_magazine` (`ID`, `ID_articulo`, `ID_magazine`, `titulo`, `pagina_inicio`, `pagina_fin`, `file_papper`) VALUES
(6, 12, 4, 'Discovering and Modeling of Information of the Business Process ', 1, 8, 'Discovering_and_Modeling_of_Information_of_the_Business_Process_moises_intech@gmail_com2017-12-16_01_24_33.docx.pdf'),
(7, 10, 4, 'Practica Docente en la asignatura Algoritmos y Estructuras de Datos', 9, 15, 'Practica_Docente_en_la_asignatura_Algoritmos_y_Estructuras_de_Datosmoises_intech@gmail_com2017-12-16_00_51_42.doc.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `clave` varchar(500) NOT NULL,
  `rol_fk` int(11) NOT NULL,
  `rol2_fk` int(11) DEFAULT NULL,
  `rol3_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`ID`, `correo`, `clave`, `rol_fk`, `rol2_fk`, `rol3_fk`) VALUES
(1, 'editor@ucm.cl', 'ec9b2638a2fd1b542fd317b0fcc8b81ec2347337', 1, NULL, NULL),
(12, 'No Asignado', 'No Asignado', 2, NULL, NULL),
(13, 'moises.intech@gmail.com', 'ec9b2638a2fd1b542fd317b0fcc8b81ec2347337', 3, NULL, NULL),
(14, 'mssflrs@gmail.com', 'e01b2a394f08c26397efbc4f9497eac96d7ef122', 2, NULL, NULL),
(15, 'mtoranzo@ucm.cl', '7465671ffdf66dcc67aa36faecb3f6f76dfd3069', 3, NULL, NULL),
(16, 'marcotoranzo@hotmail.com', '7465671ffdf66dcc67aa36faecb3f6f76dfd3069', 3, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `magazines`
--

CREATE TABLE `magazines` (
  `ID` int(11) NOT NULL,
  `titulo_revista` varchar(100) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_publicacion` varchar(100) NOT NULL,
  `logo_revista` varchar(100) NOT NULL,
  `palabras_editor` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `magazines`
--

INSERT INTO `magazines` (`ID`, `titulo_revista`, `fecha_creacion`, `fecha_publicacion`, `logo_revista`, `palabras_editor`) VALUES
(4, 'Ingeniería de Software', '2017-12-16 06:14:18', 'Diciembre - Enero 2017', '49714Rev.jpg.jpg', 'Investigadores nacionales. Artículos orientados a distintas ramas de la ingeniería de software.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`ID`, `nombre`) VALUES
(1, 'Australia'),
(2, 'Austria'),
(3, 'Azerbaiyán'),
(4, 'Anguilla'),
(5, 'Argentina'),
(6, 'Armenia'),
(7, 'Bielorrusia'),
(8, 'Belice'),
(9, 'Bélgica'),
(10, 'Bermudas'),
(11, 'Bulgaria'),
(12, 'Brasil'),
(13, 'Reino Unido'),
(14, 'Hungría'),
(15, 'Vietnam'),
(16, 'Haiti'),
(17, 'Guadalupe'),
(18, 'Alemania'),
(19, 'Países Bajos, Holanda'),
(20, 'Grecia'),
(21, 'Georgia'),
(22, 'Dinamarca'),
(23, 'Egipto'),
(24, 'Israel'),
(25, 'India'),
(26, 'Irán'),
(27, 'Irlanda'),
(28, 'España'),
(29, 'Italia'),
(30, 'Kazajstán'),
(31, 'Camerún'),
(32, 'Canadá'),
(33, 'Chipre'),
(34, 'Kirguistán'),
(35, 'China'),
(36, 'Costa Rica'),
(37, 'Kuwait'),
(38, 'Letonia'),
(39, 'Libia'),
(40, 'Lituania'),
(41, 'Luxemburgo'),
(42, 'México'),
(43, 'Moldavia'),
(44, 'Mónaco'),
(45, 'Nueva Zelanda'),
(46, 'Noruega'),
(47, 'Polonia'),
(48, 'Portugal'),
(49, 'Reunión'),
(50, 'Rusia'),
(51, 'El Salvador'),
(52, 'Eslovaquia'),
(53, 'Eslovenia'),
(54, 'Surinam'),
(55, 'Estados Unidos'),
(56, 'Tadjikistan'),
(57, 'Turkmenistan'),
(58, 'Islas Turcas y Caicos'),
(59, 'Turquía'),
(60, 'Uganda'),
(61, 'Uzbekistán'),
(62, 'Ucrania'),
(63, 'Finlandia'),
(64, 'Francia'),
(65, 'República Checa'),
(66, 'Suiza'),
(67, 'Suecia'),
(68, 'Estonia'),
(69, 'Corea del Sur'),
(70, 'Japón'),
(71, 'Croacia'),
(72, 'Rumanía'),
(73, 'Hong Kong'),
(74, 'Indonesia'),
(75, 'Jordania'),
(76, 'Malasia'),
(77, 'Singapur'),
(78, 'Taiwan'),
(79, 'Bosnia y Herzegovina'),
(80, 'Bahamas'),
(81, 'Chile'),
(82, 'Colombia'),
(83, 'Islandia'),
(84, 'Corea del Norte'),
(85, 'Macedonia'),
(86, 'Malta'),
(87, 'Pakistán'),
(88, 'Papúa-Nueva Guinea'),
(89, 'Perú'),
(90, 'Filipinas'),
(91, 'Arabia Saudita'),
(92, 'Tailandia'),
(93, 'Emiratos árabes Unidos'),
(94, 'Groenlandia'),
(95, 'Venezuela'),
(96, 'Zimbabwe'),
(97, 'Kenia'),
(98, 'Algeria'),
(99, 'Líbano'),
(100, 'Botsuana'),
(101, 'Tanzania'),
(102, 'Namibia'),
(103, 'Ecuador'),
(104, 'Marruecos'),
(105, 'Ghana'),
(106, 'Siria'),
(107, 'Nepal'),
(108, 'Mauritania'),
(109, 'Seychelles'),
(110, 'Paraguay'),
(111, 'Uruguay'),
(112, 'Congo (Brazzaville)'),
(113, 'Cuba'),
(114, 'Albania'),
(115, 'Nigeria'),
(116, 'Zambia'),
(117, 'Mozambique'),
(119, 'Angola'),
(120, 'Sri Lanka'),
(121, 'Etiopía'),
(122, 'Túnez'),
(123, 'Bolivia'),
(124, 'Panamá'),
(125, 'Malawi'),
(126, 'Liechtenstein'),
(127, 'Bahrein'),
(128, 'Barbados'),
(130, 'Chad'),
(131, 'Man, Isla de'),
(132, 'Jamaica'),
(133, 'Malí'),
(134, 'Madagascar'),
(135, 'Senegal'),
(136, 'Togo'),
(137, 'Honduras'),
(138, 'República Dominicana'),
(139, 'Mongolia'),
(140, 'Irak'),
(141, 'Sudáfrica'),
(142, 'Aruba'),
(143, 'Gibraltar'),
(144, 'Afganistán'),
(145, 'Andorra'),
(147, 'Antigua y Barbuda'),
(149, 'Bangladesh'),
(151, 'Benín'),
(152, 'Bután'),
(154, 'Islas Virgenes Británicas'),
(155, 'Brunéi'),
(156, 'Burkina Faso'),
(157, 'Burundi'),
(158, 'Camboya'),
(159, 'Cabo Verde'),
(164, 'Comores'),
(165, 'Congo (Kinshasa)'),
(166, 'Cook, Islas'),
(168, 'Costa de Marfil'),
(169, 'Djibouti, Yibuti'),
(171, 'Timor Oriental'),
(172, 'Guinea Ecuatorial'),
(173, 'Eritrea'),
(175, 'Feroe, Islas'),
(176, 'Fiyi'),
(178, 'Polinesia Francesa'),
(180, 'Gabón'),
(181, 'Gambia'),
(184, 'Granada'),
(185, 'Guatemala'),
(186, 'Guernsey'),
(187, 'Guinea'),
(188, 'Guinea-Bissau'),
(189, 'Guyana'),
(193, 'Jersey'),
(195, 'Kiribati'),
(196, 'Laos'),
(197, 'Lesotho'),
(198, 'Liberia'),
(200, 'Maldivas'),
(201, 'Martinica'),
(202, 'Mauricio'),
(205, 'Myanmar'),
(206, 'Nauru'),
(207, 'Antillas Holandesas'),
(208, 'Nueva Caledonia'),
(209, 'Nicaragua'),
(210, 'Níger'),
(212, 'Norfolk Island'),
(213, 'Omán'),
(215, 'Isla Pitcairn'),
(216, 'Qatar'),
(217, 'Ruanda'),
(218, 'Santa Elena'),
(219, 'San Cristobal y Nevis'),
(220, 'Santa Lucía'),
(221, 'San Pedro y Miquelón'),
(222, 'San Vincente y Granadinas'),
(223, 'Samoa'),
(224, 'San Marino'),
(225, 'San Tomé y Príncipe'),
(226, 'Serbia y Montenegro'),
(227, 'Sierra Leona'),
(228, 'Islas Salomón'),
(229, 'Somalia'),
(232, 'Sudán'),
(234, 'Swazilandia'),
(235, 'Tokelau'),
(236, 'Tonga'),
(237, 'Trinidad y Tobago'),
(239, 'Tuvalu'),
(240, 'Vanuatu'),
(241, 'Wallis y Futuna'),
(242, 'Sáhara Occidental'),
(243, 'Yemen'),
(246, 'Puerto Rico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `controlador` int(11) NOT NULL,
  `funciones` int(11) NOT NULL,
  `is_authorized` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisor`
--

CREATE TABLE `revisor` (
  `ID` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido_1` varchar(250) NOT NULL,
  `apellido_2` varchar(250) NOT NULL,
  `titulo_academico` varchar(250) NOT NULL,
  `organizacion` varchar(250) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `biografia` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `revisor`
--

INSERT INTO `revisor` (`ID`, `email`, `nombre`, `apellido_1`, `apellido_2`, `titulo_academico`, `organizacion`, `telefono`, `biografia`) VALUES
(0, 'No Asignado', 'No Asignado', '', '', '', '', '', ''),
(14, 'mssflrs@gmail.com', 'Marcelo', 'Silba', 'Insulza', 'Ingeniero', 'Universidad Católica del Maule', '123456789', 'Algo breve'),
(15, 'marcotoranzo@hotmail.com', 'MarcoHotmail', 'ToranzoHotmail', 'CespedesHotmail', 'Dr', 'UCM', '9768987654', 'Discovering ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revista`
--

CREATE TABLE `revista` (
  `ID` int(11) NOT NULL,
  `titulo_revista` varchar(250) NOT NULL,
  `version` int(11) NOT NULL,
  `email_autor` varchar(250) NOT NULL,
  `id_campo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `palabras_claves` varchar(250) NOT NULL,
  `abstract` text NOT NULL,
  `autor_1` varchar(200) DEFAULT NULL,
  `autor_2` varchar(200) DEFAULT NULL,
  `autor_3` varchar(200) DEFAULT NULL,
  `autor_4` varchar(200) DEFAULT NULL,
  `archivo` varchar(250) NOT NULL,
  `comentarios` text NOT NULL,
  `fecha_ultima_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_revisor_1` varchar(250) NOT NULL DEFAULT 'No Asignado',
  `email_revisor_2` varchar(250) NOT NULL DEFAULT 'No Asignado',
  `email_revisor_3` varchar(250) NOT NULL DEFAULT 'No Asignado',
  `comentario_revisor_1` varchar(250) DEFAULT NULL,
  `comentario_revisor_2` varchar(250) DEFAULT NULL,
  `comentario_revisor_3` varchar(250) DEFAULT NULL,
  `comentarios_editor` text,
  `fecha_timeout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `revista`
--

INSERT INTO `revista` (`ID`, `titulo_revista`, `version`, `email_autor`, `id_campo`, `id_estado`, `palabras_claves`, `abstract`, `autor_1`, `autor_2`, `autor_3`, `autor_4`, `archivo`, `comentarios`, `fecha_ultima_upd`, `fecha_ingreso`, `email_revisor_1`, `email_revisor_2`, `email_revisor_3`, `comentario_revisor_1`, `comentario_revisor_2`, `comentario_revisor_3`, `comentarios_editor`, `fecha_timeout`) VALUES
(10, 'Practica Docente en la asignatura Algoritmos y Estructuras de Datos', 1, 'moises.intech@gmail.com', 10, 8, 'Algoritmos Estructuras de Datos', 'La acreditación de carreras universitarias en nuestro ámbito ha permitido que muchas de ellas mejoren sus contenidos curriculares en pos de equiparar y uniformizar saberes fundamentales que un profesional debe poseer. En ese sentido, la acreditación de la Licenciatura en Análisis de Sistemas de la Universidad Nacional de Salta (Argentina) generó cambios positivos a nivel curricular, como así también en cuanto a formación de posgrado, tecnológico, de infraestructura, entre otros. En este trabajo se describen experiencias en el proceso de enseñanza-aprendizaje de una asignatura de 2do año de dicha carrera.', 'Moises Flores Estay', 'Cristian Martínez A.', 'Diego Rodríguez', 'Carlos Nocera', 'Practica_Docente_en_la_asignatura_Algoritmos_y_Estructuras_de_Datosmoises_intech@gmail_com2017-12-16_00_51_42.doc', 'Formato word 97 -2003', '2017-12-16 06:14:18', '2017-12-16 03:51:42', 'mssflrs@gmail.com', 'No Asignado', 'No Asignado', 'No he notado incoherencias ni carencias. Bien elaborado.', NULL, NULL, NULL, '2017-12-20 00:00:00'),
(11, 'Discovery and Modeling of Business Process ', 1, 'moises.intech@gmail.com', 10, 3, 'Methodology, Quality, Gap, Process, Business', 'This article presents the methodology of business process modeling, called Maule, which generates as-is models. The concepts of the methodology (value proposition, user segment, customer relationship, distribution channel, collaborators, influencers, cost structure, sources of income, process rules and data); its emphasis on the discovery of the information of the process; and the interrelated activities that guide process analysts, allow discovery, organization (with table), and process modeling, in top-down fashion. The methodology has been validated and improved with the help of students of Civil Engineering Computer Science, Accountants Auditor and Master of Computer Science of the Universidad Católica del Maule, who applied it in several administrative projects of different type of organizations of Talca. The article presents a case study to illustrate the methodology.  ', 'Moises Flores Estay', 'Marco Toranzo', '', '', 'Discovery_and_Modeling_of_Business_Process_moises_intech@gmail_com2017-12-16_01_20_06.docx', '', '2017-12-24 05:18:35', '2017-12-16 04:20:06', 'mssflrs@gmail.com', 'marcotoranzo@hotmail.com', 'No Asignado', NULL, 'Ok con las observaciones - Aprobado', NULL, NULL, NULL),
(12, 'Discovering and Modeling of Information of the Business Process ', 1, 'moises.intech@gmail.com', 10, 8, 'Methodology, Quality, Gap, Process, Business', 'This article presents the methodology of business process modeling, called Maule, which generates as-is models. The concepts of the methodology (value proposition, user segment, customer relationship, distribution channel, collaborators, influencers, cost structure, sources of income, process rules and data); its emphasis on the discovery of the information of the process; and the interrelated activities that guide process analysts, allow discovery, organization (with table), and process modeling, in top-down fashion. The methodology has been validated and improved with the help of students of Civil Engineering Computer Science, Accountants Auditor and Master of Computer Science of the Universidad Católica del Maule, who applied it in several administrative projects of different type of organizations of Talca. The article presents a case study to illustrate the methodology.  ', 'Moises Flores Estay', 'Marco Toranzo', '', '', 'Discovering_and_Modeling_of_Information_of_the_Business_Process_moises_intech@gmail_com2017-12-16_01_24_33.docx', '', '2017-12-16 06:14:18', '2017-12-16 04:24:33', 'mssflrs@gmail.com', 'No Asignado', 'No Asignado', 'Me parece completo el artículo. Abarcaron todo lo necesario.', NULL, NULL, NULL, '2017-12-20 00:00:00'),
(13, 'Data Mining in GPU', 1, 'moises.intech@gmail.com', 10, 1, 'Big Data Clustering', 'Puede ingresar hasta un máximo de 4 autores para un artículo. El nombre del autor debe ser 1° nombre, 1° apellido, letra inicial segundo apellido.', 'Moises Flores Estay', 'Jonathan Flores Estay', '', '', 'Data_Mining_in_GPUmoises.intech@gmail.com2017-12-27_23_39_07.docx', '', '2017-12-28 02:39:07', '2017-12-28 02:39:07', 'No Asignado', 'No Asignado', 'No Asignado', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Editor'),
(2, 'Revisor'),
(3, 'Autor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido_1` varchar(250) NOT NULL,
  `apellido_2` varchar(250) NOT NULL,
  `titulo_academico` varchar(250) NOT NULL,
  `organizacion` varchar(250) NOT NULL,
  `departamento` varchar(250) NOT NULL,
  `pais` int(11) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `biografia` varchar(1000) NOT NULL,
  `comentario` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `email`, `nombre`, `apellido_1`, `apellido_2`, `titulo_academico`, `organizacion`, `departamento`, `pais`, `telefono`, `biografia`, `comentario`) VALUES
(7, 'moises.intech@gmail.com', 'Moises', 'Flores', 'Estay', 'Licenciado en ciencias de la computación', 'Universidad Católica del maule', 'Informática', 81, '973950383', 'Steven Paul Jobs, más conocido como Steve Jobs, nació un 24 de febrero de 1955. Sus padres biológicos fueron Joanne Carole Schieble y Abdulfattah Jandali (de origen sirio), quienes lo dieron en adopción después de su nacimiento', ''),
(8, 'mtoranzo@ucm.cl', 'Marco', 'Toranzo', 'Cespedes', 'Dr.', 'Universidad Catolica del Maule', 'Computacion e informática de hotmail', 81, '9768987654', 'El Dr. Toranzo...biograf{ian entorno de ejecución para JavaScript construido con el motor de JavaScript V8 de Chrome. Node.js usa un modelo de operaciones E/S sin bloqueo y orientado a eventos, que lo hace liviano y eficiente. El ecosistema de paquetes de Node.js, npm, es el ecosistema mas grande de librerías de código abierto .', 'Comentarios de El Dr. Toranzo.What is Node.js? Node.js is an open source server framework; Node.js is free; Node.js runs on various platforms (Windows, Linux, Unix, Mac OS X, etc.) Node.js uses JavaScript on the server. Why Node.js? Node.js uses asynchronous programming! A common task for a web server can be to open a file on the server and '),
(9, 'marcotoranzo@hotmail.com', 'MarcoHotmail', 'ToranzoHotmail', 'CespedesHotmail', 'Dr', 'UCM', 'Computacion e informática de hotmail', 81, '9768987654', 'Discovering ', 'Discovering ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campo_investigacion`
--
ALTER TABLE `campo_investigacion`
  ADD PRIMARY KEY (`id_campo`);

--
-- Indices de la tabla `campo_revisor`
--
ALTER TABLE `campo_revisor`
  ADD PRIMARY KEY (`id_campo_usuario`),
  ADD KEY `fk_campo_revisor_campo` (`id_campo`);

--
-- Indices de la tabla `campo_usuario`
--
ALTER TABLE `campo_usuario`
  ADD PRIMARY KEY (`id_campo_usuario`),
  ADD KEY `fk_campo_usuario_campo` (`id_campo`);

--
-- Indices de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD PRIMARY KEY (`contenido`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `final_magazine`
--
ALTER TABLE `final_magazine`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `revisor`
--
ALTER TABLE `revisor`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `revista`
--
ALTER TABLE `revista`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campo_investigacion`
--
ALTER TABLE `campo_investigacion`
  MODIFY `id_campo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `campo_revisor`
--
ALTER TABLE `campo_revisor`
  MODIFY `id_campo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `campo_usuario`
--
ALTER TABLE `campo_usuario`
  MODIFY `id_campo_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `final_magazine`
--
ALTER TABLE `final_magazine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `magazines`
--
ALTER TABLE `magazines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `revisor`
--
ALTER TABLE `revisor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `revista`
--
ALTER TABLE `revista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campo_revisor`
--
ALTER TABLE `campo_revisor`
  ADD CONSTRAINT `fk_campo_revisor_campo` FOREIGN KEY (`id_campo`) REFERENCES `campo_investigacion` (`id_campo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `campo_usuario`
--
ALTER TABLE `campo_usuario`
  ADD CONSTRAINT `fk_campo_usuario_campo` FOREIGN KEY (`id_campo`) REFERENCES `campo_investigacion` (`id_campo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
