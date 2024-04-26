--
-- Base de datos: `tattoo_studio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `imagen_referencia` varchar(255) DEFAULT NULL,
  `alto` decimal(5,2) NOT NULL,
  `ancho` decimal(5,2) NOT NULL,
  `color` enum('si','no') NOT NULL,
  `hora_disponible_id` int(11) NOT NULL,
  `cotizacion` int(11) NOT NULL,
  `comision` int(11) NOT NULL,
  `precio_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `cliente_id`, `usuario_id`, `nombre_cliente`, `telefono`, `correo`, `imagen_referencia`, `alto`, `ancho`, `color`, `hora_disponible_id`, `cotizacion`, `comision`, `precio_total`) VALUES
(14, 1, 3, 'Tomas Barrueto', '963431289', 'tomas.barra.barrueto@gmail.com', 'a0f8833fa7f43399b77dd3efefc7ee0a.jpg', 8.00, 8.00, 'si', 21, 38400, 7680, 46080),
(15, 18, 3, 'Roronoa Zoro', '954236874', 'roronoaz@gmail.com', '60a3cf3d97c568147ac99475d1580038.png', 8.00, 12.00, 'si', 22, 60480, 12096, 72576);

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
(21, 3, '2024-04-23', 'pm', 'Tomada'),
(22, 3, '2024-04-24', 'pm', 'Tomada'),
(23, 3, '2024-04-25', 'pm', 'Disponible'),
(41, 3, '2024-04-26', 'am', 'Disponible'),
(42, 3, '2024-04-27', 'am', 'Disponible'),
(43, 3, '2024-04-28', 'am', 'Disponible'),
(44, 3, '2024-04-29', 'am', 'Disponible'),
(45, 3, '2024-04-30', 'am', 'Disponible'),
(46, 4, '2024-04-26', 'am', 'Disponible'),
(47, 7, '2024-04-26', 'am', 'Disponible'),
(48, 6, '2024-04-26', 'am', 'Disponible');

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
  `estilos` varchar(255) DEFAULT NULL,
  `precioBase` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tatuadores`
--

INSERT INTO `tatuadores` (`id`, `usuario_id`, `nombre`, `descripcion`, `imagen_perfil`, `estilos`, `precioBase`) VALUES
(6, 3, 'Juan Carlos Bodoque', 'cobro baratito ugu ugu ugu', '../assets/imgtatuador1.jpg', 'Paneles,Anime.', 525),
(7, 4, 'Nikko Hurtado', 'Especializado en tatuajes de estilo geométrico y minimalista.', '../assets/img/tatuador2.jpg', 'Geometrico, Minimalista', 450),
(8, 6, 'Oscar Akermo', 'Especializado en El estilo Japonés Tradicional.', '../assets/img/tatuador3.jpg', 'Japonés', 600),
(9, 7, 'Luna Inkheart', 'Especializada en Retratos realistas y Black and grey.', '../assets/img/tatuador4.jpg', 'Realista, Black And Grey.', 700);

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
(10, 'cliente', '1', 'cliente'),
(13, 'cliente tomas', '1', 'cliente'),
(16, 'luffy', '1', 'cliente'),
(18, 'zoro', '1', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `usuarios_id` (`usuario_id`),
  ADD KEY `hora_disponible_id` (`hora_disponible_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `horarios_disponibles`
--
ALTER TABLE `horarios_disponibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `tatuadores`
--
ALTER TABLE `tatuadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`hora_disponible_id`) REFERENCES `horarios_disponibles` (`id`);

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
