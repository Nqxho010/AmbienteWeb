<?php
session_start();
require_once '../model/db.php';
require_once '../model/carrito.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['idUsuario'])) {
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20agregar%20productos%20al%20carrito");
        exit;
    }

    $idUsuario = $_SESSION['idUsuario'];
    $idProducto = isset($_POST['idProducto']) ? intval($_POST['idProducto']) : null;
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : null;

    if (!$idProducto || !$cantidad || $cantidad <= 0) {
        header("Location: /AmbienteWeb/views/productos/detalleProducto.php?idProducto=$idProducto&error=Datos%20inválidos");
        exit;
    }

    try {
        $carritoModel = new Carrito($conn);

        // Verificar si el producto ya existe en el carrito
        if ($carritoModel->existeProducto($idUsuario, $idProducto)) {
            // Actualizar
            if ($carritoModel->actualizarCantidad($idUsuario, $idProducto, $cantidad)) {
                header("Location: /AmbienteWeb/views/usuarios/productos.php?");
            } else {
                header("Location: /AmbienteWeb/views/usuarios/detalleProducto.php?idProducto=$idProducto&error=error%20al%20actualizar%20el%20producto");
            }
        } else {
            // Insertar
            if ($carritoModel->insertarProducto($idUsuario, $idProducto, $cantidad)) {
                header("Location: /AmbienteWeb/views/usuarios/productos.php?");
            } else {
                header("Location: /AmbienteWeb/views/productos/detalleProducto.php?idProducto=$idProducto&error=error%20al%20agregar%20el%20producto");
            }
        }
    } catch (Exception $e) {
        error_log("Error en el controlador del carrito: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/usuarios/detalleProducto.php?idProducto=$idProducto&error=Error%20inesperado");
    }
    exit;
} else {
    header("Location: /AmbienteWeb/index.php");
    exit;
}
