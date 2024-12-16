<?php
require_once '../../model/db.php';
require_once '../../model/pedido.php';

$titulo = 'Pedidos Finalizados - Emprendedor';
require_once '../layout/head.php';
require_once '../layout/header.php';

if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idEmprendimiento'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20los%20pedidos");
    exit;
}

$idEmprendimiento = $_SESSION['idEmprendimiento'];

try {
    $pedidoModel = new Pedido($conn);

    // Obtener los pedidos finalizados del emprendimiento
    $pedidosFinalizados = $pedidoModel->obtenerPedidosFinalizadosPorEmprendimiento($idEmprendimiento);
} catch (Exception $e) {
    die("Error al cargar los pedidos: " . $e->getMessage());
}

// Mensajes de controladores
$mensajeExito = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
$mensajeError = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;

?>

<div class="pedidos-finalizados">
    <h1 class="pedidos-finalizados__titulo">Pedidos Finalizados</h1>

    <!-- Mensajes de controladores -->
    <?php if ($mensajeExito) : ?>
        <div class="alerta alerta-exito"><?= $mensajeExito ?></div>
    <?php endif; ?>
    <?php if ($mensajeError) : ?>
        <div class="alerta alerta-error"><?= $mensajeError ?></div>
    <?php endif; ?>

    <?php if (empty($pedidosFinalizados)) : ?>
        <p>No tienes pedidos finalizados. <a href="/AmbienteWeb/views/emprendedores/misPedidos.php" class="boton-verde">Explora productos</a>.</p>
    <?php else : ?>
        <table class="pedidos-finalizados__tabla">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidosFinalizados as $pedido) : ?>
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
