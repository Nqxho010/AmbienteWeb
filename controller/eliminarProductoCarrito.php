<?php
session_start();
require_once '../model/db.php';
require_once '../model/carrito.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['idUsuario'])) {
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
        exit;
    }

    $idUsuario = $_SESSION['idUsuario'];
    $idProducto = isset($_POST['idProducto']) ? intval($_POST['idProducto']) : null;

    if (!$idProducto) {
        header("Location: /AmbienteWeb/views/usuarios/carrito.php?error=Datos%20inválidos");
        exit;
    }

    try {
        $carritoModel = new Carrito($conn);

        // Eliminar el producto del carrito
        if ($carritoModel->eliminarProducto($idUsuario, $idProducto)) {
            header("Location: /AmbienteWeb/views/usuarios/carritoUsuario.php?success=Producto%20eliminado%20del%20carrito");
        } else {
            header("Location: /AmbienteWeb/views/usuarios/carritoUsuario.php?error=Error%20al%20eliminar%20el%20producto");
        }
    } catch (Exception $e) {
        error_log("Error en el controlador al eliminar producto: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/usuarios/carritoUsuario.php?error=Error%20inesperado");
    }
    exit;
}
