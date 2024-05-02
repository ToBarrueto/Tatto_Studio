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
(15, 18, 3, 'Roronoa Zoro', '954236874', 'roronoaz@gmail.com', 'valorant-logo-transparent-free-png.webp', 8.00, 12.00, 'si', 22, 60480, 12096, 72576),
(16, 19, 4, 'Bob Esponja', '123456789', 'bob.esponja@gmail.com', 'valorant-logo-transparent-free-png.webp', 10.00, 10.00, 'si', 46, 60000, 12000, 72000),
(18, 20, 4, 'Homer Simpson', '987654321', 'homer.simpson@gmail.com', 'valorant-logo-transparent-free-png.webp', 15.00, 12.00, 'si', 65, 97200, 19440, 116640),
(19, 21, 7, 'Kakaroto ', '111222333', 'goku@gmail.com', 'valorant-logo-transparent-free-png.webp', 20.00, 15.00, 'no', 47, 210000, 42000, 252000),
(20, 22, 3, 'Peter Parker', '999888777', 'spiderman@gmail.com', 'valorant-logo-transparent-free-png.webp', 18.00, 10.00, 'si', 23, 113400, 22680, 136080),
(21, 28, 6, 'Naruto Uzumaki', '555444333', 'naruto@gmail.com', 'valorant-logo-transparent-free-png.webp', 12.00, 8.00, 'si', 48, 69120, 13824, 82944),
(22, 31, 6, 'Ironman', '222333444', 'ironman@gmail.com', 'valorant-logo-transparent-free-png.webp', 15.00, 10.00, 'si', 81, 108000, 21600, 129600),
(23, 44, 7, 'Viuda Negra', '777888999', 'viuda.negra@gmail.com', 'valorant-logo-transparent-free-png.webp', 10.00, 8.00, 'no', 97, 56000, 11200, 67200),
(24, 24, 4, 'Zabdi cofre', '987654321', 'zabdicofre@gmail.com', 'valorant-logo-transparent-free-png.webp', 15.00, 8.00, 'no', 66, 54000, 10800, 64800),
(26, 25, 3, 'Mario Mario', '963431289', 'mariobros@gmail.com', 'valorant-logo-transparent-free-png.webp', 8.00, 8.00, 'no', 41, 33600, 6720, 40320),
(28, 27, 6, 'Pichu Pikachu Raichu', '987654321', 'PikaPika@gmail.com', 'valorant-logo-transparent-free-png.webp', 16.00, 12.00, 'si', 82, 138240, 27648, 165888),
(29, 29, 7, 'Sasuke Uchiha', '963891254', 'ClanUchihax100pre@gmail.com', 'valorant-logo-transparent-free-png.webp', 19.00, 12.00, 'no', 98, 159600, 31920, 191520),
(30, 49, 3, 'Flash', '666777888', 'flash@gmail.com', 'valorant-logo-transparent-free-png.webp', 8.00, 6.00, 'si', 42, 30000, 6000, 36000),
(31, 1, 3, 'Walala', '987654321', 'Walalin@gmail.com', 'valorant-logo-transparent-free-png.webp', 8.00, 15.00, 'si', 43, 75600, 15120, 90720),
(32, 1, 6, 'Barsinson', '987654321', 'Barsinson@gmail.com', 'valorant-logo-transparent-free-png.webp', 23.00, 20.00, 'si', 83, 331200, 66240, 397440),
(34, 24, 4, 'el barsison', '963431289', 'tomas.barra.barrueto@gmail.com', 'valorant-logo-transparent-free-png.webp', 13.00, 17.00, 'no', 114, 99450, 19890, 119340);

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
(23, 3, '2024-04-25', 'pm', 'Tomada'),
(41, 3, '2024-04-26', 'am', 'Tomada'),
(42, 3, '2024-04-27', 'am', 'Tomada'),
(43, 3, '2024-04-28', 'am', 'Tomada'),
(44, 3, '2024-04-29', 'am', 'Disponible'),
(45, 3, '2024-04-30', 'am', 'Disponible'),
(46, 4, '2024-04-26', 'am', 'Tomada'),
(47, 7, '2024-04-26', 'am', 'Tomada'),
(48, 6, '2024-04-26', 'am', 'Tomada'),
(51, 3, '2024-05-01', 'am', 'Disponible'),
(53, 3, '2024-05-02', 'am', 'Disponible'),
(55, 3, '2024-05-03', 'am', 'Disponible'),
(58, 3, '2024-05-04', 'pm', 'Disponible'),
(59, 3, '2024-05-05', 'am', 'Disponible'),
(62, 3, '2024-05-06', 'pm', 'Disponible'),
(63, 3, '2024-05-07', 'am', 'Disponible'),
(65, 4, '2024-04-30', 'am', 'Tomada'),
(66, 4, '2024-04-30', 'pm', 'Tomada'),
(67, 4, '2024-05-01', 'am', 'Tomada'),
(68, 4, '2024-05-01', 'pm', 'Disponible'),
(69, 4, '2024-05-02', 'am', 'Disponible'),
(70, 4, '2024-05-02', 'pm', 'Disponible'),
(71, 4, '2024-05-03', 'am', 'Disponible'),
(72, 4, '2024-05-03', 'pm', 'Disponible'),
(73, 4, '2024-05-04', 'am', 'Disponible'),
(74, 4, '2024-05-04', 'pm', 'Disponible'),
(75, 4, '2024-05-05', 'am', 'Disponible'),
(76, 4, '2024-05-05', 'pm', 'Disponible'),
(77, 4, '2024-05-06', 'am', 'Disponible'),
(78, 4, '2024-05-06', 'pm', 'Disponible'),
(79, 4, '2024-05-07', 'am', 'Disponible'),
(80, 4, '2024-05-07', 'pm', 'Disponible'),
(81, 6, '2024-04-30', 'am', 'Tomada'),
(82, 6, '2024-04-30', 'pm', 'Tomada'),
(83, 6, '2024-05-01', 'am', 'Tomada'),
(84, 6, '2024-05-01', 'pm', 'Disponible'),
(85, 6, '2024-05-02', 'am', 'Disponible'),
(86, 6, '2024-05-02', 'pm', 'Disponible'),
(87, 6, '2024-05-03', 'am', 'Disponible'),
(88, 6, '2024-05-03', 'pm', 'Disponible'),
(89, 6, '2024-05-04', 'am', 'Disponible'),
(90, 6, '2024-05-04', 'pm', 'Disponible'),
(91, 6, '2024-05-05', 'am', 'Disponible'),
(92, 6, '2024-05-05', 'pm', 'Disponible'),
(93, 6, '2024-05-06', 'am', 'Disponible'),
(94, 6, '2024-05-06', 'pm', 'Disponible'),
(95, 6, '2024-05-07', 'am', 'Disponible'),
(96, 6, '2024-05-07', 'pm', 'Disponible'),
(97, 7, '2024-04-30', 'am', 'Tomada'),
(98, 7, '2024-04-30', 'pm', 'Tomada'),
(99, 7, '2024-05-01', 'am', 'Disponible'),
(100, 7, '2024-05-01', 'pm', 'Disponible'),
(101, 7, '2024-05-02', 'am', 'Disponible'),
(102, 7, '2024-05-02', 'pm', 'Disponible'),
(103, 7, '2024-05-03', 'am', 'Disponible'),
(104, 7, '2024-05-03', 'pm', 'Disponible'),
(105, 7, '2024-05-04', 'am', 'Disponible'),
(106, 7, '2024-05-04', 'pm', 'Disponible'),
(107, 7, '2024-05-05', 'am', 'Disponible'),
(108, 7, '2024-05-05', 'pm', 'Disponible'),
(109, 7, '2024-05-06', 'am', 'Disponible'),
(110, 7, '2024-05-06', 'pm', 'Disponible'),
(111, 7, '2024-05-07', 'am', 'Disponible'),
(112, 7, '2024-05-07', 'pm', 'Disponible'),
(114, 4, '2024-03-05', 'am', 'Tomada');

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
(7, 4, 'Nikko Hurtado', 'Especializado en tatuajes de estilo geométrico y minimalista.', '../assets/imgftoperfil.jpg', 'Geometrico, Minimalista', 450),
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
(18, 'zoro', '1', 'cliente'),
(19, 'Bob_Esponja', '1', 'cliente'),
(20, 'Homer_Simpson', '1', 'cliente'),
(21, 'Goku', '1', 'cliente'),
(22, 'Spiderman', '1', 'cliente'),
(23, 'Batman', '1', 'cliente'),
(24, 'Harry_Potter', '1', 'cliente'),
(25, 'Mario', '1', 'cliente'),
(26, 'Luigi', '1', 'cliente'),
(27, 'Pikachu', '1', 'cliente'),
(28, 'Naruto_Uzumaki', '1', 'cliente'),
(29, 'Sasuke_Uchiha', '1', 'cliente'),
(30, 'Capitan_America', '1', 'cliente'),
(31, 'Ironman', '1', 'cliente'),
(32, 'Thor', '1', 'cliente'),
(33, 'Wolverine', '1', 'cliente'),
(34, 'Deadpool', '1', 'cliente'),
(35, 'Darth_Vader', '1', 'cliente'),
(36, 'Yoda', '1', 'cliente'),
(37, 'Obi_Wan_Kenobi', '1', 'cliente'),
(38, 'Anakin_Skywalker', '1', 'cliente'),
(39, 'Darth_Maul', '1', 'cliente'),
(40, 'Frodo_Bolson', '1', 'cliente'),
(41, 'Legolas', '1', 'cliente'),
(42, 'Gandalf', '1', 'cliente'),
(43, 'Hulk', '1', 'cliente'),
(44, 'Viuda_Negra', '1', 'cliente'),
(45, 'Thanos', '1', 'cliente'),
(46, 'Capitan_Marvel', '1', 'cliente'),
(47, 'Mujer_Maravilla', '1', 'cliente'),
(48, 'Superman', '1', 'cliente'),
(49, 'Flash', '1', 'cliente'),
(50, 'Linterna_Verde', '1', 'cliente'),
(51, 'Aquaman', '1', 'cliente'),
(52, 'Shrek', '1', 'cliente'),
(53, 'Burro', '1', 'cliente'),
(54, 'Fiona', '1', 'cliente'),
(55, 'Gato_con_Botas', '1', 'cliente'),
(56, 'Sin_Dientes', '1', 'cliente'),
(57, 'Hipo', '1', 'cliente'),
(58, 'Stitch', '1', 'cliente'),
(59, 'Lilo', '1', 'cliente'),
(60, 'Buzz_Lightyear', '1', 'cliente'),
(61, 'Woody', '1', 'cliente'),
(62, 'Sullivan', '1', 'cliente'),
(63, 'Mike_Wazowski', '1', 'cliente'),
(64, 'Dory', '1', 'cliente'),
(65, 'Nemo', '1', 'cliente');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `horarios_disponibles`
--
ALTER TABLE `horarios_disponibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `tatuadores`
--
ALTER TABLE `tatuadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
