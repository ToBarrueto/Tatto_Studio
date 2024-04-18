-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2024 a las 03:20:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tattoo_studio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `tatuador_id` int(11) DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` enum('pendiente','confirmada','cancelada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portafolio`
--

CREATE TABLE `portafolio` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `ruta_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `portafolio`
--

INSERT INTO `portafolio` (`id`, `usuario_id`, `descripcion`, `ruta_imagen`) VALUES
(25, 3, '', '../uploads/371995c0040f6e380785133afee7df4c.jpg'),
(26, 3, '', '../uploads/a0f8833fa7f43399b77dd3efefc7ee0a.jpg'),
(27, 3, '', '../uploads/0ab4bec6ba20255ff60727abcb380529.jpg'),
(28, 3, '', '../uploads/0be09e8a75e600eaddebc4753d3524bc.jpg'),
(29, 3, '', '../uploads/ca0e19e69e3353cd72212d6f1b7ad103.jpg'),
(30, 3, '', '../uploads/10001939fa2b6cf7bd60f50542848344.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tatuadores`
--

CREATE TABLE `tatuadores` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen_perfil` varchar(255) NOT NULL,
  `estilos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tatuadores`
--

INSERT INTO `tatuadores` (`id`, `usuario_id`, `nombre`, `descripcion`, `imagen_perfil`, `estilos`) VALUES
(6, 3, 'Juan Carlos Bodoquee', 'cobro baratito ugu ugu', '../assets/img/tatuador1.jpg', 'Anime,Lineal.'),
(7, 4, 'Nikko Hurtadoo', 'Especializado en tatuajes de estilo geométrico y minimalista.', '../assets/img/tatuador2.jpg', 'Puntillismo,Trash Polka'),
(8, 6, 'Oscar Akermo\r\n', 'Pionero en el estilo moderno de tatuaje en negro y gris.', '../assets/img/tatuador3.jpg', 'Japonés'),
(9, 7, 'Luna Inkheart', 'Luna es una tatuadora con un estilo único que fusiona elementos de la naturaleza con geometría sagrada.', '../assets/img/tatuador4.jpg', 'Fineline y Geométrico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` enum('cliente','tatuador','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `tipo_usuario`) VALUES
(1, 'cliente1', '1', 'cliente'),
(2, 'admin', '1', 'admin'),
(3, 'Juan', '1', 'tatuador'),
(4, 'Nikko', '1', 'tatuador'),
(6, 'Oscar', '1', 'tatuador'),
(7, 'Luna', '1', 'tatuador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `tatuador_id` (`tatuador_id`);

--
-- Indices de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `tatuadores`
--
ALTER TABLE `tatuadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tatuadores`
--
ALTER TABLE `tatuadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`tatuador_id`) REFERENCES `tatuadores` (`id`);

--
-- Filtros para la tabla `portafolio`
--
ALTER TABLE `portafolio`
  ADD CONSTRAINT `portafolio_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tatuadores`
--
ALTER TABLE `tatuadores`
  ADD CONSTRAINT `tatuadores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
