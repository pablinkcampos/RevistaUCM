-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2018 a las 08:17:02
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(10, 'Inducción a la vida universitaria'),
(11, 'Habilidades Sociales'),
(12, 'Aplicación del conocimiento científico'),
(14, 'Monitoriamiento de estudiantes del primer año'),
(15, 'Pensamiento computacional'),
(16, 'Metodología de enseñanza'),
(17, 'Infraestructura y recursos de apoyo a la enseñanza aprendizaje'),
(18, 'Experiencias de aprendizaje en la disciplina'),
(19, 'Certificaciones'),
(20, 'Prácticas pre-profesionales y profesionales'),
(21, 'Trabajo de título'),
(23, 'Vinculación con el medio'),
(24, 'Certificaciones'),
(25, 'Desarrollo de competencias genéricas'),
(26, 'Desarrollo, evaluación y certificación de competencias'),
(27, 'Diseño curricular'),
(28, 'Gestión académica'),
(29, 'Experiencia en auto-evaluación y acreditación de carrera'),
(31, 'Estudios relacionados con  la profesión'),
(32, 'Ingeniería de clase mundial'),
(33, 'Efectividad y resultado del proceso formativo');

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
(1, 10, 20),
(2, 11, 20),
(3, 12, 20),
(4, 10, 21),
(5, 11, 21),
(6, 12, 21),
(7, 10, 21),
(8, 11, 21);

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
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `max_dia_asig_art` int(11) NOT NULL,
  `max_revi_art` int(11) NOT NULL,
  `max_dia_res_art` int(11) NOT NULL,
  `max_dia_edi_rev_art` int(11) NOT NULL,
  `fecha_configuracion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `max_dia_asig_art`, `max_revi_art`, `max_dia_res_art`, `max_dia_edi_rev_art`, `fecha_configuracion`) VALUES
(1, 1, 2, 3, 4, '2018-02-06 06:46:24'),
(2, 1, 2, 3, 4, '2018-02-14 01:35:39');

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
('coeditor', '<p>Pablo Campos 2</p>\r\n', 'co-edit', 'co-editiñao'),
('comite editor', 'comite editor', 'comite editor', 'comite editor'),
('comite editor asesor', '<p>Pablo Campos 1</p>\r\n\r\n<p>Pablo Campos 2</p>\r\n\r\n<p>Pablo Campos 3</p>\r\n', 'comite editor asesor', 'comite editor asesor'),
('editor', '<p>Pablo Campos</p>\r\n', 'edit', 'editiño'),
('mensaje aceptación', '<p>mensaje por defecto</p>\r\n', '', ''),
('mensaje publicacion', 'mensaje por defecto', '', ''),
('mensaje recepcion', '<p>se ha recepcionado el art&iacute;culo satisfactoriamente</p>\r\n', '', ''),
('nosotros', '<p align=\"justify\"><b>Bienvenidos a la Revista Educación de Calidad en Ingeneiría</b> ,  una revista electrónica   publicada en español y portugués por la Facultad de Ciencias de la Ingeniería de la Universidad Católica del Maule.  La revista \r\n publica trabajos originales e innovadores   de académicos y profesionales que contribuyan, desde diferentes perpectivas,  con la calidad de los resultados  del proceso formativo de ingeniería.</p>\r\n\r\n<p align=\"justify\">La revista fue  creada en 2017  con el propósito de difundir un amplio espectro de temas relacionados, por ejemplo,   con  la formación de los estudiantes de ingeniería, la gestión curricular, experiencias de enseñanza aprendizaje,  vinculación con el medio, y efectividad y resultados del proceso de  formativo.  </p>', 'Changed to english', 'cambious to portuguese'),
('numeros', 'Algo de utilidad puede tener, añadir lo que se desee en este item.', 'Changed to English', 'Camboya to portugueses'),
('politicas', '<!DOCTYPE html>\r\n<html>\r\n 	<body align=\"justify\">\r\n<h2> Normas y políticas editoriales</h2>\r\n		<ol>\r\n			<li>Exclusividad</li>\r\n				<ul>\r\n					<li>Los artículos deben ser resultado de investigaciones de alto nivel académico y/o profesional, que aportan conocimiento original e inédito</li>\r\n					<li> El artículo enviado a la revista no deben estar en proceso de evaluación en otra revista</li>\r\n					<li>Todo colaborador deberá entregar firmada una “Declaración de originalidad del trabajo escrito”, cuyo formato está disponible en la guía del autor</li>\r\n					<li>Se admiten textos en español y portugués. </li>\r\n				</ul>\r\n<br>\r\n			<li>Evaluación</li>\r\n				<ul>	                                     \r\n<li>Todos los artículos serán sometidos a una valoración editorial preliminar por parte del Comité de Redacción, que se reserva el derecho de determinar si los artículos se ajustan a las líneas de interés de la Revista y cumplen con los requisitos indispensables de un artículo científico, así como con todos y cada uno de los lineamientos editoriales aquí establecidos.</li>\r\n 					<li>Las resoluciones del proceso de dictamen son</li>\r\n                                             <ul>\r\n					                     <li>Aprobado para publicar sin cambios</li>\r\n					                       <li>Condicionado a cambios obligatorios sujeto a reenvío. El editor informa  un plazo máximo para enviar las modificaciones. Las correcciones  se colocan al final del archivo, explican los ajustes realizado. Independiente de las evaluaciones de los revisores, el editor tiene la  última opción de aceptar o rechazar el artículo. el autor deberá atender puntualmente las observaciones, adiciones, correcciones, ampliaciones o aclaraciones sugeridas por los árbitros. La/el autor/a tendrá como máximo treinta días naturales como límite para hacer las correcciones. Una vez que el artículo sea corregido siguiendo las recomendaciones, será remitido a los dictaminadores y serán ellos quienes lo consideren finalmente publicable</li>\r\n					                          <li>Rechazado. </li>\r\n                                        </ul>\r\n                       <br>\r\n\r\n                                        </ul>\r\n\r\n			<li>Publicación</li>\r\n				<ul>\r\n					<li>El trabajo podrá ser publicado siempre y cuando su contenido sea compatible con los tiempos, líneas editoriales y temáticas que la Revista dicte en su momento.</li>\r\n					<li> Todo colaborador deberá entregar firmada una “Declaración de originalidad del trabajo escrito”, cuyo formato está disponible en la guía del autor</li>\r\n				</ul>\r\n\r\n\r\n\r\n<br>\r\n			<li>Corrección y edición</li>\r\n				<ul>\r\n					<li>La Revista  Educación de Calidad en Ingeniería se reserva el derecho de incorporar los cambios editoriales y las correcciones de estilo que considere pertinentes de conformidad con los criterios de la Editora y/o de su Comité de Redacción</li>\r\n					 \r\n				</ul>\r\n\r\n\r\n\r\n\r\n\r\n<br>\r\n			<li>Cesión de derechos y difusión del material publicado</li>\r\n				<ul>\r\n					<li>La publicación del artículo implica la cesión por parte de la/el autor/a de los derechos patrimoniales de su artículo, así como su permiso a difundirlo por los medios que se consideren pertinentes, ya sean impresos o electrónicos. Para tal efecto, una vez aceptado el trabajo para su publicación, cada autor deberá firmar una carta de cesión de derechos.</li>\r\n					<li>Sin la \"carta de cesión de derechos\"  no se podrá proceder a la publicación del material</li>\r\n                                         <li>La Revista  autoriza a sus colaboradores a que ofrezcan en sus webs personales o en cualquier repositorio de acceso abierto, una copia de sus trabajos publicados siempre y cuando se mencione específicamente a la Revista Educación de Calidad en Ingeniería como fuente original de procedencia, citando el año y número del ejemplar respectivo y añadiendo el enlace a la página web  de la revista. </li>\r\n				</ul>\r\n\r\n\r\n\r\n\r\n\r\n<br>\r\n			<li>Información para autoras/es</li>\r\n				<ul>\r\n					<li>Descargar la guía del autor: http://45.55.94.205/mak_hum/index.php/Home_principal/plantilla</li>\r\n					 \r\n				</ul>\r\n\r\n\r\n		</ol>\r\n		\r\n	</body>\r\n</html> ', 'Changed to english', 'cambuite to portuguese'),
('produccion editorial', '<p>Pablo Campos</p>\r\n', 'produccion editorial', 'produccion editorial');

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
(6, 10, 4, 'asdasd', 1, 10, 'asdasdmoises_intech@gmail_com2017-12-10_05_01_36.docx.pdf'),
(7, 13, 4, 'gajajsn', 11, 21, 'gajajsnmoises_intech@gmail_com2017-12-10_12_42_14.docx.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lector`
--

CREATE TABLE `lector` (
  `ID` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_1` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_2` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `titulo_academico` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `organizacion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lector`
--

INSERT INTO `lector` (`ID`, `email`, `nombre`, `apellido_1`, `apellido_2`, `titulo_academico`, `organizacion`, `telefono`) VALUES
(1, 'x_pablo_acm@hotmail.cpm', 'pablo', 'lector', 'lector', 'estudiante', 'ucm', '123456789'),
(2, 'x_pablo_acm@hotmail.com', 'pablo', 'lector', 'lector', 'alumno', 'ucm', '123456789'),
(3, 'x_pablo_acm@hotmail.com', 'pablo', 'lector', 'lector', 'alumno', 'ucm', '123456789'),
(4, 'x_pablo_acm@hotmail.com', 'pablo', 'lector', 'lector', 'alumno', 'ucm', '123456789');

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
(13, 'moises.intech@gmail.com', 'ec9b2638a2fd1b542fd317b0fcc8b81ec2347337', 3, 2, NULL),
(14, 'pmgarrido@outlook.com', '7465671ffdf66dcc67aa36faecb3f6f76dfd3069', 3, 555, NULL),
(15, 'a@a.com', '7465671ffdf66dcc67aa36faecb3f6f76dfd3069', 3, 2, NULL),
(16, 'a@b.com', '7465671ffdf66dcc67aa36faecb3f6f76dfd3069', 2, NULL, NULL),
(17, 'marcotoranzo@hotmail.com', 'ec9b2638a2fd1b542fd317b0fcc8b81ec2347337', 3, NULL, NULL),
(20, 'pablo@hotmail.com', 'a2e6a7551733e70a75592fa760ce9d82b2855d55', 1, 2, 3),
(21, 'asda@hotmail.com', '71c81485cc9b67391285223b32f1ae06bafb2e9b', 3, NULL, NULL),
(22, 'x_pablo_acm@hotmail.com', 'a2e6a7551733e70a75592fa760ce9d82b2855d55', 4, NULL, NULL);

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
(4, 'Manzanita del Peru', '2017-12-10 15:54:38', 'Noviembre - Diciembre 2018', '27292num_publi.png.png', 'Muy sabrosas y Jugozas y Rojas');

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
(14, 'moises.intech@gmail.com', 'Moises', 'Flores', 'Estay', 'ASDasdas', 'asdasd', '973950383', 'asdasd'),
(18, 'a@b.com', 'Revisando', 'Paper', 'Pro', 'ICI', 'UCM', '123456789', 'asdasd'),
(19, 'a@a.com', 'hola', 'mundo', 'pro', 'ici', 'ucm', '123456789', 'asdfasdf'),
(20, 'x_pablo_acm@hotmail.cpm', 'pablo', 'campos', 'moreno', 'alumno', 'ucm', '123456789', 'sdfsdfsdf'),
(21, 'x_pablo_acm@hotmail.com', 'pablo', 'campos', 'moreno', 'asca', 'sadasf', '123456789', 'dsfsdfsdf'),
(22, 'x_pablo_acm@hotmail.com', 'sdfsdf', 'sdfsdf', 'sdfsdfs', 'sdfsdf', 'dsfsdf', '123455677', 'sfsdfsdf');

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
  `fecha_timeout` datetime DEFAULT NULL,
  `Fecha_asig_revision` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `revista`
--

INSERT INTO `revista` (`ID`, `titulo_revista`, `version`, `email_autor`, `id_campo`, `id_estado`, `palabras_claves`, `abstract`, `autor_1`, `autor_2`, `autor_3`, `autor_4`, `archivo`, `comentarios`, `fecha_ultima_upd`, `fecha_ingreso`, `email_revisor_1`, `email_revisor_2`, `email_revisor_3`, `comentario_revisor_1`, `comentario_revisor_2`, `comentario_revisor_3`, `comentarios_editor`, `fecha_timeout`, `Fecha_asig_revision`) VALUES
(10, 'asdasd', 1, 'moises.intech@gmail.com', 9, 8, 'aSDasda', 'asdasd', 'Moises Flores Estay', '', '', '', 'asdasdmoises_intech@gmail_com2017-12-10_05_01_36.docx', '', '2017-12-10 15:54:38', '2017-12-10 08:01:36', 'moises.intech@gmail.com', 'No Asignado', 'No Asignado', NULL, NULL, NULL, NULL, '2018-01-03 00:00:00', NULL),
(13, 'gajajsn', 2, 'moises.intech@gmail.com', 9, 8, 'sdsddfsds', 'ssdfss', 'Moises Flores Estay', '', '', '', 'gajajsnmoises_intech@gmail_com2017-12-10_12_42_14.docx', '', '2017-12-10 15:54:38', '2017-12-10 15:42:14', 'a@b.com', 'No Asignado', 'No Asignado', 'HOLA ESTE PAPER TIENE UN PEQUEÑO DETALLE, ESTA MALO.', NULL, NULL, 'ASAsAS', '2017-12-13 00:00:00', NULL),
(14, 'asdasdsa', 1, 'moises.intech@gmail.com', 9, 3, 'aSDasdasd', 'asdasdasd', 'Moises Flores Estay', '', '', '', 'asdasdsamoises_intech@gmail_com2017-12-10_12_50_34.docx', '', '2018-02-02 02:37:36', '2017-12-10 15:50:34', 'a@a.com', 'a@b.com', 'No Asignado', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Practica Docente en la asignatura Algoritmos y Estructuras de Datos', 1, 'marcotoranzo@hotmail.com', 26, 3, 'competencia', 'La formación basada en competencias corresponde a una modelo de formación profesional de alta relevancia en la actualidad. El objetivo de este trabajo es presentar la evolución que ha tenido un programa de formación de competencias genéricas en la Universidad de Talca a partir de la experiencia de los autores como docentes de una carrera de ingeniería. Esta evolución, luego de más de 10 años de su inicio, se expresa en tres versiones. Se concluye que no obstante la existencia de un proceso de maduración y mejoramiento continuo, siguen abiertos espacios para mejoras significativas con miras a su consolidación.', 'Rodolfo Schmal', 'Sabino Rivero', 'Cristian Vidal-Silva', '', 'Practica_Docente_en_la_asignatura_Algoritmos_y_Estructuras_de_Datosmarcotoranzo@hotmail_com2017-12-12_09_26_59.doc', '', '2018-02-05 03:10:21', '2017-12-12 12:26:59', 'a@b.com', 'a@a.com', 'No Asignado', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'asdasd', 1, 'asda@hotmail.com', 10, 9, 'sadasd', 'sadasd', 'sdfsdf sdfsd sdfsdf', 'asdas', 'sadas', 'asdasd', 'asdasdasda@hotmail.com2018-01-28_05_36_46.docx', 'asdasdaf', '2018-03-04 17:13:51', '2018-01-28 08:36:46', 'a@a.com', 'a@b.com', 'No Asignado', NULL, NULL, NULL, 'fjhhj', '2018-02-23 00:00:00', NULL);

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
(3, 'Autor'),
(4, 'Lector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_campo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id_tema`, `nombre`, `nombre_campo`) VALUES
(3, 'tema 1', 10),
(4, 'tema de vinculacion', 23),
(6, 'la vida de la U ', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas_usuario`
--

CREATE TABLE `temas_usuario` (
  `id_tema_usuario` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temas_usuario`
--

INSERT INTO `temas_usuario` (`id_tema_usuario`, `id_tema`, `id_usuario`) VALUES
(1, 3, 2),
(2, 4, 2),
(3, 6, 2);

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
(7, 'moises.intech@gmail.com', 'Moises', 'Flores', 'Estay', 'ASDasdas', 'asdasd', 'dasd', 81, '973950383', 'asdasd', 'asdasd'),
(8, 'pmgarrido@outlook.com', 'Soy', 'Autor', 'Pro', 'ICI', 'UCM', 'DEPA', 81, '123456789', 'MMMMasdfasdf', ''),
(9, 'a@a.com', 'hola', 'mundo', 'pro', 'ici', 'ucm', 'depa', 144, '123456789', 'asdfasdf', ''),
(10, 'a@b.com', 'Revisando', 'Paper', 'Pro', 'ICI', 'UCM', 'asdsadf', 6, '123456789', 'asdasd', 'aseo'),
(11, 'marcotoranzo@hotmail.com', 'Marco', 'Hotmail', 'Hotmail', 'Dr.', 'Hotmail', 'Computacion e informática de hotmail', 81, '9768987654', 'El Dr. Marco Hotmail es ....', 'Un comentario acerca del  Dr. Marco Hotmail es ....'),
(12, 'asda@hotmail.com', 'sdfsdf', 'sdfsd', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsdf', 144, '123456789', 'dsfasdas', 'asdasdas');

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
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

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
-- Indices de la tabla `lector`
--
ALTER TABLE `lector`
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
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `id_campo` (`nombre_campo`) USING BTREE;

--
-- Indices de la tabla `temas_usuario`
--
ALTER TABLE `temas_usuario`
  ADD PRIMARY KEY (`id_tema_usuario`);

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
  MODIFY `id_campo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `campo_revisor`
--
ALTER TABLE `campo_revisor`
  MODIFY `id_campo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `campo_usuario`
--
ALTER TABLE `campo_usuario`
  MODIFY `id_campo_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `lector`
--
ALTER TABLE `lector`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `revista`
--
ALTER TABLE `revista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `temas_usuario`
--
ALTER TABLE `temas_usuario`
  MODIFY `id_tema_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_ibfk_1` FOREIGN KEY (`nombre_campo`) REFERENCES `campo_investigacion` (`id_campo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
