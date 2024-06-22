-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2024 a las 18:06:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sneakerstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(50,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `talla` varchar(255) DEFAULT NULL,
  `precio_unitario` float(10,3) DEFAULT NULL,
  `subtotal` float(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `numero_factura` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `cliente_nombre` varchar(100) NOT NULL,
  `cliente_contacto` varchar(50) NOT NULL,
  `total` float(10,3) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float(10,3) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `talla`, `color`, `marca`) VALUES
(1, 'Nike Air Force 1 \'07', 'El fulgor sigue vivo con las Air Force 1 \'07, un icono del baloncesto que aporta un nuevo toque a sus ya característicos materiales impecables, sus colores llamativos y la cantidad perfecta de brillo para destacar.', 314.289, 20, 'NikeForce.jpg', '35, 36, 37', 'Beige', 'Nike '),
(2, 'Vans Frida Black', '¡Descubre la elegancia artística con los Vans Frida Black! Inspirados en la icónica Frida Kahlo, estos zapatos combinan la sofisticación del negro clásico con toques artísticos vibrantes. Perfectos para quienes buscan destacar con estilo y rendir homenaje a una de las figuras más influyentes del arte. Con los Vans Frida Black, cada paso es una obra maestra. ¡Atrévete a llevar el arte en tus pies!', 90.000, 20, 'Frida Black.jpg', '35, 36, 37', 'white', 'Vans '),
(3, 'Adidas Tenis OwnTheGame', '¡Prepárate para dominar la cancha con los Adidas Tenis OwnTheGame! Estos zapatos combinan estilo y rendimiento para llevarte al siguiente nivel en cada partido. Con su diseño aerodinámico y su suela resistente, te brindan la estabilidad y el agarre que necesitas para destacar en la cancha. Ya seas un jugador experimentado o estés empezando, los Adidas Tenis OwnTheGame son la elección perfecta para alcanzar tus metas deportivas. ¡Domina cada jugada con estilo y confianza!', 439.950, 20, 'Adidas Tenis.jpg', '35, 36, 37', 'Black, White', 'Adidas'),
(4, 'Converse De plataforma alta', '¡Eleva tu estilo con las Converse de plataforma alta! Estos icónicos zapatos combinan la esencia clásica de Converse con una moderna plataforma que te hará destacar en cualquier ocasión. Con su diseño atemporal y su suela elevada, te ofrecen un toque de altura y audacia a tu look diario. Ya sea que los uses para un día casual o para añadir un toque de rebeldía a tu outfit, las Converse de plataforma alta son la opción perfecta para expresar tu estilo único. ¡Atrévete a elevar tu look con estas zapatillas que nunca pasan de moda!', 431.840, 20, 'Converse.jpg', '35, 36, 37', 'Black', 'Converse'),
(5, 'Zapatillas Para Hombre Diesel', '¡Haz una declaración de estilo audaz con las zapatillas para hombre de Diesel! Diseñadas para el hombre moderno que busca destacar, estas zapatillas combinan la innovación del diseño con la comodidad para un look sin igual. Con detalles únicos y materiales de alta calidad, las zapatillas Diesel son la elección perfecta para aquellos que buscan un calzado que refleje su personalidad distintiva. Ya sea que las uses para un día casual o para añadir un toque de estilo a tu atuendo de noche, las zapatillas para hombre de Diesel te llevarán a otro nivel de moda urbana. ¡Prepárate para marcar tendencia con cada paso que des!', 180.900, 20, 'Diesel.jpg', '35, 36, 37', 'Green', 'Diesel'),
(6, 'TENIS NEGRO ULTRA RUNNING NIVIA', '¡Domina cada carrera con los tenis negros Ultra Running de Nivia! Diseñados para los corredores que buscan máximo rendimiento y comodidad, estos tenis te brindan una combinación perfecta de soporte y ligereza. Con su diseño en negro clásico, son la opción ideal para aquellos que buscan un estilo versátil que se adapte a cualquier outfit deportivo. Ya sea que estés entrenando en la pista o compitiendo en una carrera, los tenis Ultra Running de Nivia te llevarán más lejos y más rápido que nunca. ¡Prepárate para superar tus límites con cada zancada!', 119.900, 20, 'Nivia.jpg', '35, 36, 37', 'Black', 'Nivia'),
(7, 'Zapatillas arena Modelo M2530', '¡Sumérgete en el estilo con las zapatillas de arena modelo M2530! Diseñadas para los amantes de la playa y los deportes acuáticos, estas zapatillas combinan un diseño funcional con un toque de moda. Con su suela antideslizante y su construcción duradera, te brindan la tracción y la protección que necesitas para caminar sobre superficies resbaladizas. Su diseño elegante encaja perfectamente con cualquier atuendo playero, mientras que su comodidad te permite disfrutar de largos paseos por la orilla del mar o sesiones de deportes acuáticos sin preocupaciones. ¡Prepárate para disfrutar del verano con estilo y seguridad con las zapatillas de arena modelo M2530!', 132.822, 20, 'Oliva.jpg', '35, 36, 37', 'Beige', 'Oliva'),
(8, 'TENIS ADIDAS RESPONSE RUNNER', '¡Acelera tu carrera con los tenis Adidas Response Runner! Diseñados para ofrecerte el máximo rendimiento en cada zancada, estos tenis combinan tecnología innovadora y estilo deportivo. Con su amortiguación receptiva y su suela duradera, te brindan la comodidad y el soporte que necesitas para superar tus límites en cada carrera. Su diseño aerodinámico y elegante encaja perfectamente con tu estilo activo, ya sea que estés corriendo en la pista o en la ciudad. ¡Prepárate para dominar el asfalto con los tenis Adidas Response Runner y alcanzar nuevas velocidades!', 200.000, 20, 'Adidas.jpg', '35, 36, 37', 'Negro', 'Adidas'),
(9, 'Tenis VikkyV3 Negros | PUMA', '¡Desata tu estilo con los tenis VikkyV3 negros de Puma! Diseñados para la mujer moderna que busca comodidad y estilo en cada paso, estos tenis combinan la elegancia del negro con el icónico diseño de Puma. Con su suave y acolchada suela, te brindan el soporte necesario para enfrentar tu día con confianza, ya sea en la ciudad o en el gimnasio. Su exterior de cuero sintético agrega un toque de sofisticación a tu look casual, mientras que el logo distintivo de Puma añade un toque de estilo deportivo. ¡Prepárate para destacar con los tenis VikkyV3 negros de Puma y camina con paso firme hacia la moda!', 389.900, 20, 'Puma.jpg', '35, 36, 37', 'Black', 'Puma'),
(10, 'TENIS AC CASUAL CABALLERO', '¡Eleva tu estilo casual con los tenis AC para caballero! Estos zapatos combinan la comodidad de unos tenis con el diseño elegante de unos zapatos casuales, creando así el equilibrio perfecto entre funcionalidad y moda. Con su construcción de alta calidad y su diseño versátil, los tenis AC son ideales para cualquier ocasión informal, ya sea para un día de paseo por la ciudad o una salida con amigos. Su estilo atemporal y su comodidad duradera los convierten en el complemento perfecto para cualquier guardarropa masculino. ¡Prepárate para destacar con los tenis AC y camina con confianza en cada paso!', 120.000, 20, 'AC.jpg', '35, 36, 37', 'Brown', 'Artuto Calle'),
(11, 'Lacoste Clásica Hombre', '¡Refina tu estilo con la clásica elegancia de los zapatos Lacoste para hombre! Estos icónicos zapatos capturan la esencia del estilo atemporal con su diseño sofisticado y detalles distintivos. Confeccionados con los mejores materiales, ofrecen comodidad y durabilidad incomparables. Ya sea que los uses para una ocasión casual o para añadir un toque de refinamiento a tu atuendo formal, los zapatos Lacoste son el símbolo definitivo de elegancia masculina. Haz una declaración de moda con cada paso que des y marca tu presencia con el inconfundible estilo de Lacoste.', 170.000, 20, 'Lacoste.jpg', '35, 36, 37', 'Black', 'Lacoste'),
(12, 'Lacoste Chaymon 223 1 Cma', '¡Eleva tu estilo con los Lacoste Chaymon 223 1 CMA! Estos zapatos fusionan la elegancia clásica con un toque contemporáneo, creando así un calzado versátil que complementa cualquier atuendo. Con su diseño aerodinámico y detalles distintivos de la marca Lacoste, estos zapatos son perfectos para aquellos que buscan un equilibrio entre estilo y comodidad. Ya sea que los uses para una salida casual o para añadir un toque de sofisticación a tu look de trabajo, los Chaymon 223 1 CMA son la elección ideal para el hombre moderno que valora la moda y la funcionalidad. ¡Prepárate para destacar con elegancia en cada paso!', 800.000, 20, 'Lacoste Origin.jpg', '35, 36, 37', 'White', 'Lacoste Origin'),
(13, 'Air Jordan 1 Mid', '¡Desata tu estilo urbano con los legendarios Air Jordan 1 Mid! Estos icónicos sneakers son mucho más que un calzado deportivo: representan una cultura, un legado, un símbolo de autenticidad y poderío. Con su diseño clásico y atemporal, los Air Jordan 1 Mid combinan la herencia del baloncesto con la moda callejera, ofreciendo una mezcla perfecta de estilo y rendimiento. Ya sea que los uses para destacar en la cancha o para darle un toque de actitud a tu look diario, los Air Jordan 1 Mid son una declaración de confianza y estilo. ¡Prepárate para elevar tu juego con la grandeza de los Air Jordan 1 Mid!', 584.194, 20, 'Jordan.jpg', '35, 36, 37', 'Black', 'Jordan'),
(14, 'VERSACE TRIGECA', '¡Haz una declaración de moda audaz con las zapatillas Versace Trigeca! Estas impresionantes zapatillas combinan la sofisticación de la moda italiana con un toque de extravagancia urbana. Con su diseño distintivo y detalles llamativos, las Trigeca capturan la esencia del estilo de vida moderno y vanguardista. Ya sea que las uses para destacar en la ciudad o para añadir un toque de lujo a tu atuendo casual, las zapatillas Versace Trigeca son el complemento perfecto para el hombre que busca destacar con estilo y confianza en cada paso que da. ¡Prepárate para dejar una impresión duradera con estas zapatillas que elevan cualquier look!', 900.000, 20, 'Vergace.jpg', '35, 36, 37', 'Yellow', 'Vergace'),
(15, 'Zapatillas New Balance', 'Las zapatillas New Balance ofrecen una combinación perfecta de comodidad, estilo y rendimiento. Con una amplia variedad de modelos que van desde los clásicos hasta los más innovadores, New Balance se ha ganado su reputación por producir calzado de alta calidad que se adapta a las necesidades de cualquier persona, ya sea para el día a día o para actividades deportivas. Desde correr y hacer ejercicio hasta caminar por la ciudad, las zapatillas New Balance te brindan el soporte y la amortiguación necesarios para mantenerte cómodo y en movimiento. Además, con su diseño contemporáneo y su distintivo logotipo, son una elección de moda versátil que complementa cualquier estilo. ¡Prepárate para caminar con estilo y confianza con las zapatillas New Balance!', 190.000, 20, 'Balance.jpg', '35, 36, 37', 'Blue', 'New Balance'),
(16, 'Tenis Diesel', 'Los tenis Diesel son sinónimo de estilo audaz y urbano. Con una amplia gama de diseños que van desde lo clásico hasta lo más vanguardista, los tenis Diesel destacan por su atención al detalle y su calidad excepcional. Ya sea que estés buscando un look casual para el día a día o quieras añadir un toque de atrevimiento a tu outfit, los tenis Diesel tienen opciones para todos los gustos y ocasiones. Además de su estilo distintivo, ofrecen comodidad y durabilidad, lo que los convierte en una elección popular entre quienes buscan un calzado que se destaque tanto en la moda como en el rendimiento. ¡Prepárate para hacer una declaración de estilo con los tenis Diesel en tus pies!', 150.000, 20, 'diesel-.jpg', '35, 36, 37', 'Blue', 'Diesel'),
(17, 'NEW BALANCE 530 BLANCO AZUL GRIS', '¡Los New Balance 530 Blanco Azul Gris combinan estilo y comodidad a la perfección! Con su diseño clásico y colores atemporales, estas zapatillas son ideales para aquellos que buscan un look fresco y versátil. El blanco, el azul y el gris se combinan de manera armoniosa para crear un estilo moderno y urbano que se adapta a cualquier ocasión. Además, la tecnología de amortiguación de New Balance garantiza una pisada suave y cómoda durante todo el día. Ya sea que estés caminando por la ciudad o haciendo ejercicio, los New Balance 530 Blanco Azul Gris te brindarán el soporte que necesitas con un toque de estilo inigualable. ¡Prepárate para destacar con estas zapatillas que son un clásico instantáneo!', 250.000, 20, 'Newbalance.jpg', '35, 36, 37', 'Grey', 'Newbalance'),
(18, 'Nike Air Zoom ACG', '¡Conquista cualquier terreno con las Nike Air Zoom ACG! Diseñadas para la aventura, estas zapatillas combinan lo mejor del estilo urbano con el rendimiento de alto nivel en exteriores. Con su tecnología Air Zoom, ofrecen una amortiguación receptiva que te impulsa en cada paso, mientras que su suela robusta y tracción agresiva te brindan estabilidad en terrenos difíciles. Ya sea que estés explorando senderos montañosos o simplemente caminando por la ciudad, las Nike Air Zoom ACG te mantendrán cómodo y con estilo en cualquier situación. ¡Prepárate para desafiar los límites con estas zapatillas que te llevan más allá de lo convencional!', 190.000, 20, 'Nike AirZoom.jpg', '35, 36, 37', 'White', 'Nike'),
(19, 'Zapatillas Puma Carina 2.0', '¡Eleva tu estilo con las zapatillas Puma Carina 2.0! Inspiradas en el icónico estilo de los años 80, estas zapatillas fusionan la nostalgia retro con un toque moderno y fresco. Con su silueta aerodinámica y suela gruesa, las Carina 2.0 añaden altura y una dosis de actitud a tu look diario. Ya sea que las combines con unos jeans o un conjunto deportivo, estas zapatillas te brindan comodidad y estilo sin esfuerzo para cualquier ocasión. Prepárate para destacar con confianza en cada paso que des con las zapatillas Puma Carina 2.0, un clásico reinventado para la mujer moderna.', 90.199, 20, 'PumaCarina.jpg', '35, 36, 37', 'White', 'Puma'),
(20, 'DOLCE GABBANA NEGRO', 'Los zapatos Dolce & Gabbana en negro representan la esencia del lujo y la elegancia. Con su diseño sofisticado y detalles meticulosos, estos zapatos son el epítome del estilo italiano refinado. Ya sea que elijas unos tacones altos para una noche especial o unos mocasines para un look más casual, los zapatos Dolce & Gabbana en negro son una declaración de moda atemporal que nunca pasa de moda. Confeccionados con los mejores materiales y artesanía impecable, son el complemento perfecto para cualquier ocasión, añadiendo un toque de glamour y sofisticación a tu guardarropa. ¡Prepárate para destacar con estilo con los zapatos Dolce & Gabbana en negro!', 225.000, 20, 'Dolce.jpg', '35, 36, 37', 'Black', 'DOLCE GABBANA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `codpostal` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
