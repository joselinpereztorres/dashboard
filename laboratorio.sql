-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2026 a las 10:28:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laboratorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `correo`, `telefono`, `ubicacion`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Refinería del Bajío S.A.', 'operaciones@refbajio.com', '2272345678', 'Guanajuato', 1, '2026-03-19 19:03:09', 1, '2026-03-24 05:07:46', 1),
(2, 'Energéticos del Norte', 'analisis@energnorte.com', '8183456789', 'Nuevo León', 1, '2026-03-19 19:03:09', 2, '2026-03-19 19:03:09', 2),
(3, 'Combustibles del Centro', 'lab@combucentro.com', '2224567890', 'Puebla', 1, '2026-03-19 19:03:09', 2, '2026-03-19 19:03:09', 2),
(4, 'Servicios Petroleros del Golfo', 'muestras@golfoenergy.com', '9935678901', 'Tabasco', 1, '2026-03-19 19:03:09', 1, '2026-03-19 19:03:09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestras`
--

CREATE TABLE `muestras` (
  `id_muestra` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `prioridad` enum('baja','normal','alta','urgente') NOT NULL DEFAULT 'normal',
  `observaciones` text NOT NULL,
  `estado` enum('pendiente','en progreso','completado','urgente') DEFAULT 'en progreso',
  `horas_estimadas` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `muestras`
--

INSERT INTO `muestras` (`id_muestra`, `id_proyecto`, `codigo`, `fecha_inicio`, `fecha_fin`, `prioridad`, `observaciones`, `estado`, `horas_estimadas`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'MUE-001', '2026-01-16', '2026-01-21', 'alta', 'Análisis de rutas inicial', 'pendiente', 0, '2026-03-22 16:58:42', 1, '2026-03-24 05:40:29', 1),
(2, 1, 'MUE-002', '2026-01-15', '2026-01-25', 'normal', 'Evaluación de tiempos logísticos', '', 0, '2026-03-22 16:58:42', 2, '2026-03-22 16:58:42', 2),
(3, 2, 'MUE-003', '2026-02-02', '2026-02-15', 'urgente', 'Instalación de estación piloto', '', 0, '2026-03-22 16:58:42', 1, '2026-03-22 16:58:42', 1),
(4, 2, 'MUE-004', '2026-02-05', '2026-02-18', 'alta', 'Validación de red energética', 'pendiente', 0, '2026-03-22 16:58:42', 2, '2026-03-22 16:58:42', 2),
(5, 3, 'MUE-005', '2026-01-22', '2026-02-05', 'normal', 'Monitoreo de inventario base', 'completado', 0, '2026-03-22 16:58:42', 1, '2026-03-22 16:58:42', 1),
(6, 3, 'MUE-006', '2026-01-25', '2026-02-10', 'alta', 'Control de combustibles críticos', '', 0, '2026-03-22 16:58:42', 2, '2026-03-22 16:58:42', 2),
(7, 4, 'MUE-007', '2026-03-05', '2026-03-20', 'urgente', 'Exploración geológica inicial', 'pendiente', 0, '2026-03-22 16:58:42', 1, '2026-03-22 16:58:42', 1),
(8, 4, 'MUE-008', '2026-03-10', '2026-03-28', 'alta', 'Análisis de suelo profundo', '', 0, '2026-03-22 16:58:42', 2, '2026-03-22 16:58:42', 2),
(9, 5, 'MUE-009', '2026-02-20', '2026-03-05', 'normal', 'Implementación ERP pruebas', 'completado', 0, '2026-03-22 16:58:42', 2, '2026-03-22 16:58:42', 2),
(10, 5, 'MUE-010', '2026-02-25', '2026-03-15', 'alta', 'Integración de módulos', '', 0, '2026-03-22 16:58:42', 1, '2026-03-22 16:58:42', 1),
(13, 2, 'MUE-013', '2026-03-01', '2026-03-20', 'urgente', 'Expansión fase 2', 'pendiente', 0, '2026-03-22 16:58:42', 1, '2026-03-22 16:58:42', 1),
(14, 3, 'MUE-014', '2026-02-10', '2026-02-28', 'normal', 'Control secundario', 'completado', 0, '2026-03-22 16:58:42', 2, '2026-03-22 16:58:42', 2),
(16, 3, 'MUE-017', '2026-02-25', '2026-03-26', 'normal', 'Ninguna', 'pendiente', 1, '2026-03-23 21:59:05', 1, '2026-03-23 21:59:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `id_cliente`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Optimización logística Bajío', 'Mejora de rutas y tiempos de entrega en la región Bajío', '2026-01-22', '2026-04-30', 1, '2026-03-22 05:03:47', 1, '2026-03-24 05:23:00', 1),
(2, 2, 'Expansión red energética norte', 'Implementación de nuevas estaciones de distribución eléctrica', '2026-02-01', '2026-06-15', 1, '2026-03-22 05:03:47', 1, '2026-03-22 05:03:47', 1),
(3, 3, 'Control de combustibles Puebla', 'Sistema de monitoreo y control de inventario de combustibles', '2026-01-20', '2026-05-10', 1, '2026-03-22 05:03:47', 1, '2026-03-22 05:03:47', 1),
(4, 4, 'Exploración Golfo Sur', 'Análisis geológico para nuevas zonas de extracción', '2026-03-01', '2026-09-01', 1, '2026-03-22 05:03:47', 2, '2026-03-22 16:52:46', 2),
(5, 1, 'Optimización logística Bajío', 'Mejora de rutas y tiempos de entrega en la región Bajío', '2026-01-22', '2026-04-30', 1, '2026-03-22 05:03:47', 2, '2026-03-24 05:23:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id_resultado` int(11) NOT NULL,
  `id_muestra` int(11) NOT NULL,
  `resultado` text NOT NULL,
  `fecha` datetime NOT NULL,
  `observaciones` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id_resultado`, `id_muestra`, `resultado`, `fecha`, `observaciones`, `id_usuario`, `created_at`) VALUES
(1, 1, 'Aprobado', '2026-03-22 10:00:00', 'Sin anomalías', 2, '2026-03-23 05:55:25'),
(2, 2, 'Rechazado', '2026-03-22 10:30:00', 'Problemas logísticos detectados', 3, '2026-03-23 05:55:25'),
(3, 3, 'Aprobado', '2026-03-22 11:00:00', 'Instalación correcta', 1, '2026-03-23 05:55:25'),
(4, 4, 'Aprobado', '2026-03-22 11:20:00', 'Validación exitosa', 4, '2026-03-23 05:55:25'),
(5, 5, 'Rechazado', '2026-03-22 11:40:00', 'Error en inventario base', 2, '2026-03-23 05:55:25'),
(6, 6, 'Aprobado', '2026-03-22 12:00:00', 'Control correcto', 3, '2026-03-23 05:55:25'),
(7, 7, 'En proceso', '2026-03-22 12:20:00', 'Exploración en curso', 1, '2026-03-23 05:55:25'),
(8, 8, 'Aprobado', '2026-03-22 12:40:00', 'Análisis de suelo correcto', 5, '2026-03-23 05:55:25'),
(9, 9, 'Rechazado', '2026-03-22 13:00:00', 'Fallas en ERP', 7, '2026-03-23 05:55:25'),
(10, 10, 'Aprobado', '2026-03-22 13:20:00', 'Integración completada', 8, '2026-03-23 05:55:25'),
(11, 13, 'Aprobado', '2026-03-18 00:00:00', 'Ninguna', 1, '2026-03-24 08:07:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rol` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `correo`, `password`, `status`, `rol`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Jorge', 'Sanchez', 'admin@laboratorio.com', '$2y$10$z5oa1eKmZPENNO8Y5it7seDWfnzPG5Q5lVcjB19SOs3HjCEVEKlPG', 1, 'superadmin', '2026-03-24 08:43:34', 1, '2026-03-24 08:43:34', 1),
(2, 'Anahi', 'Lopez', 'ana@laboratorio.com', '$2y$10$z5oa1eKmZPENNO8Y5it7seDWfnzPG5Q5lVcjB19SOs3HjCEVEKlPG', 0, 'analista', '2026-03-24 08:30:30', 1, '2026-03-24 08:30:30', 1),
(3, 'Carlos', 'Perez', 'carlos@laboratorio.com', '$2y$10$z5oa1eKmZPENNO8Y5it7seDWfnzPG5Q5lVcjB19SOs3HjCEVEKlPG', 1, 'analista', '2026-03-24 08:28:08', 1, '2026-03-24 08:28:08', 1),
(4, 'Maria', 'Gomez', 'maria@laboratorio.com', '$2y$10$z5oa1eKmZPENNO8Y5it7seDWfnzPG5Q5lVcjB19SOs3HjCEVEKlPG', 1, 'analista', '2026-03-24 06:55:18', 1, '2026-03-24 06:55:18', NULL),
(5, 'Andrea', 'Perez', 'andrea@laboratorio.com', '$2y$10$z5oa1eKmZPENNO8Y5it7seDWfnzPG5Q5lVcjB19SOs3HjCEVEKlPG', 1, 'analista', '2026-03-24 06:55:23', 1, '2026-03-24 06:55:23', NULL),
(7, 'Gerardo', 'Ortiz', 'gerardo@laboratorio.com', '$2y$10$z5oa1eKmZPENNO8Y5it7seDWfnzPG5Q5lVcjB19SOs3HjCEVEKlPG', 1, 'superadmin', '2026-03-24 08:30:44', 1, '2026-03-24 08:30:44', 1),
(8, 'Karla', 'Bautista', 'karla@laboratorio.com', '$2y$10$z5oa1eKmZPENNO8Y5it7seDWfnzPG5Q5lVcjB19SOs3HjCEVEKlPG', 1, 'analista', '2026-03-24 08:30:04', 1, '2026-03-24 08:30:04', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `muestras`
--
ALTER TABLE `muestras`
  ADD PRIMARY KEY (`id_muestra`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `resultados_ibfk_1` (`id_muestra`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `muestras`
--
ALTER TABLE `muestras`
  MODIFY `id_muestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `muestras`
--
ALTER TABLE `muestras`
  ADD CONSTRAINT `muestras_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_ibfk_1` FOREIGN KEY (`id_muestra`) REFERENCES `muestras` (`id_muestra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultados_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
