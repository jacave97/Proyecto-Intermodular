-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 01-05-2026 a las 15:41:32
-- Versión del servidor: 9.6.0
-- Versión de PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ayuda_al_viajero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DESTINOS`
--

CREATE TABLE `DESTINOS` (
  `Id_Destinos` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `país` varchar(100) NOT NULL,
  `continente` varchar(100) NOT NULL,
  `descripción` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `DESTINOS`
--

INSERT INTO `DESTINOS` (`Id_Destinos`, `nombre`, `país`, `continente`, `descripción`) VALUES
(7, 'Barcelona', 'España', 'Europa', 'Sagrada Familia'),
(8, 'Ginebra', 'Suiza', 'Europa', 'Donde se estafa dinero'),
(9, 'Washington', 'EEUU', 'America del Norte', 'Donal trump'),
(10, 'Valencia', 'España', 'Europa', 'Viaje en Bicicleta'),
(11, 'Murta', 'España', 'Europa', 'Montañas de alzira'),
(12, 'Alambra', 'Andalucia', 'España', 'Alambra de Granada'),
(13, 'Rusia', 'Moscu', 'Europa', 'Donde se bebe mucho vozka');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GUIAS`
--

CREATE TABLE `GUIAS` (
  `Id_guias` int NOT NULL,
  `destinos_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Comentario` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GUIA_GASTRONOMICA`
--

CREATE TABLE `GUIA_GASTRONOMICA` (
  `Id_guias` int NOT NULL,
  `precio_medio` decimal(6,2) DEFAULT NULL,
  `tipo_cocina` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GUIA_RUTA`
--

CREATE TABLE `GUIA_RUTA` (
  `Id_guias` int NOT NULL,
  `distancia_km` decimal(5,2) NOT NULL,
  `dificultad` enum('baja','media','alta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RESEÑAS`
--

CREATE TABLE `RESEÑAS` (
  `Id_reseñas` int NOT NULL,
  `destinos_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `Comentarios` text NOT NULL,
  `Valoración` tinyint DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `RESEÑAS`
--

INSERT INTO `RESEÑAS` (`Id_reseñas`, `destinos_id`, `usuario_id`, `Comentarios`, `Valoración`) VALUES
(5, 7, 10, 'No es tan espectacular ', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `Id_usuario` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`Id_usuario`, `nombre`, `email`, `contraseña`, `rol`) VALUES
(10, 'Abel', 'absaal@alumnatflorida.es', '1234', 'admin'),
(11, 'Lorena', 'lorena@gmail.com', '1234', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `DESTINOS`
--
ALTER TABLE `DESTINOS`
  ADD PRIMARY KEY (`Id_Destinos`);

--
-- Indices de la tabla `GUIAS`
--
ALTER TABLE `GUIAS`
  ADD PRIMARY KEY (`Id_guias`),
  ADD KEY `destinos_id` (`destinos_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `GUIA_GASTRONOMICA`
--
ALTER TABLE `GUIA_GASTRONOMICA`
  ADD PRIMARY KEY (`Id_guias`);

--
-- Indices de la tabla `GUIA_RUTA`
--
ALTER TABLE `GUIA_RUTA`
  ADD PRIMARY KEY (`Id_guias`);

--
-- Indices de la tabla `RESEÑAS`
--
ALTER TABLE `RESEÑAS`
  ADD PRIMARY KEY (`Id_reseñas`),
  ADD KEY `destinos_id` (`destinos_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `DESTINOS`
--
ALTER TABLE `DESTINOS`
  MODIFY `Id_Destinos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `GUIAS`
--
ALTER TABLE `GUIAS`
  MODIFY `Id_guias` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `RESEÑAS`
--
ALTER TABLE `RESEÑAS`
  MODIFY `Id_reseñas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `Id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `GUIAS`
--
ALTER TABLE `GUIAS`
  ADD CONSTRAINT `GUIAS_ibfk_1` FOREIGN KEY (`destinos_id`) REFERENCES `DESTINOS` (`Id_Destinos`) ON DELETE CASCADE,
  ADD CONSTRAINT `GUIAS_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `USUARIOS` (`Id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `GUIA_GASTRONOMICA`
--
ALTER TABLE `GUIA_GASTRONOMICA`
  ADD CONSTRAINT `GUIA_GASTRONOMICA_ibfk_1` FOREIGN KEY (`Id_guias`) REFERENCES `GUIAS` (`Id_guias`) ON DELETE CASCADE;

--
-- Filtros para la tabla `GUIA_RUTA`
--
ALTER TABLE `GUIA_RUTA`
  ADD CONSTRAINT `GUIA_RUTA_ibfk_1` FOREIGN KEY (`Id_guias`) REFERENCES `GUIAS` (`Id_guias`) ON DELETE CASCADE;

--
-- Filtros para la tabla `RESEÑAS`
--
ALTER TABLE `RESEÑAS`
  ADD CONSTRAINT `RESEÑAS_ibfk_1` FOREIGN KEY (`destinos_id`) REFERENCES `DESTINOS` (`Id_Destinos`) ON DELETE CASCADE,
  ADD CONSTRAINT `RESEÑAS_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `USUARIOS` (`Id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
