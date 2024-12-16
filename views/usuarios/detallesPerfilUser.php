<?php
session_start();
require_once './views/layout/head.php';
require_once './views/layout/header.php';
require_once './model/db.php';
require_once './model/usuario.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

try {
    $id_usuario = $_SESSION['id_usuario'];
    $usuarioModel = new Usuario($conn);

    // Obtener los detalles del usuario logueado
    $usuarioDetalles = $usuarioModel->obtenerDetallesUsuario($id_usuario);

    if (!$usuarioDetalles) {
        throw new Exception("No se encontraron detalles para el usuario logueado.");
    }
} catch (Exception $e) {
    die("Error al cargar los detalles del usuario: " . $e->getMessage());
}
?>

<div class="usuario-detalles">
    <h2>Detalles del Usuario</h2>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($usuarioDetalles['nombre']) ?></p>
    <p><strong>Apellidos:</strong> <?= htmlspecialchars($usuarioDetalles['apellidos']) ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($usuarioDetalles['correo']) ?></p>
    <p><strong>Provincia:</strong> <?= htmlspecialchars($usuarioDetalles['provincia']) ?></p>
    <p><strong>Dirección:</strong> <?= htmlspecialchars($usuarioDetalles['detalle_direccion']) ?></p>
    <p><strong>Tipo de Usuario:</strong> <?= htmlspecialchars($usuarioDetalles['tipo_usuario']) ?></p>
    <a href="/AmbienteWeb/sesion/editarUsuario.php" class="boton-verde">Editar Usuario</a>
</div>

<?php
require_once './views/layout/footer.php';
?>
