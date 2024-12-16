<?php
require_once '../../model/db.php';
require_once '../../model/pedido.php';

$titulo = 'Pedidos de Emprendimiento';
require_once '../layout/head.php';
require_once '../layout/header.php';

// Verificación de usuario emprendedor
if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idEmprendimiento'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20los%20pedidos");
    exit;
}

$idEmprendimiento = $_SESSION['idEmprendimiento'];

try {
    $pedidoModel = new Pedido($conn);

    // Obtener los pedidos activos del emprendimiento
    $pedidosActivos = $pedidoModel->obtenerPedidosActivosPorEmprendimiento($idEmprendimiento);
} catch (Exception $e) {
    die("Error al cargar los pedidos: " . $e->getMessage());
}

// Mensajes de controladores
$mensajeExito = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
$mensajeError = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;

?>

<div class="pedidos-emprendimiento">
    <h1 class="pedidos-emprendimiento__titulo">Pedidos Activos del Emprendimiento</h1>

    <!-- Mensajes de controladores -->
    <?php if ($mensajeExito) : ?>
        <div class="alerta alerta-exito"><?= $mensajeExito ?></div>
    <?php endif; ?>
    <?php if ($mensajeError) : ?>
        <div class="alerta alerta-error"><?= $mensajeError ?></div>
    <?php endif; ?>

    <?php if (empty($pedidosActivos)) : ?>
        <p>No tienes pedidos activos.</p>
    <?php else : ?>
        <table class="pedidos-emprendimiento__tabla">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Nombre del Usuario</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidosActivos as $pedido) : ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido['id_pedido']) ?></td>
                        <td><?= htmlspecialchars($pedido['nombre_usuario'] . ' ' . $pedido['apellidos_usuario']) ?></td>
                        <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                        <td><?= htmlspecialchars($pedido['estado_pedido']) ?></td>
                        <td>
                            <a href="/AmbienteWeb/views/emprendedores/miPedidoDetalle.php?id=<?= htmlspecialchars($pedido['id_pedido']) ?>" class="boton-verde">Ver Detalles</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once '../layout/footer.php';
?>
