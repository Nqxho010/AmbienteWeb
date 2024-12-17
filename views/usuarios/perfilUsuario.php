<?php
$titulo = 'Perfil de Usuario';
require_once '../layout/head.php';
require_once '../layout/header.php';

require_once '../../model/db.php';
require_once '../../model/cliente.php';


if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];
$clienteModel = new Cliente($conn);

$infoUsuario = $clienteModel->obtenerInformacionCompletaUsuario($idUsuario);

if (!$infoUsuario) {
    die("Error: No se encontró información del usuario.");
}
?>

<div class="perfil-usuario">
    <h1 class="perfil-usuario__titulo">Mi Perfil</h1>
    <div class="perfil-usuario__info">
        <p><strong>Nombre:</strong> <?= htmlspecialchars($infoUsuario['nombre'] . ' ' . $infoUsuario['apellidos']) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($infoUsuario['correo']) ?></p>
        <p><strong>Tipo de Usuario:</strong> <?= htmlspecialchars($infoUsuario['tipo_usuario']) ?></p>
        <p><strong>Provincia:</strong> <?= htmlspecialchars($infoUsuario['provincia']) ?></p>
        <p><strong>Dirección:</strong> <?= htmlspecialchars($infoUsuario['detalle_direccion']) ?></p>
    </div>

    <div class="perfil-usuario__acciones">
        
        <div class="perfil-usuario__acciones">
            <a href="/AmbienteWeb/views/usuarios/editarPerfilUsuario.php" class="boton-verde">Editar Dirección</a>
            <?php if (isset($_SESSION['idTipoUsuario']) && $_SESSION['idTipoUsuario'] == 1): ?>
                <a class="boton-verde" href="/AmbienteWeb/views/usuarios/crearEmprendimiento.php">Volverse emprendedor</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once '../layout/footer.php';
?>
