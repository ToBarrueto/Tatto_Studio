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
-- Estructura de tabla para la tabla `horarios_disponibles`
--

CREATE TABLE `horarios_disponibles` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `turno` enum('am','pm') NOT NULL,
  `estado` enum('Disponible','Tomada','Cerrada') NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios_disponibles`
--

INSERT INTO `horarios_disponibles` (`id`, `usuario_id`, `fecha`, `turno`, `estado`) VALUES
(20, 3, '2024-04-22', 'pm', 'Cerrada'),
(21, 3, '2024-04-23', 'pm', 'Tomada'),
(22, 3, '2024-04-24', 'pm', 'Disponible');

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
(30, 3, '', '../uploads/10001939fa2b6cf7bd60f50542848344.jpg'),
(32, 3, '', '../uploads/4fc3b0e67638399d7755afef6529abce.jpg'),
(33, 4, '', '../uploads/5a90d40f2d5ec8670e163bc40150faff.jpg'),
(34, 4, '', '../uploads/f0a0cf1685aa29376b2c305399dafb9e.jpg'),
(35, 4, '', '../uploads/c59fe4dcc98ca2db19ef4fe43d5ec9f7.jpg'),
(36, 4, '', '../uploads/47ad1fc632cfc2a339f80a3ae47a94b0.jpg'),
(37, 4, '', '../uploads/4817b8aba9b2c26dcd1e76ca7ad57cd2.jpg'),
(38, 4, '', '../uploads/7404b4b732dd3ea1c24ffb01c64482b6.jpg'),
(39, 6, '', '../uploads/5b656afcb3fb827bfcf2fdf8d59e90fd.jpg'),
(40, 6, '', '../uploads/42d5574d5f20b37d6ec191ce41248918.jpg'),
(41, 6, '', '../uploads/5662901ed905ad04bb3c0531a80c5f37.jpg'),
(42, 6, '', '../uploads/67b78d6210bbe7b778abb7ba18d968eb.jpg'),
(43, 6, '', '../uploads/f4ef18fd789048e540c2f4efe0d83a0e.jpg'),
(44, 6, '', '../uploads/2e79ced45759e84caaf7ec2c8fccabdf.jpg'),
(45, 7, '', '../uploads/bbec20ea379b620cf8556c516e3e4a91.jpg'),
(46, 7, '', '../uploads/0abe5e8062ae8be96a4d1116d0a04edb.jpg'),
(47, 7, '', '../uploads/f460fcecbf13d04b02209e2bb98688d1.jpg'),
(48, 7, '', '../uploads/d52e440f1d49beca8d8cfdafc80dedfc.jpg'),
(49, 7, '', '../uploads/40a3910f7d905a315edf02bd0f4033b2.jpg'),
(50, 7, '', '../uploads/a4d07b16cdc57321189bf7b53145bef9.jpg');

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
(6, 3, 'Juan Carlos Bodoquee', 'cobro baratito ugu ugu', '../assets/img/tatuador1.jpg', 'Paneles,Anime.'),
(7, 4, 'Nikko Hurtadoo', 'Especializado en tatuajes de estilo geométrico y minimalista.', '../assets/img/tatuador2.jpg', 'Geometrico, Minimalista'),
(8, 6, 'Oscar Akermo', 'Especializado en El estilo Japonés Tradicional.', '../assets/img/tatuador3.jpg', 'Japonés'),
(9, 7, 'Luna Inkheart', 'Especializada en Retratos realistas y Black and grey.', '../assets/img/tatuador4.jpg', 'Realista, Black And Grey.');

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
(7, 'Luna', '1', 'tatuador'),
(10, 'cliente', '1', 'cliente');

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
-- Indices de la tabla `horarios_disponibles`
--
ALTER TABLE `horarios_disponibles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

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
-- AUTO_INCREMENT de la tabla `horarios_disponibles`
--
ALTER TABLE `horarios_disponibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tatuadores`
--
ALTER TABLE `tatuadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Filtros para la tabla `horarios_disponibles`
--
ALTER TABLE `horarios_disponibles`
  ADD CONSTRAINT `fk_tatuador_horario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

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