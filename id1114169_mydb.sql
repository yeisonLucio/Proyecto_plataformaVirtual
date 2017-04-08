-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2017 at 03:21 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id1114169_mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividades`
--

CREATE TABLE `actividades` (
  `idactividades` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `tipo_actividad_idtipo_actividad` int(11) NOT NULL,
  `docente_iddocente` int(11) NOT NULL,
  `curso_idcurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actividades`
--

INSERT INTO `actividades` (`idactividades`, `nombre`, `descripcion`, `tipo_actividad_idtipo_actividad`, `docente_iddocente`, `curso_idcurso`) VALUES
(31, 'tes', 'tes del curso', 1, 1, 1),
(32, 'andrea', 'el mapa mundi es una representación cartográfica (mapa) de toda la superficie de la Tierra', 1, 2, 2),
(33, 'felipe', 'La reproducción sexual en los eucariotas se caracteriza por una alternancia de fases nucleares', 1, 1, 2),
(34, 'vanesa', 'Los antivalores son como una escala de valores morales', 1, 1, 4),
(35, 'richard', 'Expresiones algebraicas, valor numérico de una expresión algebraica', 1, 1, 5),
(36, 'yeison', 'La comprensión lectora es la capacidad de entender lo que se lee', 1, 2, 4),
(37, 'luis', 'la caligrafia es el arte de escribir con letra bella, artística y correctamente formada', 1, 1, 7),
(38, 'anyi', 'La palabra división, deriva en su etimología del latín “divisio” y significa fraccionar, separar', 1, 2, 5),
(39, 'marlon', 'Se le puede presentar las partes del cuerpo (cabeza,tromco,extremidades', 1, 5, 5),
(40, 'tes', 'pdf con informacion sobre el tes', 1, 2, 3),
(44, 'examen', 'un examen de prueba', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `actividades_has_estudiante_curso`
--

CREATE TABLE `actividades_has_estudiante_curso` (
  `idactividade_has_estudiante_curso` int(11) NOT NULL,
  `actividades_idactividades` int(11) NOT NULL,
  `estudiante_curso_idestudiante_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actividades_has_estudiante_curso`
--

INSERT INTO `actividades_has_estudiante_curso` (`idactividade_has_estudiante_curso`, `actividades_idactividades`, `estudiante_curso_idestudiante_curso`) VALUES
(2, 31, 2),
(3, 32, 1),
(4, 32, 3),
(5, 32, 4),
(6, 33, 5),
(7, 33, 6),
(8, 34, 6);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `docente_iddocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`idcurso`, `nombre`, `descripcion`, `docente_iddocente`) VALUES
(1, '6 A', 'suma de numeros naturales ', 1),
(2, '5 C', 'sinónimos y antonimos', 2),
(3, '4 B', 'mapa mundi', 3),
(4, '8 D', 'el ciclo de la vida', 4),
(5, '11 A', 'valores y antivalores', 5),
(6, '10 C', 'operaciones algebraicas', 6),
(7, '7 B', 'comprensión lectora', 7),
(8, '9 B', 'caligrafia', 8),
(9, '3 C', 'división política ', 9),
(10, '2 B', 'partes del cuerpo humano', 10);

-- --------------------------------------------------------

--
-- Table structure for table `docente`
--

CREATE TABLE `docente` (
  `iddocente` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `licenciatura` varchar(45) DEFAULT NULL,
  `docentecol` varchar(45) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `docente`
--

INSERT INTO `docente` (`iddocente`, `nombre`, `apellido`, `correo`, `fechaNacimiento`, `sexo`, `licenciatura`, `docentecol`, `usuario_idusuario`) VALUES
(1, 'joes', 'villa', 'cordobarely@gmail.com', '1985-11-24', '1', 'matematicas', '', 11),
(2, 'olmer', 'giron', 'gironolmer@hotmail.com', '1976-10-07', 'M', 'español', '', 12),
(3, 'martin', 'ceron', 'ceronmartin@gmail.com', '1989-05-02', 'M', 'ciencias sociales', '', 13),
(4, 'patricia', 'vidal', 'vipatricia@hotmail.com', '1985-09-12', 'F', 'ciencias naturales', '', 14),
(5, 'yolanda', 'ramirez', 'rayolanda@gmail.com', '1981-12-12', 'F', 'etica y religion', '', 15),
(6, 'andres', 'marin', 'marionandres@hotmail.com', '1976-03-27', 'M', 'matematicas', '', 16),
(7, 'harol', 'castillo', 'casharol@gmail.com', '1988-04-27', 'M', 'español', '', 17),
(8, 'jean paul', 'minota', 'minotajean@gmail.com', '1967-12-03', 'M', 'español', '', 18),
(9, 'arley', 'gonzales', 'gonzalesarley@gmail.com', '1990-07-24', 'F', 'ciencias sociales', '', 19),
(10, 'jaime', 'jurado', 'juradojaime@hotmail.com', '1991-01-12', 'M', 'ciencias naturales', '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `estudiante`
--

CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `nombre`, `apellido`, `correo`, `fechaNacimiento`, `sexo`, `estado`, `usuario_idusuario`) VALUES
(1, 'camilo', 'leon', 'leoncamil@hotmail.com', '2001-07-21', '1', '1', 1),
(2, 'carlos', 'muñoz', 'carlosmuñoz@gmail.com', '1997-02-12', 'M', 'activo', 2),
(3, 'ximena', 'solano', 'sonaloximena@hotmail.com', '1996-09-24', 'F', 'activo', 3),
(4, 'ruben ', 'alvarez', 'rubenalvarez@gmail.com', '2001-12-01', 'M', 'retirado', 4),
(5, 'jesus', 'erazo', 'erazojesus@gmail.com', '1996-10-05', 'M', 'egresado', 5),
(6, 'richard', 'marin', 'marinrichard@gmail.com', '1998-09-09', 'M', 'egresado', 6),
(7, 'jesica', 'checa', 'jesicacheca@hotmail.com', '1997-01-12', 'F', 'egresado', 7),
(8, 'yeison', 'lucio', 'lucioyeison@hotmail.com', '1998-06-03', 'M', 'egresado', 8),
(9, 'luis', 'moncayo', 'mcayoluis@gmail.com', '2006-09-13', 'M', 'retirado', 9),
(10, 'anyit', 'tenorio', 'anyitenorio@hotmail.com', '1988-10-22', 'F', 'egresado', 10);

-- --------------------------------------------------------

--
-- Table structure for table `estudiante_curso`
--

CREATE TABLE `estudiante_curso` (
  `idestudiante_curso` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `estudiante_idestudiante` int(11) NOT NULL,
  `curso_idcurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estudiante_curso`
--

INSERT INTO `estudiante_curso` (`idestudiante_curso`, `estado`, `estudiante_idestudiante`, `curso_idcurso`) VALUES
(1, 'cursando', 1, 1),
(2, 'terminado', 1, 4),
(3, 'terminado', 1, 5),
(4, 'cursando', 2, 1),
(5, 'terminado', 2, 2),
(6, 'terminado', 2, 3),
(7, 'cursando', 2, 5),
(8, 'cursando', 2, 6),
(9, 'cursando', 2, 8),
(10, 'cursando', 2, 9),
(11, 'terminado', 3, 3),
(12, 'cursando', 4, 4),
(13, 'cursando', 4, 9),
(14, 'terminado ', 5, 1),
(15, 'terminado ', 5, 3),
(16, 'terminado', 5, 5),
(17, 'terminado', 6, 5),
(18, 'cursando', 6, 6),
(19, 'terminado ', 6, 7),
(20, 'cursando', 6, 10),
(21, 'terminado ', 7, 4),
(22, 'cursando ', 7, 7),
(23, 'terminado', 7, 8),
(24, 'cursando', 7, 10),
(25, 'terminado', 8, 8),
(26, 'cursando', 9, 3),
(27, 'terminado', 9, 4),
(28, 'terminado', 9, 6),
(29, 'cursando', 9, 8),
(30, 'terminado', 9, 9),
(31, 'terminado', 10, 1),
(32, 'terminado ', 10, 3),
(33, 'cursando', 10, 5),
(34, 'cursando', 10, 6),
(35, 'cursando', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `materiales`
--

CREATE TABLE `materiales` (
  `idmateriales` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `curso_idcurso` int(11) NOT NULL,
  `tipo_material_idtipo_material` int(11) NOT NULL,
  `docente_iddocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materiales`
--

INSERT INTO `materiales` (`idmateriales`, `nombre`, `descripcion`, `curso_idcurso`, `tipo_material_idtipo_material`, `docente_iddocente`) VALUES
(11, 'numeros naturales', 'El resultado de sumar dos números naturales es otro número natural', 1, 1, 1),
(12, 'sinonimos y antonimos', 'Grupos de sinónimos separados por acepciones y categorías gramaticales.', 1, 1, 2),
(13, 'Mapamundi', 'Los mapamundis suelen presentarse en forma de distintos tipos de mapa temático', 1, 1, 3),
(14, 'Ciclo de vida', 'El ciclo de vida es un enfoque que permite entender las vulnerabilidades', 1, 1, 4),
(15, 'Valores y antivalores', 'Los antivalores son como una escala de valores morales', 1, 1, 5),
(16, 'Expresiones algebraica ', 'Expresiones algebraicas, valor numérico de una expresión algebraica', 1, 1, 6),
(17, 'Comprensión lectora', 'La comprensión lectora es la capacidad de entender lo que se lee', 1, 1, 6),
(18, 'Caligrafía ', 'la caligrafia es el arte de escribir con letra bella, artística y correctamente formada', 1, 1, 7),
(19, 'División política', 'La palabra división, deriva en su etimología', 1, 1, 8),
(20, 'Partes del cuerpo', 'Si hablamos de su composición podemos afirmar que está compuesto por 4 partes', 1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `idtest` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `preguntas` varchar(45) DEFAULT NULL,
  `actividades_idactividades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`idtest`, `nombre`, `descripcion`, `preguntas`, `actividades_idactividades`) VALUES
(2, 'Test 1 español', 'sinonimos y antonimos ', 'sinónimo de árboles', 32),
(3, 'Test 2 sociales', 'mapa mundi', 'como puede ser un mapamundi', 33),
(4, 'Test 4 naturales', 'el ciclo de vida ', 'para que se utiliza el ciclo de vida', 34),
(5, 'Test 1 religión ', 'valores y antivalores', 'de una breve descripción de un antivalor ', 35),
(6, 'Test 6 algebra', 'operaciones algebraicas', 'cuales son las operaciones algebraicas ', 36),
(7, 'Test 3 español', 'comprensión lectora ', 'estrategias para desarrollar habilidades', 37),
(8, 'Test 2 español', 'caligrafia', 'para que sirve la caligrafía ', 38),
(9, 'Test 4 sociales', 'división política ', 'a que se refiere al fraccionmiento del mundo', 39),
(11, 'Test 1 matemáticas ', 'suma de números naturales ', '¿el orden de los sumandos varían?', 31);

-- --------------------------------------------------------

--
-- Table structure for table `test_estudiante_curso`
--

CREATE TABLE `test_estudiante_curso` (
  `idtes_estudiante_curso` int(11) NOT NULL,
  `calificacion` double DEFAULT NULL,
  `test_idtest` int(11) NOT NULL,
  `docente_iddocente` int(11) NOT NULL,
  `estudiante_curso_idestudiante_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_estudiante_curso`
--

INSERT INTO `test_estudiante_curso` (`idtes_estudiante_curso`, `calificacion`, `test_idtest`, `docente_iddocente`, `estudiante_curso_idestudiante_curso`) VALUES
(1, 3, 2, 1, 1),
(2, 3.1, 2, 2, 2),
(3, 3.4, 3, 3, 2),
(4, 3.5, 3, 3, 3),
(5, 3.4, 4, 3, 4),
(6, 3.1, 5, 2, 4),
(7, 3.1, 4, 6, 4),
(8, 3.2, 4, 5, 2),
(9, 4, 6, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_actividad`
--

CREATE TABLE `tipo_actividad` (
  `idtipo_actividad` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_actividad`
--

INSERT INTO `tipo_actividad` (`idtipo_actividad`, `nombre`, `descripcion`) VALUES
(1, 'Actividad 1', 'números naturales'),
(2, 'Actividad sinónimos y antónimos ', 'sinónimos y antónimos '),
(3, 'Actividad mapa mundi', 'mapa mundi'),
(4, 'Actividad ciclos de vida', 'ciclos de vida '),
(5, 'Actividad valores', 'valores y antivalores'),
(6, 'Actividad 2', 'operaciones algebraicas'),
(7, 'Actividad comprensión lectora', 'comprensión lectora'),
(8, 'Actividad caligrafía ', 'caliigrafia'),
(9, 'Actividad división política ', 'división política '),
(10, 'Actividad partes del cuerpo', 'partes del cuerpo'),
(11, 'parcial', 'pregunta');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_material`
--

CREATE TABLE `tipo_material` (
  `idtipo_material` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_material`
--

INSERT INTO `tipo_material` (`idtipo_material`, `nombre`) VALUES
(1, 'pdf'),
(2, 'word'),
(3, 'word'),
(4, 'pdf'),
(5, 'pdf'),
(6, 'word'),
(7, 'word'),
(8, 'pdf'),
(9, 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombreUsuario` varchar(45) DEFAULT NULL,
  `contrasena` varchar(45) DEFAULT NULL,
  `tipoUsuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombreUsuario`, `contrasena`, `tipoUsuario`) VALUES
(1, 'camil', '34566', 'estudiante'),
(2, 'carlos', '12345', 'estudiante'),
(3, 'ximena', '45678', 'estudiante '),
(4, 'ruben', '78910', 'estudiante'),
(5, 'jesus', '98765', 'estudiante'),
(6, 'richard', '67890', 'estudiante'),
(7, 'jesica', '23478', 'estudiante'),
(8, 'yeison', '76540', 'estudiante'),
(9, 'luis', '87654', 'estudiante'),
(10, 'anyit', '76543', 'estudiante'),
(11, 'arely', '14789', 'docente'),
(12, 'olmer', '23445', 'docente'),
(13, 'martin', '34567', 'docente'),
(14, 'patricia', '23980', 'docente'),
(15, 'yolanda', '56780', 'docente'),
(16, 'andres', '38092', 'decente'),
(17, 'harol', '45789', 'docente'),
(18, 'jean paul', '78904', 'docente'),
(19, 'arley', '67890', 'docente'),
(20, 'jaime', '56383', 'docente');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`idactividades`,`tipo_actividad_idtipo_actividad`,`docente_iddocente`,`curso_idcurso`),
  ADD KEY `fk_actividades_tipo_actividad1_idx` (`tipo_actividad_idtipo_actividad`),
  ADD KEY `fk_actividades_docente1_idx` (`docente_iddocente`),
  ADD KEY `fk_actividades_curso1_idx` (`curso_idcurso`);

--
-- Indexes for table `actividades_has_estudiante_curso`
--
ALTER TABLE `actividades_has_estudiante_curso`
  ADD PRIMARY KEY (`idactividade_has_estudiante_curso`,`actividades_idactividades`,`estudiante_curso_idestudiante_curso`),
  ADD KEY `fk_actividades_has_estudainte_curso_actividades1_idx` (`actividades_idactividades`),
  ADD KEY `fk_actividades_has_estudainte_curso_estudiante_curso1_idx` (`estudiante_curso_idestudiante_curso`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`,`docente_iddocente`),
  ADD KEY `fk_curso_docente1_idx` (`docente_iddocente`);

--
-- Indexes for table `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`iddocente`,`usuario_idusuario`),
  ADD KEY `fk_docente_usuario1_idx` (`usuario_idusuario`);

--
-- Indexes for table `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idestudiante`,`usuario_idusuario`),
  ADD KEY `fk_estudiante_usuario_idx` (`usuario_idusuario`);

--
-- Indexes for table `estudiante_curso`
--
ALTER TABLE `estudiante_curso`
  ADD PRIMARY KEY (`idestudiante_curso`,`estudiante_idestudiante`,`curso_idcurso`),
  ADD KEY `fk_estudiante_curso_estudiante1_idx` (`estudiante_idestudiante`),
  ADD KEY `fk_estudiante_curso_curso1_idx` (`curso_idcurso`);

--
-- Indexes for table `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`idmateriales`,`curso_idcurso`,`tipo_material_idtipo_material`,`docente_iddocente`),
  ADD KEY `fk_materiales_curso1_idx` (`curso_idcurso`),
  ADD KEY `fk_materiales_tipo_material1_idx` (`tipo_material_idtipo_material`),
  ADD KEY `fk_materiales_docente1_idx` (`docente_iddocente`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`idtest`,`actividades_idactividades`),
  ADD KEY `fk_test_actividades1_idx` (`actividades_idactividades`);

--
-- Indexes for table `test_estudiante_curso`
--
ALTER TABLE `test_estudiante_curso`
  ADD PRIMARY KEY (`idtes_estudiante_curso`,`test_idtest`,`docente_iddocente`,`estudiante_curso_idestudiante_curso`),
  ADD KEY `fk_test_estudiante_curso_test1_idx` (`test_idtest`),
  ADD KEY `fk_test_estudiante_curso_docente1_idx` (`docente_iddocente`),
  ADD KEY `fk_test_estudiante_curso_estudiante_curso1_idx` (`estudiante_curso_idestudiante_curso`);

--
-- Indexes for table `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  ADD PRIMARY KEY (`idtipo_actividad`);

--
-- Indexes for table `tipo_material`
--
ALTER TABLE `tipo_material`
  ADD PRIMARY KEY (`idtipo_material`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividades`
--
ALTER TABLE `actividades`
  MODIFY `idactividades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `actividades_has_estudiante_curso`
--
ALTER TABLE `actividades_has_estudiante_curso`
  MODIFY `idactividade_has_estudiante_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `docente`
--
ALTER TABLE `docente`
  MODIFY `iddocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `estudiante_curso`
--
ALTER TABLE `estudiante_curso`
  MODIFY `idestudiante_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `materiales`
--
ALTER TABLE `materiales`
  MODIFY `idmateriales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `test_estudiante_curso`
--
ALTER TABLE `test_estudiante_curso`
  MODIFY `idtes_estudiante_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  MODIFY `idtipo_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tipo_material`
--
ALTER TABLE `tipo_material`
  MODIFY `idtipo_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `fk_actividades_curso1` FOREIGN KEY (`curso_idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_actividades_docente1` FOREIGN KEY (`docente_iddocente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_actividades_tipo_actividad1` FOREIGN KEY (`tipo_actividad_idtipo_actividad`) REFERENCES `tipo_actividad` (`idtipo_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `actividades_has_estudiante_curso`
--
ALTER TABLE `actividades_has_estudiante_curso`
  ADD CONSTRAINT `fk_actividades_has_estudainte_curso_actividades1` FOREIGN KEY (`actividades_idactividades`) REFERENCES `actividades` (`idactividades`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_actividades_has_estudainte_curso_estudiante_curso1` FOREIGN KEY (`estudiante_curso_idestudiante_curso`) REFERENCES `estudiante_curso` (`idestudiante_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_docente1` FOREIGN KEY (`docente_iddocente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `fk_docente_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_usuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `estudiante_curso`
--
ALTER TABLE `estudiante_curso`
  ADD CONSTRAINT `fk_estudiante_curso_curso1` FOREIGN KEY (`curso_idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiante_curso_estudiante1` FOREIGN KEY (`estudiante_idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `fk_materiales_curso1` FOREIGN KEY (`curso_idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materiales_docente1` FOREIGN KEY (`docente_iddocente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materiales_tipo_material1` FOREIGN KEY (`tipo_material_idtipo_material`) REFERENCES `tipo_material` (`idtipo_material`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `fk_test_actividades1` FOREIGN KEY (`actividades_idactividades`) REFERENCES `actividades` (`idactividades`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test_estudiante_curso`
--
ALTER TABLE `test_estudiante_curso`
  ADD CONSTRAINT `fk_test_estudiante_curso_docente1` FOREIGN KEY (`docente_iddocente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_test_estudiante_curso_estudiante_curso1` FOREIGN KEY (`estudiante_curso_idestudiante_curso`) REFERENCES `estudiante_curso` (`idestudiante_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_test_estudiante_curso_test1` FOREIGN KEY (`test_idtest`) REFERENCES `test` (`idtest`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
