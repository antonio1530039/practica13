-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2018 a las 13:22:04
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica13`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `tiendas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `deleted`, `tiendas_id`) VALUES
(1, 'Lacteos', 0, 1),
(2, 'Abarrotes', 0, 2),
(3, 'Carnes', 0, 2),
(20, 'Reposteria', 0, 2),
(21, 'Cat2', 1, 2),
(22, 'Semillas', 0, 2),
(23, 'c1', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `tiendas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio_unitario`, `stock`, `id_categoria`, `fecha_registro`, `deleted`, `tiendas_id`) VALUES
(7, 'Cod01', 'Galletas Lors - Extra Queso', 'Galletas de maiz', '11.50', 295, 2, '2018-06-09', 0, 2),
(8, 'p02', 'Coca cola 600 ml', 'Refresco de cola', '15.00', 0, 3, '2018-06-09', 0, 2),
(9, 'p21', 'Cigarros Marbolo Rojo 14\'s', 'Tabaco', '52.00', 0, 2, '2018-06-09', 0, 2),
(10, 'pd01', 'Galletas Lors', 'z', '22.00', 31, 2, '2018-06-09', 0, 2),
(11, '3232', 'weqeqwe Editado', 'wqeqe', '22.00', 0, 2, '2018-06-09', 0, 2),
(12, '435', '2222222', '22222', '222.00', 2222, 2, '2018-06-09', 1, 2),
(13, 'pruebaProd', 'Martillo', 'Martillo de fierro', '250.00', 100, 2, '2018-06-09', 1, 2),
(14, 'p1', 'productodeprueba', 'gggg', '100.00', 199, 23, '2018-06-11', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id`, `nombre`, `direccion`, `fecha_registro`, `active`, `deleted`) VALUES
(1, 'Sucursal Root', 'Col centro', '2018-06-05', 1, 0),
(2, 'GranD', 'Col. Centro Cd Victoria', '2018-06-04', 1, 0),
(3, 'Walmart', 'Cd. Victoria', '2018-06-03', 1, 0),
(9, 'TiendaMainero', 'Col mainero', '2018-06-01', 1, 0),
(10, 'Waldos', '16 Guerrero', '2018-06-11', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `serie` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `tiendas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id`, `id_producto`, `id_usuario`, `cantidad`, `tipo`, `fecha`, `serie`, `deleted`, `tiendas_id`) VALUES
(10, 9, 1, 50, 'Entrada', '2018-06-08', '928321', 0, 2),
(11, 8, 1, 5, 'Salida', '2018-06-07', '9382', 0, 2),
(12, 9, 1, 10, 'Salida', '2018-06-05', '2812', 0, 2),
(13, 8, 1, 10, 'Entrada', '2018-06-06', '232132', 0, 2),
(14, 8, 1, 5, 'Entrada', '2018-06-09', '123', 0, 2),
(15, 7, 1, 6, 'Entrada', '2018-06-09', '7777', 0, 2),
(16, 7, 2, 300, 'Entrada', '2018-06-11', '10101', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL,
  `tipo_usuario` int(11) DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `tiendas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `fecha_registro`, `tipo_usuario`, `deleted`, `tiendas_id`) VALUES
(1, 'mario', 'mario', '2018-06-07', 1, 0, 1),
(2, 'jose', 'jose', '2018-06-07', 0, 0, 2),
(10, 'qwerty2', 'qwerty2x', '2018-06-09', 0, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tiendas_id` int(11) NOT NULL,
  `total` decimal(20,2) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `id_usuario`, `tiendas_id`, `total`, `deleted`) VALUES
(27, '2018-06-11', 1, 2, '2050.00', 0),
(28, '2018-06-11', 1, 2, '2149.00', 0),
(29, '2018-06-11', 1, 2, '55704.00', 0),
(30, '2018-06-11', 2, 2, '101.50', 0),
(31, '2018-06-11', 1, 3, '10100.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_productos`
--

CREATE TABLE `ventas_productos` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas_productos`
--

INSERT INTO `ventas_productos` (`id`, `id_producto`, `id_venta`, `cantidad`, `subtotal`, `deleted`) VALUES
(9, 7, 27, 100, '1150.00', 0),
(10, 8, 27, 60, '900.00', 0),
(11, 7, 28, 6, '69.00', 0),
(12, 9, 28, 40, '2080.00', 0),
(13, 11, 29, 2232, '49104.00', 0),
(14, 10, 29, 300, '6600.00', 0),
(15, 7, 30, 5, '57.50', 0),
(16, 10, 30, 2, '44.00', 0),
(17, 14, 31, 101, '10100.00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorias_tiendas1_idx` (`tiendas_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `fk_productos_tiendas1_idx` (`tiendas_id`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `fk_transaccion_tiendas1_idx` (`tiendas_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_tiendas1_idx` (`tiendas_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tienda` (`tiendas_id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categorias_tiendas1` FOREIGN KEY (`tiendas_id`) REFERENCES `tiendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_tiendas1` FOREIGN KEY (`tiendas_id`) REFERENCES `tiendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_transaccion_tiendas1` FOREIGN KEY (`tiendas_id`) REFERENCES `tiendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaccion_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `transaccion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_tiendas1` FOREIGN KEY (`tiendas_id`) REFERENCES `tiendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`tiendas_id`) REFERENCES `tiendas` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD CONSTRAINT `ventas_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `ventas_productos_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
