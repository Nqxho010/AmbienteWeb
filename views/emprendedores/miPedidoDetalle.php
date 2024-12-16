<?php
require_once '../../model/db.php';
require_once '../../model/pedido.php';

$titulo = 'Detalles del Pedido - Administrador';
require_once '../layout/head.php';
require_once '../layout/header.php';

if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idEmprendimiento'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20los%20detalles");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: /AmbienteWeb/views/emprendimientos/pedidosEmprendimiento.php?error=Pedido%20no%20especificado");
    exit;
}

$idPedido = (int)$_GET['id'];

try {
    $pedidoModel = new Pedido($conn);

    // Obtener información del pedido
    $detallePedido = $pedidoModel->obtenerPedidoPorId($idPedido);

    if (!$detallePedido) {
        throw new Exception("No se encontró el pedido especificado.");
    }

    // Obtener los productos asociados al pedido
    $productosPedido = $pedidoModel->obtenerProductosDelPedido($idPedido);
} catch (Exception $e) {
    die("Error al cargar los detalles del pedido: " . $e->getMessage());
}
?>

<div class="detalle-pedido">
    <h1 class="detalle-pedido__titulo">Detalle del Pedido</h1>

    <div class="detalle-pedido__informacion">
        <p><strong>ID Pedido:</strong> <?= htmlspecialchars($detallePedido['id_pedido']) ?></p>
        <p><strong>Cliente:</strong> <?= htmlspecialchars($detallePedido['nombre_usuario']) ?></p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($detallePedido['fecha']) ?></p>
        <p><strong>Estado:</strong> <?= htmlspecialchars($detallePedido['estado_pedido']) ?></p>
    </div>

    <!-- Lógica para mostrar los botones de acción -->
    <div class="detalle-pedido__acciones">
        <?php if (strtolower($detallePedido['estado_pedido']) === 'activo') : ?>
            <form action="/AmbienteWeb/controller/cancelarPedido.php" method="POST" style="display:inline;">
                <input type="hidden" name="idPedido" value="<?= htmlspecialchars($detallePedido['id_pedido']) ?>">
                <button type="submit" class="boton-rojo">Cancelar Pedido</button>
            </form>
            <form action="/AmbienteWeb/controller/marcarPedidoEnviado.php" method="POST" style="display:inline;">
                <input type="hidden" name="idPedido" value="<?= htmlspecialchars($detallePedido['id_pedido']) ?>">
                <button type="submit" class="boton-verde">Marcar como Enviado</button>
            </form>
        <?php elseif (strtolower($detallePedido['estado_pedido']) === 'enviado') : ?>
            <form action="/AmbienteWeb/controller/marcarPedidoCompletado.php" method="POST" style="display:inline;">
                <input type="hidden" name="idPedido" value="<?= htmlspecialchars($detallePedido['id_pedido']) ?>">
                <button type="submit" class="boton-verde">Marcar como Completado</button>
            </form>
        <?php endif; ?>
    </div>

    <h2 class="detalle-pedido__subtitulo">Productos del Pedido</h2>

    <?php if (empty($productosPedido)) : ?>
        <p>Este pedido no tiene productos asociados.</p>
    <?php else : ?>
        <table class="detalle-pedido__tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalPedido = 0;
                foreach ($productosPedido as $producto) :
                    $totalPedido += $producto['total'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                        <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                        <td>₡<?= number_format($producto['precio_unitario'], 2) ?></td>
                        <td>₡<?= number_format($producto['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Total del Pedido:</td>
                    <td style="font-weight: bold;">₡<?= number_format($totalPedido, 2) ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once '../layout/footer.php';
?>
