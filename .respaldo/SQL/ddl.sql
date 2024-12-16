CREATE DATABASE db_feria_virtual_cr;

CREATE TABLE TAB_TIPO_USUARIO(
    id_tipo_usuario INT AUTO_INCREMENT PRIMARY KEY,
    detalle VARCHAR(20) NOT NULL
);
INSERT INTO TAB_TIPO_USUARIO(detalle) VALUES
('cliente'),
('emprendedor');

CREATE TABLE TAB_PROVINCIAS(
    id_provincia INT AUTO_INCREMENT PRIMARY KEY,
    detalle VARCHAR(20) NOT NULL
);
INSERT INTO TAB_PROVINCIAS (detalle) VALUES
('San José'),
('Alajuela'),
('Cartago'),
('Heredia'),
('Guanacaste'),
('Puntarenas'),
('Limón');

CREATE TABLE TAB_CATEGORIAS(
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    detalle VARCHAR(50) NOT NULL
);
INSERT INTO TAB_CATEGORIAS (detalle) VALUES
('Electrónica'),
('Ropa y Accesorios'),
('Hogar y Jardín'),
('Salud y Belleza'),
('Juguetes y Juegos'),
('Arte y Artesanía'),
('Automotriz'),
('Mascotas'),
('Muebles'),
('Instrumentos Musicales'),
('Joyería y Bisutería'),
('Servicios Digitales'),
('Productos Orgánicos'),
('Decoración de Interiores');

CREATE TABLE TAB_ESTADO_PEDIDO(
    id_estado_pedido INT AUTO_INCREMENT PRIMARY KEY,
    detalle VARCHAR(20) NOT NULL
);
INSERT INTO TAB_ESTADO_PEDIDO (detalle) VALUES
('Activo'),
('Enviado'),
('Cancelado');

CREATE TABLE TAB_USUARIOS(
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_tipo_usuario INT NOT NULL DEFAULT 1,
    nombre VARCHAR(20),
    apellidos VARCHAR(50),
    correo VARCHAR(50) UNIQUE NOT NULL,
    contrasenia VARCHAR(255) NOT NULL,
    id_provincia INT,
    detalle_direccion VARCHAR(100),
    soft_delete TINYINT(1) DEFAULT 0,
    FOREIGN KEY (id_tipo_usuario) REFERENCES TAB_TIPO_USUARIO(id_tipo_usuario),
    FOREIGN KEY (id_provincia) REFERENCES TAB_PROVINCIAS(id_provincia)
);
INSERT INTO TAB_USUARIOS (id_tipo_usuario, nombre, apellidos, correo, contrasenia, id_provincia, detalle_direccion) 
VALUES
(2, 'Juan', 'Pérez', 'juan.perez@email.com', 'contrasena123', 1, 'Calle 1, San José');

CREATE TABLE TAB_EMPRENDIMIENTOS(
    id_emprendimiento INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nombre_emprendimiento VARCHAR(50) NOT NULL,
    descripcion_larga VARCHAR(1000) NOT NULL,
    telefono INT UNIQUE NOT NULL,
    url_imagen_perfil VARCHAR(255) NOT NULL,
    id_provincia INT NOT NULL,
    detalle_direccion VARCHAR(255) NOT NULL,
    descripcion_corta VARCHAR(255) NOT NULL,
    soft_delete TINYINT(1) DEFAULT 0,
    FOREIGN KEY (id_usuario) REFERENCES TAB_USUARIOS(id_usuario),
    FOREIGN KEY (id_provincia) REFERENCES TAB_PROVINCIAS(id_provincia)
);
INSERT INTO TAB_EMPRENDIMIENTOS (id_usuario, nombre_emprendimiento, descripcion_larga, telefono, url_imagen_perfil, id_provincia, detalle_direccion, descripcion_corta) 
VALUES
(1, 'Emprendimiento de Prueba', 'Descripción larga del emprendimiento de prueba', 12345678, 'https://answers-afd.microsoft.com/static/images/image-not-found.jpg', 1, 'Dirección del emprendimiento', 'Descripción corta');

CREATE TABLE TAB_PRODUCTOS(
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_emprendimiento INT NOT NULL,
    id_categoria INT NOT NULL,
    nombre_producto VARCHAR(20) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    url_imagen VARCHAR(255) NOT NULL,
    soft_delete TINYINT(1),
    FOREIGN KEY (id_emprendimiento) REFERENCES TAB_EMPRENDIMIENTOS(id_emprendimiento),
    FOREIGN KEY (id_categoria) REFERENCES TAB_CATEGORIAS(id_categoria)
);
INSERT INTO TAB_PRODUCTOS (id_emprendimiento, id_categoria, nombre_producto, descripcion, precio, stock, url_imagen) 
VALUES
(1, 1, 'Smartphone', 'Smartphone con pantalla de 6.5 pulgadas', 350.00, 50, 'https://answers-afd.microsoft.com/static/images/image-not-found.jpg'),
(1, 2, 'Camisa de Algodón', 'Camisa de algodón para hombre', 25.00, 100, 'https://answers-afd.microsoft.com/static/images/image-not-found.jpg'),
(1, 3, 'Silla de Oficina', 'Silla ergonómica de oficina', 120.00, 30, 'https://answers-afd.microsoft.com/static/images/image-not-found.jpg');


CREATE TABLE TAB_PEDIDOS (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_estado_pedido INT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_usuario) REFERENCES TAB_USUARIOS(id_usuario),
    FOREIGN KEY (id_estado_pedido) REFERENCES TAB_ESTADO_PEDIDO(id_estado_pedido)
);

INSERT INTO TAB_PEDIDOS (id_usuario, fecha, id_estado_pedido)
VALUES
(1, '2024-11-25 14:30:00', 1),
(1, '2024-11-26 09:00:00', 2);

CREATE TABLE TAB_EMPRENDIMIENTO_CATEGORIAS(
    id_emprendimiento INT NOT NULL,
    id_categoria INT NOT NULL,
    PRIMARY KEY (id_emprendimiento, id_categoria),
    FOREIGN KEY (id_emprendimiento) REFERENCES TAB_EMPRENDIMIENTOS(id_emprendimiento),
    FOREIGN KEY (id_categoria) REFERENCES TAB_CATEGORIAS(id_categoria)
);
INSERT INTO TAB_EMPRENDIMIENTO_CATEGORIAS (id_emprendimiento, id_categoria)
VALUES
(1, 1),
(1, 2),
(1, 3);

CREATE TABLE TAB_CARRITO_USUARIO(
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    PRIMARY KEY (id_usuario, id_producto),
    FOREIGN KEY (id_usuario) REFERENCES TAB_USUARIOS(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES TAB_PRODUCTOS(id_producto)
);
INSERT INTO TAB_CARRITO_USUARIO (id_usuario, id_producto, cantidad)
VALUES
(1, 1, 2),  -- 2 Smartphones
(1, 2, 3);  -- 3 Camisas de Algodón

CREATE TABLE TAB_PRODUCTOS_PEDIDO(
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES TAB_PEDIDOS(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES TAB_PRODUCTOS(id_producto)
);
INSERT INTO TAB_PRODUCTOS_PEDIDO (id_pedido, id_producto, cantidad, precio_unitario)
VALUES
(1, 1, 1, 350.00),  -- 1 Smartphone
(1, 2, 2, 25.00);   -- 2 Camisas de Algodón

CREATE TABLE TAB_PRODUCTOS_EMPRENDIMIENTO(
    id_emprendimiento INT NOT NULL,
    id_producto INT NOT NULL,
    precio INT NOT NULL,
    stock INT NOT NULL,  

    PRIMARY KEY (id_emprendimiento, id_producto),

    FOREIGN KEY (id_emprendimiento) REFERENCES TAB_EMPRENDIMIENTOS(id_emprendimiento),
    FOREIGN KEY (id_producto) REFERENCES TAB_PRODUCTOS(id_producto)
);

INSERT INTO TAB_PRODUCTOS_EMPRENDIMIENTO (id_emprendimiento, id_producto, precio, stock)
VALUES
(1, 1, 350, 50),  -- Smartphone
(1, 2, 25, 100),  -- Camisa de Algodón
(1, 3, 120, 30);  -- Silla de Oficina