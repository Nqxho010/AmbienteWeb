<?php
require_once '../../model/db.php';
require_once '../../model/pedido.php';

$titulo = 'Pedidos Activos';
require_once '../layout/head.php';
require_once '../layout/header.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20sus%20pedidos");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];

try {
    $pedidoModel = new Pedido($conn);
    $pedidosActivos = $pedidoModel->obtenerPedidosActivosOEnviados($idUsuario);
} catch (Exception $e) {
    die("Error al cargar los pedidos: " . $e->getMessage());
}

// Captura de mensajes de controladores
$mensajeExito = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
$mensajeError = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;

?>

<div class="pedidos">
    <h1 class="pedidos__titulo">Pedidos Activos</h1>
    <a class="boton-verde" href="/AmbienteWeb/views/usuarios/historialUsuarioFinalizados.php">Ver pedidos finalizados</a>
    <!-- Mensajes de controladores -->
    <?php if ($mensajeExito) : ?>
        <div class="alerta alerta-exito"><?= $mensajeExito ?></div>
    <?php endif; ?>
    <?php if ($mensajeError) : ?>
        <div class="alerta alerta-error"><?= $mensajeError ?></div>
    <?php endif; ?>

    <?php if (empty($pedidosActivos)) : ?>
        <p style="margin-top: 50px;">No tienes pedidos activos. <a href="/AmbienteWeb/views/usuarios/productos.php" class="boton-verde">Explora productos</a>.</p>
    <?php else : ?>
        <table class="pedidos__tabla">
            <thead class="pedidos__thead">
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="pedidos__tbody">
                <?php foreach ($pedidosActivos as $pedido) : ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido['id_pedido']) ?></td>
                        <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                        <td><?= htmlspecialchars($pedido['estado_pedido']) ?></td>
                        <td>
                            <a href="/AmbienteWeb/views/usuarios/detallePedido.php?id=<?= htmlspecialchars($pedido['id_pedido']) ?>" class="boton-verde">Ver Detalles</a>
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
