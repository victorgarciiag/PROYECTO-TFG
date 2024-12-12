-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2024 a las 12:33:26
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
-- Base de datos: `bbdd_tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id` int(11) NOT NULL,
  `titulo_producto` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id`, `titulo_producto`, `precio`, `imagen`, `admin_id`) VALUES
(1, 'Línea Completa Akrapovic', 1299.00, 'Foto_escape_campo.jpg', NULL),
(2, 'Silenciador Akrapovic Carretera', 669.00, 'Foto_escape_carretera.jpg', NULL),
(3, 'Silenciador Akrapovic Enduro', 135.00, 'Foto_escape_enduro.jpg', NULL),
(4, 'Manillar Reinthal Motocross', 99.00, 'Foto_manillar.jpg', NULL),
(5, 'Puños Motocross', 21.00, 'Foto_puños.jpg', NULL),
(6, 'Corona cadena 49 dientes', 57.00, 'Foto_corona.jpg', NULL),
(7, 'Cadena reforzada 125 eslabones', 77.00, 'Foto_cadena.jpg', NULL),
(8, 'Llanta reforzada con buje mecanizado', 550.00, 'foto_llanta.jpg', NULL),
(9, 'Pinza de Freno Brembo', 560.00, 'foto_pinza_freno.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios_ayuda`
--

CREATE TABLE `formularios_ayuda` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `tipo_incidencia` enum('consulta','reparacion','mantenimiento','garantia','otro') NOT NULL,
  `fecha_incidencia` date NOT NULL,
  `descripcion` text NOT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formularios_ayuda`
--

INSERT INTO `formularios_ayuda` (`id`, `nombre_completo`, `email`, `telefono`, `tipo_incidencia`, `fecha_incidencia`, `descripcion`, `archivo_adjunto`, `usuario_id`, `admin_id`, `fecha_registro`) VALUES
(9, 'David Postigo', 'davidpostigo@gmail.com', '456345879', 'consulta', '2024-12-12', 'Me gustaría recibir información acerca de la financiación de los productos', NULL, NULL, NULL, '2024-12-12 12:14:20'),
(10, 'Victor Garcia Garrido', 'victorgarciia03@gmail.com', '618703459', 'garantia', '2024-11-10', 'Quiero recibir mas información acerca de la garantía de los productos.', NULL, NULL, NULL, '2024-12-12 12:15:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descripcion`, `imagen`, `link_video`, `admin_id`) VALUES
(1, 'Trepidante inicio de temporada: Red Bull KTM Factory Racing despega en el Gran Premio de Argentina MXGP 2024.', 'Los ganadores del Campeonato Mundial y defensores número 1 de la clase MX2, Red Bull KTM Factory Racing, lanzaron la temporada MXGP 2024 con Andrea Adamo logrando un resultado entre los cinco primeros en el oscuro suelo volcánico arenoso de Neuquén para el Gran Premio de Argentina y la primera ronda de veinte en la nueva campaña.', 'uploads/674ecc38538ab9.66666501-noticia2.jpeg', 'https://www.youtube.com/watch?v=-QnodJpBJgw', NULL),
(2, 'Chase Sexton y Tom Vialle reclaman podium de triple corona en Indianapolis.', 'Chase Sexton y Tom Vialle de Red Bull KTM Factory Racing obtuvieron resultados en el podio en la décima ronda de esta noche del Campeonato AMA Supercross 2024 en la Triple Corona de Indianápolis, con Sexton corriendo hacia el tercer lugar general en 450SX y Vialle terminando segundo en el Evento Principal 250SX.', 'uploads/674ecc54bf9ca3.21622172-noticia1.jpeg', 'https://www.youtube.com/watch?v=wJKij5Ph4xc', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `servicio` enum('consultoria','reserva moto','mantenimiento','otros') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `comentarios` text DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `concesionario` enum('Concesionario KTM - Sevilla','Concesionario KTM - Madrid','Concesionario KTM - Barcelona','Concesionario KTM - Valencia','Concesionario KTM - Málaga','Concesionario KTM - Bilbao','Concesionario KTM - Murcia','Concesionario KTM - Vigo','Concesionario KTM - Tenerife','Concesionario KTM - Alicante') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre`, `email`, `telefono`, `servicio`, `cantidad`, `fecha`, `hora`, `comentarios`, `fecha_registro`, `usuario_id`, `concesionario`) VALUES
(9, 'David Postigo', 'victorgarciia03@gmail.com', '32425435', 'mantenimiento', 1, '2024-12-19', '12:00:00', '', '2024-12-12 11:59:33', NULL, 'Concesionario KTM - Málaga'),
(10, 'Victor Garcia Garrido', 'victorgarciia03@gmail.com', '618703459', 'consultoria', 1, '2024-12-19', '13:00:00', 'Me gustaría recibir mas información acerca del modelo ADVENTURE', '2024-12-12 12:00:09', NULL, 'Concesionario KTM - Sevilla'),
(11, 'Jose Manuel Guillamon', 'josemanuelguillamon@gmailcom', '345234532', 'mantenimiento', 1, '2024-12-12', '11:00:00', 'Cambio de aceite a mi KTM Enduro 450', '2024-12-12 12:01:10', NULL, 'Concesionario KTM - Murcia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `usuario`, `contrasena`, `email`, `telefono`, `fecha_nacimiento`, `fecha_registro`) VALUES
(1, 'Victor García Garrido', 'victorgarcia', '$2y$10$JdbvBiusag/T3R.HGBXLeeMUmK6hjxl4TRiEz0fQlWK8qR.jogW6O', 'victorgarciia03@gmail.com', '618703459', '2003-02-06', '2024-12-03 10:05:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_admin`
--

CREATE TABLE `usuarios_admin` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_admin`
--

INSERT INTO `usuarios_admin` (`id`, `nombre_completo`, `usuario`, `contrasena`, `email`, `telefono`, `fecha_nacimiento`, `fecha_registro`) VALUES
(1, 'Victor Garcia Garrido', 'admin', 'admin', 'victorgarciia03@gmail.com', '618703459', '2003-02-06', '2024-12-03 10:07:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indices de la tabla `formularios_ayuda`
--
ALTER TABLE `formularios_ayuda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `formularios_ayuda`
--
ALTER TABLE `formularios_ayuda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios_admin`
--
ALTER TABLE `usuarios_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD CONSTRAINT `accesorios_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `usuarios_admin` (`id`);

--
-- Filtros para la tabla `formularios_ayuda`
--
ALTER TABLE `formularios_ayuda`
  ADD CONSTRAINT `formularios_ayuda_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `formularios_ayuda_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `usuarios_admin` (`id`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `usuarios_admin` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
