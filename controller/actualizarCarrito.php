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
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : null;

    if (!$idProducto || !$cantidad || $cantidad <= 0) {
        header("Location: /AmbienteWeb/views/usuarios/carrito.php?error=Datos%20inválidos");
        exit;
    }

    try {
        $carritoModel = new Carrito($conn);

        // Actualizar la cantidad del producto en el carrito
        if ($carritoModel->actualizarCantidad($idUsuario, $idProducto, $cantidad)) {
            header("Location: /AmbienteWeb/views/usuarios/carrito.php?success=Cantidad%20actualizada");
        } else {
            header("Location: /AmbienteWeb/views/usuarios/carrito.php?error=Error%20al%20actualizar%20la%20cantidad");
        }
    } catch (Exception $e) {
        error_log("Error en el controlador al modificar la cantidad: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/usuarios/carrito.php?error=Error%20inesperado");
    }
    exit;
}
