<?php
session_start();
require_once '../model/db.php';
require_once '../model/cliente.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];
$idProvincia = $_POST['id_provincia'] ?? null;
$detalleDireccion = $_POST['detalle_direccion'] ?? null;

if (!$idProvincia || !$detalleDireccion) {
    header("Location: /AmbienteWeb/views/cliente/editarDireccion.php?error=Todos%20los%20campos%20son%20obligatorios");
    exit;
}

$clienteModel = new Cliente($conn);
$resultado = $clienteModel->actualizarDireccionUsuario($idUsuario, $idProvincia, $detalleDireccion);

if ($resultado) {
    header("Location: /AmbienteWeb/views/usuarios/perfilUsuario.php?success=Dirección%20actualizada%20correctamente");
} else {
    header("Location: /AmbienteWeb/views/cliente/editarPerfilUsuario.php?error=No%20se%20pudo%20actualizar%20la%20dirección");
}
