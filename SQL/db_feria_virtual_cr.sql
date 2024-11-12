-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 12:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_feria_virtual_cr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tab_carrito_usuario`
--

CREATE TABLE `tab_carrito_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_categorias`
--

CREATE TABLE `tab_categorias` (
  `id_categoria` int(11) NOT NULL,
  `detalle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tab_categorias`
--

INSERT INTO `tab_categorias` (`id_categoria`, `detalle`) VALUES
(1, 'Electrónica'),
(2, 'Ropa y Accesorios'),
(3, 'Hogar y Jardín'),
(4, 'Salud y Belleza'),
(5, 'Juguetes y Juegos'),
(6, 'Arte y Artesanía'),
(7, 'Automotriz'),
(8, 'Mascotas'),
(9, 'Muebles'),
(10, 'Instrumentos Musicales'),
(11, 'Joyería y Bisutería'),
(12, 'Servicios Digitales'),
(13, 'Productos Orgánicos'),
(14, 'Decoración de Interiores');

-- --------------------------------------------------------

--
-- Table structure for table `tab_emprendimientos`
--

CREATE TABLE `tab_emprendimientos` (
  `id_emprendimiento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_emprendimiento` varchar(50) NOT NULL,
  `descripcion_larga` varchar(1000) NOT NULL,
  `telefono` int(11) NOT NULL,
  `url_imagen_perfil` varchar(255) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `detalle_direccion` varchar(255) NOT NULL,
  `descripcion_corta` varchar(255) NOT NULL,
  `soft_delete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_emprendimiento_categorias`
--

CREATE TABLE `tab_emprendimiento_categorias` (
  `id_emprendimiento` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_estado_pedido`
--

CREATE TABLE `tab_estado_pedido` (
  `id_estado_pedido` int(11) NOT NULL,
  `detalle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tab_estado_pedido`
--

INSERT INTO `tab_estado_pedido` (`id_estado_pedido`, `detalle`) VALUES
(1, 'Activo'),
(2, 'Enviado'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Table structure for table `tab_pedidos`
--

CREATE TABLE `tab_pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `id_estado_pedido` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_productos`
--

CREATE TABLE `tab_productos` (
  `id_producto` int(11) NOT NULL,
  `id_emprendimiento` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre_producto` varchar(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL,
  `soft_delete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_productos_pedido`
--

CREATE TABLE `tab_productos_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_provincias`
--

CREATE TABLE `tab_provincias` (
  `id_provincia` int(11) NOT NULL,
  `detalle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tab_provincias`
--

INSERT INTO `tab_provincias` (`id_provincia`, `detalle`) VALUES
(1, 'San José'),
(2, 'Alajuela'),
(3, 'Cartago'),
(4, 'Heredia'),
(5, 'Guanacaste'),
(6, 'Puntarenas'),
(7, 'Limón');

-- --------------------------------------------------------

--
-- Table structure for table `tab_tipo_usuario`
--

CREATE TABLE `tab_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `detalle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tab_tipo_usuario`
--

INSERT INTO `tab_tipo_usuario` (`id_tipo_usuario`, `detalle`) VALUES
(1, 'cliente'),
(2, 'emprendedor');

-- --------------------------------------------------------

--
-- Table structure for table `tab_usuarios`
--

CREATE TABLE `tab_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL DEFAULT 1,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasenia` varchar(20) NOT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `detalle_direccion` varchar(100) DEFAULT NULL,
  `soft_delete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_carrito_usuario`
--
ALTER TABLE `tab_carrito_usuario`
  ADD PRIMARY KEY (`id_usuario`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `tab_categorias`
--
ALTER TABLE `tab_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `tab_emprendimientos`
--
ALTER TABLE `tab_emprendimientos`
  ADD PRIMARY KEY (`id_emprendimiento`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_provincia` (`id_provincia`);

--
-- Indexes for table `tab_emprendimiento_categorias`
--
ALTER TABLE `tab_emprendimiento_categorias`
  ADD PRIMARY KEY (`id_emprendimiento`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `tab_estado_pedido`
--
ALTER TABLE `tab_estado_pedido`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indexes for table `tab_pedidos`
--
ALTER TABLE `tab_pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estado_pedido` (`id_estado_pedido`);

--
-- Indexes for table `tab_productos`
--
ALTER TABLE `tab_productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_emprendimiento` (`id_emprendimiento`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `tab_productos_pedido`
--
ALTER TABLE `tab_productos_pedido`
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `tab_provincias`
--
ALTER TABLE `tab_provincias`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indexes for table `tab_tipo_usuario`
--
ALTER TABLE `tab_tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indexes for table `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`),
  ADD KEY `id_provincia` (`id_provincia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_categorias`
--
ALTER TABLE `tab_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tab_emprendimientos`
--
ALTER TABLE `tab_emprendimientos`
  MODIFY `id_emprendimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tab_estado_pedido`
--
ALTER TABLE `tab_estado_pedido`
  MODIFY `id_estado_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tab_pedidos`
--
ALTER TABLE `tab_pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tab_productos`
--
ALTER TABLE `tab_productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tab_provincias`
--
ALTER TABLE `tab_provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tab_tipo_usuario`
--
ALTER TABLE `tab_tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tab_carrito_usuario`
--
ALTER TABLE `tab_carrito_usuario`
  ADD CONSTRAINT `tab_carrito_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tab_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tab_carrito_usuario_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tab_productos` (`id_producto`);

--
-- Constraints for table `tab_emprendimientos`
--
ALTER TABLE `tab_emprendimientos`
  ADD CONSTRAINT `tab_emprendimientos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tab_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tab_emprendimientos_ibfk_2` FOREIGN KEY (`id_provincia`) REFERENCES `tab_provincias` (`id_provincia`);

--
-- Constraints for table `tab_emprendimiento_categorias`
--
ALTER TABLE `tab_emprendimiento_categorias`
  ADD CONSTRAINT `tab_emprendimiento_categorias_ibfk_1` FOREIGN KEY (`id_emprendimiento`) REFERENCES `tab_emprendimientos` (`id_emprendimiento`),
  ADD CONSTRAINT `tab_emprendimiento_categorias_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tab_categorias` (`id_categoria`);

--
-- Constraints for table `tab_pedidos`
--
ALTER TABLE `tab_pedidos`
  ADD CONSTRAINT `tab_pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tab_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tab_pedidos_ibfk_2` FOREIGN KEY (`id_estado_pedido`) REFERENCES `tab_estado_pedido` (`id_estado_pedido`);

--
-- Constraints for table `tab_productos`
--
ALTER TABLE `tab_productos`
  ADD CONSTRAINT `tab_productos_ibfk_1` FOREIGN KEY (`id_emprendimiento`) REFERENCES `tab_emprendimientos` (`id_emprendimiento`),
  ADD CONSTRAINT `tab_productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `tab_categorias` (`id_categoria`);

--
-- Constraints for table `tab_productos_pedido`
--
ALTER TABLE `tab_productos_pedido`
  ADD CONSTRAINT `tab_productos_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `tab_pedidos` (`id_pedido`),
  ADD CONSTRAINT `tab_productos_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tab_productos` (`id_producto`);

--
-- Constraints for table `tab_usuarios`
--
ALTER TABLE `tab_usuarios`
  ADD CONSTRAINT `tab_usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tab_tipo_usuario` (`id_tipo_usuario`),
  ADD CONSTRAINT `tab_usuarios_ibfk_2` FOREIGN KEY (`id_provincia`) REFERENCES `tab_provincias` (`id_provincia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
