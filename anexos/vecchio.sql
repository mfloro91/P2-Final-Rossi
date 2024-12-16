-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2024 a las 12:47:26
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
-- Base de datos: `vecchio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Electricos', '   Dispositivos y aparatos antiguos que funcionan con electricidad, como radios, televisores, y computadoras vintage.   '),
(2, 'Muebles', ' Piezas de mobiliario antiguas que incluyen sillas, mesas, sillones y lámparas, con un diseño clásico y detalles artesanales. '),
(3, 'Musicales', ' Instrumentos musicales y equipos relacionados, como pianos, trompetas, gramófonos y accesorios para tocadiscos, todos de épocas pasadas. '),
(4, 'Rodados', ' Vehículos antiguos y objetos relacionados, como bicicletas, motocicletas, coches de época, y otros medios de transporte con valor histórico. ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `importe` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_usuario`, `fecha`, `importe`) VALUES
(1, 3, '2024-12-10', 150000.00),
(7, 3, '2024-12-15', 270000.00),
(8, 1, '2024-12-16', 355000.00),
(9, 3, '2024-12-16', 120000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Madera', '    Material natural utilizado en la fabricación de muebles, instrumentos musicales y otros objetos decorativos. Apreciado por su durabilidad y belleza.    '),
(2, 'Metal', 'Incluye hierro, acero, bronce y otros metales utilizados en estructuras de muebles, dispositivos eléctricos y componentes musicales. Valorado por su resistencia y estética.'),
(3, 'Vidrio', 'Material frágil y transparente utilizado en lámparas, pantallas de televisores antiguos y decoraciones. Conocido por su elegancia y capacidad de transformación en diversas formas y colores.'),
(4, 'Cuero', 'Material flexible y duradero obtenido de la piel de animales, utilizado en tapicería de muebles y en algunos instrumentos musicales. Apreciado por su comodidad y estilo.'),
(5, 'Tela', 'Material textil utilizado en tapicería de muebles, altavoces y decoraciones. Ofrece una amplia variedad de texturas, colores y patrones.'),
(6, 'Baquelita', 'Primer plástico sintético utilizado en la fabricación de radios, teléfonos y otros dispositivos eléctricos. Reconocido por su resistencia al calor y a la electricidad.'),
(7, 'Cerámica', 'Material no metálico, inorgánico, utilizado en lámparas, decoraciones y algunas partes de instrumentos musicales. Valorado por su durabilidad y estética.'),
(8, 'Plástico', 'Material sintético utilizado en la fabricación de varios dispositivos eléctricos y componentes de muebles. Conocido por su versatilidad y bajo costo.'),
(9, 'Marfil', 'Material duro, blanco y liso obtenido de los colmillos de elefantes y otros animales. Utilizado en teclas de pianos y decoraciones. (Nota: La venta de marfil es ilegal en muchos lugares debido a la protección de especies en peligro de extinción).'),
(10, 'Papel', '  Material delgado y plano utilizado en la fabricación de libros antiguos, partituras musicales y etiquetas. Valorado por su importancia histórica y documental.  ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origen`
--

CREATE TABLE `origen` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `origen`
--

INSERT INTO `origen` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Francia', '    Famosa por sus muebles de estilo Luis XV y Luis XVI, así como por su arte y relojes de época. Las antigüedades francesas son conocidas por su elegancia y sofisticación.    '),
(2, 'Italia', 'Conocida por su arte renacentista, esculturas y muebles barrocos. Las antigüedades italianas destacan por su belleza artística y detalles elaborados.'),
(3, 'Argentina', 'Con una rica historia en mobiliario y arte de estilo colonial y art nouveau, las antigüedades argentinas reflejan la mezcla de culturas europeas y locales.'),
(4, 'Brasil', 'Conocido por sus muebles coloniales y barrocos, así como por su arte indígena y decoraciones de influencia africana. Las antigüedades brasileñas reflejan una rica mezcla de culturas y tradiciones locales.'),
(5, 'Alemania', 'Destacada por su porcelana de Meissen, relojes de cuco y muebles Biedermeier. Las piezas alemanas son valoradas por su precisión y artesanía.'),
(8, 'Japon', 'Test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `fecha_origen` year(4) NOT NULL,
  `lugar_origen_id` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `img` varchar(256) NOT NULL,
  `alt` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `fecha_origen`, `lugar_origen_id`, `stock`, `img`, `alt`) VALUES
(1, 1, 'Teléfono Verde', '            Se estima su fecha de origen en 1980. Excelente estado, aún funcionando. Su diseño atemporal la convierte en una pieza de colección.      ', 30000.00, '1980', 3, 1, '1718842536.png', 'Telefono antiguo color verde con cable'),
(2, 2, 'Sillón Terciopelo', 'Rellena de pluma, listo para habitar tu hogar. Ideal para coleccionistas o para dar un toque retro a cualquier ambiente.', 150000.00, '1970', 1, 2, 'sillon1.png', 'Sillon de madera y terciopelo verde'),
(3, 3, 'Gramófono Vintage', 'Gramófono recuperado de una casa colonial. Aún se encuentra en funcionamiento. Listo para ser instalado en tu casa.', 120000.00, '1960', 3, 1, 'gramofono1.png', 'Gramófono de madera y metal'),
(4, 1, 'Radio Antigua de Madera', 'Radio de madera con diseño vintage. Conserva su funcionamiento original y añade un toque retro a cualquier espacio.', 55000.00, '1940', 3, 2, 'radio1.png', 'Radio antiguo de madera con dial'),
(5, 1, 'Radio Vintage de Baquelita', 'Radio vintage de baquelita con dial iluminado. Perfecto para coleccionistas o para ambientar una decoración retro.', 60000.00, '1955', 3, 1, 'radio4.png', 'Radio vintage de baquelita con dial iluminado'),
(6, 1, 'Radio de Bolsillo Retro', 'Radio de bolsillo retro en perfecto estado de funcionamiento. Ideal para los amantes de la música en movimiento.', 45000.00, '1970', 4, 1, 'radio2.png', 'Radio de bolsillo retro'),
(7, 1, 'Radio Transistorizada Clásica', 'Radio transistorizada clásica en excelente estado. Perfecta para quienes buscan un sonido de alta fidelidad en un diseño retro.', 70000.00, '1965', 1, 1, 'radio3.png', 'Radio transistorizada clásica'),
(8, 1, 'Televisor Vintage Blanco y Negro', 'Televisor de tubo blanco y negro. Ideal para coleccionistas o para dar un toque retro a cualquier ambiente.', 85000.00, '1955', 3, 2, 'tele2.png', 'Televisor vintage blanco y negro'),
(9, 1, 'Televisor a Color Retro', 'Televisor a color retro en perfecto estado de funcionamiento. Añade un toque de nostalgia a tu sala de estar.', 95000.00, '1975', 3, 1, 'tele4.png', 'Televisor a color retro'),
(10, 1, 'Televisor Portátil Vintage', 'Televisor portátil vintage en excelente estado. Perfecto para llevar la nostalgia de los años 80 a donde quiera que vayas.', 75000.00, '1980', 3, 3, 'tele1.png', 'Televisor portátil vintage'),
(11, 1, 'Computadora Vintage', '  Computadora portátil vintage en excelente estado de funcionamiento. Ideal para aquellos que buscan un estilo retro en su tecnología. ', 85000.00, '1990', 3, 1, '1718680437.png', 'Computadora portatil vintage'),
(13, 2, 'Sillón Chesterfield de Cuero', '    Elegante sillón Chesterfield tapizado en cuero de alta calidad. Un clásico atemporal que añadirá sofisticación a tu sala de estar.  ', 185000.00, '1960', 5, 4, '1719113965.png', 'Sillón Chesterfield de cuero'),
(14, 2, 'Sillón Luis XVI', '  Sillón Luis XVI con estructura de madera tallada y tapizado en tela de damasco. Una pieza elegante para añadir un toque de sofisticación a tu hogar. ', 195000.00, '2000', 1, 1, '1719114048.png', 'Sillón Luis XVI'),
(15, 1, 'Lámpara Art Nouveau', '    Lámpara estilo Art Nouveau con base de bronce y pantalla de vidrio opalino. Aporta una iluminación suave y elegante a cualquier ambiente.  ', 95000.00, '1910', 3, 1, '1719114125.png', 'Lámpara Art Nouveau'),
(16, 2, 'Lámpara de Sobremesa Retro', '  Lámpara de sobremesa retro con base de cerámica y pantalla de tela. Perfecta para añadir un toque de nostalgia a tu decoración. ', 65000.00, '1968', 3, 2, '1719114210.png', 'Lámpara de Sobremesa Retro'),
(17, 2, 'Mesa Auxiliar Tallada', '  Mesa auxiliar de madera tallada a mano. Perfecta para agregar un toque de elegancia a tu sala de estar. ', 75000.00, '1920', 2, 1, '1719114291.png', 'Mesa Auxiliar Tallada de madera'),
(18, 2, 'Sillón Bergère Antiguo', '  Sillón Bergère antiguo con cuero bordó y acabado en madera tallada. Perfecto para crear un ambiente clásico y acogedor. ', 175000.00, '1935', 1, 1, '1719114374.png', 'Sillón Bergère Antiguo'),
(19, 3, 'Trompeta Vintage', '  Trompeta vintage en perfecto estado de funcionamiento. Ideal para músicos aficionados y coleccionistas. ', 65000.00, '1968', 3, 1, '1719114442.png', 'Trompeta vintage'),
(20, 3, 'Saxofón Clásico', 'Saxofón clásico en excelente estado. Perfecto para interpretar melodías nostálgicas y jazz.', 85000.00, '1970', 3, 2, '1719114494.png', 'Saxofón Clásico'),
(21, 3, 'Piano de Cola Steinway & Sons', '  Piano de cola Steinway & Sons en perfecto estado. Su sonido excepcional lo convierte en una pieza codiciada por músicos y coleccionistas. ', 650000.00, '1978', 5, 1, '1719114569.png', 'Piano de cola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_x_compra`
--

CREATE TABLE `producto_x_compra` (
  `id` int(10) UNSIGNED NOT NULL,
  `compra_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_x_compra`
--

INSERT INTO `producto_x_compra` (`id`, `compra_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 2, 1),
(7, 7, 3, 1),
(8, 7, 2, 1),
(9, 8, 11, 1),
(10, 8, 17, 1),
(11, 8, 19, 3),
(12, 9, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_x_material`
--

CREATE TABLE `producto_x_material` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `material_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_x_material`
--

INSERT INTO `producto_x_material` (`id`, `producto_id`, `material_id`) VALUES
(5, 2, 1),
(6, 2, 5),
(7, 3, 1),
(8, 3, 2),
(10, 5, 6),
(11, 5, 8),
(12, 5, 2),
(13, 6, 2),
(14, 6, 8),
(15, 7, 2),
(16, 8, 2),
(17, 8, 3),
(18, 9, 1),
(19, 9, 3),
(41, 13, 1),
(42, 13, 4),
(43, 13, 5),
(44, 14, 1),
(45, 14, 4),
(46, 14, 5),
(47, 11, 2),
(48, 11, 3),
(49, 15, 2),
(50, 15, 3),
(51, 15, 8),
(52, 16, 2),
(53, 16, 3),
(54, 16, 8),
(55, 17, 1),
(56, 17, 2),
(57, 18, 1),
(58, 18, 4),
(59, 19, 2),
(60, 19, 8),
(61, 21, 1),
(62, 21, 2),
(63, 21, 8),
(64, 21, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(256) NOT NULL,
  `nombre_usuario` varchar(256) NOT NULL,
  `nombre_completo` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rol` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `email`, `nombre_usuario`, `nombre_completo`, `password`, `rol`) VALUES
(1, 'mfloro.91@gmail.com', 'superadmin_vecchio', 'Maria Florencia Rossi', '$2y$10$v2BEcs6TEETuxdlj31.gB.fbFxZBrYSr6Btyhh/V0z4N8IEVxSIre', 'superadmin'),
(2, 'maria.rossi@davinci.edu.ar', 'admin_vecchio', 'María Rossi', '$2y$10$l5CtgNmMylzpp./O/ce.C.qwaXlF9GVtX.BYLfShfQcz72XmFNUOe', 'admin'),
(3, 'jorge_perez@davinci.edu.ar', 'usuario_vecchio', 'Jorge Perez', '$2y$10$A85i8GlZE/hT0za1doINxOpyAy5yX61Un9KQD5w5ptSg3sCaCZriW', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `origen`
--
ALTER TABLE `origen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `lugar_origen` (`lugar_origen_id`);

--
-- Indices de la tabla `producto_x_compra`
--
ALTER TABLE `producto_x_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compra_id` (`compra_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `producto_x_material`
--
ALTER TABLE `producto_x_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `origen`
--
ALTER TABLE `origen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `producto_x_compra`
--
ALTER TABLE `producto_x_compra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto_x_material`
--
ALTER TABLE `producto_x_material`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`usuario_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`lugar_origen_id`) REFERENCES `origen` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_x_compra`
--
ALTER TABLE `producto_x_compra`
  ADD CONSTRAINT `producto_x_compra_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_x_compra_ibfk_2` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_x_material`
--
ALTER TABLE `producto_x_material`
  ADD CONSTRAINT `producto_x_material_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_x_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
